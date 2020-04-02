<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if(!$userInfo) //Nếu account chưa đc login thì redirect về trang đăng nhập
        {
            return redirect()->route('user/index/login');
            
        }
        else //Nếu account đã đc login thì tiếp tục kiểm tra xem có quyền không
        {
            if($userInfo['level'] !== "admin")
            {
                return redirect()->route('notify'); 
            }
        }
        return $next($request);
    }
}
