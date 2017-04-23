<? include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; 
@session_start();
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
?>
<link href="/Article/article.css" rel="stylesheet" type="text/css" />
<link href="/Article/css-social-buttons/social-buttons.css" rel="stylesheet" type="text/css" />	
<!-- BUT THIS MAKES IT LOAD SOOOOO SLOW! --> <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script> 
<!-- comments -->
<link href="/livechat/comments.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" type="text/css" />	

<link href="/scripts/froala/css/froala_content.min.css" rel="stylesheet" type"text/css" />
<link href="/scripts/froala/css/froala_style.min.css" rel="stylesheet" type"text/css" />

<!--<link rel="stylesheet" href="/scripts/jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="/scripts/jqwidgets/styles/jqx.metrodark.css" type="text/css" />
<script type="text/javascript" src="/scripts/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxdropdownbutton.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxcolorpicker.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxtooltip.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxtoolbar.js"></script>
<script type="text/javascript" src="/scripts/jqwidgets/jqxcheckbox.js"></script>-->
<!--  Dialog page-->

<? 
// only show if admin? 
if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
?>
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

<script>
/*$("#editPageBtn").kendoButton({
})*/

$(document).ready(function() {
	var loadOnce = 0;

	var loadTheEditor = function() {		
		$("#Leftbody_Article").editable({
			enter: "<br>",
	  		inlineMode: false,
	  		alwaysBlank: true, // Always set open in new window: _blank for URLs
	  		codeBeautifier: true,
	  		crossDomain: false,
	  		language: "zh_cn",
	  		pasteImage: true,
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
	  	loadOnce = 1;		
	};

 	$("#previewBtn").on('click', function(e) {
 		e.preventDefault();
 		if ($("#Leftbody_Article").data("fa.editable")) {
 			$("#Leftbody_Article").editable("destroy");
 		}
 		//$('#Leftbody_Article').froalaEditor('edit.off');
 	});
 	
 	$("#editBtn").on('click', function(e) {
 		loadOnce = 0;
 		e.preventDefault();
	  	setTimeout(function() {		
		if (loadOnce == 0) {
			if ($("#Leftbody_Article").data("fa.editable")) {
	 			$("#Leftbody_Article").editable("destroy");
	 		}
			loadTheEditor();
		}  	
	}, 200); // Need to wait to load for a  bit, so the content gets loaded first
 	});
    
    // Panel only
    $("#adminpanel").kendoPanelBar();    
  

  /*  
    $("#Leftbody_Article").kendoEditor({
        tools: [
            "bold",
            "italic",
            "underline",
            "strikethrough",
            "justifyLeft",
            "justifyCenter",
            "justifyRight",
            "justifyFull",
            "createLink",
            "unlink",
            "insertImage",
            "createTable",
            "addColumnLeft",
            "addColumnRight",
            "addRowAbove",
            "addRowBelow",
            "deleteRow",
            "deleteColumn",
            "foreColor",
            "backColor",
            "cleanFormatting",
            "formatting",
            "viewHtml"
        ]
    }); */
   
    
    // Tag editor
    $("#Leftbody_Headline_t").kendoEditor({
        tools: []
    });
    
    // headline editor
    $("#article_headline").kendoEditor({
        tools: []
    });

    // subheadline editor
    $("#article_subheadline").kendoEditor({
        tools: []
    });
    
    $("#photoEditBox").hide();
    $("#editPhoto").click(function() {
            
        // Turn photo area into photo upload and edit function
        $("#photoEditBox").toggle();
        $("#Leftbody_Poster").toggle();
        
       // update src of photo if changed...
    });
    
    $("#saveArticle").click(function() {
        var catid =  <?=$_GET["catlogid"]?>;
        var article = $("#Leftbody_Article").html(); // This is "duplicating" the editor...
        //var article = $("#Leftbody_Article").editable('getHTML', false, false);
        
        var headline = $("#article_headline").text();
        var subheadline = $("#article_subheadline").text();
        //var link = $("#article_picture").attr('src');$Pic_Link
        //var tag = $("#Leftbody_Headline_t").text();  
        var tag = $("#tag_edit").val();       
        //var is_spotlight = $("#spotlight_switch").is(':checked');
        var is_trash;
        
        if ($("#Leftbody_Article").data("fa.editable")) {
        	article = $("#Leftbody_Article").editable('getHTML', false, false);
        }
        
        /*
        if (temppath == null) {       
            console.log('1'.$("#article_picture").attr('src'));
            //console.log('2'.$pic_link);
             //var link 
            var link = $("#article_picture").attr('src');
        } else {
            console.log('1223');
            var link = temppath;
        }*/
       /*
       if (isEmpty(temppath)) {
           var dlink = $("#article_picture").attr('src');
           console.log('ok'+dlink);
       } else {
           var dlink = temppath;
           dlink = '/'+dlink;
           console.log('new'+dlink);
       }
        */
        if (document.getElementById('spotlight_switch').checked) {
            is_trash = 8;
            console.log('t');
        } else {
            //is_trash = "<?//=$catalog_op?>";
            //is_trash = Number(is_trash);
            console.log('f');
        }
        
        
        if (document.getElementById('spotlight_delete').checked) {
            var spot_id = "<?=$_GET["catlogid"];?>"
            console.log('delete'+spot_id);
            // Delete spot light
            $.ajax({
                url: "deletespot.php",
                method: "post",
                data: { 
                    'spot_id': spot_id
                    },
                cache : false,
                success: function(result) {
                    alert("deleted spotlight");
                },            
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                       
                    }   
    
                });
        } else {
            console.log('keep spot');
        }
        
            if (document.getElementById('air_delete').checked) {
            var release_id = "<?=$_GET["catlogid"];?>"
            console.log('delete'+spot_id);
            // Delete spot light
            $.ajax({
                url: "delete_air.php",
                method: "post",
                data: { 
                    'release_id': release_id
                    },
                cache : false,
                success: function(result) {
                    alert("直播删除！");
                },            
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                       
                    }   
    
                });
        } else {
            console.log('keep spot');
        }
        
        // Save article to database
        $.ajax({
            url: "/Article/savearticle.php",
            method: "post",
            data: { 
                'aid': catid,
                'article' : article,
                'tag' : tag,
                'headline' : headline,
                'subheadline' : subheadline,
                /*'link' : dlink,*/
                'is_trash' : is_trash
                },
            cache : false,
            success: function(result) {
                //console.log("R:" + result);
                //$('#Leftbody_Article').append(result);
                console.log(result);
                alert("Article saved to server.");
                document.location.reload(true);
            },            
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                   
                }  	

            });
    });

    
});

//to make sure string is empty or not
function isEmpty(str) {
    return (!str || 0 === str.length);
}
</script>

<style>
.k-editor-inline p {
    font-size: 13px;
}
.k-editor-inline {
    margin: 0;
    padding: 21px 21px 11px;
    border-width: 0;
    box-shadow: none;
    background: none;
}

.k-editor-inline.k-state-active {
    border-width: 1px;
    padding: 20px 20px 10px;
    background: none;
}
.k-editor-inline, .k-state-active, .k-state-active:hover {
	color: #000;
}
</style>
<!-- end of editor -->
   
<? } ?>
    
</head>
<body>
    
<? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; 

     //if ( ($catalog_op >= 8) and $_SESSION["myrank"] >= 240) { ?> 

	<!--
		Whole Article Page design
		By Daniel Lee 6/8/2015
	 -->
	 <?
	   //database update
	   //07/03/2015
	   //by daniel lee
	   
	   if (!isset($_GET["catlogid"])) {
	   		die("Article not found.");
	   }
	   
       $cat_key = $_GET["catlogid"];
	   $query = "SELECT * FROM catalog WHERE catalog.Catalog_Id = :catkey";    
       if($result_c = $pdo->prepare($query)) {
           //$result_t->bindParam(':cat_key',$_GET["catlogid"]);
           $result_c->bindParam(":catkey", $cat_key);
           $result_c->execute();
           $result_c->bindColumn('Link', $Pic_Link);
           $result_c->bindColumn('order_Spotlight', $Catalog_Order);
           $result_c->bindColumn('Tag', $Art_Tag);
           $result_c->bindColumn('Headline', $Art_Headline);
           $result_c->bindColumn('Content', $Art_Content);
           $result_c->bindColumn('Datetime', $Art_Datetime);
           $result_c->bindColumn('Author', $Art_Author);
           $result_c->bindColumn('Catalog_Id', $cat_id);
           $result_c->bindColumn('Subheadline', $Subheadline);
           $result_c->bindColumn('catalog_op', $catalog_op);
		            
          // while ($result_c->fetch()) {
           		
     $result_c->fetchColumn();     	
           	
           	
	 if ($catalog_op != 8 AND $Art_Headline != "" AND $Art_Headline != null) {
	 	// Continue showing the article
	 } else {
	 	if (!isset($_SESSION["myrank"]) or $_SESSION["myrank"] < 150) {
	 		// 404 Error not found
	 		die('<h1 style="text-align: center; margin-top: 2em;">文章未找到</h1>');		
	 	}
		echo '<h3 style="color: maroon; text-align: center;">文章在网站上不可见</h3>';
	 }
	 
	 // Check article body content for "hidden tags" (only logged in members can see)
	 if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 10) {
	 	// Show all content to members regardless (must be logged in)
	 } else {
	 	$search = '/<div class=\"membersOnly\">(.*?)<\/div>/si';
		$Art_Content = preg_replace($search, "Mm", $Art_Content);
		//die('m');
	 }
	 /*
     $replace = preg_replace_callback($search, function($matches) {		
     	if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 10) {
			$membersOnlyContent = '<div style="border: 2px solid pink; background-color: hotpink; border-radius: 6px;">'.$matches[1].'</div>';
		} else {
			$membersOnlyContent = ''; // Must be logged in to view, man!
		}
		return $membersOnlyContent;
     }, $Art_Content);
  	 $Art_Content = $replace;     */
     
	 ?>
	<div id="wcontainer"> 
	<div id="ArticleBody">
<? if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?> 
        <ul id="adminpanel">
            <li class="k-state-inactive">
                <span class="k-link k-state-selected">文章管理</span>
                <div style="padding: 10px;">
                   删除文章 Delete Article<input type="checkbox" style="width: 15px; height: 15px; vertical-align: middle;" id="spotlight_switch" <? if($catalog_op==8) echo 'checked';?> /><br>
                   移除滚动栏 Delete Spotlight<input type="checkbox" style="width: 15px; height: 15px; vertical-align: middle;" id="spotlight_delete" unchecked/><br>
                   移除直播室 Delete Rlease<input type="checkbox" style="width: 15px; height: 15px; vertical-align: middle;" id="air_delete" unchecked/><br>
                   <!--删除文章 Delete Article <input type="checkbox" style="width: 15px; height: 15px; vertical-align: middle;" id="delete_switch" />-->
                        
                </div>   
            </li>  
        </ul>
        
<? } ?>

        <div id="Article_Leftbody">
			<div class="Leftbody_Headline ">
			    <!--
			    <div id="Leftbody_Headline_t" style="text-align: center; font-weight: bold;">
			        <?=$Art_Tag?>
			    </div>-->
			    <title><?=$Art_Headline?></title>
			    <div class="Leftbody_Headline_l"></div>

			    <div id="Leftbody_Headline_c" style="text-align: center">
			       <p id="article_headline"><?=$Art_Headline?></p>
			    </div>  
			</div>
                
            <? if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?> 
                <!--<div>
                    
                    <div>
                    <button id="editPhoto" type="button" style="float: right; border-radius: 4px; clear: both; margin-top: 1em;">
                        <span class="k-icon"></span> 编辑图片
                    </button>
                    </div>
                    
            <link rel="stylesheet" href="/Article/uploadphoto.css" type="text/css" />
            <script type="text/javascript" src="/user/portrait/cropbox.js"></script>
        
            <div class="container" id="photoEditBox">
              <div class="imageBox">
                <div class="thumbBox"></div>
                <div class="spinner" style="display: none">Loading...</div>
              </div>
              <div class="action"> 
                <input type="file" id="file" style=" width: 200px">
                  <form method="post" id="fileinfo2" name="fileinfo2" onsubmit="return submitport2();">
                  <input type="file" name="file" id="file" value="123"/>
                  <input type="submit" value="上传文件"/> 
                  </form>
                <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
                <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
                <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >

              </div>
          <div class="cropped"></div>
            
            </div>-->
            <script type="text/javascript">
            /*

            $(document).ready(function() {
                var options =
                {
                    thumbBox: '.thumbBox',
                    spinner: '.spinner',
                    imgSrc: ''
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
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:480px; height:320px;"><p>480px*320px 用于滚动栏</p>');
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:355px; height:234px;"><p>355px*234px 用于资讯封面</p>');
                })
                $('#btnZoomIn').on('click', function(){
                    cropper.zoomIn();
                })
                $('#btnZoomOut').on('click', function(){
                    cropper.zoomOut();
                })
            });
            */
            </script>

            <!--
            <div id="Leftbody_Poster">    
                <img id="article_picture" src="<?=$Pic_Link?>" />
			</div>
			-->

                <div>

                <button class="k-button" id="editBtn" style="border-radius: 4px;">页面编辑</button>
                <button class="k-button" id="previewBtn" style="border-radius: 4px;">页面预览</button>

			    <button class="k-button" id="saveArticle" type="button" style="float: right; border-radius: 4px; clear: both;">
                    <span class="k-icon-tick"></span> 保存
                </button>             
                </div>
                
            <? } // End of admin only ?>
            
			<div id="Leftbody_Article">
				
			</div>
			<?
			//get all links from database
        	$query = "SELECT * FROM download_link WHERE catalog_id = :cat_id";
            //$query_top = "Select Link,Catalog_Order,Tag,Headline,Content,Datetime,Author FROM catalog,top_spotlight WHERE catalog.Catalog_Id = top_spotlight.Catalog_Id LIMIT 3";
            if($result_t = $pdo->prepare($query)) {
                 $result_t->bindParam(':cat_id', $_GET["catlogid"], PDO::PARAM_STR);
                 $result_t->execute();
                 $result_t->bindColumn('link1', $link1);
                 $result_t->bindColumn('link2', $link2);
                 $result_t->bindColumn('link3', $link3);
                 $result_t->bindColumn('link4', $link4);
                 $result_t->bindColumn('link5', $link5);
                 $result_t->bindColumn('link6', $link6);
                 $result_t->bindColumn('move_name', $link7);
                 $result_t->bindColumn('acfun', $link9);
                 $result_t->bindColumn('bili', $link10);
                 $result_t->bindColumn('pw1', $pw1);
                 $result_t->bindColumn('pw2', $pw2);
                
                 while ($result_t->fetch()) {
                     
                     //if its not member ,then dont show resourse
                    if(isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 10) { ?>
                        <div id="Leftbody_link">
                            <div id="Leftbody_link_head"><h2>相关下载</h2></div>
                            
                            <div class="Leftbody_link_box">
                                <div class="Leftbody_link_icon" id="360pw"><a href="<?=$link5?>" target="_blank"><img id="360pw1" src="/Article/icon/360.png" /></a></div>
                                <div class="Leftbody_link_icon" id="baidupw"><a href="<?=$link4?>" target="_blank"><img id="baidupw1" src="/Article/icon/Baidu.png" /></a></div>
                                <div class="Leftbody_link_icon"><a href="<?=$link6?>" target="_blank"><img src="/Article/icon/emule.png" /></a></div>
                                <div class="Leftbody_link_icon"><a href="<?=$link2?>" target="_blank"><img src="/Article/icon/xuanf.png" /></a></div>
                                <div class="Leftbody_link_icon"><a href="<?=$link3?>" target="_blank"><img src="/Article/icon/xun.png" /></a></div>
                            </div>
                            <div id="Leftbody_link_head"><h2>在线视频</h2></div>
                            <div class="Leftbody_link_box">
                                <div class="Leftbody_link_icon1"><a href="<?=$link9?>" target="_blank"><img width="32px" height="32px" src="/Article/icon/acf.png" /></a></div>
                                <div class="Leftbody_link_icon1"><a href="<?=$link10?>" target="_blank"><img width="80px" height="32px" src="/Article/icon/bilibili.png" /></a></div>
                                </div>
                                
                           
                        <!--    <table cellspacing="0" style="width:80%">
                                <tr bgcolor="#0055AA"><td><strong><font color="#FFFFFF"><?=$link7?></font></strong></td></tr>
                                <tr bgcolor="#FFFFFF"><td><strong><font color="#FF0000">文件扩展名 .qafone 修改为 .mkv 即可自动关联</font></strong></td></tr>
                                <tr bgcolor="#E0E0E0"><td style="padding:0px"><br>
                            <table cellspacing="0" style="width:90%;"><tbody><tr bgcolor="#FFFFFF"><td style="padding: 10px 30px">
                                <strong>国内网盘下载：<div class="showhide"><h4>本帖隐藏的内容需要是会员才可以浏览</h4>
                                    <a href="<?=$link1?>" target="_blank"><u>CTDisk网盘</u></a> | <a href="<?=$link2?>" target="_blank"><u>QQ旋风</u></a> | <a href="<?=$link3?>" target="_blank"><u>迅雷快传</u></a> | <a href="<?=$link4?>" target="_blank"><u>百度网盘</u></a>【密码: <?=$pw1?>】 | <a href="<?=$link5?>" target="_blank"><u>360云盘</u></a>【访问密码 <?=$pw2?>】<br>
                            <br>-<br>
                            <font color="Teal">以下电驴地址永久有效，可直接复制到迅雷进行离线下载，或者使用电驴软件下载：
                                <br><br>
                            <code>
                                <?=$link6?>
                            </code>
                            </font></div><br>
                            </strong></td></tr></tbody></table><br>
                            </td></tr></table>-->
                        </div>
                    <?
                    }
                 } 
        
            } else {
                die();
            }?>
<?			
// Donations
if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] > 9) { // Or show to everyone?
	?>
	<div style="text-align: center; margin-top: 2em; margin-bottom: 2em;">

			 
		<div id="donators" style="margin-bottom: 1em; text-align: left;">
			<h2>打赏的人</h2>
		</div>
		<div style="clear: both;"> </div>
		
	</div>

	<style type="text/css">
		h2.linethru {
			text-align: center;
			display: table;
			white-space: nowrap;
			&:before, &:after {
			      border-top: 1px solid #dfdfdf;
			      content: '';
			      display: table-cell;
			      position: relative;
			      top: 0.5em;
			      width: 35%;
			}
			&:before { right: 1.5%; }
			&:after { left: 1.5%; }
		}		
	</style>
	
	<div id="donateBox" style="text-align: center;">
		
		<p>
		<label for="donateAmount" style="font-size: 17pt;"></label>
		<input type="text" id="donateAmount" style="font-size: 17pt;" required="required"/>
		</p>
		
		<p>
			<label for="donateAccountName">微信账号</label>
			<input type="text" id="donateAccountName" class="k-textbox" style="width: 200px;"/>
		</p>
		(填写账号可显示荣誉墙或写"佚名")
		<!--<p> <input type="checkbox" id="donateAnonymously" class="k-checkbox" />
			<label class="k-checkbox-label" for="donateAnonymously">匿名</label>
		</p>-->
		
		<p><button class="k-button" style="font-size: 15pt; background-color: #FF8140" id="donateSend">立即支付</button></p>
		
	</div>
	
	<div id="donateBoxMsg"></div>
	

	<div id="Leftbody_SubHeadline"> 
        <div id="Leftbody_SubHeadline_down">
                    <span id="donateBtn" class="k-button"
            style="font-size: 34px; border-radius: 100%; width: 65px; 
                   height: 65px; text-align: center; vertical-align: middle;
                   background-color: #FF6600; border: 1px solid #CBD2D4; color: white;
                   margin-top: 12px;">赏</span>    
        </div>
        <div id="Leftbody_SubHeadline_MED">
            <div id="Leftbody_SubHeadline_iconcontainer">
                <div class="Leftbody_SubHeadline_icn"><a target="_blank" href="http://service.weibo.com/share/share.php?url=http://qafone.sweetgreen.org/Article/article.php?catlogid=<?=$cat_id?>&amp;appkey=&amp;title=<?=$Art_Headline?>&amp;pic=<?=$_SERVER['SERVER_NAME']?><?=$Pic_Link?>&amp;ralateUid=1768888052&amp;language=zh_cn"><img src="/uploads/LOGO_32x32.png" width="24px" height="24px"></a></div>
                <div class="Leftbody_SubHeadline_icn"><a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://www.douban.com/recommend/?url='+e(d.location.href)+'&title=<?=$Art_Headline?>&sel='+e(s)+'&v=1',x=function(){if(!window.open(r,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r+'&r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()"><img src="/uploads/favicon_48x48.png" width="24px" height="24px" alt="推荐到豆瓣" /></a></div>
                
                <div class="Leftbody_SubHeadline_icn">
                    <script type="text/javascript">
                    (function(){
                    var p = {
                    url:location.href,
                    showcount:'0',/*是否显示分享总数,显示：'1'，不显示：'0' */
                    desc:'',/*默认分享理由(可选)*/
                    summary:'',/*分享摘要(可选)*/
                    title:'<?$Art_Headline?>',/*分享标题(可选)*/
                    site:'<?=$_SERVER['SERVER_NAME']?>',/*分享来源 如：腾讯网(可选)*/
                    pics:'', /*分享图片的路径(可选)*/
                    style:'202'
                    };
                    var s = [];
                    for(var i in p){
                    s.push(i + '=' + encodeURIComponent(p[i]||''));
                    }
                    document.write(['<a version="1.0" class="qzOpenerDiv" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank">分享</a>'].join(''));
                    })();
                    </script>
                    <script src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20111201" charset="utf-8"></script>                           
                </div>
                <div class="Leftbody_SubHeadline_icn"><a target="_blank" href="http://www.facebook.com/share.php?u=http://outfilm.com/Article/article.php?catlogid=<?=$cat_id?>&title='<?$Art_Headline?>'">
                    <img width="24px" height="24px" src="/Article/fb.png" /></a></div>
                 <div class="Leftbody_SubHeadline_icn"><a target="_blank" href="https://twitter.com/intent/tweet?source=<?=$_SERVER['SERVER_NAME']?>&text=<?=$Art_Headline?>&url='http://outfilm.com/Article/article.php?catlogid=<?=$cat_id?>'">
                     <img width="24px" height="24px" src="/Article/tw.jpeg" /></a></div>
                 <div class="Leftbody_SubHeadline_icn"><a target="_blank" href="http://www.tumblr.com/share/link?url=http://outfilm.com/Article/article.php?catlogid=<?=$cat_id?>&name=<?=$Art_Headline?>&description=<?=$Art_Headline?>">
                     <img width="24px" height="24px" src="/Article/tm.ico" /></a></div>
                 <div class="Leftbody_SubHeadline_icn"><a target="_blank" href="https://plus.google.com/share?url=http://www.tumblr.com/share?v=3&u=http://outfilm.com/Article/article.php?catlogid=<?=$cat_id?>">
                     <img width="26px" height="26px" src="/Article/g2.png" /></a></div>
            </div>
        </div>
        <div id="Leftbody_SubHeadline_RID">
            <!--tag display-->          
            <?
            $pieces = explode(" ", $Art_Tag); 
            foreach($pieces as $tag) { ?><a target="_blank" href="/search.php?keyword=<?=$tag?>&submit=Submit" style="margin-left:10px;margin-top: 5px; "><?=$tag?></a><? }
            if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?> 
                <div id="tag_e"><input  id="tag_edit"  name="tag_edit" placeholder="<?=$Art_Tag?>" /></div>
                <button class="k-button" id="chenge_tag" type="button" style="float: right; border-radius: 4px; clear: both;">
                    <span class="k-icon-tick"></span> 编辑
               
            <? }
            ?>
            <!--tag display ends-->
        </div>
    </div>
	<script>
    $("#chenge_tag").click(function() {
        $("#tag_e").slideToggle("slow");
    });
	$("#changeTag").click(function() {
    //var clickedTag = $(this).find(".taggle_text").text();
    //console.log("a");
    
    })
	$(document).ready(function() {			
		getDonators();
		
		function getDonators() {
			var donators = $("#donators");
			donators.hide();
			$.ajax({
				cache: false,
				url: "/Article/getdonations.php",
				data: { 
					'aid': '<?=$_GET["catlogid"]?>' 
				},
				dataType: "json",
				success: function(result) {       	
					if (result.status != 0) {
			        	var donatorsTotal = 0;
			        	$.each(result, function(key,value) { 		
			  	        	donatorsTotal++;
			        		donatorPop(value.user_id, value.user_name, value.avatar, donatorsTotal);
			        		donators.show();
						});						
					} else {
						donators.hide();
					}		
				}
			});
		}
		
		function donatorPop(user_id, user_name, avatar, donatorNumber) {
			
			var newDonator = $('<div style="float: left; margin: 0 10px 10px 0;">'+
				'<img style="border-radius: 100%; width: 24px; padding-right: 3px; '+
				'  vertical-align: middle;" src="/uimg/'+user_id+'/'+avatar+'.png" />' +
				'<span style="color: #999; font-weight: bold; font-size: 12pt;">'+user_name+'</span>' +
				'</div>'); 
		
			$("#donators")		
				.append(newDonator.css("opacity", 0))
				.animate({ 
					scrollTop: $('#donators')[0].scrollHeight }, 
					5, 
					function() {
						newDonator.transition({ y: '-15px', 'opacity': 1, 'easing': 'in', delay: 200 }, 500 );
					}
				);			
		}			
		
		var donateBox = $("#donateBox"),
			donateBtn = $("#donateBtn")
			.bind("click", function() {
				var win = donateBox.data("kendoWindow");
				win.open();
				win.center();
				//donateBtn.hide();
			});
			
		var donateBoxMsg = $("#donateBoxMsg");
		
		var onClose = function() {
			//donateBtn.show();
		}
		
		if (!donateBox.data("kendoWindow")) {
			donateBox.kendoWindow({
				title: "微信打赏",
				modal: true,
				resizable: false,
				visible: false,
				actions: [
					"Close"
				],
				close: onClose
			});
		}
		
		if (!donateBoxMsg.data("kendoWindow")) {
			donateBoxMsg.kendoWindow({
				modal: true,
				resizable: false,
				visible: false,
				actions: [ "Close "]
			});
		}
		
		$("#donateAmount").kendoNumericTextBox({
			format: "c0",
			culture: "zh-CHS",
			min: 1,
			value: 10,
			step: 1
		});			
		
		$("#donateSend").bind("click", function() {
			var donateAccountName = $("#donateAccountName").val();
			var donateAmount = $("#donateAmount").val();
			//var isAnonymous = $("#donateAnonymously").val();
			var msgBox = donateBoxMsg.data("kendoWindow");
			var win = donateBox.data("kendoWindow");
			//var defaultContent = win.content();
			
			// Change to loading
			msgBox.content('<img src="/ajax-loader.gif" />');
			msgBox.open();
			msgBox.center();
			
			$.ajax({
				cache: false,
				url: "/Article/donate.php",
				method: "post",
				dataType: "json",
				async: false,
				data: { 
					'donate' : '1', 
					'account_name' : donateAccountName,
					'amount' : donateAmount,
					'article_id' : '<?=$_GET["catlogid"]?>'
					//'is_anonymous' : isAnonymous
				},
				success: function(result) {      
					console.log(result);
					 	
					if (result.error == "0") {
			        	//window.open(result.redirect, "_blank"); // Open in popup window		
			        		        		
						var link = document.createElementNS("http://www.w3.org/1999/xhtml", "a");
						    link.href = result.redirect;
						    link.target = '_blank';
						    
						    var event = new MouseEvent('click', {
						        'view': window,
						        'bubbles': false,
						        'cancelable': true
						    });
						    //link.dispatchEvent(event);
						    			        	
			        	//donateBox.data("kendoWindow").close();
			        	msgBox.content('<img src="/img/donate.jpg" height="300px">');	
			        	msgBox.center();
			        	/*
			        	setTimeout(function() { 
			        		msgBox.close();
			        		win.close();
			        	}, 6000);		        	
	        	        */
					} else {
						console.log("Unexpected error: " + result.error);
						msgBox.content("<p>错误: " + result.error + "</p>");
						
						setTimeout(function() { 
			        		msgBox.close();
			        	}, 5000);
						
					}
					

			        
						
				}
			});	
			
		});
		
	});
	</script>
	<?
}
			?>

			
<script>
// reveal the password of shared link 
$('#baidupw').hover(function(){
        $("#baidupw1").transition({ 
            opacity: 0.0, 
            y: '-30px',
            easing: 'out',
            duration: 1000,
            complete: function () { 
                $('#baidupw').html('<a href="<?=$link4?>" target="_blank"><?=$pw1?></a>');                          
            }
        });
    });
$('#360pw').hover(function(){
        $("#360pw1").transition({ 
            opacity: 0.0, 
            y: '-30px',
            easing: 'out',
            duration: 1000,
            complete: function () { 
                $('#360pw').html('<a href="<?=$link5?>" target="_blank"><?=$pw2?></a>');                          
            }
        });
    });
/* store the content in database */
$( document ).ready(function(){
var catid =  <?php echo json_encode($cat_key); ?>;
//console.log(catid);
$.ajax({
	url: "/Article/getarticle.php",
	method: "get",
	data: { 'aid': catid },
	cache : false,
	success: function(result) {
		//console.log("R:" + result);
		$('#Leftbody_Article').append(result);
				
	},            
		error: function(jqXHR, textStatus, errorThrown) {
			alert(errorThrown);
		}  	
	
	});
});
	/*-------------------------------*/
$("#test2").on("click", function() {
            //$("#Leftbody_Article").load("http://cors.io/?u=http://mp.weixin.qq.com/s?__biz=MzI1MDEzMTQyMQ==&mid=2656203447&idx=1&sn=6610f7fb395cb1281a34f46e577a6f6d#rd");
}); 
</script>
            <div id="Leftbody_CommentWindow">
				<div>					
					<? include $_SERVER["DOCUMENT_ROOT"]."/livechat/comments.php"; ?>
				</div>
            </div>
             <!-- Editor 
             <div id="Leftbody_Editor">
                    <!-- 
                    <textarea id="elm1" name="area"></textarea>
                    <!-- 
             </div>
             -->        <?

        $query_ALL1 = "SELECT * FROM catalog WHERE catalog_op NOT LIKE 8 AND catalog_op NOT LIKE 9 ORDER BY Clicks DESC LIMIT 4";
        $result_t = $pdo->prepare($query_ALL1);
        //$result_t->bindParam(':page_key',$page_key); 
        $result_t->execute();
        $result_t->bindColumn('Link', $Pic_Link);
        $result_t->bindColumn('Tag', $Art_Tag);
        $result_t->bindColumn('Headline', $Art_Headline);
        $result_t->bindColumn('Catalog_Id', $Catalog_Id);
        $result = array();?>
        </div>
        <div id="Article_Rightbody">
            <!-- Display Top news in mini size on right side-->
            <!--<div class="Rightbody_GapBox"></div>-->
            <div id="Rightbody_Top">
                <div id="Topmini_body">
                    <div id="Topmini_headline">
                        <h3 style="text-align: center;">QAF站 TOP推荐</h3>
                    </div>
                    <?
                    while ($result_t->fetch()) {?>
                        <div class="Topmini_box">
                        <div class="Topmini_box_pic"><a href="/Article/article.php?catlogid=<?=$Catalog_Id;?>"><img src="<?=$Pic_Link;?>"/></a></div>
                        <div class="Topmini_box_tag"><?=$Art_Tag; ?></div>
                        <div class="Topmini_box_headline"><?=$Art_Headline; ?></div>
                        </div><?    
                
                    }       
                    ?>
                    <!--

                    <div class="Topmini_box"></div>
                    -->
                </div>
            </div>
            <!-- weibo window on air-->
            <!--<div class="Rightbody_GapBox"></div>-->
            <?php           
              //  } // end of old while loop
            } else {  die();}
            ?> 
            <div id="Rightbody_Weibo">
                <iframe width="100%" height="1000" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=1768888052&verifier=78e29345&dpc=1"></iframe>
            </div>
            
            <!--<div class="Rightbody_GapBox"></div>-->
            <div class="Rightbody_AD">
                <wb:bulkfollow uids="1768888052" type="1" width="250" count="1" color="C2D9F2,FFFFFF,0082CB,666666" ></wb:bulkfollow>
            </div>
            <!--<div class="Rightbody_GapBox"></div>-->
        </div>  
		</div>

		</div>
	</div>
	<?// } else {die('you dont have access');} ?>
	</body>
	</html>