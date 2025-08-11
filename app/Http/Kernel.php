<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // middleware default Laravel
        'auth' => \App\Http\Middleware\Authenticate::class,
        // middleware lain...
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}
