<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发表图文动态</title>
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
    <span class="title">写动态</span>
    <a class="right" href="javascript:;" id="fabu">发布</a>
</header>
<textarea class="content" id="content" cols="30" rows="10" placeholder="这一刻你的想法..."></textarea>

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
                        <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" name="fileselect[]" multiple>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    imgUpdateFiles = new Array();
    $(function(){
        var $gallery = $("#gallery"), $galleryImg = $("#galleryImg"),
            $uploaderInput = $("#uploaderInput"),
            $uploaderFiles = $("#uploaderFiles"),
            $weuiGalleryDel= $(".weui-gallery__del")
            ;

        $uploaderInput.on("change", function(e){
            var src, url = window.URL || window.webkitURL || window.mozURL, files = e.target.files;
            for (var i = 0, len = files.length; i < len; ++i) {
                var file = files[i];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(a){
                    randId = parseInt(1000*Math.random());
                    imgUpdateFiles[randId] = this.result;
                    html = '<li class="weui-uploader__file" id="img'+ randId +'" style="background-image:url('+ this.result +')"></li>';
                    $uploaderFiles.append(html);

                }
            }
            //console.log(imgUpdateFiles);

        });
        $uploaderFiles.on("click", "li", function(){
            $galleryImg.attr("style", this.getAttribute("style"));
            $galleryImg.next('div').attr("onclick",'delImg("'+ $(this).attr("id") +'")');
            $gallery.fadeIn(100);
        });
        $galleryImg.on("click", function(){
            $gallery.fadeOut(100);
        });
    });

    function delImg(key){
        $('#'+key).remove();
        $("#gallery").fadeOut(100);
        keyIds = parseInt( key.substr(3));
        imgUpdateFiles[keyIds] = '';
        //console.log(imgUpdateFiles);
    }
</script>

<script>
    $(function(){
        $('#fabu').click(function(){
            $('#fabu').unbind("click");
            $(this).html('正在发布中');
            content = $('#content').val();
            $.post("{{url('user/weiboImgText')}}",{'content':content,'_token':"{{csrf_token()}}",'fileArray':imgUpdateFiles},function(data){
                if(data.code == 1){
                    $.toast(data.msg);
                    setTimeout(function(){
                        window.location.href = "{{url('user/index')}}";
                    },2000)
                }else{
                    $.toast(data.msg, "cancel");
                }
            });
        })
    })
</script>
@include('Home.Public.cnzz')
</body>
</html>