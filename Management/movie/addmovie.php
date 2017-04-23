<!DOCTYPE html>
<html>
<head>
    <!--<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
    <meta charset="UTF-8">
    <link href="main.css" rel="stylesheet" type="text/css" />   
    <link href="Management.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
    <!-- corp pic-->
    <link rel="stylesheet" href="/user/portrait/forkuer.css" type="text/css" />
    <script type="text/javascript" src="/user/portrait/cropbox.js"></script>
     <!-- CDN hosted by Cachefly -->
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
    <!--<script type="text/javascript" src="upload_feature.js"></script>-->
</head>
<body>
    <div id="M_rightbar_bot_main_headline">
        <div class="form-style-5">
        <fieldset>
        <legend style="font-family: Microsoft JhengHei"><span class="number">1</span> 电影名(汉译) </legend>
        <input type="text" id="headline1" name="headline" placeholder="请输入标题" style="font-family: Microsoft JhengHei">
        </fieldset>     
        </div>
         
    </div>
    <div id="M_rightbar_bot_main_tag">
        <div class="form-style-5">
        <fieldset>
        <legend style="font-family: Microsoft JhengHei"><span class="number">2</span> 标签 </legend>
        <input type="text" id="tag1" name="tag" placeholder="请输入标签" style="font-family: Microsoft JhengHei">
        </fieldset>
        </div>                              
    </div>
    <div id="M_rightbar_bot_main_link" >
        <div class="form-style-5">
        <fieldset>
        <legend style="font-family: Microsoft JhengHei"><span class="number">3</span> 电影链接 </legend>
        <input type="text" id="mlink1" name="mlink" placeholder="请输入电影链接" style="font-family: Microsoft JhengHei">
        </fieldset>
        </div>                              
    </div>
    <div id="M_rightbar_bot_main_cover">
        <div class="form-style-5">
        <fieldset>
        <legend style="font-family: Microsoft JhengHei"><span class="number">4</span> 文章封面 </legend>
        </fieldset>                 
        </div>
        <div class="imageBox">
        <div class="thumbBox"></div>
        <div class="spinner" style="display: none">Loading...</div>
        </div>
        <div class="cropped"></div>
        <div class="action"> 
            <!-- <input type="file" id="file" style=" width: 200px  316 216">-->
            <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
            <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
            <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
            <form method="post" id="fileinfo2" name="fileinfo2" onsubmit="return submitport2();">
            <input type="file" name="file" id="file" />
            <input type="submit"  class="Btnsty_peyton1" value="上传文件"/> 
            </form>
        </div>
         <button type="button" class="btn"  id="submit_con" value="click">提交</button>
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

                    
<script type="text/javascript">
    // Check for the various File API support.
    if (window.File && window.FileReader && window.FileList && window.Blob) {
    // Great success! All the File APIs are supported.
    } else {
        alert('The File APIs are not fully supported in this browser.');
    }                       
    // Ajax upload picture  ​
    
    
</script>
<script>
var temppath;
var con_all;
var temppath1;
function submitForm1() {
    console.log("submit event");
    var fd = new FormData(document.getElementById("fileinfo"));
    console.log( fd );
    fd.append("label", "WEBUPLOAD");
    $.ajax({
        url: "upload.php",
        type: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
    console.log("PHP Output:");
    console.log( data );
    temppath1 = data;
    temppath = temppath1.slice(1);
    });
    return false;
}       


/* store the content in database */
$('#submit_con').click(function(){
    
    var headline1 = document.getElementById('headline1').value;
    var tag1 = document.getElementById('tag1').value;
    var art_link1 = document.getElementById('mlink1').value;
    console.log('the head and tag: '+ headline1 + tag1);
    if(headline1 == null || tag1 == null || art_link1 ==null) {
        alert("headline and tag and article can not be empty!")
    } else {
    $.ajax({
        url: "/Management/movie/sendkuer.php",
        method: "post",
        data: { 'headline1': headline1 , 'pic' : temppath , 'tag1' : tag1 , 'art_link1' : art_link1},
        cache : false,
        success: function(result) {
            console.log('123 Posted successfully!');
            alert("movie Posted successfully!");
                
            },            
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }  
        
        });
    }
   })
    /*-------------------------------*/

</script>
<script type="text/javascript">
console.log('1');
var dataURL;
var temppath;
function submitport2() {
    console.log("submit event");
     $.ajax({
        url: "/articlecover_up.php",
        type: "POST",
        data: {'img': dataURL},
    }).done(function( data ) {
    console.log("PHP Output:");
    console.log( data );
    temppath = data;
    console.log('upload cpber!');
    console.log( data );
    temppath = data;
    temppath = data.slice(1);
    alert('上传成功!'.temppath);
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
    })
    $('#btnCrop').on('click', function(){
        var img = cropper.getDataURL();  
        dataURL = cropper.getDataURL(); 
        $('.cropped').html('');
        $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:316px;height:216px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;" ><p>316px*216px</p><p>发布后为316px*216px</p>');

    })
    $('#btnZoomIn').on('click', function(){
        cropper.zoomIn();
    })
    $('#btnZoomOut').on('click', function(){
        cropper.zoomOut();
    })
});

</script>                   
</body>
</html>