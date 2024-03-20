<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Builders\Sequence\SequenceMailBuilder;
use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Mail\Enums\Sequence\SequenceMailStatus;
use Domain\Mail\Models\Casts\FiltersCast;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

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

    public function newEloquentBuilder($query): SequenceMailBuilder
    {
        return new SequenceMailBuilder($query);
    }

    public function schedule(): HasOne
    {
        return $this->hasOne(SequenceMailSchedule::class);
    }

    public function sequence(): BelongsTo
    {
        return $this->belongsTo(Sequence::class);
    }

    public function sent_mails(): MorphMany
    {
        return $this->morphMany(SentMail::class, 'sendable');
    }

    public function shouldSendToday(): bool
    {
        $dayName = Str::lower(now()->dayName);

        return $this->schedule->allowed_days->{$dayName};
    }

    public function enoughTimePassedSince(SentMail $mail): bool
    {
        return $this->schedule->unit->timePassedSince($mail->sent_at) >= $this->schedule->delay;
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

    public function filters(): FilterData
    {
        return $this->filters;
    }
}
