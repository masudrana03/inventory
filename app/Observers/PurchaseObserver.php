<?php

namespace App\Observers;

use App\Models\Purchase;

class PurchaseObserver
{
    /**
     * Handle the Purchase "created" event.
     */
    public function created(Purchase $purchase): void
    {
        // Increase stock quantity for each purchase item
        foreach ($purchase->purchaseItems as $item) {
            $product = $item->product;
            $product->increment('stock_quantity', $item->quantity);
        }
    }

    /**
     * Handle the Purchase "updated" event.
     */
    public function updated(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "deleted" event.
     */
    public function deleted(Purchase $purchase): void
    {
        // Decrease stock quantity for each purchase item
        foreach ($purchase->purchaseItems as $item) {
            $product = $item->product;
            $product->decrement('stock_quantity', $item->quantity);
        }
    }

    /**
     * Handle the Purchase "restored" event.
     */
    public function restored(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "force deleted" event.
     */
    public function forceDeleted(Purchase $purchase): void
    {
        //
    }
}
