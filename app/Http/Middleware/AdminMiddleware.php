<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Membatasi akses khusus untuk akun admin: admin@gmail.com
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        if ($user->email !== 'admin@gmail.com') {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk Administrator (admin@gmail.com).');
        }

        return $next($request);
    }
}
