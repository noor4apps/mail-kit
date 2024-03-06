<?php

namespace Domain\Subscriber\ViewModels;

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

    /**
     * @return Collection<TagData>
     */
    public function tags(): Collection
    {
        // convert it to Collection of data object
        return Tag::all()->map->getData();
    }

    /**
     * @return Collection<FormData>
     */
    public function forms(): Collection
    {
        // convert it to Collection of data object
        return Form::all()->map->getData();
    }
}
