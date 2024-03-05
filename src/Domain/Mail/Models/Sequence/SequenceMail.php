<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Enums\Sequence\SequenceMailStatus;
use Domain\Mail\Models\Casts\FiltersCast;
use Domain\Shared\Models\BaseModel;

class SequenceMail extends BaseModel
{
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
    ];

    protected $attributes = [
        'status' => SequenceMailStatus::Draft,
    ];
}
