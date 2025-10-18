<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SaleController extends Controller
{
    public function __construct(
        private InvoiceService $invoiceService
    ) {}

    public function downloadInvoice(Sale $sale): BinaryFileResponse
    {
        $filePath = $this->invoiceService->downloadSaleInvoice($sale);
        
        return response()->download($filePath);
    }
}
