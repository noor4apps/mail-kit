<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Automation\Enums\Actions;
use Domain\Automation\Models\AutomationStep;
use Domain\Mail\Models\Sequence\Sequence;
use Illuminate\Support\Facades\DB;

class DeleteSequenceAction
{
    public static function execute(Sequence $sequence): void
    {
        DB::transaction(function () use ($sequence) {
            $sequence->mails()->delete();

            AutomationStep::query()
                ->whereName(Actions::AddToSequence)
                ->where('value->id', $sequence->id)
                ->delete();

            $sequence->delete();
        });
    }
}
