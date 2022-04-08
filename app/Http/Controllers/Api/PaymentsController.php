<?php

namespace App\Http\Controllers\Api;

use App\Filters\PaymentFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Loaders\PaymentLoaders;
use App\Models\Payment;

class PaymentsController extends Controller
{
    public function index(PaymentFilters $filters)
    {
        $payments = Payment::filter($filters);

        return PaymentResource::collection($payments);
    }

    public function show($id, PaymentLoaders $loaders)
    {
        $payment = Payment::findorFail($id);

        return new PaymentResource($payment->filter($loaders));
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->delete();

        return response()->json([], 204);
    }

    public function restore($id)
    {
        $payment = Payment::withTrashed()->where('id',$id)->restore();

        return response()->json([], 204);
    }

    public function store(PaymentRequest $request)
    {
        return new PaymentResource($request->persist());
    }

    public function update(PaymentRequest $request, $id)
    {
        $payment = Payment::findOrFail($id);

        return new PaymentResource($request->persist($payment));
    }
}
