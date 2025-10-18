<?php

namespace App\Providers;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\PurchaseItem;
use App\Observers\SaleObserver;
use App\Observers\PurchaseObserver;
use App\Observers\SaleItemObserver;
use Illuminate\Support\Facades\URL;
use App\Observers\PurchaseItemObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Purchase::observe(PurchaseObserver::class);
        Sale::observe(SaleObserver::class);
        SaleItem::observe(SaleItemObserver::class);
        PurchaseItem::observe(PurchaseItemObserver::class);

        URL::forceScheme('https');
    }
}
