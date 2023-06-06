<?php

namespace App\Events;

use App\Models\Interaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InteractionEndedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $interaction;

    /**
     * Create a new event instance.
     */
    public function __construct(Interaction $interaction)
    {
        $this->interaction = $interaction;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public');
    }
}
