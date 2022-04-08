<?php


namespace App\Filters;


use Ambengers\QueryFilter\AbstractQueryFilter;
use App\Filters\Concerns\BySoftDeletes;
use App\Loaders\ClassLoaders;

class ClassFilters extends AbstractQueryFilter
{
    use BySoftDeletes;

    protected $loader = ClassLoaders::class;

    /**
     * Columns that are searchable.
     *
     * @var array
     */
    protected $searchableColumns = [
        'name',
        'period'
    ];

    /**
     * List of object filters.
     *
     * @var array
     */
    protected $filters = [
        //
    ];
}
