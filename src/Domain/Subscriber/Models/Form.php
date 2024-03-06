<?php

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;

class Form extends BaseModel
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

}
