<?php

use App\Enums\InteractionType;
use App\Enums\InteractionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', InteractionType::getValues());
            $table->foreignId('call_to_action_id')->nullable()->constrained();
            $table->timestamps();
            $table->timestamp('ended_at')->nullable();
            $table->foreignId('animator_id')->constrained();
            $table->foreignId('reward_id')->constrained();
            $table->integer('winners_count')->nullable();
            $table->enum('status', InteractionStatus::getValues())->default(InteractionStatus::PENDING->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
