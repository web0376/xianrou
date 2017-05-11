<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017/3/29 11:01
 * version  : 会员相关操作
 **/
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Model\Follow;
use App\Http\Model\Picture;
use App\Http\Model\Report;
use App\Http\Model\SellWeixin;
use App\Http\Model\Support;
use App\Http\Model\User;
use App\Http\Model\Weibo;
use App\Http\Model\WeiboCom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function test()
    {
        echo rand();
    }
    public function index(Request $request){
        $uid = Session::get('wx_uid');
        $openid = Session::get('wx_openid');
        $userRow = User::where(['openid'=>$openid,'id'=>$uid])->first();

        $weiboList = Weibo::where(['uid'=>$uid,'status'=>1])->orderBy('is_top','desc')->orderBy('create_time','desc')->get();

        $sellWeixin = SellWeixin::where(['uid'=>$uid,'status'=>1])->first();
        if($sellWeixin){
            $sellWeixinStatus = 1;
        }else{
            $sellWeixinStatus = 2;
        }
        
        //$user = Redis::get('hello');
        $uri = $request->path();
        $uri = explode('/',$uri);

        return view('Home.User.index',compact('userRow','weiboList','sellWeixinStatus','uri'));
    }
    public function weiboImgText(Request $request){


        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')) {
            $post = Input::all();
            $content = $post['content'];
            $fileArray = @$post['fileArray'];
            $data['content'] = $content;
            if($fileArray){
                //上传图片
                $fileArray = array_filter($fileArray);
                $imgCount = count($fileArray);
                if($imgCount > 9){
                    $arr = ["msg"=>"图片最多为9张","code"=>2];
                    return $arr;
                }
                $imgID = '';
                $fileArray = array_values($fileArray);
                foreach($fileArray as $key => $v){
                    //匹配出图片的格式
                    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $v, $result)) {
                        $type = $result[2];
                        $new_file = "uploads/weibo/img/".date('Y-m-d')."/";
                        if(!file_exists($new_file))
                        {
                            mkdir($new_file, 0700);
                        }
                        $new_file = $new_file.createNonceStr(10,'str').".{$type}";
                        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $v)))){
                            $imgInfo = getimagesize($new_file);
                            $picData['type']        = 'local';
                            $picData['path']        = '/'.$new_file;
                            $picData['create_time'] = time();
                            $picData['width']       = $imgInfo['0'];
                            $picData['height']      = $imgInfo['1'];
                            $re = Picture::create($picData);
                            if(($key+1) == $imgCount){
                                $imgID .= $re->id;
                            }else{
                                $imgID .= $re->id.',';
                            }
                            if(!$re){
                                $arr = ["msg"=>"存储图片失败","code"=>2];
                                return $arr;
                            }
                        }else{
                            $arr = ["msg"=>"上传图片失败","code"=>2];
                            return $arr;
                        }
                    }
                }
                if($imgID){
                    $hello['attach_id'] = $imgID;
                    $data['data'] = serialize($hello);
                }else{
                    $data['data'] = 'a:0:{}';
                }
                $data['type'] = 'image';
            }else{
                $data['type'] = 'text';
            }
            if(empty($content)){
                $arr = ["msg"=>"内容不能为空","code"=>2];
                return $arr;
            }
            $data['uid'] = $uid;
            $data['create_time'] = time();

            $re = Weibo::create($data);
            if($re){
                $arr = ["msg"=>"发布动态成功","code"=>1];
                return $arr;
            }else{
                $arr = ["msg"=>"发布动态失败","code"=>2];
                return $arr;
            }
        }else{
            return view('Home.User.weiboImgText');
        }


    }

    //出售微信页面
    public function sellWeixin(Request $request)
    {
        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')){
            $post = Input::all();

            $rules = [
                'weixin' => 'required',
                'price' => 'required|numeric|max:1314|min:99',
            ];
            $message = [
                'weixin.required' => '请输入你的微信号！',
                'price.required' => '请输入销售价格！',
                'price.numeric'=> '销售价格限99-1314元之间!',
                'price.max'=> '销售价格限99-1314元之间!',
                'price.min'=> '销售价格限99-1314元之间!',
            ];
            $validator = Validator::make($post,$rules,$message);
            if($validator->passes()){

                $input = Input::except('_token');
                $input['stime'] = time();
                $input['uid'] = $uid;

                $row = SellWeixin::where(['uid'=>$uid])->first();
                if($row){
                    //更新
                    $input = Input::except('_token','_method');
                    $input['stime'] = time();
                    $input['status'] = 1;

                    $re = SellWeixin::where('uid',$uid)->update($input);
                    if($re){
                        return redirect('user/index')->with('success','上架成功');
                    }else{
                        return back()->with('errors','数据更新失败，请稍后重试！');
                    }
                }else{
                    //添加
                    $re = SellWeixin::create($input);
                    if($re){
                        return redirect('user/index')->with('success','上架成功');
                    }else{
                        return back()->with('errors','数据填充失败，请稍后重试！');
                    }
                }
            }else{
                return back()->withErrors($validator)->withInput();
            }

        }else{
            $data = SellWeixin::where('uid',$uid)->first();

            return view('Home.User.sellWeixin',compact('data'));
        }

    }

    public function upload()
    {
        echo rand();
    }
    public function weixinXiajia(){
        $uid = Session::get('wx_uid');
        $input['stime'] = time();
        $input['status'] = 2;
        $re = SellWeixin::where('uid',$uid)->update($input);
        if($re){
            $arr = ["msg"=>"下架成功","code"=>1];
            return $arr;
        }else{
            return back()->with('errors','数据更新失败，请稍后重试！');
        }
    }
    //删除指定微博动态
    public function weiboDel(Request $request){
        $uid = Session::get('wx_uid');
        if($request->isMethod('DELETE')) {
            $post = Input::all();
            $where['id'] = intval($post['id']);
            $where['uid'] = $uid;
            $row = Weibo::where($where)->first();
            if($row){
                $row['status'] = '-1';
                if($row->save()){
                    $arr = ["msg"=>"删除成功","code"=>1];
                    return $arr;
                }else{
                    $arr = ["msg"=>"删除数据失败","code"=>2];
                    return $arr;
                }
            }else{
                $arr = ["msg"=>"非法操作","code"=>2];
                return $arr;
            }

        }
    }
    //置顶微博动态
    public function weiboTop(Request $request){
        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')) {
            $post = Input::all();
            $where['id'] = intval($post['id']);
            $where['uid'] = $uid;
            $isTop = $post['isTop'];

            $row = Weibo::where($where)->first();
            if($row){
                if($isTop == 1){
                    $row['is_top'] = 1;
                    $msg = '置顶成功';
                }else{
                    $row['is_top'] = 0;
                    $msg = '取消成功';
                }
                if($row->save()){
                    $arr = ["msg"=>$msg,"code"=>1];
                    return $arr;
                }else{
                    $arr = ["msg"=>"置顶失败","code"=>2];
                    return $arr;
                }
            }else{
                $arr = ["msg"=>"非法操作","code"=>2];
                return $arr;
            }
        }
    }
    //微博点赞
    public function praise(Request $request){
        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')) {
            $post = Input::all();
            $id = intval($post['id']);
            $where['w_id'] = $id;
            $where['uid'] = $uid;
            $row = Support::where($where)->first();
            if($row){
                //删除
                if($row->delete()){
                    $arr = ["code"=>2];
                    return $arr;
                }else{
                    $arr = ["code"=>3];
                    return $arr;
                }
            }else{
                //添加
                $data['w_id'] = $id;
                $data['uid'] = $uid;
                $data['stime'] = time();
                if(Support::create($data)){
                    $arr = ["code"=>1];
                    return $arr;
                }else{
                    $arr = ["code"=>3];
                    return $arr;
                }

            }
        }
    }
    public function weiboInfo($id){
        $uid = Session::get('wx_uid');
        $row = Weibo::where(['id'=>$id])->first();

        $list = WeiboCom::where(['weibo_id'=>$id])->get();

        return view('Home.User.weiboInfo',compact('row','list'));

    }
    //微博评论接收
    public function do_msgSubmit(Request $request){
        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')) {
            $post = Input::all();
            $id = intval($post['id']);
            $content = $post['content'];
            $data['weibo_id'] = $id;
            $data['uid'] = $uid;
            $data['content'] = $content;
            $data['create_time'] = time();
            if(WeiboCom::create($data)){
                DB::table('weibo')->where(['id'=>$id])->increment('comment_count');
                $arr = ["code"=>1];
                return $arr;
            }else{
                $arr = ["code"=>2];
                return $arr;
            }
        }
    }

    public function getValidatesRequestErrorBag()
    {
        return $this->validatesRequestErrorBag;
    }

    //查看其它用户主页
    public function other($id){
        $uid = Session::get('wx_uid');
        $userRow = User::find($id);
        if(!$userRow){
            return redirect('user/index');
        }
        if($id == $uid){
            return redirect('user/index');
        }

        $weiboList = Weibo::where(['uid'=>$id,'status'=>1])->orderBy('is_top','desc')->orderBy('create_time','desc')->limit(5)->get();

        $fans = Follow::where(['who_follow'=>$uid,'follow_who'=>$id])->select('id')->first();

        return view('Home.User.other',compact('userRow','weiboList','fans'));
    }
    //举报动态
    public function report(Request $request)
    {
        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')) {
            $post = Input::all();
            $wid = $post['id'];
            $row = Report::where(['uid'=>$uid,'wid'=>$wid])->first();
            if($row){
                $arr = ["code"=>1,'msg'=>'举报成功'];
                return $arr;
            }else{
                $data['uid'] = $uid;
                $data['wid'] = $wid;
                $data['stime'] = time();
                $re = Report::create($data);
                if($re){
                    $arr = ["code"=>1,'msg'=>'举报成功'];
                    return $arr;
                }else{
                    $arr = ["code"=>0,'msg'=>'举报失败'];
                    return $arr;
                }
            }
        }
    }
    //主动关注
    public function  fans(Request $request){
        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')) {
            $post = Input::all();
            $id = $post['id'];
            $data['who_follow'] = $uid;
            $data['follow_who'] = $id;
            $data['create_time'] = time();

            $row = Follow::where(['who_follow'=>$uid,'follow_who'=>$id])->first();
            if($row){
                $re = Follow::find($row->id)->delete();
                if($re){
                    $arr = ["code"=>1,'msg'=>'关注'];
                }else{
                    $arr = ["code"=>0,'msg'=>'取消关注失败'];
                }
            }else{
                $re = Follow::create($data);
                if($re){
                    $arr = ["code"=>1,'msg'=>'　已关注'];
                }else{
                    $arr = ["code"=>0,'msg'=>'关注失败'];
                }
            }
            return $arr;
        }
    }
    //购买微信号
    public function addWeixin(Request $request){
        $uid = Session::get('wx_uid');
        if($request->isMethod('POST')) {
            $post = Input::all();
            $id = $post['id'];
            $re = SellWeixin::where(['uid'=>$id,'status'=>1])->first();
            if($re){
                $arr = ["code"=>1];
            }else{
                $arr = ["code"=>0,'msg'=>'对方没有设置微信号，暂时不能聊天。'];
            }
            return $arr;
        }
    }
    //打赏
    public function dashang($id,Request $request){
        if($request->method() == 'POST'){
            $post = Input::all();
            var_dump($post);
        }else{
            $userRow = User::select(['id','headimgurl'])->find($id);
            if(!$userRow){
                $userRow = User::select(['id','headimgurl'])->find(1);
            }
            return view('Home.User.dashang',compact('userRow'));
        }
    }
    //修改个人资料
    public function edit(Request $request)
    {
        $uid = Session::get('wx_uid');
        if($request->method() == 'POST'){
            $post = Input::except('_token');
            $re = User::where('id',$uid)->update($post);
            if($re){
                return redirect('user/index')->with('success','修改成功');
            }else{
                return back()->with('errors','数据更新失败，请稍后重试！');
            }
        }else{
            $userRow = User::find($uid);
            return view('Home.User.edit',compact('userRow'));
        }

    }
    //查看别人的资料
    public function viewData($id){
        $userRow = User::find($id);
        if($userRow){
            return view('Home.User.view',compact('userRow'));
        }else{
            return redirect('user/index');
        }

    }
}
