<?php

namespace App\Console\Commands;

use App\Libraries\Contracts\InvoiceServiceInterface;
use Illuminate\Console\Command;

class GenerateInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Invoice Based on Current Billing Cycle';

    /**
     * The Dependency Injection Variable.
     *
     * @var string
     */
    protected $logicCommand;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InvoiceServiceInterface $invoiceService)
    {
        parent::__construct();

        $this->logicCommand = $invoiceService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Memulai Proses Perhitungan Invoice");
        $this->info("Billing Cycle :" . Carbon::now()->day);
        $this->logicCommand->createInvoice();
        return 0;
    }
}
