<?php

namespace App\Events;
use Illuminate\Support\Facades\Log;

use App\Models\PostCommentLike;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentLike implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $commentLike;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($commentLike)
    {
        $this->commentLike = $commentLike;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::error(print_r($this->commentLike,true));
        return new PrivateChannel('commentLike');
    }
    // public function broadcastWith() {
    //     return [
    //       'description' => $this->post->description,
    //     ];
    //   }
}
