<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Product Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('sku')
                            ->label('SKU')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ]),

                Grid::make(2)
                    ->schema([
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('unit_type')
                            ->label('Unit Type')
                            ->default('pcs')
                            ->maxLength(50),
                    ]),

                Grid::make(3)
                    ->schema([
                        TextInput::make('purchase_price')
                            ->label('Purchase Price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01),

                        TextInput::make('selling_price')
                            ->label('Selling Price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01),

                        TextInput::make('low_stock_threshold')
                            ->label('Low Stock Threshold')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->default(10)
                            ->minValue(0),
                    ]),

                Grid::make(2)
                    ->schema([
                        TextInput::make('stock_quantity')
                            ->label('Current Stock')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->default(0)
                            ->minValue(0),

                        FileUpload::make('image')
                            ->label('Product Image')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->visibility('public'),
                    ]),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
