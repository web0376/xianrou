<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017/4/22 16:03
 * version  : 微博动态详情页面
 **/
?>
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
    <link rel="stylesheet" type="text/css" href="/home/css/css/demo.css">
    <link rel="stylesheet" type="text/css" href="/home/css/css/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="/home/css/css/default-skin/default-skin.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="/home/css/jquery-weui.min.css">
    <style>
        .weui-toast_content{color:#fff;}
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
        <a href="javascript:;" class="back"></a>
        <div class="topAlign">详情</div>
    </div>
</div>
<div class="blankTop"></div>
<div class="index">
    <ul class="recommendList" style="background:#f3f3f3 ;">
        <li class="clearfix recommendLi">
            <div class="comHead">
                <img src="{{getUser($row->uid,'headimgurl')}}" alt=""/>
                {{--<div class="v"></div>--}}
            </div>
            <div class="comRight">
                <div class="clearfix">
                    <div class="comRightLeft">
                        <h3>{{getUser($row->uid,'nickname')}}</h3>
                        <p>{{$row->content}}</p>
                    </div>
                    <div class="comRightR">{{format_date($row->create_time)}}</div>
                </div>
                <div class="contain">
                    <ul>
                        <li>
                            <div class="my-gallery " data-pswp-uid="1">
                                {!! getWeiboPic($row->id) !!}
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                    <!-- 背景photoswipe
                    它是一个单独的元素作为动画透明度比rgba()。 -->
                    <div class="pswp__bg"></div>
                    <!--溢出：隐藏的幻灯片包装。-->
                    <div class="pswp__scroll-wrap">

                        <!--保存幻灯片的容器。
                            photoswipe保持他们中只有3在DOM中节省内存。不要修改这些3 pswp__item元素，数据是后来加入的。
                            -->
                        <div class="pswp__container">
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                        </div>
                        <!--默认（photoswipeui_default）上滑动区界面。可以改变。 -->
                        <div class="pswp__ui pswp__ui--hidden">
                            <div class="pswp__top-bar">

                                <!-- 控件是自解释的。订单可以更改。-->
                                <div class="pswp__counter"></div>
                                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                                <!--元素将获得类pswp__preloader主动当预载运行 -->
                                <div class="pswp__preloader">
                                    <div class="pswp__preloader__icn">
                                        <div class="pswp__preloader__cut">
                                            <div class="pswp__preloader__donut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pswp__caption">
                                <div class="pswp__caption__center"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="rec-actions clearfix">
                    <button class="praise-actions">{!!  getWeiboSupportStyle($row->id) !!}<span>{{getWeiboSupport($row->id)}}</span></button>
                    <button class="comment-actions"><i></i><span>{{$row->comment_count}}</span></button>
                    <div  class="res-foot" onclick="button_del('{{$row->id}}')"><span id="res-foot"></span></div>
                </div>
            </div>
        </li>
    </ul>
    <ul class="giveUpList"></ul>
    <ul class="detailList" style="margin-bottom: 50px;">
        @if(count($list))
            @foreach($list as $v)
            <li class="clearfix">
                <a href="#">
                    <div class="detHead">
                        <img src="{{getUser($v->uid,'headimgurl')}}" alt=""/>
                    </div>
                    <div class="detRight">
                        <h3>{{getUser($v->uid,'nickname')}}</h3>
                        <p>{{$v->content}}</p>
                    </div>
                    <div class="detDate">{{format_date($v->create_time)}}</div>
                </a>
            </li>
            @endforeach
        @else
            <div style="text-align: center;padding: 10px;color: #999;">暂时还没有人评论Ta,快来评论吧</div>
        @endif
    </ul>
</div>
<div class="fixed-comment">
    <input type="text" placeholder="评论" id="msgs"/>
    <button id="msgSubmit">发送</button>
</div>
</body>
<script src="http://cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="/home/js/js-photo/photoswipe.js"></script>
<script src="/home/js/js-photo/photoswipe-ui-default.min.js"></script>
<script src="/home/js/js-photo/photoswipe-jq.js"></script>
<script>
    window.onload=function(){
        auto_data_size();
    };
    function auto_data_size(){
        var imgss= $("figure img");
        $("figure img").each(function() {
            var imgs = new Image();
            imgs.src=$(this).attr("src");
            var w = imgs.width,
                    h =imgs.height;
            $(this).parent("a").attr("data-size","").attr("data-size",w+"x"+h);
        })
    };
    function button_del(id){

        $.actions({
            actions: [{
                text: "删除动态",
                className: "color-danger",
                onClick: function() {
                    $.ajax({
                        type:"DELETE",
                        url:"{{url('weibo/delete')}}",
                        data: {id: id,'_token':"{{csrf_token()}}"},
                        success: function(data) {
                            if(data.code == 1){
                                $.toast('删除成功');
                                setTimeout(function(){
                                    window.location.href= "{{url('user/index')}}";
                                },2000)
                            }else{
                                $.toast('删除失败，请联系在线客服。', "cancel");
                            }
                        }
                    })
                }
            }]
        });
    }
    $(function(){
        $('#msgSubmit').click(function(){
            msgs = $('#msgs').val();
            if(msgs.length == 0){
                $.toast('请输入评论内容。', "text");
                return false;
            }
            id = "{{$row->id}}";
            $.ajax({
                type:"POST",
                url:"{{url('weibo/do_msgSubmit')}}",
                data: {id: id,'_token':"{{csrf_token()}}",'content':msgs},
                success: function(data) {
                    if(data.code == 1){
                        $.toast('评论成功');
                        setTimeout(function(){
                            html = '<li class="clearfix"><a href="#"><div class="detHead"><img src="{{getUser(session('wx_uid'),'headimgurl')}}" alt=""/></div><div class="detRight"><h3>{{getUser(session('wx_uid'),'nickname')}} </h3><p>'+msgs+'</p></div><div class="detDate">1秒前</div></a></li>';
                            $('.detailList').prepend(html);

                            number = $('.comment-actions').find("span").html();
                            num = parseInt(number) + 1;
                            $('.comment-actions').find("span").html(num);
                        },2000)
                    }else{
                        $.toast('评论失败，请联系在线客服。', "cancel");
                    }
                }
            })
        })
    })
</script>
@include('Home.Public.cnzz')
</html>



