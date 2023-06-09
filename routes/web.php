<?php

use App\Http\Controllers\AdminKehilanganController;
use App\Http\Controllers\AdminMenemukanController;
use App\Http\Controllers\KehilanganController;
use App\Http\Controllers\MenemukanController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Auth;
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
    return view('main');
});

Route::resource('menemukans', MenemukanController::class);
Route::resource('kehilangans', KehilanganController::class);

// Paypal Donation Form
Route::get( 'donation-form',  [ DonationController::class, 'donationForm' ] );
Route::get( 'donation/success',  [ DonationController::class, 'donationSuccess' ] )->name('donation.success');
Route::get( 'donation/cancelled',  [ DonationController::class, 'donationCancelled' ] )->name('donation.cancelled');
Route::get( 'donation/notify_url',  [ DonationController::class, 'donationNotify' ] )->name('donation.notify');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('admin/menemukans', AdminMenemukanController::class, [ 'as' => 'admin']);
    Route::resource('admin/kehilangans', AdminKehilanganController::class, [ 'as' => 'admin']);
});
