<?php

namespace Domain\Shared\ViewModels;

use Domain\Shared\Models\User;
use Domain\Subscriber\DataTransferObjects\NewSubscribersCountData;
use Domain\Shared\Filters\DateFilter;
use Domain\Subscriber\Models\Subscriber;

class GetDashboardViewModel extends ViewModel
{
    public function __construct(private readonly User $user)
    {
    }

    public function newSubscribersCount(): NewSubscribersCountData
    {
        return new NewSubscribersCountData(
            total: Subscriber::count(),
            this_month: Subscriber::whereSubscribedBetween(DateFilter::thisMonth())->count(),
            this_week: Subscriber::whereSubscribedBetween(DateFilter::thisWeek())->count(),
            today: Subscriber::whereSubscribedBetween(DateFilter::today())->count(),
        );
    }

}
