<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\InvestmentController;

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
    return view('berandaTamu');
})->name('berandaTamu');

// autentikasi

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');;

Route::post('/login', [LoginController::class, 'login'])->name('login-store');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');;

Route::post('/register', [RegisterController::class, 'register'])->name('register-store')->middleware('guest');;

Route::get('/loginAdmin', function () {
    return view('loginAdmin');
})->name('loginAdmin');


Route::get('/registerAdmin', function () {
    return view('registerAdmin');
})->name('registerAdmin');

Route::group([
    'middleware' => 'auth',
], function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // bagian utama
    Route::get('/beranda', function () {
        return view('beranda');
    })->name('beranda');

    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');

    Route::get('/investasi', function () {
        return view('investasi');
    })->name('investasi');

    Route::get('/aset', function () {
        return view('aset');
    })->name('aset');


    Route::get('/profile', [ProfileController::class, 'showEditProfileForm'])->name('profil');

    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('update-profile');

    Route::get('/edit-password', [ProfileController::class, 'showEditPasswordForm'])->name('gantiPassword');

    Route::post('/edit-password', [ProfileController::class, 'updatePassword'])->name('update-password');

    Route::get('/edit-bank-account', [ProfileController::class, 'showEditBankAccount'])->name('bankAkun');

    Route::post('/update-bank-account', [ProfileController::class, 'updateBankAccount'])->name('update-bank-account');


    Route::get('/topUp', function () {
        return view('topUp');
    })->name('topUp');

    Route::get('/bantuan', function () {
        return view('bantuan');
    })->name('bantuan');

    Route::group([
        'middleware' => 'admin',
    ], function () {
        Route::get('/invests', [InvestmentController::class, 'indexAdmin'])->name('investasiAdmin');
        Route::post('/store-investment', [InvestmentController::class, 'store'])->name('storeInvestment');
        Route::delete('/delete-investment/{id}', [InvestmentController::class, 'destroy'])->name('deleteInvestment');
        Route::put('/investment/update/{id}', [InvestmentController::class, 'update'])->name('updateInvestment');




        Route::get('/admin', function () {
            return view('admin');
        })->name('admin');

        Route::get('/pasarUang', function () {
            return view('pasarUang');
        })->name('pasarUang');

        Route::get('/obligasi', function () {
            return view('obligasi');
        })->name('obligasi');
    });
});






Route::get('/coba', function () {
    return view('coba');
})->name('coba');


Route::get('/index', function () {
    return view('index');
});
