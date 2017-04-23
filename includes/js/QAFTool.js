/// <reference path="jquery-1.11.2.min.js" />
$.fn.extend({
    AutoClip: function (width, height) {
        $(this).each(function () {
            $div = $("<div></div>");
            $img = $(this);

            $div.width(width).height(height).css({
                "overflow": "hidden",
                "position": "relative",
                "display": "inline-block"
            });
            $img.wrap($div);
            if (width > height) {
                //横放形状剪裁
                if ($img.width() / $img.height() > width / height) {
                    //图片比容器更宽，需要剪裁左右端
                    var scale = height / $img.height();//缩放比
                    $img.width($img.width * scale).height(height).css({
                        "position": "absolute",
                        "left": (width - $img.width()) / 2 + "px",
                    });
                } else {
                    //图片比容器更高，需要剪裁上下端
                    var scale = width / $img.width();//缩放比
                    $img.height($img.height * scale).width(width).css({
                        "position": "absolute",
                        "top": (height - $img.height()) / 2 + "px",
                    });
                }
            } else {
                //以下为上面的镜像代码
                if ($img.height() / $img.width() > height / width) {
                    var scale = width / $img.width();//缩放比
                    $img.height($img.height * scale).width(width).css({
                        "position": "absolute",
                        "top": (height - $img.height()) / 2 + "px",
                    });
                } else {
                    var scale = height / $img.height();//缩放比
                    $img.width($img.width * scale).height(height).css({
                        "position": "absolute",
                        "left": (width - $img.width()) / 2 + "px",
                    });
                }
            }
        })

    }
})