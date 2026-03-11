<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
//use App\Http\Controllers\masters\SegmentController;
use App\Http\Controllers\master\Category;
use App\Http\Controllers\master\CategoryController;
use App\Http\Controllers\master\SubcategoryController;
use App\Http\Controllers\master\ValayaController;
use App\Http\Controllers\master\PoojaController;
use App\Http\Controllers\sevapooja\SevapoojaController;
use App\Http\Controllers\master\CustomerController;
use App\Http\Controllers\purchase\PurchaseController;
use App\Http\Controllers\purchase\PurchaseCategoryController;
use App\Http\Controllers\purchase\PurchaseSubcategoryController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

/** Test Contorller */
Route::get('/index', [TestController::class, 'index']);


Route::get('/master/category/add_category', [CategoryController::class, 'create']);

/** Artisan commands Start */
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

// In your web.php routes file
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "All caches cleared!";
});

/** Artisan commands Ends */


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
   // Route::get('/master/subcategory/add_subcategory', [SubcategoryController::class, 'create'])->name('create');
    
    // Category  Controller Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/master/category/view_category', 'index')->name('Category.index');
        Route::get('/master/category/add_category', 'create')->name('Category.create');
        Route::post('/master/category/store_category', 'store')->name('Category.store');
        Route::get('cat', 'get_all_category')->name('category.get_all_category');
        Route::get('/master/category/edit_category/{id}', 'edit')->name('Category.edit');
        Route::post('/master/category/update_category/{id}', 'update')->name('Category.update');
    });
    
     //Sub Category  Controller Route
    Route::controller(SubcategoryController::class)->group(function () {
        Route::get('/master/subcategory/view_subcategory', 'index')->name('Subcategory.index');
        Route::get('/master/subcategory/add_subcategory', 'create')->name('Subcategory.create');
        Route::post('/master/subcategory/store_subcategory', 'store')->name('Subcategory.store');
        Route::get('/master/subcategory/edit_subcategory/{id}', 'edit')->name('Subcategory.edit');
        Route::get('view_all_sub_category', 'get_all_subcategory')->name('Subcategory.get_all_subcategory');
        Route::post('/master/subcategory/update_subcategory/{id}', 'update')->name('Subcategory.update');
    });

       // Valaya  Controller Route
    Route::controller(ValayaController::class)->group(function () {
        Route::get('/master/valaya/view_valaya', 'index')->name('Valaya.index');
        Route::get('/master/valaya/add_valaya', 'create')->name('Valaya.create');
        Route::post('/master/valaya/store_valaya', 'store')->name('Valaya.store');
        Route::get('view_all_valaya', 'get_all_valaya')->name('Valaya.get_all_category');
        Route::get('/master/valaya/edit_valaya/{id}', 'edit')->name('Valaya.edit');
        Route::post('/master/valaya/update_valaya/{id}', 'update')->name('Valaya.update');

    });
    

    // Pooja Controller Route
    Route::controller(PoojaController::class)->group(function () {
        Route::get('/master/pooja/view_pooja', 'index')->name('Pooja.index');
        Route::get('/master/pooja/add_pooja', 'create')->name('Pooja.create');
        Route::post('/master/pooja/store_pooja', 'store')->name('Pooja.store');
        Route::get('view_poja_ajax', 'get_all_pooja')->name('Pooja.get_all_pooja');
        Route::get('/master/pooja/edit_pooja/{id}', 'edit')->name('Pooja.edit');
        Route::post('/master/pooja/update_pooja/{id}', 'update')->name('Pooja.update');
    });

     // Seva Pooja Controller Route
     Route::controller(SevapoojaController::class)->group(function () {
        Route::get('/sevapooja/view_sevapooja', 'index')->name('Sevapooja.index');
        Route::get('/sevapooja/add_pooja', 'create')->name('Sevapooja.create');
      //  Route::post('submit_pooja_values', 'store')->name('Sevapooja.store');
        Route::get('search_customer', 'search_customer')->name('Sevapooja.search_customer');
        Route::get('search_on_code', 'search_on_code')->name('Sevapooja.search_on_code');
        Route::get('search_on_pooja', 'search_on_pooja')->name('Sevapooja.search_on_pooja');
        Route::post('submit_pooja_values', 'submit_pooja_values')->name('Sevapooja.submit_pooja_values');
        Route::get('/sevapooja/seva_pooja_report', 'seva_pooja_report')->name('Sevapooja.seva_pooja_report');
        Route::get('seva_pooja_report_ajax', 'seva_pooja_report_ajax')->name('Pooja.seva_pooja_report_ajax');
    });
    // Customer Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/master/customer/view_customer', 'index')->name('Customer.index');
        Route::get('/master/customer/add_customer', 'create')->name('Customer.create');
        Route::post('/master/customer/store_customer', 'store')->name('Customer.store');
        Route::get('get_all_customer_ajax', 'get_all_customer')->name('Customer.get_all_customer');
        Route::get('/master/customer/edit_customer/{id}', 'edit')->name('Customer.edit');
        Route::post('/master/customer/update_customer/{id}', 'update')->name('Customer.update');
        
    });
      // Purchase Controller Route
      Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/view_purchase', 'index')->name('Purchase.index');
        Route::get('/purchase/add_purchase', 'create')->name('Purchase.create');
        Route::post('/purchase/store_purchase', 'store')->name('Purchase.store');
        Route::get('purchase_det', 'get_all_purchase')->name('Purchase.get_all_purchase');
        Route::get('/purchase/edit_purchase/{}', 'edit')->name('Purchase.edit');
    });
    
         // Purchase Category Controller Route
         Route::controller(PurchaseCategoryController::class)->group(function () {
            Route::get('/purchase_category/view_purchase_category', 'index')->name('Purchasecategory.index');
            Route::get('/purchase_category/add_purchase_category', 'create')->name('Purchasecategory.create');
            Route::post('/purchase_category/add_purchase_category/store_purchase_category', 'store')->name('Purchasecategory.store');
            Route::get('purchase_cat', 'get_all_category')->name('Purchasecategory.get_all_category');
            Route::get('/purchase_category/edit_purchase_category/{id}', 'edit')->name('Purchasecategory.edit');
            Route::post('/purchase_category/update_purchase_category/{id}', 'update')->name('Purchasecategory.update');
        });

        // Purchase Sub Category Controller Route
        Route::controller(PurchaseSubcategoryController::class)->group(function () {
        Route::get('/purchase_subcategory/view_purchase_subcategory', 'index')->name('Purchasesubcategory.index');
        Route::get('/purchase_subcategory/add_purchase_subcategory', 'create')->name('Purchasesubcategory.create');
        Route::post('/purchase_subcategory/add_purchase_subcategory/store_purchase_category', 'store')->name('Purchasesubcategory.store');
        Route::get('purchase_subcat', 'get_all_subcategory')->name('Purchasesubcategory.get_all_subcategory');
        Route::get('/purchase_subcategory/edit_purchase_subcategory/{id}', 'edit')->name('Purchasesubcategory.edit');
        Route::post('/purchase_subcategory/update_purchase_subcategory/{id}', 'update')->name('Purchasesubcategory.update');
    });
    //Route::get('cat', 'CategoryController@get_all_category')->name('get.cat');
    //Route::get('cat', [CategoryController::class, 'get_all_category'])->name('get.cat');
});





/**Master Creation */
//Route::get('/masters/add_segement', [SegmentController::class, 'create']);
/** End of Masters Creation */

require __DIR__.'/auth.php';
