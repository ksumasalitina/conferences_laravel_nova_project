<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Zoom;
use App\Traits\ZoomJWT;
use App\Http\Requests\ZoomRequest;
use Illuminate\Support\Facades\Cache;

class ZoomController extends Controller
{
    use ZoomJWT;

    const MEETING_TYPE_SCHEDULE = 2;

    public function list()
    {
        $path = 'users/me/meetings';
        $response = $this->zoomGet($path);

        $data = json_decode($response->body(), true);

        $data['meetings'] = array_map(function ($m) {
            $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
            return $m;
        }, $data['meetings']);

        $data['meetings'] = array_map(function ($m) {
            $lecture = Lecture::query()->where('zoom_id',$m['id'])->first();
            if($lecture) $m['lecture_id'] = $lecture->id;
            return $m;
        }, $data['meetings']);

        $list = Cache::remember('zoom', 86400, function () use ($data){
            return $data;
        });

        return [
            'success' => $response->ok(),
            'data' => $list,
        ];
    }

    public function create(ZoomRequest $request)
    {
        return $this->createZoom($request);
    }

    public function get($id)
    {
        return $this->getZoom($id);
    }

    public function update(ZoomRequest $request, $id)
    {
        return $this->updateZoom($request, $id);
    }

    public function delete($id)
    {
        return $this->deleteZoom($id);
    }
}
