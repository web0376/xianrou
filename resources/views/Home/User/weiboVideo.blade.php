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
    <script>
        function preventDefault(ev) {
            ev.preventDefault()
        }
        document.addEventListener('touchmove', preventDefault, false)
    </script>
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
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <div class="weui-uploader">
                <div class="weui-uploader__bd">
                    <ul class="weui-uploader__files" id="uploaderFiles">

                    </ul>
                    <div class="weui-uploader__input-box">
                        <input id="uploaderInput" class="weui-uploader__input" type="file" accept="video/*" name="videos" multiple>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">

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