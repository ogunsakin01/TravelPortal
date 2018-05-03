<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/paystack-payment-verification',
        '/interswitch-payment-verification',
        '/backend/paystack-payment-verification',
        '/backend/interswitch-payment-verification'
    ];
}
