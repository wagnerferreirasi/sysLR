<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\LoginComponent;
use App\Http\Livewire\Dashboard\HomeComponent;
use App\Http\Livewire\Dashboard\User\UserComponent;
use App\Http\Livewire\Dashboard\Place\PlaceComponent;
use App\Http\Livewire\Dashboard\Route\RouteComponent;
use App\Http\Livewire\Dashboard\User\NewUserComponent;
use App\Http\Livewire\Dashboard\Client\ClientComponent;
use App\Http\Livewire\Dashboard\Report\ReportComponent;
use App\Http\Livewire\Dashboard\User\EditUserComponent;
use App\Http\Livewire\Dashboard\Place\NewPlaceComponent;
use App\Http\Livewire\Dashboard\Route\NewRouteComponent;
use App\Http\Livewire\Dashboard\Cashier\CashierComponent;
use App\Http\Livewire\Dashboard\Destiny\DestinyComponent;
use App\Http\Livewire\Dashboard\Package\PackageComponent;
use App\Http\Livewire\Dashboard\Place\EditPlaceComponent;
use App\Http\Livewire\Dashboard\Route\EditRouteComponent;
use App\Http\Livewire\Dashboard\Client\NewClientComponent;
use App\Http\Livewire\Dashboard\Client\EditClientComponent;
use App\Http\Livewire\Dashboard\Password\PasswordComponent;
use App\Http\Livewire\Dashboard\Destiny\NewDestinyComponent;
use App\Http\Livewire\Dashboard\Package\NewPackageComponent;
use App\Http\Livewire\Dashboard\Destiny\EditDestinyComponent;
use App\Http\Livewire\Dashboard\Package\EditPackageComponent;
use App\Http\Livewire\Dashboard\Report\CachierReportComponent;

Route::get('/', LoginComponent::class)->name('login');


// group dashboard routes
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', HomeComponent::class)->middleware('auth')->name('dashboard');

    //Cashier routes
    Route::group(['prefix' => 'cashiers'], function () {
        Route::get('/', CashierComponent::class)->middleware('auth')->name('dashboard.cashiers');
    });

    //Clients routes
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', ClientComponent::class)->middleware('auth')->name('dashboard.clients');
        Route::get('/add', NewClientComponent::class)->middleware('auth')->name('dashboard.clients.add');
        Route::get('/edit/{id}', EditClientComponent::class)->middleware('auth')->name('dashboard.clients.edit');
    });

    //Places routes
    Route::group(['prefix' => 'places'], function () {
        Route::get('/', PlaceComponent::class)->middleware('auth')->name('dashboard.places');
        Route::get('/add', NewPlaceComponent::class)->middleware('auth')->name('dashboard.places.add');
        Route::get('/edit/{id}', EditPlaceComponent::class)->middleware('auth')->name('dashboard.places.edit');
    });

    //Destinies routes
    Route::group(['prefix' => 'destinies'], function () {
        Route::get('/', DestinyComponent::class)->middleware('auth')->name('dashboard.destinies');
        Route::get('/add', NewDestinyComponent::class)->middleware('auth')->name('dashboard.destinies.add');
        Route::get('/edit/{id}', EditDestinyComponent::class)->middleware('auth')->name('dashboard.destinies.edit');
    });

    //Routes routes
    Route::group(['prefix' => 'routes'], function () {
        Route::get('/', RouteComponent::class)->middleware('auth')->name('dashboard.routes');
        Route::get('/add', NewRouteComponent::class)->middleware('auth')->name('dashboard.routes.add');
        Route::get('/edit/{id}', EditRouteComponent::class)->middleware('auth')->name('dashboard.routes.edit');
    });

    //Packages routes
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', PackageComponent::class)->middleware('auth')->name('dashboard.packages');
        Route::get('/add', NewPackageComponent::class)->middleware('auth')->name('dashboard.packages.add');
        Route::get('/edit/{id}', EditPackageComponent::class)->middleware('auth')->name('dashboard.packages.edit');
        Route::get('/print/{id}', PackageComponent::class)->middleware('auth')->name('dashboard.packages.print');
        Route::get('/qrcode/{id}', [PackageComponent::class, 'getQrCode'])->name('qrcode');
    });

    //Reports routes
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', ReportComponent::class)->middleware('auth')->name('dashboard.reports');
        Route::get('/cashiers', CachierReportComponent::class)->middleware('auth')->name('dashboard.reports.cashiers');
        Route::post('/cashiers/getData', [CachierReportComponent::class, 'getData'])->middleware('auth')->name('dashboard.reports.cashiers.getData');
        Route::get('/cashiers/export', [CachierReportComponent::class, 'exportData'])->middleware('auth')->name('dashboard.reports.cashiers.export');
    });

    Route::group(['prefix' => 'password'], function () {
        Route::get('/', PasswordComponent::class)->middleware('auth')->name('dashboard.password');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', UserComponent::class)->middleware('auth')->name('dashboard.users');
        Route::get('/add', NewUserComponent::class)->middleware('auth')->name('dashboard.users.add');
        Route::get('/edit/{id}', EditUserComponent::class)->middleware('auth')->name('dashboard.users.edit');
    });

});

Route::get('/print', function () {
    return view('print');
})->name('print');


//logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
