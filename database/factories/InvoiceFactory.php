<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Invoice::class;

    public function definition()
    {
        $mockParticipant = Participant::factory()->createOne();

        return [
            //
            'invoice_create_date' => Carbon::now(),
            'invoice_ref_id' => $this->faker->text(10),
            'total_billed' => $this->faker->numerify("######"),
            'participant_id' => $mockParticipant->id,
        ];
    }
}
