<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class CheckExpiredPayments
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();

        // Cek dan update pembayaran yang sudah expired
        Payment::where('status', 'pending')
            ->where('expired_time', '<', $now)
            ->update(['status' => 'canceled']);

        return $next($request);
    }
}
