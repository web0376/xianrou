<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title></title>
    <link rel="stylesheet" href="/home/css/reset.css"/>
    <link rel="stylesheet" href="/home/css/public.css"/>
    <link rel="stylesheet" href="/home/css/index.css"/>
    <script type="text/javascript" src="/home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/home/js/findnavjs.js"></script>
    <style>
        .layui-m-layercont{color:#fff;}
    </style>
    <script type="text/javascript">
        var winW = document.documentElement.clientWidth;
        document.documentElement.style.fontSize = winW / 6.4 + "px";
        //document.body.style.fontSize = '6.4rem';
    </script>
</head>
<body>
<div class="top">
    <div class="topCon" onclick="javascript:history.go(-1);">
        <a class="back"></a>
        <div class="topAlign">编辑</div>
    </div>
</div>
<div class="blankTop"></div>
<div class="index">



    <form method="post"  action="" class="sell-weixin">
        {{csrf_field()}}
        <div class="sell-tr">
            <span class="sw-span"></span>
            <div class="sell-td">
                <input type="text" name="weixin" value="{{ old('weixin') ?  old('weixin') : @$data->weixin}}" class="form-control" placeholder="输入您的微信号"/>
            </div>
        </div>
        <div class="sell-tr">
            <span class="sm-span"></span>
            <div class="sell-td">
                <input type="number" name="price" value="{{ old('price') ?  old('price') : @$data->price}}" class="form-control" placeholder="输入您的价格"/>
            </div>
        </div>
        @if(count($errors))
            <div class="sell-note">{{ $errors->first() }}</div>
        @else
            <div class="sell-note">销售价格限99-1314元之间</div>
        @endif

        <div class="sell-btn">
            @if(@$data->status == 1)
                <button type="button" class="sell-affirm" id="xiajia" style="border: 0px;float:left;width:35%;">下架</button>
            @else
                <a href="javascript:;" class="sell-sold">下架</a>
            @endif

            <button type="submit" class="sell-affirm" style="border: 0px;">确认出售</button>
        </div>
    </form>
    <div id="sell-rule"  class="sell-rule"  style="display: none">
        <style>
            .layui-m-layerbtn span[yes] {
                color: #ffffff;
            }
            .layui-m-layerbtn{
                position: relative;
                left: 50%;
                bottom: 20px;
                margin-left: -69px;
                display: inline-block;
                border: none;
                outline: none;
                font-size: 16px;
                color: #ffffff;
                width: 138px;
                height: 45px;
                line-height: 45px;
                background: #e7595d;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
            }
        </style>
        <div class="sellRp">1.买家留下微信号，由卖家添加后，进入买家列表进行确认；</div>
        <div class="sellRp">2.长时间不添加买家微信，出售功能将被禁用；</div>
        <div class="sellRp">3.任何绕过平台私加买家微信的，都将被封禁；</div>

    </div>
</div>
</body>

<script type="text/javascript" src="/home/js/layer_mobile/layer.js"></script>
<script type="text/javascript" src="/home/js/cookie.js"></script>
<script id="jsID" type="text/javascript">
isFabu = getCookie('is_fabu');
if(isFabu != 'ok'){
    layer.open({
        type:0,  //--默认：0，设置弹层的类型，0表示信息框，1表示页面层，2表示加载层
        btn: '我了解了',
        btnAlign: 'c',
        title: '微信号出售规则', //显示标题
        skin: 'layui-layer-demo', //样式类名
        shadeClose: true, //点击遮罩关闭
        shade: 0.6, //遮罩透明度
        moveType: 1, //拖拽风格，0是默认，1是传统拖动
        shift: 1, //0-6的动画形式，-1不开启
        content:$('#sell-rule').html(),
        yes: function(index){
            setCookie('is_fabu','ok');
            layer.close(index);
        }
    });
}
</script>
<script>
    $(function(){

        $('#xiajia').click(function(){
            $.post("{{url('user/weixinXiajia')}}",{'_token':'{{csrf_token()}}'},function(data){
                if(data.code == 1){
                    layer.open({
                        content: '下架成功'
                        ,skin: 'msg'
                        ,time: 2
                    });
                    setTimeout("location.href='{{url('user/index')}}'",3000)
                }else{
                    layer.open({
                        content: '下架失败啦,请联系在线客服！'
                        ,skin: 'msg'
                        ,time: 2
                    });
                }
            });
        })
    })
</script>
@include('Home.Public.cnzz')
</html>
