<?php

namespace App\Filters;

use Ambengers\QueryFilter\AbstractQueryFilter;
use App\Filters\Concerns\BySoftDeletes;
use App\Loaders\InvoiceLoaders;
use App\Filters\Invoices\Participants;


class InvoiceFilters extends AbstractQueryFilter
{
    use BySoftDeletes;
    /**
     * Relationship loader class.
     *
     * @var string
     */
    protected $loader = InvoiceLoaders::class;

    /**
     * Columns that are searchable.
     *
     * @var array
     */
    protected $searchableColumns = [
        'invoice_create_date',
        'total_billed',
        'invoice_ref_id',
    ];

    /**
     * List of object filters.
     *
     * @var array
     */
    protected $filters = [
        'participant' => Participants::class
    ];
}
