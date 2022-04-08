<?php


namespace App\Filters\Participants;


use Illuminate\Database\Eloquent\Builder;

class Gender
{
    /**
     * Handle the filtering.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  string|null  $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(Builder $builder, $value = null)
    {
        return ! $value
            ? $builder
            : $builder->where('gender', $value);
    }
}
