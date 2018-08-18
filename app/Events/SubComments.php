<?php

namespace App\Events;
use Illuminate\Support\Facades\Log;

use App\Models\PostSubComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SubComments implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $subComment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($subComment)
    {
        $this->subComment = $subComment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::error(print_r($this->subComment,true));
        return new PrivateChannel('subComment');
    }

}
