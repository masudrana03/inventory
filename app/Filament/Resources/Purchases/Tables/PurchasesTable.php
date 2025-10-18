<?php

namespace App\Filament\Resources\Purchases\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PurchasesTable
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

                TextColumn::make('supplier.name')
                    ->label('Supplier')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('purchase_date')
                    ->label('Purchase Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('purchaseItems_count')
                    ->label('Items')
                    ->getStateUsing(fn ($record) => $record->purchaseItems()->count())
                    ->sortable(),

                TextColumn::make('invoice_path')
                    ->label('Invoice')
                    ->formatStateUsing(fn ($state) => $state ? 'Available' : 'Not Available')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('supplier')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('download_invoice')
                    ->label('Download Invoice')
                    ->icon(Heroicon::DocumentText)
                    ->url(fn ($record) => $record->invoice_path ? asset('storage/' . $record->invoice_path) : null)
                    ->openUrlInNewTab()
                    ->color('success')
                    ->visible(fn ($record) => !empty($record->invoice_path)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
