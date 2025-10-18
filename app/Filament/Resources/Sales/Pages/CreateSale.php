<?php

namespace App\Filament\Resources\Sales\Pages;

use App\Filament\Resources\Sales\SaleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Calculate total amount from sale items
        $totalAmount = 0;
        if (isset($data['saleItems']) && is_array($data['saleItems'])) {
            foreach ($data['saleItems'] as $item) {
                if (isset($item['subtotal']) && is_numeric($item['subtotal'])) {
                    $totalAmount += (float) $item['subtotal'];
                }
            }
        }
        
        $data['total_amount'] = $totalAmount;
        return $data;
    }
}
