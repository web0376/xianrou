<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017/3/29 10:30
 * version  : 判断用户是否微信授权登录
 **/

namespace App\Http\Middleware;

use App\Http\Model\User;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeLogin
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
        $uid = Session::get('wx_uid');
        $openid = Session::get('wx_openid');
        if($uid){
            $userRow = User::where(['openid'=>$openid,'id'=>$uid])->first();
            if(!$userRow){
                return redirect('index/wxAuth');
                exit;
            }
        }else{
            return redirect('index/wxAuth');
            exit;
        }
        return $next($request);

    }
}
