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
</head>
<body>
<div class="top">
    <div class="topCon" onclick="javascript:history.go(-1);">
        <a href="" class="back"></a>

        <div class="topAlign">基本资料</div>
    </div>
</div>
<div class="blankTop"></div>
<div class="index">
    <div class="per-headTop">
        <div class="per-head">
            <img src="{{$userRow->headimgurl}}" alt=""/>
            {{--<div class="v"></div>--}}
        </div>
    </div>
    <table class="per-table" width="100%">
        <tr>
            <td>昵称</td>
            <td>{{$userRow->nickname}}</td>
        </tr>
        <tr>
            <td>性别</td>
            <td>{{$userRow->sex}}</td>
        </tr>
        <tr>
            <td>城市</td>
            <td>{{$userRow->city}}</td>
        </tr>
        <tr>
            <td>身高</td>
            <td>{{$userRow->height}}</td>
        </tr>
        <tr>
            <td>体重</td>
            <td>{{$userRow->weight}}</td>
        </tr>
        <tr>
            <td>职业</td>
            <td>{{$userRow->work}}</td>
        </tr>
        <tr>
            <td>学校</td>
            <td>{{$userRow->school}}</td>
        </tr>
        <tr>
            <td>星座</td>
            <td>{{$userRow->star_sign}}</td>
        </tr>
    </table>
</div>
</body>
</html>
