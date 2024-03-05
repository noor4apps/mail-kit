<?php

use Domain\Mail\Models\Sequence\Sequence;
use Domain\Subscriber\Models\Subscriber;
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
        Schema::create('sequence_subscriber', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sequence::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Subscriber::class)->constrained()->cascadeOnDelete();
            $table->dateTime('subscribed_at')->useCurrent();
            $table->string('status')->nullable()->default(null);

            $table->unique(['sequence_id', 'subscriber_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequence_subscriber');
    }
};
