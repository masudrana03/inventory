<?php

namespace App\Filament\Resources\Sales\Schemas;

use App\Models\Customer;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Select::make('customer_id')
                            ->label('Customer')
                            ->relationship('customer', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(255),
                            ]),

                        DatePicker::make('sale_date')
                            ->label('Sale Date')
                            ->required()
                            ->default(now()),
                    ]),

                Grid::make(3)
                    ->schema([
                        TextInput::make('reference_no')
                            ->label('Reference Number')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->default(fn () => 'SAL-' . strtoupper(uniqid())),

                        TextInput::make('total_amount')
                            ->label('Total Amount')
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01)
                            ->disabled()
                            ->dehydrated()
                            ->default(0.00),

                        TextInput::make('discount_amount')
                            ->label('Discount Amount')
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01)
                            ->default(0.00)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $totalAmount = (float) $get('total_amount');
                                $discountAmount = (float) $state;
                                if ($totalAmount > 0) {
                                    $percentage = ($discountAmount / $totalAmount) * 100;
                                    $set('discount_percentage', round($percentage, 2));
                                }
                                // Update final amount
                                $finalAmount = $totalAmount - $discountAmount;
                                $set('final_amount', $finalAmount);
                            }),
                    ]),

                Grid::make(2)
                    ->schema([
                        TextInput::make('discount_percentage')
                            ->label('Discount Percentage')
                            ->numeric()
                            ->suffix('%')
                            ->step(0.01)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $totalAmount = (float) $get('total_amount');
                                $percentage = (float) $state;
                                $discountAmount = 0;
                                if ($totalAmount > 0) {
                                    $discountAmount = ($percentage / 100) * $totalAmount;
                                    $set('discount_amount', round($discountAmount, 2));
                                }
                                // Update final amount
                                $finalAmount = $totalAmount - $discountAmount;
                                $set('final_amount', $finalAmount);
                            }),

                        TextInput::make('final_amount')
                            ->label('Final Amount')
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01)
                            ->disabled()
                            ->dehydrated(false)
                            ->default(0.00),
                    ]),

                Textarea::make('notes')
                    ->label('Notes')
                    ->rows(3)
                    ->columnSpanFull(),

                Repeater::make('saleItems')
                    ->label('Sale Items')
                    ->relationship('saleItems')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $product = Product::find($state);
                                            if ($product) {
                                                $set('unit_price', $product->selling_price);
                                            }
                                        }
                                    }),

                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        $quantity = (float) $state;
                                        $unitPrice = (float) $get('unit_price');
                                        $set('subtotal', $quantity * $unitPrice);
                                    }),

                                TextInput::make('unit_price')
                                    ->label('Unit Price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$')
                                    ->step(0.01)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        $unitPrice = (float) $state;
                                        $quantity = (float) $get('quantity');
                                        $set('subtotal', $quantity * $unitPrice);
                                    }),

                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                    ])
                    ->defaultItems(1)
                    ->addActionLabel('Add Item')
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
