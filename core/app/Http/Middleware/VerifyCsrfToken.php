<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/business/settings/cod/status',
        '/business/settings/digital/payment/status',
        '/payment/gateway/manual/status/change',
        '/payment/gateway/automatic/status/change',
        '/currency/status/change',
        '/setting/extensions/status/change',
        '/deshboard',
        
    ];
}
