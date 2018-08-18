<?php

namespace App\Events;
use Illuminate\Support\Facades\Log;

use App\Models\PostComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Comments implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $PostComment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($PostComment)
    {
        $this->PostComment = $PostComment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::error(print_r($this->PostComment,true));
        return new PrivateChannel('comment');
    }
    // public function broadcastWith() {
    //     return [
    //       'description' => $this->post->description,
    //     ];
    //   }
}
