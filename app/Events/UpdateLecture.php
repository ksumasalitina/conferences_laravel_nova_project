<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateLecture
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $meeting, $lecture, $user, $time, $recipient;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($meeting, $lecture, $user, $time, $recipient)
    {
        $this->meeting = $meeting;
        $this->lecture = $lecture;
        $this->user = $user;
        $this->time = $time;
        $this->recipient = $recipient;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
