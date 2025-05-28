<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return "This is <b>". tenant('name')."</b> and my multi-tenant application.<br/>  The id of the current tenant is <b>" . tenant('id').'</b> <br/>And Database Name is : '.tenant('tenancy_db_name').'<br/><br/> <a href="/login">Login Now</a>';
    });
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('/tenants', TenantController::class);
    });
    
    require __DIR__.'/auth.php';
});
