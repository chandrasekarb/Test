<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // other middleware...
            \App\Http\Middleware\VerifyCsrfToken::class,
            // other middleware...
        ],

        'api' => [
            // other middleware...
        ],
    ];

    // other code...
}