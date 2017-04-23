<!DOCTYPE html>
<html>
<head>
	<!--<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
	<meta charset="UTF-8">
	<link href="main.css" rel="stylesheet" type="text/css" />	
	<link href="Management.css" rel="stylesheet" type="text/css" />	
	<link href="/Management/airpost/airpost.css" rel="stylesheet" type="text/css" />    
	<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
	<!-- corp pic-->
	<link rel="stylesheet" href="/user/portrait/style123.css" type="text/css" />
	<script type="text/javascript" src="/user/portrait/cropbox.js"></script>
	 <!-- CDN hosted by Cachefly -->
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
    <!--<script type="text/javascript" src="upload_feature.js"></script>-->
    <!--  Dialog page-->
    <script type="text/javascript" src="/scripts/jquery.transit.min.js"></script>   
    <link href="/scripts/metro/build/css/metro.css" rel="stylesheet">
    <link href="/scripts/metro/build/css/metro-icons.css" rel="stylesheet">
    <link href="/scripts/metro/build/css/metro-responsive.css" rel="stylesheet">
    <link href="/scripts/metro/build/css/metro-schemes.css" rel="stylesheet">
    <script src="/scripts/metro/build/js/metro.js"></script>
</head>
<body>
        
    <div id="M_rightbar_bot_main_gen">
    <div class="form-style-5">
            <fieldset>
                <legend style="font-family: Microsoft JhengHei"><span class="number">1</span> 类别 </legend>
                <!--
                <input type="checkbox" name="cata" id="cata" value="1">一般时讯
                <input type="checkbox" name="cata" id="cata" value="2">主题报告
                <input type="checkbox" name="cata" id="cata" value="3">新片上映
                -->
            <select name="cata" id="cata">
            <option value="1">一般时讯</option>
            <option value="2">主题报告</option>
            <option value="3">新片上映</option>
             <option value="4">影视资讯</option>
              <option value="5">其它</option>
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
    <input id="d_link5" type="url" name="url" maxlength="100">
    <span>下载链接在150字符之内,暂无填写#</span>
</li>
<li>
    <label for="m360">360密码</label>
    <input id="m360" type="text" name="ch_name" maxlength="5">
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
		</div>
		<div class="imageBox">
   		<div class="thumbBox"></div>
    	<div class="spinner" style="display: none">Loading...</div>
 		</div>
 		<div class="cropped"></div>
    <div class="action"> 
    <!-- <input type="file" id="file" style=" width: 200px">-->
    <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
    <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
    <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
    <form method="post" id="fileinfo2" name="fileinfo2" onsubmit="return submitport2();">
      <input type="file" name="file" id="file" />
      <input type="submit"  class="Btnsty_peyton1" value="上传文件"/> 
    </form>
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
<div data-role="dialog,draggable" data-overlay="true" data-overlay-color="op-dark" data-easing="easeInCubic"
    class="padding20 dialog warning" data-close-button="true" id="dialog-error" style="z-index: 1070">
    <h3 id="errorMessageTitle">错误</h3>
    <div id="errorMessage">文章标题，标签，内容不可以为空！</div>   
    <button class="button" onclick="showDialog('dialog-error');"> 确定 </button>
</div>

<div data-role="dialog" data-overlay="true" data-overlay-color="op-light"
    class="padding20 dialog success" data-close-button="true" id="dialog-success" style="z-index: 1090">
    <h1 id="errorMessageTitle" style="font-family: 'PingFang'">投稿成功！</h1>
    <div id="errorMessage">文章已经发布到首页，请及时查看</div>  
    <button class="button" onclick="showDialog('dialog-success');"> 确定 </button>
</div> 
					
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
var temppath;
var con_all;
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
	temppath = data;
	});
	return false;
}		


/* store the content in database */
$('#submit_con').click(function(){
    
    var catalog_op = document.getElementById('cata').value;
    
    var baim = document.getElementById('baim').value;
    var m360 = document.getElementById('m360').value;
    var d_link1 = document.getElementById('d_link1').value;
    var d_link2 = document.getElementById('d_link2').value;
    var d_link3 = document.getElementById('d_link3').value;
    var d_link4 = document.getElementById('d_link4').value;
    var d_link5 = document.getElementById('d_link5').value;
    var d_link6 = document.getElementById('d_link6').value;
     var ch_name = document.getElementById('ch_name').value;

    
	var mlink = new Array(d_link1, d_link2, d_link3 , d_link4 , d_link5 , d_link6 , baim , m360, ch_name);
	var headline = document.getElementById('headline1').value;
 	var tag = document.getElementById('tag1').value;
	console.log('the head and tag: '+ mlink.toString());
	
    if(headline == null || tag == null || con_all ==null) {
    	showDialog('dialog-error');
    } else {
	$.ajax({
		url: "storecontent.php",
		method: "post",
		data: { 'content_main': con_all , 'headline' : headline , 'tag' : tag , 'link' : temppath , 'cata' : catalog_op , 'mlink' : mlink},
		cache : false,
		success: function(result) {
    			console.log('Posted successfully!');
    			showDialog('dialog-success');		
			},            
			error: function(jqXHR, textStatus, errorThrown) {
    			alert(errorThrown);
 			}  
		
        });
    }
   })
	/*-------------------------------*/


tinymce.init({
	selector: "textarea#elm1",
	theme: "modern",
	width: 700,
	height: 300,
	plugins: [
     	"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
     	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
     	"save table contextmenu directionality emoticons template paste textcolor"
	],
	/*content_css: "css/content.css",*/
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
	style_formats: [
    	{title: 'Bold text', inline: 'b'},
    	{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
    	{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
    	{title: 'Example 1', inline: 'span', classes: 'example1'},
    	{title: 'Example 2', inline: 'span', classes: 'example2'},
    	{title: 'Table styles'},
    	{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	],
	setup : function(ed) {
              ed.on('change', function(e) {
                 console.log('the content '+ed.getContent());
                 con_all = ed.getContent();
              });
           
        }

	});
	

</script>
<script type="text/javascript">
console.log('1');
var dataURL;
var temppath;
function submitport2() {
    console.log("submit event");
     $.ajax({
        url: "articlecover_up.php",
        type: "POST",
        data: {'img': dataURL},
    }).done(function( data ) {
    console.log("PHP Output:");
    console.log( data );
    temppath = data;
    console.log('upload cpber!');
	console.log( data );
	temppath = data;
    alert('上传成功!');
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
        $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:175px;height:160px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;" ><p>175px*160px</p><p>发布后为351x181</p>');

    });
    $('#btnZoomIn').on('click', function(){
        cropper.zoomIn();
    });
    $('#btnZoomOut').on('click', function(){
        cropper.zoomOut();
    });
   
    $('#cata').on('change', function(){
        checkingop();
    });
   checkingop();
    
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
   }
});

</script>

<!--script for showing submit successful box or erroe box js-->
<script>
function showDialog(id){
    var dialog = $("#"+id).data('dialog');
    if (!dialog.element.data('opened')) {
        dialog.open();
        $("#"+id).css({ opacity: 0, y: -150 });
        $("#"+id).transition({ opacity: 95, y: 0 }, 800, "ease");
    } else {
        $("#"+id).transition({ opacity: 0, y: 150 }, 800, "ease", function() {
            dialog.close();         
        });
    }
} 

function adjust_textarea(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}   
</script>
    				
</body>
</html>