<?php

namespace Domain\Mail\Builders\Sequence;

use Illuminate\Database\Eloquent\Builder;

class SequenceBuilder extends Builder
{
    public function activeSubscriberCount(): int
    {
        return $this->model
            ->subscribers()
            ->whereNotNull('status')
            ->count();
    }
}
