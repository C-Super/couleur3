<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InteractionSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $interaction;

    public function __construct(array $interaction)
    {
        $this->interaction = $interaction;
    }

    /**
     * Get the channel the event should broadcast on.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('interaction');
    }
}
