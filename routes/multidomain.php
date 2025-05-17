<?php

use Illuminate\Support\Facades\Route;

foreach (centralDomains() as $domain) {
    Route::middleware('web')
        ->domain($domain)
        ->group(base_path('routes/web.php'));

}

function centralDomains(): array
{
    return config('tenancy.central_domains', []);
}