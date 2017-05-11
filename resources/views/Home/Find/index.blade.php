<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title></title>
    <link rel="stylesheet" href="/Home/css/reset.css"/>
    <link rel="stylesheet" href="/Home/css/index.css"/>
    <link rel="stylesheet" href="/Home/css/public.css"/>
    <script type="text/javascript" src="/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Home/js/findnavjs.js"></script>
    <link rel="stylesheet" type="text/css" href="/Home/css/css/demo.css">
    <link rel="stylesheet" type="text/css" href="/Home/css/css/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="/Home/css/css/default-skin/default-skin.css">
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
<div class="find_nav">
    <div class="find_nav_left">
        <div class="find_nav_list" style="margin-left: -48px">
            <ul>
                <li class="find_nav_cur"><a href="{{url('find/index')}}">推荐</a></li>
                <li><a href="{{url('find/nearby')}}">附近</a></li>
                <li class="sideline"></li>
            </ul>
        </div>
    </div>
</div>
<div class="blankNav"></div>
<div class="index">
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

                                <div class="comRightR">{{format_date($v->create_time)}}</div>

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

                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',0)"><span class="res-foot"></span></div>

                        </div>
                    @elseif($v->type == 'video')
                        <div class="clearfix comRightTxt">
                            <a href="{{url('winfo/'.$v->id)}}">
                                <div class="comRightLeft">
                                    <h3>{{getUser($v->uid,'nickname')}}</h3>
                                    <p>{{$v->content}}</p>
                                </div>
                                <div class="comRightR">{{format_date($v->create_time)}}</div>
                            </a>
                        </div>
                        <div class="picV">
                            <img src="/home/images/img1.png" alt=""/>
                            <div class="playV"></div>
                        </div>
                        <div class="rec-actions clearfix">
                            <button class="praise-actions" onclick="praise(this,'{{$v->id}}')">
                                {!!  getWeiboSupportStyle($v->id) !!}<span>{{getWeiboSupport($v->id)}}</span></button>
                            <button class="comment-actions" onclick='location.href="{{url('winfo/'.$v->id)}}"'><i></i><span>{{$v->comment_count}}</span></button>
                            <button class="video-actions"><i></i><span>1</span></button>
                            <div class="res-foot" onclick="button_del(this,'{{$v->id}}',0)"><span class="res-foot"></span></div>

                        </div>
                    @endif

                </div>
            </li>
        @endforeach
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
@include('Home.Public.nav')
</body>
<script src="http://cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="/Home/js/js-photo/photoswipe.js"></script>
<script src="/Home/js/js-photo/photoswipe-ui-default.min.js"></script>
<script src="/Home/js/js-photo/photoswipe-jq.js"></script>
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
    */
    function button_del(obj,id){
        $.actions({
            actions: [{
                text: '举报动态',
                onClick: function() {
                    $.ajax({
                        type:"POST",
                        url:"{{url('weibo/report')}}",
                        data: {id: id,'_token':"{{csrf_token()}}"},
                        success: function(data) {
                            if(data.code == 1){
                                $.toast(data.msg);
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
</html>
