<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;

use App\Models\ProductType;
use App\Observers\ProductTypeObserver;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
        ResourceCollection::withoutWrapping();
        Collection::macro('transformKeys', function ($callback) {
            return $this->mapWithKeys(fn ($value, $key) => [
                $callback($key) => is_array($value) ? collect($value)->transformKeys($callback) : $value
            ]);
        });

        Product::observe(ProductObserver::class);
        ProductType::observe(ProductTypeObserver::class);
    }
}
