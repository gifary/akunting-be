<?php

namespace App\Filters\Invoices;

use Illuminate\Database\Eloquent\Builder;

class Participants
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
        $value = explode(',', $value);
        return ! $value
            ? $builder
            : $builder->whereHas('participants',function ($query) use($value) {
                $query->whereIn('id',$value);
            });
    }
}
