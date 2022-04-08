<?php

namespace App\Http\Requests\Api;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transaction_date' => ['required'],
            'source' => ['required'],
            'is_validated' => ['required','boolean'],
            'invoice_id' => ['nullable', Rule::exists('invoices', 'id')]
        ];
    }

    public function persist(Payment $paymentData = null)
    {
        $payment = $paymentData ?? new Payment;

        $payment->transaction_date = $this->transaction_date;
        $payment->source = $this->source;
        $payment->is_validated = $this->is_validated;
        $payment->invoice_id = $this->invoice_id;

        $payment->save();

        return $payment;
    }
}
