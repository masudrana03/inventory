<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'sale_date',
        'reference_no',
        'total_amount',
        'discount_amount',
        'discount_percentage',
        'notes',
        'invoice_path',
    ];

    protected $attributes = [
        'total_amount' => 0.00,
        'discount_amount' => 0.00,
    ];

    protected function casts(): array
    {
        return [
            'sale_date' => 'date',
            'total_amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'discount_percentage' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Calculate the final amount after discount
     */
    public function getFinalAmountAttribute(): float
    {
        return $this->total_amount - $this->discount_amount;
    }

    /**
     * Calculate the total profit for this sale
     */
    public function getTotalProfitAttribute(): float
    {
        $totalProfit = 0;
        foreach ($this->saleItems as $item) {
            $profit = ($item->unit_price - $item->product->purchase_price) * $item->quantity;
            $totalProfit += $profit;
        }
        return $totalProfit;
    }

    /**
     * Calculate profit percentage
     */
    public function getProfitPercentageAttribute(): float
    {
        if ($this->total_amount == 0) {
            return 0;
        }
        return ($this->total_profit / $this->total_amount) * 100;
    }
}
