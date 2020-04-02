<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userInfo = $request->session()->get('userInfo');
        if($userInfo) //Nếu account đã đc login thì ko cho phép truy cập nữa mà redirect ngay về trang chủ
        {
            return redirect()->route('notify'); 
        }
        return $next($request);
    }
}
