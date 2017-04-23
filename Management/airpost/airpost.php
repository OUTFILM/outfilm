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
    <!--<link rel="stylesheet" href="/Management/airpost/cropped.css" type="text/css" />-->
    <link rel="stylesheet" href="/includes/css/cropper.css">
    <script src="/includes/lib/cropper.js"></script>
    <!--<script type="text/javascript" src="/user/portrait/cropbox.js"></script>-->
    <style>
    .container {
      max-width: 350px;
      margin: 20px auto;
    }

    .img-container {
      width: 100%;
      margin-top: 10px;
    }

    .img-container img {
      width: 100%;
    }
    </style>
</head>
<body>

<meta charset="UTF-8">

<div id="M_rightbar_bot_main_cover" style="border: none">
  <div class="container">
    <button type="button" id="replace">上传图片</button>
    <input type="file" name="file" id="inputImage" />
    <div class="img-container">
      <img  src="/confectionary.png" alt="Picture" id="image" crossorigin="anonymous">
    </div>
  </div>
</div>


<div id="form_container">
<form class="form-style-7">
<ul>
<li>
    <label for="ch_name">汉译名</label>
    <input id="ch_name" type="text" name="ch_name" maxlength="30">
    <span>请填写汉译名</span>
</li>
<li>
    <label for="en_name">英译名</label>
    <input id="en_name" type="text" name="en_name" maxlength="30">
    <span>请填写英译名</span>
</li>
<li>
    <label for="CID">文章ID</label>
    <input id="CID" type="text" name="CID" maxlength="10">
    <span>文章ID点击文章看链接 例：http://www.outfilm.org/Article/article.php?catlogid=1486</span>
</li>
<!--
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
-->
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
    //var s_year = document.getElementById('year').value;
    //var s_time = document.getElementById('time').value;
    //var s_option = document.getElementById('option').value;
    //var region = document.getElementById('region').value;
    // var intro = document.getElementById('intro').value;
    //var d_link = document.getElementById('d_link').value;
    //var a_link = document.getElementById('a_link').value;
    var cid =  document.getElementById('CID').value;
    console.log('the head and tag: '+ en_name + cid);
    
    if(en_name == '' || cid =='') {/* || ch_name == '' || s_year =='' || s_time =='' || region ==''*/
        alert("headline and cid and article can not be empty!");
    } else {
        console.log("Run ajax");
    $.ajax({
        url: "/Management/airpost/sendair.php",
        method: "post",
        data: {
        	
            'en_name': en_name , 
            'ch_name' : ch_name , 
            /*
            'year' : s_year , 
            'time' : s_time , 
            'region' : region , 
            'option' : s_option ,  
            'intro' : intro, 
            'd_link' : d_link, 
            'a_link' : a_link , */
            'temppath' : tempa ,
            'catalog_id' : cid
            },
        cache: false,
        success: function(result) {
            //console.log('123 Posted successfully!');
            alert("movie Posted successfully!");
                
            },            
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }  
        
        });
    }
});

</script>
 <script>
    var tempa // for storing the path for image
    //window.addEventListener('DOMContentLoaded', function () {
    $( document ).ready(function() {
      var test;
      var image = document.querySelector('.img-container > img');
      var cropper = new Cropper(image, {
        movable: false,
        zoomable: false,
        rotatable: false,
        scalable: false,
        build: function () {
          console.log('build');
        },
        built: function () {
          console.log('built');
        }
	  });
      document.getElementById('replace').onclick = function () {
      	
        //cropper.replace('f3.jpg');
		// Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob
		var formData = cropper.getCroppedCanvas().toDataURL();
        var c_size = 250;
        $.ajax({
		        url: "/uploadthumbnail.php",
		        type: "POST",
		        data: {
		       		'img': formData , 
		        	'c_size': c_size
		        }
		}).done(function( data ) {
		    console.log("PHP Output:");
		    //console.log( data );
		    tempa = data;
		    //console.log('upload cpber!');
			tempa = data;
			//console.log('1'+tempa)
		    alert('上传成功!'+tempa);
		});
      };
    
    
    
    
    
   
    $(function() {
      var $image = $('#image');	
	  var $inputImage = $('#inputImage');
	  var URL = window.URL || window.webkitURL;
	  var blobURL;
	
	  if (URL) {
	  	
	    $inputImage.change(function () {
	     
	      var files = this.files;
	      var file;
		  /*
	      if (!$image.data('cropper')) {
	      	console.log('7');
	        return;
	        
	      }*/
		 
	      if (files && files.length) {
	        file = files[0];
	        
	
	        if (/^image\/\w+$/.test(file.type)) {
	          
	          /*$image.one('built.cropper', function () {
	
	            // Revoke when load complete
	            URL.revokeObjectURL(blobURL);
	          }).cropper('reset').cropper('replace', blobURL);*/
	          blobURL = URL.createObjectURL(file);
              cropper.reset().replace(blobURL);
          	  inputImage.value = null;
	          //console.log('3');
	          //$inputImage.val('');
	        } else {
	        	//console.log('4');
	          window.alert('Please choose an image file.');
	        } 
	       // console.log('9');
	      }
	    });
	  } else {
	  	//console.log('5');
	    $inputImage.prop('disabled', true).parent().addClass('disabled');
	  }
    });
    }); 
  </script>                   
</body>
</html>