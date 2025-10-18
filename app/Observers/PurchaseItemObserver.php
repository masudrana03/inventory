<?php

namespace App\Observers;

use App\Models\PurchaseItem;

class PurchaseItemObserver
{
    /**
     * Handle the PurchaseItem "created" event.
     */
    public function created(PurchaseItem $purchaseItem): void
    {
        $this->updatePurchaseTotal($purchaseItem);
    }

    /**
     * Handle the PurchaseItem "updated" event.
     */
    public function updated(PurchaseItem $purchaseItem): void
    {
        $this->updatePurchaseTotal($purchaseItem);
    }

    /**
     * Handle the PurchaseItem "deleted" event.
     */
    public function deleted(PurchaseItem $purchaseItem): void
    {
        $this->updatePurchaseTotal($purchaseItem);
    }

    /**
     * Update the purchase total amount based on all purchase items
     */
    private function updatePurchaseTotal(PurchaseItem $purchaseItem): void
    {
        $purchase = $purchaseItem->purchase;
        $totalAmount = $purchase->purchaseItems()->sum('subtotal');
        $purchase->update(['total_amount' => $totalAmount]);
    }

    /**
     * Handle the PurchaseItem "restored" event.
     */
    public function restored(PurchaseItem $purchaseItem): void
    {
        //
    }

    /**
     * Handle the PurchaseItem "force deleted" event.
     */
    public function forceDeleted(PurchaseItem $purchaseItem): void
    {
        //
    }
}
