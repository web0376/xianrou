<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发表视频动态</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="/home/css/main.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>

    <link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Home/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/Home/js/fileinput.js" type="text/javascript"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        .file-preview-frame{margin: 8px auto;float: none;}
        .file-caption-main{width: 85%;margin: auto;}
        .file-preview{width: 85%;margin: auto;margin-bottom: 5px;}
    </style>
</head>
<body>

<header id="header">
    <a class="left" href="javascript:history.back();">取消</a>
    <span class="title">视频动态</span>
    <a class="right" href="javascript:;" id="fabu">发布</a>
</header>
<form id="form" action="" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
<textarea class="content" id="content" name="content" cols="30" rows="5" placeholder="这一刻你的想法..."></textarea>
<div class="weui-gallery" id="gallery">
    <span class="weui-gallery__img" id="galleryImg"></span>
    <div class="weui-gallery__opr">
        <a href="javascript:" class="weui-gallery__del">
            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
        </a>
    </div>
</div>
    <div class="htmleaf-container" style="margin-bottom: 30px;">
        <div class="container kv-main">
                <input id="file-0a" name="videos" class="file" type="file" data-min-file-count="1" accept="video/*">
        </div>
    </div>

</form>
<script type="text/javascript">
    @if(count($errors))
        $.toast("{{$errors}}", "cancel");
    @endif
</script>

<script>
    $(function(){
        $('#fabu').click(function(){
            $('#form').submit();
        })
    })
</script>
@include('Home.Public.cnzz')
</body>
</html>