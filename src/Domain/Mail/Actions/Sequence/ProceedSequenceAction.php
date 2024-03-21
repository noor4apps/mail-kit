<?php

namespace Domain\Mail\Actions\Sequence;

use Domain\Mail\Enums\Sequence\SubscriberStatus;
use Domain\Mail\Mails\EchoMail;
use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Mail\Models\Sequence\SequenceSubscriber;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class ProceedSequenceAction
{
    public static function execute(Sequence $sequence): int
    {
        $sentMailCount = 0;

        foreach ($sequence->mails()->wherePublished()->get() as $mail) {
            $subscribers = self::subscribers($mail);

            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber)->queue(new EchoMail($mail));

                $mail->sent_mails()->create([
                    'subscriber_id' => $subscriber->id,
                    'user_id' => $sequence->user->id,
                ]);
            }

            self::markAsInProgress($sequence, $subscribers);

            $sentMailCount += $subscribers->count();
        }

        return $sentMailCount;
    }

    private static function subscribers(SequenceMail $mail): Collection
    {
        if (!$mail->shouldSendToday()) {
            return collect([]);
        }

        return $mail->audience()
            ->reject->alreadyReceived($mail)
            ->reject->tooEarlyFor($mail);
    }

    /**
     * @param Sequence $sequence
     * @param Collection<Subscriber> $subscribers
     */
    private static function markAsInProgress(Sequence $sequence, Collection $subscribers): void
    {
        SequenceSubscriber::query()
            ->whereBelongsTo($sequence)
            ->whereIn('subscriber_id', $subscribers->pluck('id'))
            ->update([
                'status' => SubscriberStatus::InProgress,
            ]);
    }
}
