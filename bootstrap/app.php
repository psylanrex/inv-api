<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HasPurchaseOrder;
use App\Http\Middleware\HasInvoice;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([

            'hasPo' => HasPurchaseOrder::class,
            'hasInvoice' => HasInvoice::class

        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
