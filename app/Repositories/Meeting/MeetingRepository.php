<?php

namespace App\Repositories\Meeting;
use App\Events\JoinListener;
use App\Http\Requests\MeetingRequest;
use App\Models\Country;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MeetingRepository implements MeetingRepositoryInterface
{
    public function getAllMeetings()
    {
        /** @var Collection<Meeting> $meetings */
        $meetings = Meeting::select(['id','title','date'])->latest()->paginate(15);

        foreach ($meetings as $meeting) {
            $meeting->setAttribute('is_joined', $meeting->isJoined());
        }

        return $meetings;
    }

    public function getMeetingsByFilter(Request $request)
    {
        $query = Meeting::query()->select(['id','title','date'])->where('date','>=', date('Y-m-d'));
        if($request->filled('category'))
            $query = $query->categoryFilter($request['category']);
        if($request->filled('first_date'))
            $query = $query->firstDateFilter($request['first_date']);
        if ($request->filled('last_date'))
            $query = $query->lastDateFilter($request['last_date']);
        if ($request->filled('lectures'))
            $query = $query->lecturesFilter($request['lectures']);

        $meetings = $query->paginate(15);
        foreach ($meetings as $meeting) {
            $meeting->is_joined = $meeting->isJoined();
        }
        return $meetings;
    }

    public function searchMeeting(Request $request): Collection
    {
        $query = Meeting::query()->select('id','title')->where('date','>=', date('Y-m-d'));
        if($request->filled('title'))
            $query = $query->search($request['title']);

        return $query->get();
    }

    public function getMeetingById($id): Meeting
    {
        /** @var Meeting $meeting */
        $meeting = Meeting::findOrFail($id);
        $meeting->setAttribute('category', $meeting->category);
        return $meeting;
    }

    public function deleteMeeting($id): int
    {
        return Meeting::destroy($id);
    }

    public function createMeeting(MeetingRequest $meetingRequest): Meeting
    {
        $meetingRequest['date'] = date('Y/m/d H:i', strtotime($meetingRequest['date']));

        return Meeting::create($meetingRequest->all());
    }

    public function updateMeeting($id, MeetingRequest $meetingRequest): int
    {
        $meetingRequest['date'] = date('Y/m/d H:i', strtotime($meetingRequest['date']));

        $data = $meetingRequest->only([
            'title',
            'country',
            'date',
            'latitude',
            'longitude'
        ]);

        return Meeting::whereId($id)->update($data);
    }

    public function getCountries(): Collection
    {
        return Country::query()->select('name')->get();
    }

    public function sendNewListenerEmail($meeting, $user): void
    {
        $listener = User::findOrFail($user);
        $announcers = array_column($meeting->subscribers->toArray(),'id');
        $recipient = User::query()->select('email')->whereIn('id',$announcers)
            ->whereHas('role', function ($q) {
                $q->where('name','announcer');})->get();

        event(new JoinListener($meeting, $listener, $recipient));
    }

    public function join($id): bool
    {
        $meeting = Meeting::findOrFail($id);
        $user = User::findOrFail(auth('sanctum')->id());
        $check = true;

        if($user->monthly_joins >= 1) {
            if($user->plan_id == 1){
                $check = false;
            } elseif ($user->plan_id == 2) {
                if($user->montly_joins >= 5) {
                    return false;
                }
            } elseif ($user->plan_id == 3) {
                if($user->montly_joins >= 50) {
                    return false;
                }
            }
        }
        if($check) {
            $this->sendNewListenerEmail($meeting, $user->id);
            User::query()->where('id',$user->id)->update(['monthly_joins'=>$user->monthly_joins+1]);
            $meeting->subscribers()->attach($user->id);
        }
    }

    public function cancel($id): void
    {
        $meeting = Meeting::findOrFail($id);

        $meeting->subscribers()->detach(auth()->user()->id);
    }
}
