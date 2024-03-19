<?php

namespace Domain\Mail\Enums\Sequence;

use Carbon\Carbon;

enum SequenceMailUnit: string
{
    case Day = 'day';
    case Hour = 'hour';
}
