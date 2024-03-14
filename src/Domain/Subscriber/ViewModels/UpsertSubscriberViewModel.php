<?php

namespace Domain\Subscriber\ViewModels;

use Domain\Shared\ViewModels\Concerns\HasForms;
use Domain\Shared\ViewModels\Concerns\HasTags;
use Domain\Shared\ViewModels\ViewModel;
use Domain\Subscriber\DataTransferObjects\FormData;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\DataTransferObjects\TagData;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;
use Illuminate\Support\Collection;

class UpsertSubscriberViewModel extends ViewModel
{
    use HasTags;
    use HasForms;

    public function __construct(public readonly ?Subscriber $subscriber = null)
    {
    }

    public function subscriber(): ?SubscriberData
    {
        if (!$this->subscriber) {
            return null;
        }

        // convert it to a data object
        return $this->subscriber->load('tags', 'form')->getData();
    }
}
