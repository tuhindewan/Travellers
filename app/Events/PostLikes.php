<?php

namespace App\Events;
use Illuminate\Support\Facades\Log;

use App\Models\PostLike;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostLikes implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $postLike;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($postLike)
    {
        $this->postLike = $postLike;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::error(print_r($this->postLike,true));
        return new PrivateChannel('postLike');
    }
    
}
