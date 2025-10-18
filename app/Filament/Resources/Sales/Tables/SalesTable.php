<?php

namespace App\Filament\Resources\Sales\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Reference')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('sale_date')
                    ->label('Sale Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('discount_amount')
                    ->label('Discount')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('final_amount')
                    ->label('Final Amount')
                    ->getStateUsing(fn ($record) => $record->final_amount)
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('total_profit')
                    ->label('Profit')
                    ->getStateUsing(fn ($record) => $record->total_profit)
                    ->money('USD')
                    ->sortable()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),

                TextColumn::make('profit_percentage')
                    ->label('Profit %')
                    ->getStateUsing(fn ($record) => $record->profit_percentage)
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . '%')
                    ->sortable()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),

                TextColumn::make('saleItems_count')
                    ->label('Items')
                    ->getStateUsing(fn ($record) => $record->saleItems()->count())
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('customer')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('download_invoice')
                    ->label('Download Invoice')
                    ->icon(Heroicon::DocumentText)
                    ->url(fn ($record) => route('sales.invoice.download', $record))
                    ->openUrlInNewTab()
                    ->color('success'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
