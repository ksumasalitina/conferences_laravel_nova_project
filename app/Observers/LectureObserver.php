<?php

namespace App\Observers;

use App\Http\Requests\ZoomRequest;
use App\Models\Lecture;
use App\Models\Meeting;
use App\Models\Slot;
use App\Models\Zoom;
use App\Traits\Email;
use App\Traits\ZoomJWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class LectureObserver
{
    use ZoomJWT;
    use Email;
    use \App\Traits\Slot;

    /**
     * Handle the Lecture "creating" event.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return void
     */
    public function creating(Lecture $lecture)
    {
        //Upload presentation
        if(request()->filled('presentation')){
            $fileName = time().'.'.request()->presentation->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('presentations', request()->presentation,$fileName);
            $lecture->presentation = $fileName;
        }

        //Create zoom meeting
        if(request()->filled('zoom')){
            $date = Meeting::query()->select('date')->whereId(request()->meeting_id)->first();
            $date = date('Y-m-d', $date->date);
            $time = Slot::query()->select('start')->whereId(request()->slot_id)->first();
            $start_time = $date . 'T' . $time->start;

            $zoom = $this->createZoom(new ZoomRequest(['topic'=>request()->theme, 'start_time'=>$start_time]));
            $lecture->zoom_id = $zoom['data']['id'];
            Zoom::query()->create($zoom['data']);
            Cache::forget('zoom');
        }

        //Set slot
        $this->deleteSlot($lecture->meeting_id, $lecture->slot_id);
    }

    /**
     * Handle the Lecture "created" event.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return void
     */
    public function created(Lecture $lecture)
    {
        //Set category
        $lecture->category()->attach(request()->category);

        //Send email notification
        $this->newLectureEmail($lecture);
    }

    /**
     * Handle the Lecture "updated" event.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return void
     */
    public function updating(Lecture $lecture)
    {
        Storage::disk('local')->delete('presentations/'.$lecture->presentation);
        $fileName = time().'.'.request()->presentation->getClientOriginalExtension();
        Storage::disk('local')->putFileAs('presentations', request()->presentation,$fileName);
        $lecture->presentation = $fileName;

        if($lecture->slot_id != request()->slot_id) {
            $this->insertSlot($lecture->meeting_id, $lecture->slot_id);
            $this->deleteSlot($lecture->meeting_id, request()->slot_id);

            $this->updateLectureEmail($lecture, request()->slot_id);

            if ($lecture->zoom_id) {
                $meeting_date = Meeting::query()->select('date')->whereId(request()->meeting_id)->first();
                $date = date('Y-m-d', $meeting_date->date);
                $time = Slot::query()->select('start')->whereId(request()->slot_id)->first();
                $start_time = $date . 'T' . $time->start;
                Cache::forget('zoom');

                $this->updateZoom(new ZoomRequest(['topic' => request()->theme, 'start_time' => $start_time]), $lecture->zoom_id);
            }
        }

        $lecture->category()->detach($lecture->category);
        $lecture->category()->attach(request()->category);
    }

    /**
     * Handle the Lecture "deleted" event.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return void
     */
    public function deleting(Lecture $lecture)
    {
        if($lecture->zoom_id){
            $this->deleteZoom($lecture->zoom_id);
            Zoom::destroy($lecture->zoom_id);
            Cache::forget('zoom');
        }

        Storage::disk('local')->delete('presentations/'.$lecture->presentation);

        $this->insertSlot($lecture->meeting_id,$lecture->slot_id);

        $this->deleteLectureEmail($lecture);
    }

    /**
     * Handle the Lecture "restored" event.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return void
     */
    public function restored(Lecture $lecture)
    {
        //
    }

    /**
     * Handle the Lecture "force deleted" event.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return void
     */
    public function forceDeleted(Lecture $lecture)
    {
        //
    }
}
