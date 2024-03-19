<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\Enums\Sequence\SequenceMailStatus;
use Domain\Mail\Models\Casts\FiltersCast;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SequenceMail extends BaseModel implements Sendable
{
    use HasUser;

    protected $fillable = [
        'sequence_id',
        'sequence_mail_schedule_id',
        'subject',
        'content',
        'status',
        'filters',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => SequenceMailStatus::class,
        'filters' => FiltersCast::class,
    ];

    protected $attributes = [
        'status' => SequenceMailStatus::Draft,
    ];

    public function schedule(): HasOne
    {
        return $this->hasOne(SequenceMailSchedule::class);
    }

    public function sequence(): BelongsTo
    {
        return $this->belongsTo(Sequence::class);
    }

    // -------- Sendable --------

    public function id(): int
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this::class;
    }

    public function subject(): string
    {
        return $this->subject;
    }

    public function content(): string
    {
        return $this->content;
    }
}
