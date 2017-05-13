<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>个人中心</title>
    <link rel="stylesheet" href="/home/css/reset.css"/>
    <link rel="stylesheet" href="/home/css/public.css"/>
    <link rel="stylesheet" href="/home/css/index.css"/>
    <link rel="stylesheet" href="/home/css/swiper.min.css"/>
    <script type="text/javascript" src="/home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/home/js/findnavjs.js"></script>
    <link rel="stylesheet" type="text/css" href="/home/css/css/demo.css">
    <link rel="stylesheet" type="text/css" href="/home/css/css/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="/home/css/css/default-skin/default-skin.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="/home/css/jquery-weui.min.css">

    <style>
        .weui-toast_content{color:#fff;}
        .color-danger{color:#f6383a;}
    </style>
    <script type="text/javascript">
        var winW = document.documentElement.clientWidth;
        document.documentElement.style.fontSize = winW / 6.4 + "px";
        //document.body.style.fontSize = '6.4rem';
    </script>
</head>
<body>
<div class="index">
    <div class="otherTop">
        <img src="/home/images/userHead.jpg" alt=""/>
    </div>
    <div class="otherHead" onclick=location.href="{{url('user/edit')}}">
        <div class="otherHeadImg">
            <img src="{{$userRow->headimgurl}}" alt=""/>

            {{--<div class="v"></div>--}}
        </div>
        <div class="otherHeadRight">
            <h3 style="margin-top: 0.2rem"><span>{{$userRow->nickname}}</span>
                @if($userRow->sex == 1)
                    <i class="man"></i>
                @else
                    <i class="woman"></i>
                @endif
            </h3>
        </div>
    </div>
    <div class="myIcon">
        <div class="myIconAll">总收入<span>0</span>元</div>
        <div class="myIconAll">今日收益<span>0</span>元</div>

    </div>
    <ul class="otherFans">
        <li>
            <h3>{{fans(session('wx_uid'),'follow')}}</h3>

            <p>关注</p>
        </li>
        <li>
            <h3>{{fans(session('wx_uid'),'fans')}}</h3>

            <p>粉丝</p>
        </li>
        <li>
            <h3>{{count($weiboList)}}</h3>

            <p>我的动态</p>
        </li>
    </ul>
    <!--
    <div class="swiper-container addPic">
        <ul class="swiper-wrapper clearfix">
            <li class="swiper-slide"><button></button></li>
            {{--<li class="swiper-slide"><img src="/home/images/img1.png" alt=""/></li>
            <li class="swiper-slide"><img src="/home/images/img1.png" alt=""/></li>
            <li class="swiper-slide"><img src="/home/images/img1.png" alt=""/></li>
            <li class="swiper-slide"><img src="/home/images/img1.png" alt=""/></li>
            <li class="swiper-slide"><img src="/home/images/img1.png" alt=""/></li>--}}
        </ul>
    </div>
    -->
    <div class="my-sell clearfix">
        <div class="mySellLeft">
            出售我的微信
            @if($sellWeixinStatus == 1)
                <div class="sell-icon"></div>
            @endif
        </div>
        <div class="mySellRight">
            <a href="{{url('user/sellWeixin')}}" class="sellLink">编辑</a>
            <p>100人已购买了你的私人微信</p>
        </div>
    </div>
    <div class="myShop">
        <a href="#"></a>
        <a href="#"></a>
    </div>
    <ul class="recommendList">
        @foreach($weiboList as $v)
        <li class="clearfix recommendLi">

            <div class="comHead">
                <a href="{{url('winfo/'.$v->id)}}">
                    <img src="{{getUser($v->uid,'headimgurl')}}" alt=""/>
                    {{--<div class="v"></div>--}}
                </a>
            </div>
            <div class="comRight">
                @if($v->type == 'text')
                    <div class="clearfix comRightTxt">
                        <a href="{{url('winfo/'.$v->id)}}">
                            <div class="comRightLeft">
                                <h3>{{getUser($v->uid,'nickname')}}</h3>
                                <p>{{$v->content}}</p>
                            </div>

                            @if($v->is_top == 1)
                                <div class="comRightR"><button class="ulTop"><i></i>置顶</button></div>
                            @else
                                <div class="comRightR">{{format_date($v->create_time)}}</div>
                            @endif
                        </a>
                    </div>

                    <div class="rec-actions clearfix">
                        <button class="praise-actions" onclick="praise(this,'{{$v->id}}')">{!!  getWeiboSupportStyle($v->id) !!}<span>{{getWeiboSupport($v->id)}}</span></button>
                        <button class="comment-actions" onclick='location.href="{{url('winfo/'.$v->id)}}"'><i></i><span>{{$v->comment_count}}</span></button>
                        @if($v->is_top == 1)
                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',1)"><span class="res-foot"></span></div>
                        @else
                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',0)"><span class="res-foot"></span></div>
                        @endif
                    </div>
                @elseif($v->type == 'image')

                    <div class="clearfix comRightTxt">
                        <a href="{{url('winfo/'.$v->id)}}">
                            <div class="comRightLeft">
                                <h3>{{getUser($v->uid,'nickname')}}</h3>
                                <p>{{$v->content}}</p>
                            </div>
                            @if($v->is_top == 1)
                                <div class="comRightR"><button class="ulTop"><i></i>置顶</button></div>
                            @else
                                <div class="comRightR">{{format_date($v->create_time)}}</div>
                            @endif
                        </a>
                    </div>
                    <div class="contain">
                        <ul>
                            <li>
                                <div class="my-gallery " data-pswp-uid="1">
                                    {!! getWeiboPic($v->id) !!}
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <div class="rec-actions clearfix">
                        <button class="praise-actions" onclick="praise(this,'{{$v->id}}')">{!!  getWeiboSupportStyle($v->id) !!}<span>{{getWeiboSupport($v->id)}}</span></button>
                        <button class="comment-actions" onclick='location.href="{{url('winfo/'.$v->id)}}"'><i></i><span>{{$v->comment_count}}</span></button>
                        @if($v->is_top == 1)
                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',1)"><span class="res-foot"></span></div>
                        @else
                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',0)"><span class="res-foot"></span></div>
                        @endif
                    </div>
                @elseif($v->type == 'video')
                    <div class="clearfix comRightTxt">
                        <a href="{{url('winfo/'.$v->id)}}">
                            <div class="comRightLeft">
                                <h3>{{getUser($v->uid,'nickname')}}</h3>
                                <p>{{$v->content}}</p>
                            </div>
                            @if($v->is_top == 1)
                                <div class="comRightR"><button class="ulTop"><i></i>置顶</button></div>
                            @else
                                <div class="comRightR">{{format_date($v->create_time)}}</div>
                            @endif
                        </a>
                    </div>
                    <div class="picV">
                        {!!  getWeiboVideo($v->id) !!}
                        {{--<img src="/home/images/img1.png" alt=""/>--}}
                        {{--<div class="playV"></div>--}}
                    </div>
                    <div class="rec-actions clearfix">


                        <button class="praise-actions" onclick="praise(this,'{{$v->id}}')">
                            {!!  getWeiboSupportStyle($v->id) !!}<span>{{getWeiboSupport($v->id)}}</span></button>
                        <button class="comment-actions" onclick='location.href="{{url('winfo/'.$v->id)}}"'><i></i><span>{{$v->comment_count}}</span></button>
                        {{--<button class="video-actions"><i></i><span>1</span></button>--}}

                        @if($v->is_top == 1)
                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',1)"><span class="res-foot"></span></div>
                        @else
                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',0)"><span class="res-foot"></span></div>
                        @endif
                    </div>
                @endif

            </div>
        </li>
        @endforeach

    </ul>
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
    @include('Home.Public.nav')
</div>
<script src="http://cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="/home/js/js-photo/photoswipe.js"></script>
<script src="/home/js/js-photo/photoswipe-ui-default.min.js"></script>
<script src="/home/js/js-photo/photoswipe-jq.js"></script>
<script src="/home/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    @if (Session::has('success'))
        $.toast("{{Session::get('success')}}");
    @endif

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

    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 5
    });
    function button_del(obj,id,title){
        if(title == 1){
            isTop = 0;
            titles = '取消置顶';
        }else{
            isTop = 1;
            titles = '置顶动态';
        }
        $.actions({
            actions: [{
                text: titles,
                onClick: function() {
                    $.ajax({
                        type:"POST",
                        url:"{{url('weibo/top')}}",
                        data: {id: id,isTop:isTop,'_token':"{{csrf_token()}}"},
                        success: function(data) {
                            if(data.code == 1){
                                $.toast(data.msg);
                                setTimeout(function(){
                                    window.location.reload();
                                },2000)
                            }else{
                                $.toast(data.msg, "cancel");
                            }
                        }
                    })
                }
            },{
                text: "删除动态",
                className: "color-danger",
                onClick: function() {
                    $.ajax({
                        type:"DELETE",
                        url:"{{url('weibo/delete')}}",
                        data: {id: id,'_token':"{{csrf_token()}}"},
                        success: function(data) {
                            if(data.code == 1){
                                $.toast(data.msg);
                                $(obj).parent().parent().parent().remove();
                            }else{
                                $.toast(data.msg, "cancel");
                            }
                        }
                    })
                }
            }]
        });
    }
    //点赞
    function praise(obj,id){
        number = $(obj).find("span").html();
        $.ajax({
            type:"POST",
            url:"{{url('weibo/praise')}}",
            data: {id: id,'_token':"{{csrf_token()}}"},
            success: function(data) {
                if(data.code == 1){
                    num = parseInt(number) + 1;
                    $(obj).find("span").html(num);
                    $(obj).find("i").css({'background':'url("/home/images/like_white_2.png") no-repeat','background-size':'contain'});
                }else if(data.code == 2){
                    num = parseInt(number) - 1;
                    $(obj).find("span").html(num);
                    $(obj).find("i").css({'background':'url("/home/images/like_white.png") no-repeat','background-size':'contain'});
                }
            }
        })
    }
</script>
</body>
</html>
