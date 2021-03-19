<?php
use App\Imports\ProductsImport;
use App\Jobs\ExcelUploadProductsJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/notify', function(){
    $user = User::find(1);
    $user->notify(new \App\Notifications\ProductsUploaded());
});

Route::get('/phpinfo', function () {
    echo "<pre>";
    print_r(get_loaded_extensions());
    echo "<pre/>";
});

Route::get('/products-template', function () {
    return Excel::download(new \App\Exports\ProductsTemplateExport(), 'products-template.xlsx');
});

Route::post('/upload-products', function (Request $request) {
    $filename = $request->file('upload_file')->getClientOriginalName();
    $path = $request->file('upload_file')->storeAs(
        'excel-uploads',
        $filename,
        'local'
    );

    ExcelUploadProductsJob::dispatch($path);
    return redirect()->back();
})->name('upload-products');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('products', \App\Http\Controllers\Web\ProductController::class);
Route::resource('clients', \App\Http\Controllers\Web\ClientController::class);
Route::resource('product-types', \App\Http\Controllers\Web\ProductTypeController::class);

require __DIR__ . '/auth.php';

