<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017-05-11 11:16:43
 * version  : 发现
 **/
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Model\Weibo;
use App\Http\Requests;
use Illuminate\Http\Request;

class FindController extends Controller
{
    public function index(Request $request)
    {
        $uri = $request->path();
        $uri = explode('/',$uri);

        $weiboList = Weibo::where(['is_tj'=>1,'status'=>1])->orderBy('create_time','desc')->get();

        return view('Home.Find.index',compact('uri','weiboList'));
    }

    public function nearby(Request $request){
        $uri = $request->path();
        $uri = explode('/',$uri);

        return view('Home.Find.nearby',compact('uri'));
    }
}

