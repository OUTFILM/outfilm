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
  	<link rel="stylesheet" href="/scripts/testcrop/bootstrap.min.css">
  	<link rel="stylesheet" href="/scripts/testcrop/cropper.css">
  	<link rel="stylesheet" href="/scripts/testcrop/css/main.css">

    <script src="/scripts/testcrop/bootstrap.min.js"></script>
  	<script src="/scripts/testcrop/cropper.js"></script>
  	<script src="/scripts/testcrop/js/main.js"></script>
  	
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
                <!--
                <input type="checkbox" name="cata" id="cata" value="1">一般时讯
                <input type="checkbox" name="cata" id="cata" value="2">主题报告
                <input type="checkbox" name="cata" id="cata" value="3">新片上映
                -->
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
		</div>
		<!--<div class="imageBox">
   		<div class="thumbBox"></div>
    	<div class="spinner" style="display: none">Loading...</div>
 		</div>
 		<div class="cropped"></div>
    <div class="action"> 
     <input type="file" id="file" style=" width: 200px">
    <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
    <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
    <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
    <form method="post" id="fileinfo2" name="fileinfo2" onsubmit="return submitport2();">
      <input type="file" name="file" id="file" />
      <input type="submit"  class="Btnsty_peyton1" value="上传文件"/> 
    </form> 
    </div>-->
    

<!-- Content -->
  <div class="container" style="width: 950px;margin-left: 0px;height: 600px;">
    <div class="row">
      <div class="col-md-9">
        <!-- <h3 class="page-header">Demo:</h3> -->
        <div class="img-container">
          <img id="image" src="/uploads/default_portrait.png" alt="Picture" crossorigin="anonymous">
        </div>
      </div>
      <div class="col-md-3">
        <!-- <h3 class="page-header">Preview:</h3> -->
        <div class="docs-preview clearfix">
          <div class="img-preview preview-lg"></div>
          <div class="img-preview preview-md"></div>
          <div class="img-preview preview-sm"></div>
          <div class="img-preview preview-xs"></div>
        </div>

        <!-- <h3 class="page-header">Data:</h3> -->
        <div class="docs-data">
          <div class="input-group input-group-sm">
            <label class="input-group-addon" for="dataX">X</label>
            <input type="text" class="form-control" id="dataX" placeholder="x">
            <span class="input-group-addon">px</span>
          </div>
          <div class="input-group input-group-sm">
            <label class="input-group-addon" for="dataY">Y</label>
            <input type="text" class="form-control" id="dataY" placeholder="y">
            <span class="input-group-addon">px</span>
          </div>
          <div class="input-group input-group-sm">
            <label class="input-group-addon" for="dataWidth">Width</label>
            <input type="text" class="form-control" id="dataWidth" placeholder="width">
            <span class="input-group-addon">px</span>
          </div>
          <div class="input-group input-group-sm">
            <label class="input-group-addon" for="dataHeight">Height</label>
            <input type="text" class="form-control" id="dataHeight" placeholder="height">
            <span class="input-group-addon">px</span>
          </div>
          <div class="input-group input-group-sm">
            <label class="input-group-addon" for="dataRotate">Rotate</label>
            <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
            <span class="input-group-addon">deg</span>
          </div>
          <div class="input-group input-group-sm">
            <label class="input-group-addon" for="dataScaleX">ScaleX</label>
            <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
          </div>
          <div class="input-group input-group-sm">
            <label class="input-group-addon" for="dataScaleY">ScaleY</label>
            <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 docs-buttons">
        <!-- <h3 class="page-header">Toolbar:</h3> -->
        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
              <span class="fa fa-arrows"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
              <span class="fa fa-crop"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, -10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
              <span class="fa fa-rotate-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
              <span class="fa fa-rotate-right"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleX&quot;, -1)">
              <span class="fa fa-arrows-h"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleY&quot;-1)">
              <span class="fa fa-arrows-v"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;crop&quot;)">
              <span class="fa fa-check"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)">
              <span class="fa fa-remove"></span>
            </span>
          </button>
        </div>
        <!--
        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;disable&quot;)">
              <span class="fa fa-lock"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;enable&quot;)">
              <span class="fa fa-unlock"></span>
            </span>
          </button>
        </div>
        -->
        <div class="btn-group">
          <!--
          <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)">
              <span class="fa fa-refresh"></span>
            </span>
          </button>
          -->
          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
            <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
              <span class="fa fa-upload"></span>
            </span>
          </label>
          <!--
          <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)">
              <span class="fa fa-power-off"></span>
            </span>
          </button>
          -->
        </div>
        
        <div class="btn-group btn-group-crop"> 
          <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
              Get Cropped Canvas
            </span>
          </button>
          <!--
          <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 160, height: 90 })">
              160&times;90
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 320, height: 180 })">
              320&times;180
            </span>
          </button>-->
          </div>

        <!-- Show the cropped image in modal -->
        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.png">Download</a>
              </div>
            </div>
          </div>
        </div><!-- /.modal -->
        <!--
        <button type="button" class="btn btn-primary" data-method="getData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getData&quot;)">
            Get Data
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="setData" data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setData&quot;, data)">
            Set Data
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="getContainerData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getContainerData&quot;)">
            Get Container Data
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="getImageData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getImageData&quot;)">
            Get Image Data
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="getCanvasData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCanvasData&quot;)">
            Get Canvas Data
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="setCanvasData" data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCanvasData&quot;, data)">
            Set Canvas Data
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="getCropBoxData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCropBoxData&quot;)">
            Get Crop Box Data
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="setCropBoxData" data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCropBoxData&quot;, data)">
            Set Crop Box Data
          </span>
        </button>
        
        <button type="button" class="btn btn-primary" data-method="moveTo" data-option="0">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.moveTo(0)">
            0,0
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="zoomTo" data-option="1">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoomTo(1)">
            100%
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="rotateTo" data-option="180">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotateTo(180)">
            180°
          </span>
        </button>
        <!--
        <button type="button" class="btn btn-primary">
            <span class="docs-tooltip" data-method="rotateTo">
              Done!!
            </span>
         </button>
         
        <input type="text" class="form-control" id="putData" placeholder="Get data to here or set data with this value">-->

      </div><!-- /.docs-buttons -->

      <div class="col-md-3 docs-toggles">
        <!-- <h3 class="page-header">Toggles:</h3> -->
        <div class="btn-group btn-group-justified" data-toggle="buttons">
          <label class="btn btn-primary active">
            <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9">
              16:9
            </span>
          </label>
          <label class="btn btn-primary">
            <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3">
              4:3
            </span>
          </label>
          <label class="btn btn-primary">
            <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1">
              1:1
            </span>
          </label>
          <label class="btn btn-primary">
            <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3">
              2:3
            </span>
          </label>
          <label class="btn btn-primary">
            <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN">
              Free
            </span>
          </label>
        </div>

        <div class="btn-group btn-group-justified" data-toggle="buttons">
          <label class="btn btn-primary active">
            <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0" checked>
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 0">
              VM0
            </span>
          </label>
          <label class="btn btn-primary">
            <input type="radio" class="sr-only" id="viewMode1" name="viewMode" value="1">
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 1">
              VM1
            </span>
          </label>
          <label class="btn btn-primary">
            <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 2">
              VM2
            </span>
          </label>
          <label class="btn btn-primary">
            <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3">
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 3">
              VM3
            </span>
          </label>
        </div>
        <!--
        <div class="dropdown dropup docs-options">
          <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true">
            Toggle Options
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="responsive" checked>
                responsive
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="restore" checked>
                restore
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="checkCrossOrigin" checked>
                checkCrossOrigin
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="checkOrientation" checked>
                checkOrientation
              </label>
            </li>

            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="modal" checked>
                modal
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="guides" checked>
                guides
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="center" checked>
                center
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="highlight" checked>
                highlight
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="background" checked>
                background
              </label>
            </li>

            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="autoCrop" checked>
                autoCrop
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="movable" checked>
                movable
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="rotatable" checked>
                rotatable
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="scalable" checked>
                scalable
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="zoomable" checked>
                zoomable
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="zoomOnTouch" checked>
                zoomOnTouch
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="zoomOnWheel" checked>
                zoomOnWheel
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="cropBoxMovable" checked>
                cropBoxMovable
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="cropBoxResizable" checked>
                cropBoxResizable
              </label>
            </li>
            <li role="presentation">
              <label class="checkbox-inline">
                <input type="checkbox" name="toggleDragModeOnDblclick" checked>
                toggleDragModeOnDblclick
              </label>
            </li>
          </ul>
        </div> /.dropdown -->
      </div><!-- /.docs-toggles -->
    </div>
  </div> 


<script type="text/javascript">
/*	$(document).ready(function() {
		var uploadWindow = $("#uploadWindow");
		var uploadWindowBtn = $("#uploadWindowBtn").bind("click", function() {
			var win = uploadWindow.data("kendoWindow");
			win.open();
			win.center();
		});
		
		$("#uploadWindow").kendoWindow({
			content: "/scripts/testcrop/index.php",
			modal: true,
			visible: false,
			iframe: true,
			actions: [
				"Close"
			],
		});
		
		var onClose = function() {
			
		}
		
}); */
</script>
    
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
		data: { 'content_main': con_all , 'headline' : headline , 'tag' : tag  , 'cata' : catalog_op , 'mlink' : mlink},
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
  		preloaderSrc: '/ajax-loader.gif',
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
}
