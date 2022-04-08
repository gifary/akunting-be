<?php

namespace App\Filters;

use Ambengers\QueryFilter\AbstractQueryFilter;
use App\Filters\Concerns\BySoftDeletes;
use App\Filters\Payments\Invoices;
use App\Loaders\PaymentLoaders;


class PaymentFilters extends AbstractQueryFilter
{
    use BySoftDeletes;
    /**
     * Relationship loader class.
     *
     * @var string
     */
    protected $loader = PaymentLoaders::class;

    /**
     * Columns that are searchable.
     *
     * @var array
     */
    protected $searchableColumns = [
        'transaction_date',
        'source',
        'invoice_id',
        'is_validated'
    ];

    /**
     * List of object filters.
     *
     * @var array
     */
    protected $filters = [
        'invoices' => Invoices::class
    ];
}
