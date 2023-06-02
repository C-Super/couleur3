<?php

namespace App\Jobs;

use App\Models\Interaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Inertia\Inertia;

class CheckInteractionEnded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $interaction;

    /**
     * Create a new job instance.
     *
     * @return void
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
        if ($this->interaction->ended_at <= now()) {
            dump('Interaction ended at ' . $this->interaction->ended_at);
            // Collect all answers
            $answers = $this->interaction->answers()->with('auditor')->get();

            // Return Inertia response with the interaction and its answers
            return Inertia::render('InteractionEnd', [
                'interaction' => $this->interaction,
                'answers' => $answers,
            ]);
        }
    }
}
