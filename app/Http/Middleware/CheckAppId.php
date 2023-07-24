<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAppId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $appId = $request->session()->get('appId');

        if (!$appId) {
            // Jika tidak ada appId, redirect ke halaman utama atau tampilkan pesan kesalahan
            return redirect()->route('apps.index')->with('error', 'Invalid App ID');
        }

        // Lakukan validasi appId di sini sesuai dengan kebutuhan Anda
        // Misalnya, periksa apakah appId ada di database atau apakah pengguna berhak mengaksesnya

        return $next($request);
    }
}
