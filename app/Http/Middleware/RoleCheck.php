<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 0はシステム管理者、１は会員ユーザー、２は営業ユーザー
        if(auth()->check() && auth()->user()->type == '0'){

            return $next($request);
        }
        if(auth()->check() && auth()->user()->type == '1'){

            return $next($request);
        }
        if(auth()->check() && auth()->user()->type == '2'){

            return redirect()->to('/product');
        }
        return $next($request);
    }
}
