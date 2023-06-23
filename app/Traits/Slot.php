<?php

namespace App\Traits;

use App\Models\Meeting;

trait Slot
{
    public function deleteSlot($meetingId, $slotId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        return $meeting->slots()->detach($slotId);
    }

    public function insertSlot($meetingId, $slotId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        return $meeting->slots()->attach($slotId);
    }
}
