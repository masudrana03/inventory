<?php

namespace App\Observers;

use App\Models\SaleItem;

class SaleItemObserver
{
    /**
     * Handle the SaleItem "created" event.
     */
    public function created(SaleItem $saleItem): void
    {
        $this->updateSaleTotal($saleItem);
    }

    /**
     * Handle the SaleItem "updated" event.
     */
    public function updated(SaleItem $saleItem): void
    {
        $this->updateSaleTotal($saleItem);
    }

    /**
     * Handle the SaleItem "deleted" event.
     */
    public function deleted(SaleItem $saleItem): void
    {
        $this->updateSaleTotal($saleItem);
    }

    /**
     * Update the sale total amount based on all sale items
     */
    private function updateSaleTotal(SaleItem $saleItem): void
    {
        $sale = $saleItem->sale;
        $totalAmount = $sale->saleItems()->sum('subtotal');
        $sale->update(['total_amount' => $totalAmount]);
    }

    /**
     * Handle the SaleItem "restored" event.
     */
    public function restored(SaleItem $saleItem): void
    {
        //
    }

    /**
     * Handle the SaleItem "force deleted" event.
     */
    public function forceDeleted(SaleItem $saleItem): void
    {
        //
    }
}
