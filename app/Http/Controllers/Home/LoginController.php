<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017/3/28 15:58
 * version  : 判断用户是否授权
 **/
namespace App\Http\Controllers\Admin;
use App\Http\Model\User;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class LoginController extends CommonController
{
    public function login()
    {
        /*
        if($input = Input::all()){
            $code = new \Code;
            $_code = $code->get();
            if(strtoupper($input['code'])!=$_code){
                return back()->with('msg','验证码错误！');
            }
            $user = User::first();
            if($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass)!= $input['user_pass']){
                return back()->with('msg','用户名或者密码错误！');
            }
            session(['user'=>$user]);
            return redirect('admin/index');

        }else {
            return view('admin.login');
        }*/
    }

    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');



    }


}
