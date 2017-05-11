<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="/home/js/layer_mobile/layer.js"></script>
<!--底部固定-->
<div class="foot"></div>
<section class="fixed">
    <ul class="clearfix">
        <li class="fixed-f1"><a href="/"><i></i><p>鲜肉</p></a></li>
        <li class="fixed-f2"><a href="{{url('find/index')}}"><i></i><p>发现</p></a></li>
        <li class="fixed-f3"><a href="javascript:;" id="fabuweibo"><span></span></a></li>
        <li class="fixed-f4"><a href=""><i></i><p>聊天</p></a></li>
        <li class="fixed-f5 bg"><a href="{{url('user/index')}}"><i></i><p>我6</p></a></li>
    </ul>
</section>
<?php
        var_dump($_GET);

        ?>
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
<div class="publish">
    <ul class="publishList clearfix">
        <li>
            <a href="{{url('user/sellWeixin')}}">
                <i class="publish-i0"></i>
                <p>出售微信</p>
            </a>

        </li>
        <li>
            <a href="javascript:;" class="kefu">
                <i class="publish-i1"></i>
                <p>红包照片</p>
            </a>
        </li>
        <li>
            <a href="{{url('user/weiboImgText')}}">
                <i class="publish-i2"></i>
                <p>图文动态</p>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="kefu">
                <i class="publish-i3"></i>
                <p>视频动态</p>
            </a>
        </li>
    </ul>
    <div class="publishButton">
        <button></button>
    </div>
</div>
<script>
    $(function(){
        $('#fabuweibo').click(function(){
            $('.publish').fadeIn();
        })
        $('.publishButton').click(function(){
            $('.publish').fadeOut();
        })
        $('.kefu').click(function(){
            alert(123);
        })
    })

</script>
@include('Home.Public.cnzz')