<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');
Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->middleware(['auth'])->name('profile');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    Route::get('/admin/accounts', 'App\Http\Controllers\admin\AccountsController@index')->name('admin-accounts');

    Route::get('/admin/license-settings', 'App\Http\Controllers\admin\LicenseController@index')->name('admin-licenses');
    Route::post('/admin/add-license/price', 'App\Http\Controllers\admin\LicenseController@add_price')->name('add-license-price');
    Route::post('/admin/edit-license/price', 'App\Http\Controllers\admin\LicenseController@edit_price')->name('edit-license-price');
    Route::post('/admin/delete-license/price', 'App\Http\Controllers\admin\LicenseController@delete_price')->name('delete-license-price');
    Route::post('/admin/update-penalty', 'App\Http\Controllers\admin\LicenseController@update_penalty')->name('update-penalty');

    Route::get('/admin/transactions', 'App\Http\Controllers\admin\TransactionController@index')->name('admin-transactions');
    Route::get('/admin/transaction-report', 'App\Http\Controllers\admin\TransactionController@report')->name('admin-transaction-report');

});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');

    Route::get('/user/license-payment', 'App\Http\Controllers\user\PaymentController@index')->name('user-payment');
    Route::post('/user/add-payment', 'App\Http\Controllers\user\PaymentController@payment')->name('user-add-payment');

    Route::get('/user/statement', 'App\Http\Controllers\user\StatementController@index')->name('user-statement');
    Route::get('/user/download-statement', 'App\Http\Controllers\user\StatementController@download')->name('user-download_statement');

});

require __DIR__.'/auth.php';
