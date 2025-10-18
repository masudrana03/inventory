<?php

namespace App\Filament\Resources\Sales\Pages;

use App\Filament\Resources\Sales\SaleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSale extends EditRecord
{
    protected static string $resource = SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
