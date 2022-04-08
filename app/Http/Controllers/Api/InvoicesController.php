<?php

namespace App\Http\Controllers\Api;

use App\Filters\InvoiceFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InvoicesRequest;
use App\Http\Resources\InvoiceResource;
use App\Loaders\InvoiceLoaders;
use App\Models\Invoice;

class InvoicesController extends Controller
{
    public function index(InvoiceFilters $filters)
    {
        $invoices = Invoice::filter($filters);

        return InvoiceResource::collection($invoices);
    }

    public function show($id, InvoiceLoaders $loaders)
    {
        $invoice = Invoice::findOrFail($id);

        return new InvoiceResource($invoice->filter($loaders));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->delete();

        return response()->json([], 204);
    }

    public function restore($id)
    {
        $invoice = Invoice::withTrashed()->where('id',$id)->restore();

        return response()->json([], 204);
    }
}
