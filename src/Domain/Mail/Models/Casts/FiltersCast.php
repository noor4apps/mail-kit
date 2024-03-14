<?php

namespace Domain\Mail\Models\Casts;

use Domain\Mail\DataTransferObjects\FilterData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class FiltersCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $filterArray = json_decode($value, true);

        return $filterArray ?
            FilterData::from($filterArray) :
            FilterData::from(FilterData::empty());
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return [
            'filters' => json_encode($value)
        ];
    }
}
