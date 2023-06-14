<?php

namespace App\Events;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnswerSubmitedToAnimator
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Answer $answer;

    /**
     * Create a new event instance.
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('interactions.' . $this->answer->interaction_id);
    }
}
