<?php

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Spatie\LaravelData\WithData;

class Form extends BaseModel
{
    use WithData;
    use HasUser;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

}
