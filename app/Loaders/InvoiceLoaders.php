<?php

namespace App\Loaders;

use Ambengers\QueryFilter\AbstractQueryLoader;

class InvoiceLoaders extends AbstractQueryLoader
{
    protected $loadables = [
        'invoice_details'
    ];
}
