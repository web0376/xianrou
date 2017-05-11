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
    <script type="text/javascript">
        var winW = document.documentElement.clientWidth;
        document.documentElement.style.fontSize = winW / 6.4 + "px";
        //document.body.style.fontSize = '6.4rem';
    </script>
    <style>
        html{
            background: #f7f5f6;
        }
    </style>
</head>
<body>
<div class="tip">
    <div class="topTip">
        <div class="tipHead">
            <img  src="{{$userRow->headimgurl}}" alt=""/>
            {{--<div class="v"></div>--}}
        </div>
    </div>
    <p>发个红包，拉近距离</p>
    <div class="inputMoney">
        @if(@$_GET['type'] == 'weixin')
            <input type="text" value="150" disabled/>
        @else
            <input type="number" maxlength="4" placeholder="请输入金额"/>
        @endif
    </div>
    <ul class="tipList clearfix">
        <li><button><img src="/home/images/red_open_8.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_28.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_69.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_122.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_258.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_520.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_666.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_1314.png" alt=""/></button></li>
        <li><button><img src="/home/images/red_open_weixin.png" alt=""/></button></li>
    </ul>
    <div class="tipPay"><button>微信支付</button></div>
</div>
@include('Home.Public.cnzz')
</body>
</html>
