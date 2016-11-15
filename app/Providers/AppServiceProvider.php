<?php

namespace App\Providers;

use App\Repository\Customer\CustomerEloquent;
use App\Repository\Customer\CustomerRepo;
use App\Repository\Manufacturer\ManufacturerEloquent;
use App\Repository\Manufacturer\ManufacturerRepo;
use App\Repository\Order\OrderEloquent;
use App\Repository\Order\OrderRepo;
use App\Repository\Payment\PaymentEloquent;
use App\Repository\Payment\PaymentRepo;
use App\Repository\PNK\PNKEloquent;
use App\Repository\PNK\PNKrepo;
use App\Repository\PNK\StatusEloquent;
use App\Repository\PNK\StatusRepo;
use App\Repository\Product\ProductEloquent;
use App\Repository\Product\ProductRepo;
use App\Repository\Role\RoleEloquent;
use App\Repository\Role\RoleRepo;
use App\Repository\Supplier\SupplierEloquent;
use App\Repository\Supplier\SupplierRepo;
use App\Repository\Type\TypeEloquent;
use App\Repository\Type\TypeRepo;
use App\Repository\Warehouse\WarehouseEloquent;
use App\Repository\Warehouse\WarehouseRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(RoleRepo::class, RoleEloquent::class);
        $this->app->bind(TypeRepo::class, TypeEloquent::class);
        $this->app->bind(ManufacturerRepo::class, ManufacturerEloquent::class);
        $this->app->bind(SupplierRepo::class, SupplierEloquent::class);
        $this->app->bind(CustomerRepo::class, CustomerEloquent::class);
        $this->app->bind(ProductRepo::class, ProductEloquent::class);
        $this->app->bind(PNKrepo::class, PNKEloquent::class);
        $this->app->bind(WarehouseRepo::class, WarehouseEloquent::class);
        $this->app->bind(StatusRepo::class, StatusEloquent::class);
        $this->app->bind(PaymentRepo::class, PaymentEloquent::class);
        $this->app->bind(OrderRepo::class, OrderEloquent::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
