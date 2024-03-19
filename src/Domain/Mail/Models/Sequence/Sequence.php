<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\DataTransferObjects\Sequence\SequenceData;
use Domain\Mail\Enums\Sequence\SequenceStatus;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Sequence extends BaseModel
{
    use HasUser;
    use WithData;

    protected $dataClass = SequenceData::class;

    protected $fillable = [
        'title',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => SequenceStatus::class,
    ];

    protected $attributes = [
        'status' => SequenceStatus::Draft,
    ];

    public function mails(): HasMany
    {
        return $this->hasMany(SequenceMail::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class)->withPivot(['subscribed_at', 'status']);
    }

}
