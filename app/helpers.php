<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017/4/8 11:25
 * version  : 自定义函数
 **/

//获取指定用户指定字段
function getUser($uid,$field){
    $user = \App\Http\Model\User::find($uid,[$field]);
    return $user->$field;
}

//查询指定用户说说的点赞数
function getWeiboSupport($id){
    return \App\Http\Model\Support::where(['w_id'=>$id])->count();
}

//获取用户说说中的图片
function getWeiboPic($id){
    $data = \App\Http\Model\Weibo::find($id,['data']);
    $data = unserialize($data->data);
    if(!$data){
        return false;
    }
    $arr = explode(',',$data['attach_id']);
    $html = '';
    foreach($arr as $k=>$v){
        $row = \App\Http\Model\Picture::find($v);
        if($row){
            if(count($arr) == 1){
                $html .= '<figure class="my-gallery-0 line-1"><div class="my-gallery-1"><a href="'.$row->path.'" data-size="800x800"><img  style="height: 2.5rem;" src="'.$row->path.'"></a></div></figure>';
            }else{
                $html .= '<figure class="my-gallery-0 line-2"><div class="my-gallery-1"><a href="'.$row->path.'" data-size="800x800"><img  style="height: 1.5rem;" src="'.$row->path.'"></a></div></figure>';
            }
        }
    }
    return $html;
}

//格式化时间
function format_date($time){
    $t=time()-$time;
    $f=array(
        '31536000'=>'年',
        '2592000'=>'个月',
        //'604800'=>'星期',
        '86400'=>'天',
        '3600'=>'小时',
        '60'=>'分钟',
        '1'=>'秒'
    );
    foreach ($f as $k=>$v)    {
        if (0 !=$c=floor($t/(int)$k)) {
            return $c.$v.'前';
        }
    }
}

//获取用户的关注数和粉丝数
function fans($uid,$type ='fans'){
    if($type == 'fans'){
        $count = \App\Http\Model\Follow::where(['follow_who'=>$uid])->count();
    }else{
        $count = \App\Http\Model\Follow::where(['who_follow'=>$uid])->count();
    }
    return $count;
}

//随机数字或字母
function createNonceStr($length = 16,$type='num') {
    if($type == 'num'){
        $chars = "0123456789";
    }else{
        $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
    }
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}


function getWeiboSupportStyle($id){
    $uid = \Illuminate\Support\Facades\Session::get('wx_uid');
    $row = \App\Http\Model\Support::where(['w_id'=>$id,'uid'=>$uid])->count();
    if($row){
        return '<i style="background: url(\'/home/images/like_white_2.png\') 0% 0% / contain no-repeat;"></i>';
    }else{
        return '<i></i>';
    }
}
