<?php
/**
 * CSRF middleware.
 */
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'continue/*',
        'new-game/*',
        'game/*',
        'admin/*',
        'api/*'
    ];
}
