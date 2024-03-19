<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\Models\Sequence\Sequence;
use Illuminate\Support\Facades\DB;

class DeleteSequenceAction
{
    public static function execute(Sequence $sequence): void
    {
        DB::transaction(function () use ($sequence) {
            $sequence->mails()->delete();

            $sequence->delete();
        });
    }
}
