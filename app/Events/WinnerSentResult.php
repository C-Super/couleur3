<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WinnerSentResult
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $auditorId;

    /**
     * Create a new event instance.
     */
    public function __construct($auditorId)
    {
        $this->auditorId = $auditorId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('interactions.auditor. '.$this->auditorId.'.winner'),
        ];
    }
}
