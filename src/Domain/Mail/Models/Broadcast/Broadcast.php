<?php

namespace Domain\Mail\Models\Broadcast;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\Broadcast\BroadcastData;
use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Mail\Models\Casts\FiltersCast;
use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\LaravelData\WithData;

class Broadcast extends BaseModel implements Sendable
{
    use WithData;
    use HasUser;

    protected $dataClass = BroadcastData::class;

    protected $fillable = [
        'id',
        'subject',
        'content',
        'status',
        'filters',
        'sent_at',
        'user_id',
    ];

    protected $casts = [
        'filters' => FiltersCast::class,
        'status' => BroadcastStatus::class,
    ];

    protected $attributes = [
        'status' => BroadcastStatus::Draft,
    ];

    public function sent_mails(): MorphMany
    {
        return $this->morphMany(SentMail::class, 'sendable');
    }

    public function markAsSent(): void
    {
        $this->status = BroadcastStatus::Sent;
        $this->sent_at = now();
        $this->save();
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
