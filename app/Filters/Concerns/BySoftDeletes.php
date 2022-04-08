<?php

namespace App\Filters\Concerns;

trait BySoftDeletes
{
    /**
     * Include soft deleted rows.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function withTrashed()
    {
        return $this->builder->withTrashed();
    }

    /**
     * Filter by non soft deleted rows.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function withoutTrashed()
    {
        return $this->builder->withoutTrashed();
    }

    /**
     * Filter by only soft deleted rows.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function onlyTrashed()
    {
        return $this->builder->onlyTrashed();
    }
}
