<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Calculate total amount from purchase items
        $totalAmount = 0;
        if (isset($data['purchaseItems']) && is_array($data['purchaseItems'])) {
            foreach ($data['purchaseItems'] as $item) {
                if (isset($item['subtotal']) && is_numeric($item['subtotal'])) {
                    $totalAmount += (float) $item['subtotal'];
                }
            }
        }
        
        $data['total_amount'] = $totalAmount;
        return $data;
    }
}
