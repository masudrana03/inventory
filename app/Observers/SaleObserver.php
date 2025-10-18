<?php

namespace App\Observers;

use App\Models\Sale;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     */
    public function created(Sale $sale): void
    {
        // Decrease stock quantity for each sale item
        foreach ($sale->saleItems as $item) {
            $product = $item->product;
            
            // Check if sufficient stock is available
            if ($product->stock_quantity < $item->quantity) {
                throw new \Exception("Insufficient stock for product: {$product->name}. Available: {$product->stock_quantity}, Required: {$item->quantity}");
            }
            
            $product->decrement('stock_quantity', $item->quantity);
        }
    }

    /**
     * Handle the Sale "updated" event.
     */
    public function updated(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "deleted" event.
     */
    public function deleted(Sale $sale): void
    {
        // Increase stock quantity for each sale item (reverse the sale)
        foreach ($sale->saleItems as $item) {
            $product = $item->product;
            $product->increment('stock_quantity', $item->quantity);
        }
    }

    /**
     * Handle the Sale "restored" event.
     */
    public function restored(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     */
    public function forceDeleted(Sale $sale): void
    {
        //
    }
}
