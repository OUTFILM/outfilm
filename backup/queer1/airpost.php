<!DOCTYPE html>
<html>
<head>
    <!--<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
    <meta charset="UTF-8">
    <link href="/main.css" rel="stylesheet" type="text/css" />   
    <link href="/Management.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
    <!-- corp pic-->
    <link rel="stylesheet" href="/Management/airpost/cropped.css" type="text/css" />
    <script type="text/javascript" src="/user/portrait/cropbox.js"></script>
    <!--<script type="text/javascript" src="upload_feature.js"></script>-->
</head>
<body>

<meta charset="UTF-8">

<div id="M_rightbar_bot_main_cover" style="border: none">
    <label for="posterl">封面</label>
    <div class="imageBox">
    <div class="thumbBox"></div>
    <div class="spinner" style="display: none">Loading...</div>
    </div>
    <div class="cropped"></div>
    <div class="action"> 
        <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
        <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
        <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
        <form method="post" id="fileinfo2" name="fileinfo2" onsubmit="return submitport2();">
        <input type="file" name="file" id="file" />
        <input type="submit"  class="Btnsty_peyton1" value="上传文件"/> 
        </form>
    </div>
</div>


<div id="form_container">
<form class="form-style-7">
<ul>
<li>
    <label for="ch_name">汉译名</label>
    <input id="ch_name" type="text" name="ch_name" maxlength="10">
    <span>请填写汉译名</span>
</li>
<li>
    <label for="en_name">英译名</label>
    <input id="en_name" type="text" name="en_name" maxlength="10">
    <span>请填写英译名</span>
</li>
<li>
    <label for="region">国家</label>
    <input id="region" type="text" name="region" maxlength="10">
    <span>请填写出品地区</span>
</li>
<li>
    <label for="year">年份</label>
    <input id="year" type="text" name="region" maxlength="10">
    <span>请填写出品地区</span>
</li>
<li>
    <label for="time">时长</label>
    <input id="time" type="text" name="region" maxlength="10">
    <span>请填写出品地区</span>
</li>
<li>
    <label for="option">类型</label>
    <input id="option" type="text" name="region" maxlength="10">
    <span>请填写类型，标签之间用空格</span>
</li>
<li>
    <label for="d_link">下载链接</label>
    <input id="d_link" type="url" name="url" maxlength="150">
    <span>下载链接 (eg: http://www.google.com) 150字符之内</span>
</li>
<li>
    <label for="ura_linkl2">在线链接</label>
    <input id="a_link" type="url" name="url" maxlength="150">
    <span>在线链接 (eg: http://www.google.com) 150字符之内</span>
</li>
<li>
    <label for="intro">简介</label>
    <textarea id="intro" name="bio" onkeyup="adjust_textarea(this)" maxlength="150"></textarea>
    <span>请填写豆瓣简介或IMDB 150字符以内！</span>
</li>
<li>
    <button type="button" class="btn"  id="submit_con" value="click">提交</button>
</li>
</ul>
</form>
</div>

   
    
<!--
<div id="M_rightbar_bot_main_vip">
    <div class="form-style-5">
    <fieldset>
    <legend style="font-family: Microsoft JhengHei"><span class="number">5</span> TOP选择 </legend>
    <select id="editor_rec" name="editor_rec">
    <optgroup label="是否推为编辑推荐前四">
    <option value="y">是</option>
    <option value="n" selected>否</option>
    </optgroup>
    </fieldset>
    </div>

</div>
 -->

                    
<script>


function adjust_textarea(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}

var temppath;
var temppath1;
/* store the content in database */
$('#submit_con').click(function(){
    var en_name = document.getElementById('en_name').value;
    var ch_name = document.getElementById('ch_name').value;
    var s_year = document.getElementById('year').value;
    var s_time = document.getElementById('time').value;
    var s_option = document.getElementById('option').value;
    var region = document.getElementById('region').value;
    var intro = document.getElementById('intro').value;
    var d_link = document.getElementById('d_link').value;
    var a_link = document.getElementById('a_link').value;
    console.log('the head and tag: '+ en_name + d_link);
    
    if(en_name == '') {/* || ch_name == '' || s_year =='' || s_time =='' || region ==''*/
        alert("headline and tag and article can not be empty!");
    } else {
        console.log("Run ajax");
    $.ajax({
        url: "/Management/airpost/sendair.php",
        method: "post",
        data: {
            'en_name': en_name , 
            'ch_name' : ch_name , 
            'year' : s_year , 
            'time' : s_time , 
            'region' : region , 
            'option' : s_option ,  
            'intro' : intro, 
            'd_link' : d_link, 
            'a_link' : a_link , 
            'temppath' : temppath
            },
        cache: false,
        success: function(result) {
            console.log('123 Posted successfully!');
            alert("movie Posted successfully!");
                
            },            
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }  
        
        });
    }
   });
    /*-------------------------------*/

console.log('1');
var dataURL;
function submitport2() {
    console.log("submit event");
     $.ajax({
        url: "/articlecover_up.php",
        type: "POST",
        data: {'img': dataURL}
    }).done(function( data ) {
    console.log("PHP Output:");
    console.log( data );
    temppath = data;
    console.log('upload cpber!');
    console.log( data );
    temppath = data;
    temppath = data.slice(1);
    alert('上传成功!' + temppath);
    });
    return false;
}


$(document).ready(function() {
    var options =
    {
        thumbBox: '.thumbBox',
        spinner: '.spinner',
        imgSrc: '/uploads/default_portrait.png'
    }
    var cropper = $('.imageBox').cropbox(options);
    $('#file').on('change', function(){
        var reader = new FileReader();
        reader.onload = function(e) {
            options.imgSrc = e.target.result;
            cropper = $('.imageBox').cropbox(options);
        }
        
        reader.readAsDataURL(this.files[0]);
        //var source = reader.result;
        this.files = [];
    });
    $('#btnCrop').on('click', function(){
        var img = cropper.getDataURL();  
        dataURL = cropper.getDataURL(); 
        $('.cropped').html('');
        $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:233px;height:349px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;" ><p>发布后预览</p>');

    });
    $('#btnZoomIn').on('click', function(){
        cropper.zoomIn();
    });
    $('#btnZoomOut').on('click', function(){
        cropper.zoomOut();
    });
});

</script>                   
</body>
</html>