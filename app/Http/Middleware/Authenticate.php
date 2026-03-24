<?php
/**
 * Middleware: auth.
 */
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // У нас пока нет логина. Можно поменять на /login если добавите auth.
        return $request->expectsJson() ? null : '/';
    }
}
