<?php

namespace App\Events;

use App\Models\Reward;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WinnerSentResult implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $auditorId;

    public $reward;

    /**
     * Create a new event instance.
     */
    public function __construct($auditorId, Reward $reward)
    {
        $this->auditorId = $auditorId;
        $this->reward = $reward;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('auditors.' . $this->auditorId);
    }
}
