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
        <a class="back" ></a>
        <div class="topAlign">基本资料</div>
    </div>
</div>
<div class="blankTop"></div>
<div class="index">
    <div class="per-headTop" style="padding-top: 0.5rem">
        <div class="per-head">
            <img src="{{$userRow->headimgurl}}" alt=""/>
            {{--<div class="v"></div>--}}
        </div>
    </div>
    <form action="" method="POST">
        {{csrf_field()}}
    <table class="editTable" width="100%">
        <tbody>
        <tr>
            <td>昵称</td>
            <td><input type="text"  class="inputtxt" value="{{$userRow->nickname}}"/><label></label></td>
        </tr>
        <tr>
            <td>性别</td>
            <td>
                  <span class="select-box">
                  <select class="select" size="1">
                      <option value="1" @if($userRow->sex == '1') selected @endif>男</option>
                      <option value="2" @if($userRow->sex == '2') selected @endif>女</option>
                  </select>
                </span>
                <label></label>
            </td>
        </tr>
        <tr>
            <td>城市</td>
            <td><div class="inputDq"><input name="city" id="city-picker3" class="form-control city-picker-input inputtxt"  type="text" value="北京市/北京市/东城区" data-toggle="city-picker"/></div>
            </td>
        </tr>
        <tr>
            <td>身高</td>
            <td><input type="number" name="height" maxlength="3" class="inputtxt" value="{{$userRow->height}}"/><label></label></td>
        </tr>
        <tr>
            <td>体重</td>
            <td><input type="number" name="weight" maxlength="3" class="inputtxt" value="{{$userRow->weight}}"/><label></label></td>
        </tr>
        <tr>
            <td>职业</td>
            <td><input type="text" name="work" class="inputtxt" value="{{$userRow->work}}"/><label></label></td>
        </tr>
        <tr>
            <td>学校</td>
            <td><input type="text" name="school" class="inputtxt" value="{{$userRow->school}}"/><label></label></td>
        </tr>
        <tr>
            <td>星座</td>
            <td>
                <select class="select" name="star_sign">
                    <option value="水瓶座" @if($userRow->star_sign == '水瓶座') selected @endif>水瓶座</option>
                    <option value="双鱼座" @if($userRow->star_sign == '双鱼座') selected @endif>双鱼座</option>
                    <option value="白羊座" @if($userRow->star_sign == '白羊座') selected @endif>白羊座</option>
                    <option value="金牛座" @if($userRow->star_sign == '金牛座') selected @endif>金牛座</option>
                    <option value="双子座" @if($userRow->star_sign == '双子座') selected @endif>双子座</option>
                    <option value="巨蟹座" @if($userRow->star_sign == '巨蟹座') selected @endif>巨蟹座</option>
                    <option value="狮子座" @if($userRow->star_sign == '狮子座') selected @endif>狮子座</option>
                    <option value="处女座" @if($userRow->star_sign == '处女座') selected @endif>处女座</option>
                    <option value="天枰座" @if($userRow->star_sign == '天枰座') selected @endif>天枰座</option>
                    <option value="天蝎座" @if($userRow->star_sign == '天蝎座') selected @endif>天蝎座</option>
                    <option value="射手座" @if($userRow->star_sign == '射手座') selected @endif>射手座</option>
                    <option value="摩羯座" @if($userRow->star_sign == '摩羯座') selected @endif>摩羯座</option>
                </select>
                <label></label>
            </td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">保存</button></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    </form>
</div>
<script type="text/javascript" src="/home/js/city-picker.data.js"></script>
<script type="text/javascript" src="/home/js/city-picker.js"></script>
<script>
    @if(count($errors))
            alert("{{ $errors }}");
    @endif
</script>
</body>
</html>
