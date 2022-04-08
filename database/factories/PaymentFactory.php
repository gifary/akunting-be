<?php
namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory {
    protected $model = Payment::class;

    public function definition()
    {
        // TODO: Implement definition() method.

        $invoice = Invoice::factory()->createOne();

        return [
            'transaction_date' => Carbon::now()->format('Y-m-d H:i:s.u'),
            'source' => $this->faker->text(10),
            'is_validated' => $this->faker->boolean(70),
            'invoice_id' => $invoice->id,
        ];
    }
}
