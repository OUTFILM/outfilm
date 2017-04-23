<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config.php";

if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="main.css" rel="stylesheet" type="text/css" />	
	<link href="Management.css" rel="stylesheet" type="text/css" />	
	<link href="/Management/airpost/airpost.css" rel="stylesheet" type="text/css" />
  
	<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
	<!-- corp pic-->
  	<script src="/includes/lib/cropper.js"></script>
  	<link rel="stylesheet" href="/includes/css/cropper.css">  
	<!-- CDN hosted by Cachefly -->

    
    <!--  Dialog page-->
    <script type="text/javascript" src="/scripts/jquery.transit.min.js"></script>   

    
    <link rel="stylesheet" href="/scripts/k/styles/kendo.metroblack.min.css" />	
	<link rel="stylesheet" href="/scripts/k/styles/kendo.common.min.css" />
	<!--<link ref="stylesheet" href="/scripts/k/styles/kendo.mobile.all.min.css" />-->

	<script src="/scripts/k/js/kendo.all.min.js"></script>
	<script src="/scripts/k/js/cultures/kendo.culture.zh-CHS.min.js"></script>
	<script src="/scripts/k/js/messages/kendo.messages.zh-CN.min.js"></script>

	<link rel="stylesheet" href="/scripts/testcrop/font-awesome.min.css">
  	<link rel="stylesheet" href="/scripts/testcrop/css/main.css">

    <script src="/scripts/testcrop/bootstrap.min.js"></script>
    <style>
    .container {
      max-width: 360px;
    }

    .img-container {
      width: 100%;
      margin-top: 10px;
    }

    .img-container img {
      width: 100%;
    }
    </style>
  	
  	<link href="/Article/editor/fr.css" rel="stylesheet" type"text/css" />
	<script src="/Article/editor/fr.js" type="text/javascript"></script>
	<script src="/scripts/froala/js/plugins/tables.min.js"></script>
	<script src="/scripts/froala/js/plugins/colors.min.js"></script>
	<script src="/scripts/froala/js/plugins/file_upload.min.js"></script>
	<script src="/scripts/froala/js/plugins/font_family.min.js"></script>
	<script src="/scripts/froala/js/plugins/font_size.min.js"></script>
	<script src="/scripts/froala/js/plugins/fullscreen.min.js"></script>
	<script src="/scripts/froala/js/plugins/lists.min.js"></script>
	<script src="/scripts/froala/js/plugins/media_manager.min.js"></script>
	<script src="/scripts/froala/js/plugins/tables.min.js"></script>
	<script src="/scripts/froala/js/plugins/urls.min.js"></script>
	<script src="/scripts/froala/js/plugins/video.min.js"></script>
	<script src="/scripts/froala/js/plugins/entities.min.js"></script>
	<!--<script src="/scripts/froala/js/plugins/emoticons.min.js"></script>
	<script src="/scripts/froala/js/plugins/paragraph_format.min.js"></script>-->	
	<script src="/scripts/froala/js/langs/zh_cn.js"></script>
	<link rel="stylesheet" href="/scripts/froala/css/themes/dark.min.css" />
    
</head>
<body>
        
    <div id="M_rightbar_bot_main_gen">
    <div class="form-style-5">
            <fieldset>
                <legend style="font-family: Microsoft JhengHei"><span class="number">1</span> 类别 </legend>
            <select name="cata" id="cata" onchange="checkingop();">
            <option value="1">一般时讯</option>
            <option value="2">主题报告</option>
            <option value="3">新片上映</option>
            <option value="4">影视资讯</option>
            <option value="5">其它</option>
            <option value="9">更新日志</option>
            </select>
            </fieldset>
    </div>                            
    </div>
    <div id="M_rightbar_bot_dlink">
<form class="form-style-7">
<ul>
<li>
    <label for="ch_name">压制名称</label>
    <input id="ch_name" type="text" name="ch_name" maxlength="100">
    <span>请填写类似 小鹿</span>
</li>
<li>
    <label for="d_link1">CTDisk网盘</label>
    <input id="d_link1" type="url" name="url" maxlength="150">
    <span>下载链接在150字符之内,暂无填写#</span>
</li>
<li>
    <label for="d_link2">QQ旋风</label>
    <input id="d_link2" type="url" name="url" maxlength="150">
    <span>下载链接在150字符之内,暂无填写#</span>
</li>
<li>
    <label for="d_link3">迅雷快传</label>
    <input id="d_link3" type="url" name="url" maxlength="150">
    <span>下载链接在150字符之内,暂无填写#</span>
</li>
<li>
    <label for="d_link4">百度网盘</label>
    <input id="d_link4" type="url" name="url" maxlength="150">
    <span>下载链接在150字符之内,暂无填写#</span>
</li>
<li>
    <label for="baim">百度密码</label>
    <input id="baim" type="text" name="ch_name" maxlength="5">
</li>
<li>
    <label for="d_link5">360网盘</label>
    <input id="d_link5" type="url" name="url" maxlength="150">
    <span>下载链接在150字符之内,暂无填写#</span>
</li>
<li>
    <label for="m360">360密码</label>
    <input id="m360" type="text" name="ch_name" maxlength="5">
</li>
<li>
    <label for="acfun">A站在线</label>
    <input id="acfun" type="url" name="url">
    <span>在线链接,暂无填写#</span>
</li>
<li>
    <label for="bili">B站在线</label>
    <input id="bili" type="url" name="url">
    <span>在线链接,暂无填写#</span>
</li>
<li>
    <label for="d_link6">电驴</label>
    <textarea id="d_link6" name="bio" onkeyup="adjust_textarea(this)"></textarea>
    <span>请填写电驴地址</span>
</li>
</ul>
</form>
    </div>
	<div id="M_rightbar_bot_main_headline">
		<div class="form-style-5">
		<fieldset>
		<legend style="font-family: Microsoft JhengHei"><span class="number">2</span> 标题 </legend>
		<input maxlength="24" type="text" id="headline1" name="headline" placeholder="请输入标题" style="font-family: Microsoft JhengHei">
		</fieldset>		
		</div>
		 
	</div>
	<div id="M_rightbar_bot_main_tag">
		<div class="form-style-5">
		<fieldset>
		<legend style="font-family: Microsoft JhengHei"><span class="number">3</span> 标签 </legend>
		<input maxlength="24" type="text" id="tag1" name="tag" placeholder="请输入标签" style="font-family: Microsoft JhengHei">
		</fieldset>
		</div>								
	</div>

   
	<div id="M_rightbar_bot_main_cover">
		<div class="form-style-5">
		<fieldset>
		<legend style="font-family: Microsoft JhengHei"><span class="number">4</span> 文章封面 </legend>
		</fieldset>					
		
		<div class="container">
		    <button type="button" id="replace">上传图片</button>
		    <input type="file" name="file" id="inputImage" />
		    <div class="img-container">
		      <img  src="..\confectionary.png" alt="Picture" id="image" crossorigin="anonymous">
		    </div>
	    </div>
		</div>   
	</div>
	
   
   
    <div id="M_rightbar_bot_main_article">
<!-- -->
	<div class="form-style-5">
	<fieldset>
	<legend style="font-family: Microsoft JhengHei"><span class="number">5</span> 写作框 </legend>
	</fieldset>	
	<textarea id="elm1" name="area"></textarea>
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
    // for making check box to be single select
    $('input[type="checkbox"]').on('change', function() {
    $(this).siblings('input[type="checkbox"]').prop('checked', false);
    });
	// Check for the various File API support.
	if (window.File && window.FileReader && window.FileList && window.Blob) {
	// Great success! All the File APIs are supported.
	} else {
		alert('The File APIs are not fully supported in this browser.');
	}						
	// Ajax upload picture	​
	
	
</script>
<script>
var con_all;


/* store the content in database */
$('#submit_con').click(function(){
    //var tem_path = " <?//=$_SESSION['tem_path']?>";
    var catalog_op = document.getElementById('cata').value;
    
    var baim = document.getElementById('baim').value;
    var m360 = document.getElementById('m360').value;
    var d_link1 = document.getElementById('d_link1').value;
    var d_link2 = document.getElementById('d_link2').value;
    var d_link3 = document.getElementById('d_link3').value;
    var d_link4 = document.getElementById('d_link4').value;
    var d_link5 = document.getElementById('d_link5').value;
    var d_link6 = document.getElementById('d_link6').value;
    var acfun = document.getElementById('acfun').value;
    var bili = document.getElementById('bili').value;
    var ch_name = document.getElementById('ch_name').value;

    con_all = $("#elm1").editable('getHTML', false, false);
    console.log("content"+con_all);
	var mlink = new Array(d_link1, d_link2, d_link3 , d_link4 , d_link5 , d_link6 , baim , m360, ch_name, acfun, bili);
	var headline = document.getElementById('headline1').value;
 	var tag = document.getElementById('tag1').value;
 	
	console.log('the head and tag: '+ mlink.toString());
	
    if(headline == null || tag == null || con_all ==null) {
    	alert('headline,tag,content can not be empty!');
    } else {
	$.ajax({
		url: "storecontent.php",
		method: "post",
		data: { 'content_main': con_all , 'headline' : headline , 'tag' : tag  , 'cata' : catalog_op , 'mlink' : mlink , 'picsrc' : tempa},
		cache : false,
		success: function(result) {
    			alert('Posted successfully!');
    					
			},            
			error: function(jqXHR, textStatus, errorThrown) {
    			alert(errorThrown);
 			}  
		
        });
    }
   })
	/*-------------------------------*/



var loadTheEditor = function() {		
	$("#elm1").editable({
  		inlineMode: false,
  		alwaysBlank: true, // Always set open in new window: _blank for URLs
  		codeBeautifier: true,
  		crossDomain: false,
  		language: "zh_cn",
  		pasteImage: true,
  		height: 500,
  		theme: 'dark',
  		imageUploadURL: '/Article/uploadmedia16-0107.php',
  		imagesLoadURL: '/Article/managemedia16-0107.php',
		fileUploadURL: '/Article/uploadfile16-0108.php',
  		preloaderSrc: '',
  		mediaManager: true,
  		toolbarFixed: false,
  		buttons: [ 
  			'undo', 'redo', 'sep', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|',
  			'fontFamily', 'fontSize', 'color', 'formatBlock', 'blockStyle', 'inlineStyle', '|',
  			'align', 'insertOrderedList', 'insertUnorderedList', 'outdent', 'indent', '-',
  			'table', 'insertHorizontalRule', '|', 
  			'createLink', 'insertImage', 'insertVideo', 'uploadFile', '|',
  			'removeFormat', 'html', 'fullscreen'
  		],
  		htmlAllowedAttrs: [ 'accept', 'accept-charset', 
  		'accesskey', 'action', 'align', 'alt', 'async', 'autocomplete', 'autofocus', 'autoplay', 
  		'autosave', 'background', 'bgcolor', 'border', 'charset', 'cellpadding', 'cellspacing', 
  		'checked', 'cite', 'class', 'color', 'cols', 'colspan', 'content', 'contenteditable', 
  		'contextmenu', 'controls', 'coords', 'data', 'data-.*', 'datetime', 'default', 'defer', 
  		'dir', 'dirname', 'disabled', 'download', 'draggable', 'dropzone', 'enctype', 'for', 
  		'form', 'formaction', 'headers', 'height', 'hidden', 'high', 'href', 'hreflang', 
  		'http-equiv', 'icon', 'id', 'ismap', 'itemprop', 'keytype', 'kind', 'label', 'lang', 
  		'language', 'list', 'loop', 'low', 'max', 'maxlength', 'media', 'method', 'min', 'multiple', 
  		'name', 'novalidate', 'open', 'optimum', 'pattern', 'ping', 'placeholder', 'poster', 'preload', 
  		'pubdate', 'radiogroup', 'readonly', 'rel', 'required', 'reversed', 'rows', 'rowspan', 'sandbox', 
  		'scope', 'scoped', 'scrolling', 'seamless', 'selected', 'shape', 'size', 'sizes', 'span', 'src', 
  		'srcdoc', 'srclang', 'srcset', 'start', 'step', 'summary', 'spellcheck', 'style', 'tabindex', 
  		'target', 'title', 'type', 'translate', 'usemap', 'value', 'valign', 'width', 'wrap',
  		'quality', 'flashvars', 'allowfullscreen' ] 
    
  	});	
  	//$.FroalaEditor.DEFAULTS.htmlAllowedAttrs = $.merge($.FroalaEditor.DEFAULTS.htmlAllowedAttrs, ['quality', 'flashvars', 'allowfullscreen']);	
};
	
loadTheEditor();

</script>
<script type="text/javascript">


$(document).ready(function() {
    checkingop();

});

    /* for checking option 2*/
   function checkingop() {
   var optest  = document.getElementById("cata").value;
   console.log(optest + " selected.");  
   if(optest == "3") {
       
        $("#M_rightbar_bot_dlink").removeClass('hide');
        $("#M_rightbar_bot_dlink").transition({ 
        opacity: 1, 
        y: '0px',
        duration: 1500,
        complete: function () { 
            
            //this.css({ display: 'none' }); 
        }
    });
       
   } else {
        $("#M_rightbar_bot_dlink").transition({ 
        opacity: 0.0, 
        y: '-500px',
        easing: 'out',
        duration: 1500,
        complete: function () { 
            this.addClass('hide');
            //this.css({ display: 'none' }); 
        }
    });
   }
   };

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
        var c_size = 360;
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
<!--script for showing submit successful box or erroe box js-->
<script>


function adjust_textarea(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}   
</script>
    				
</body>
</html>
<?
} else {
	?>Must be logged in.<?
}
?>

