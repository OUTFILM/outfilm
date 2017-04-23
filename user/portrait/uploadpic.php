
<!DOCTYPE HTML>

<? session_start(); 
   include $_SERVER["DOCUMENT_ROOT"]."/config.php";
?>
<html>
<head>
<meta charset="UTF-8"> 
<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="/user/portrait/style.css" type="text/css" />
<script type="text/javascript" src="/user/portrait/cropbox.js"></script>
</head>
<body>
<div class="container">
  <div class="imageBox">
    <div class="thumbBox"></div>
    <div class="spinner" style="display: none">Loading...</div>
  </div>
  <div class="action"> 
    <!-- <input type="file" id="file" style=" width: 200px">-->
      <form method="post" id="fileinfo2" name="fileinfo2" onsubmit="return submitport2();">
      <input type="file" name="file" id="file" value="123"/>
      <input type="submit" value="上传文件"/> 
      </form>
    <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
    <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
    <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >

  </div>
  <div class="cropped"></div>
   
</div>
<script type="text/javascript">
console.log('1');
var c_size = 64;
var c_option = 1;
var dataURL;
var temppath;
function submitport2() {
    console.log("submit event");
     $.ajax({
        url: "/uploadthumbnail.php",
        type: "POST",
        data: {
			'img': dataURL,
			'c_option' : c_option,
			'c_size' : c_size
			
		}
    }).done(function( data ) {
    console.log("PHP Output:");
    console.log( data );
    temppath = data;
    console.log(temppath+'upload successfully!');
    alert(temppath+'上传成功！快去首页看看哪~');
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
        //this.files = [];
    })
    $('#btnCrop').on('click', function(){
        var img = cropper.getDataURL();  
        dataURL = cropper.getDataURL(); 
        $('.cropped').html('');
        $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
        $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
        $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
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