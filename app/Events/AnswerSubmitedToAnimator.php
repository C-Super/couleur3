<?php

namespace App\Events;

use App\Models\Answer;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnswerSubmitedToAnimator
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    /**
     * @var \App\Models\Answer
     */
    public $answer;

    /**
     * Create a new event instance.
     * @param \App\Models\Answer $answer
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
        $this->user = $answer->auditor->user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('answers.animator.' . $this->answer->auditor_id);
    }
}
