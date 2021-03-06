<?php

namespace Tests\Feature\Api;

use App\Libraries\Contracts\InvoiceServiceInterface;
use App\Models\Classes;
use App\Models\Invoice;
use App\Models\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoicesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->apiSignIn();

        $this->withoutExceptionHandling();

        $this->invoiceService = $this->app->make(InvoiceServiceInterface::class);
    }

    /** @test */
    public function can_get_list_of_invoices()
    {
        $mockClasses = Classes::factory()
            ->count(1)
            ->create();
        Participant::factory()
            ->count(5)
            ->hasAttached($mockClasses)
            ->create();

        $result = $this->invoiceService->createInvoice();

        $response = $this->getJson(route('api.invoices.index'));

        $response->assertStatus(200)->assertJson([
            'data' => true
        ]);

    }


}
