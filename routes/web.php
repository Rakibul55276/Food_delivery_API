<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebRestaurantAuthController;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\API\Restaurant\RestaurantDashboardController;
use App\Http\Controllers\API\Restaurant\RestaurantFoodController;
use App\Http\Controllers\API\Restaurant\RestaurantCategoryController;
use App\Http\Controllers\API\Restaurant\RestaurantProfileController;
use App\Http\Controllers\API\Restaurant\RestaurantOrderController;
use App\Http\Controllers\API\Admin\AdminDashboardController;
use App\Http\Controllers\API\Admin\AdminRestaurantController;
use App\Http\Controllers\API\Admin\AdminFoodController;
use App\Http\Controllers\API\Admin\AdminCustomerController;
use App\Http\Controllers\API\Admin\AdminOrderController;
use App\Http\Controllers\API\Admin\AdminRiderController;

Route::get('/restaurant/register', [WebRestaurantAuthController::class, 'showRegisterForm'])
    ->name('restaurant.register');

Route::post('/restaurant/register', [WebRestaurantAuthController::class, 'register'])
    ->name('restaurant.register.store');


Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('web.login');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:restaurant'])
    ->prefix('restaurant')
    ->name('restaurant.')
    ->group(function () {

        Route::get('/dashboard',
            [RestaurantDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('foods',
            RestaurantFoodController::class);
 Route::resource('categories', RestaurantCategoryController::class);

 Route::get('/profile', [RestaurantProfileController::class, 'edit'])
    ->name('profile');

Route::put('/profile', [RestaurantProfileController::class, 'update'])
    ->name('profile.update');

Route::get('/orders', [RestaurantOrderController::class, 'index'])
    ->name('orders.index');

    Route::patch('/orders/{order}/status', [RestaurantOrderController::class, 'updateStatus'])
    ->name('orders.updateStatus');

Route::patch('/orders/{order}/payment', [RestaurantOrderController::class, 'updatePayment'])
    ->name('orders.updatePayment');

    Route::get('/orders/{order}', [RestaurantOrderController::class, 'show'])
    ->name('orders.show');
            
    });

       Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/restaurants', [AdminRestaurantController::class, 'index'])
            ->name('restaurants.index');

        Route::get('/restaurants/create', [AdminRestaurantController::class, 'create'])
            ->name('restaurants.create');

        Route::post('/restaurants', [AdminRestaurantController::class, 'store'])
            ->name('restaurants.store');

        Route::get('/restaurants/{restaurant}', [AdminRestaurantController::class, 'show'])
            ->name('restaurants.show');

        Route::get('/restaurants/{restaurant}/edit', [AdminRestaurantController::class, 'edit'])
            ->name('restaurants.edit');

        Route::put('/restaurants/{restaurant}', [AdminRestaurantController::class, 'update'])
            ->name('restaurants.update');

        Route::patch('/restaurants/{restaurant}/toggle', [AdminRestaurantController::class, 'toggle'])
            ->name('restaurants.toggle');

        Route::get('/restaurants/{restaurant}/categories/create', [AdminRestaurantController::class, 'createCategory'])
            ->name('restaurants.categories.create');

        Route::post('/restaurants/{restaurant}/categories', [AdminRestaurantController::class, 'storeCategory'])
            ->name('restaurants.categories.store');

        Route::get('/restaurants/{restaurant}/foods/create', [AdminFoodController::class, 'create'])
            ->name('foods.create');

        Route::post('/restaurants/{restaurant}/foods', [AdminFoodController::class, 'store'])
            ->name('foods.store');

        Route::get('/foods/{food}/edit', [AdminFoodController::class, 'edit'])
            ->name('foods.edit');

        Route::put('/foods/{food}', [AdminFoodController::class, 'update'])
            ->name('foods.update');

        Route::delete('/foods/{food}', [AdminFoodController::class, 'destroy'])
            ->name('foods.destroy');
         Route::delete('/categories/{category}',[AdminRestaurantController::class, 'destroyCategory'])
            ->name('categories.destroy');

        Route::get('/customers', [AdminCustomerController::class, 'index'])
                ->name('customers.index');

        
        Route::put('/customers/{user}', [AdminCustomerController::class, 'update'])
                ->name('customers.update');

                Route::get('/customers/create', [AdminCustomerController::class, 'create'])
             ->name('customers.create');

        Route::get('/customers/{user}', [AdminCustomerController::class, 'show'])
            ->name('customers.show');

        

        Route::post('/customers', [AdminCustomerController::class, 'store'])
            ->name('customers.store');

        Route::get('/customers/{user}/edit', [AdminCustomerController::class, 'edit'])  
                ->name('customers.edit');

        Route::get('/orders', [AdminOrderController::class, 'index'])
                    ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
                     ->name('orders.show');
        Route::put('/orders/{order}', [AdminOrderController::class, 'update'])
                    ->name('orders.update');


        Route::get('/riders', [AdminRiderController::class, 'index'])
            ->name('riders.index');

        Route::get('/riders/create', [AdminRiderController::class, 'create'])
            ->name('riders.create');

        Route::post('/riders', [AdminRiderController::class, 'store'])
            ->name('riders.store');

        Route::get('/riders/{rider}', [AdminRiderController::class, 'show'])
            ->name('riders.show');

        Route::get('/riders/{rider}/edit', [AdminRiderController::class, 'edit'])
            ->name('riders.edit');

        Route::put('/riders/{rider}', [AdminRiderController::class, 'update'])
            ->name('riders.update');

        Route::patch('/riders/{rider}/toggle', [AdminRiderController::class, 'toggle'])
            ->name('riders.toggle');

            
    });