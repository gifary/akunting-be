<?php

namespace BusinessLogic;

use App\Models\Classes;
use App\Models\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Libraries\Contracts\InvoiceServiceInterface;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    protected $invoiceService;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->apiSignIn();

        $this->withoutExceptionHandling();

        $this->invoiceService = $this->app->make(InvoiceServiceInterface::class);
    }

    /** @test  */
    public function can_create_invoice() {
        $mockClasses = Classes::factory()
                        ->count(3)
                        ->create();
        Participant::factory()
            ->count(5)
            ->hasAttached($mockClasses)
            ->create();

        $result = $this->invoiceService->createInvoice();
        $this->assertEquals(true,$result,"Success Create Invoice for All Due Participants");
    }
}