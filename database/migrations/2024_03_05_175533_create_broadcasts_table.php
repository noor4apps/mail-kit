<?php

use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Shared\Models\User;
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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('subject')->nullable(false);
            $table->text('content')->nullable(false);
            $table->json('filters')->nullable(true);
            $table->string('status')->default(BroadcastStatus::Draft->value);
            $table->dateTime('sent_at')->nullable(true);
            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};
