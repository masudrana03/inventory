<?php

namespace App\Services;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    public function generateSaleInvoice(Sale $sale): string
    {
        // Generate PDF
        $pdf = Pdf::loadView('invoices.sale', [
            'sale' => $sale,
            'company' => [
                'name' => config('app.name', 'Inventory System'),
                'address' => '123 Business Street, City, State 12345',
                'phone' => '+1 (555) 123-4567',
                'email' => 'info@company.com',
            ],
        ]);

        // Set PDF options
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        // Generate filename
        $filename = 'invoice_' . $sale->reference_no . '_' . now()->format('Y-m-d') . '.pdf';
        
        // Store PDF
        $path = 'invoices/sales/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        // Update sale record with invoice path
        $sale->update(['invoice_path' => $path]);

        return $path;
    }

    public function downloadSaleInvoice(Sale $sale): string
    {
        // If invoice doesn't exist, generate it
        if (!$sale->invoice_path || !Storage::disk('public')->exists($sale->invoice_path)) {
            $this->generateSaleInvoice($sale);
        }

        return Storage::disk('public')->path($sale->invoice_path);
    }

    public function getInvoiceUrl(Sale $sale): string
    {
        return Storage::disk('public')->url($sale->invoice_path);
    }
}
