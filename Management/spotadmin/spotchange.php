<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <!--<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
    <meta charset="UTF-8">
    <link href="/main.css" rel="stylesheet" type="text/css" />   
    <link href="/Management.css" rel="stylesheet" type="text/css" />
    <link href="/Management/spotadmin/spotchange.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
    <!--<script type="text/javascript" src="upload_feature.js"></script>-->
    
    <link rel="stylesheet" href="/scripts/testcrop/font-awesome.min.css">
    <link rel="stylesheet" href="/includes/css/cropper.css">
    <script src="/includes/lib/cropper.js"></script>
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




<div id="form_container">
<form class="form-style-7">
<ul>
<li>
    <label for="cataid">文章ID</label>
    <input id="cataid" type="number" name="cataid" maxlength="10">
    <span>请填写ID</span>
</li>
<li>
    <label for="spothead">新标题</label>
    <input id="spothead" type="text" name="spothead" maxlength="30">
    <span>请填写新标题</span>
</li>
<li>
    <label for="ch_name">新封面</label></li>
<li>
	<div class="container">
    <button type="button" id="replace">上传图片</button>
    <input type="file" name="file" id="inputImage" />
    <div class="img-container">
      <img  src="/confectionary.png" alt="Picture" id="image" crossorigin="anonymous">
    </div>
  	</div>
    <button type="button" class="btn"  id="submit_con" value="click">提交</button>
</li>
</ul>
</form>
</div>


<script>

/* store the content in database */
$('#submit_con').click(function(){
    var cataid = document.getElementById('cataid').value;
    var spothead = document.getElementById('spothead').value;
    var temp_path = "<?=$_SESSION['tem_path']?>";
    if(cataid == '') {/* || ch_name == '' || s_year =='' || s_time =='' || region ==''*/
        alert("headline and tag and article can not be empty!");
    } else {
        console.log("Run ajax");
    $.ajax({
        url: "/Management/spotadmin/sendspot.php",
        method: "post",
        data: {
            'temp_path': tempa , 
            'spothead' : spothead ,
            'cataid' : cataid 
            },
        cache: false,
        success: function(result) {
            alert("spot Posted successfully!");
                
            },            
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }  
        
        });
    }
   });
    /*-------------------------------*/
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
        //var c_size = 250;
        $.ajax({
		        url: "/articlecover_up.php",
		        type: "POST",
		        data: {
		       		'img': formData 
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