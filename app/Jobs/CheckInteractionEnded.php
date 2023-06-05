<?php

namespace App\Jobs;

use App\Events\InteractionEndedEvent;
use App\Events\InteractionEndedForAnimatorEvent;
use App\Models\Interaction;
use App\Models\Reward;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckInteractionEnded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $interaction;

    /**
     * Create a new job instance.
     */
    public function __construct(Interaction $interaction)
    {
        $this->interaction = $interaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->interaction->refresh();

        if ($this->interaction->status != 'stopped' && $this->interaction->ended_at <= now()) {
            // Collect all answers
            $answers = $this->interaction->answers()->with('auditor')->get();

            // Update the interaction status
            $this->interaction->update(['status' => 'stopped']);

            // Get the rewards
            $rewards = Reward::all();

            // Trigger the InteractionEnded event for the auditors
            event(new InteractionEndedEvent($this->interaction));

            // Trigger the InteractionEndedForAnimator event for the animator
            event(new InteractionEndedForAnimatorEvent($this->interaction, $answers, $rewards));
        }
    }
}
