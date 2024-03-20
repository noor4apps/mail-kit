<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Subscriber\Actions\FilterSubscribersAction;
use Illuminate\Support\Collection;

class ProceedSequenceAction
{
    public static function execute(Sequence $sequence): int
    {
        foreach ($sequence->mails()->wherePublished()->get() as $mail) {
            $subscribers = self::subscribers($mail);

            // ...
        }
    }

    private static function subscribers(SequenceMail $mail): Collection
    {
        if (!$mail->shouldSendToday()) {
            return collect([]);
        }

        return FilterSubscribersAction::execute($mail)
            ->reject->alreadyReceived($mail)
            ->reject->tooEarlyFor($mail);
    }
}
