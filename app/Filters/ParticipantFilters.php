<?php


namespace App\Filters;


use Ambengers\QueryFilter\AbstractQueryFilter;
use App\Filters\Concerns\BySoftDeletes;
use App\Filters\Participants\Classes;
use App\Filters\Participants\Gender;
use App\Loaders\ParticipantLoaders;

class ParticipantFilters extends AbstractQueryFilter
{
    use BySoftDeletes;

    protected $loader = ParticipantLoaders::class;

    /**
     * Columns that are searchable.
     *
     * @var array
     */
    protected $searchableColumns = [
        'name',
        'email',
        'nip',
        'phone',
    ];

    /**
     * List of object filters.
     *
     * @var array
     */
    protected $filters = [
        'gender' => Gender::class,
        'classes' => Classes::class,
    ];
}
