<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title></title>
    <link rel="stylesheet" href="/Home/css/reset.css"/>
    <link rel="stylesheet" href="/Home/css/index.css"/>
    <link rel="stylesheet" href="/Home/css/public.css"/>

    <script type="text/javascript">
        var winW = document.documentElement.clientWidth;
        document.documentElement.style.fontSize = winW / 6.4 + "px";
    </script>
</head>
<body>
<div class="find_nav">
    <div class="find_nav_left">
        <div class="find_nav_list" style="margin-left: -48px">
            <ul>
                <li><a href="{{url('find/index')}}">推荐</a></li>
                <li class="find_nav_cur"><a href="{{url('find/nearby')}}">附近</a></li>
                <li class="sideline"></li>
            </ul>
        </div>
    </div>
    <ul class="screen-xuan" id="screen">
        <li class="s-nl">
            <a class="screen"  href="javascript:;">筛选</a>
            <div class="screenFix">
                <div class="scr-choose clearfix">
                    <a href="">只看男</a><a href="">只看女</a>
                    <div class="border"></div>
                </div>
                <div class="scr-all">全部</div>
            </div>
        </li>

    </ul>


</div>
<div class="blankNav"></div>
<div class="index">
    <ul class="nearByList0">
        <li>
            <a href="">
                <img src="/Home/images/img1.png" alt=""/>
                <div class="nearTxt">
                    <h5>鲜肉2030</h5>
                    <p><span>杭州</span><span>粉丝：0</span><span>关注：0</span></p>
                </div>
                <div class="nearDis">1公里内</div>
            </a>
        </li>

    </ul>
</div>
@include('Home.Public.nav')
<script>
    $(function(){
        $('.screen').click(function(){
            $('.screenFix').toggle();
        })


    })
</script>
</body>
</html>
