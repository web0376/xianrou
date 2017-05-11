<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017/3/28 15:30
 * version  : 首页展示
 **/
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;

class IndexController extends Controller
{
    public function index(Request $request){
        $uri = 'index';
        return view('Home.Index.index',compact('uri'));
    }
    public function sendMsg(){
        // 配置信息
        $config = [
            'app_key'    => '23451264',
            'app_secret' => '75c0c89531e89a0c8bb5dd6588a4bff3',
            // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];

        // 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;

        $req->setRecNum('13282168304')
            ->setSmsParam([
                'yzm' => rand(100000, 999999)
            ])
            ->setSmsFreeSignName('通知')
            ->setSmsTemplateCode('SMS_14705049');

        $resp = $client->execute($req);
        var_dump($resp);
    }
    public function test(Request $request){

        Session::put('key', 'value');
        Session::put('wx_uid',1);
        Session::put('wx_openid','4564651616');

        //$request->session()->put('key2','val2');

        //return redirect('/');
    }
    public function test2(Request $request){
        //$data = \App\Http\Model\Weibo::find(2);
        //$data = unserialize($data->data);
        //var_dump($data->data);
        $array = array('attach_id'=>'1,2,3,4,5');
        $abc = serialize($array);
        var_dump($abc);

        echo 'a:1:{s:10:"attach_id";s:1:"1";}';
    }
    //拉取微信授权
    public function wxAuth(){
        echo 'this is weixin auth';
        $val = Session::all();
        dd($val);

    }
    //微信授权返回数据
    public function wxBack(){



    }
}