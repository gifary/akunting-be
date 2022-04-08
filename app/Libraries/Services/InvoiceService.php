<?php

namespace App\Libraries\Services;

use App\Models\Participant;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Libraries\Contracts\InvoiceServiceInterface;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class InvoiceService implements InvoiceServiceInterface
{

    public function createInvoice()
    {
        // TODO: Implement createInvoice() method.

        try {
            $currentDate = Carbon::now()->setTimezone('Asia/Jakarta');
            $allDueParticipants = Participant::dueToday()->get();
            if ($allDueParticipants != null) {
                foreach ($allDueParticipants as $dueParticipant) {
                    $totalAmountBilled = 0;
                    $newInvoice = Invoice::create([
                        'participant_id' => $dueParticipant->id,
                        'total_billed' => 0,
                        'invoice_create_date' => $currentDate->format('y-m-d'),
                        'invoice_ref_id' => 'STS-INV' . $currentDate->format('shymd'),
                    ]);

                    foreach ($dueParticipant->classes as $activeClass) {
                        InvoiceDetail::create([
                            'invoices_id' => $newInvoice->id,
                            'is_reduction' => 0,
                            'detail_transaction' => $activeClass->name . '-' . $activeClass->period,
                            'detail_amount' => $activeClass->price,
                        ]);

                        $totalAmountBilled = $totalAmountBilled + $activeClass->price;
                    }

                    Invoice::find($newInvoice->id)->update([
                        'total_billed' => $totalAmountBilled,
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            Log::error("Error Creating Invoice");
            return false;
        }
    }
}
