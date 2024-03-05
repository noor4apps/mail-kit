<?php

use Domain\Mail\Models\Sequence\SequenceMail;
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
        Schema::create('sequence_mail_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SequenceMail::class)->constrained()->cascadeOnDelete();
            $table->integer('delay');
            $table->string('unit');
            $table->json('allowed_days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequence_mail_schedules');
    }
};
