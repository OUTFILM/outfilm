<html xmlns:wb="http://open.weibo.com/wb">
<head>
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<meta charset="UTF-8">
	<link href="main.css" rel="stylesheet" type="text/css" />	
	<link href="Management.css" rel="stylesheet" type="text/css" />	
	<script type="text/javascript" src="scripts/jquery-1.11.2.min.js"></script>
	 <!-- CDN hosted by Cachefly -->
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="upload_feature.js"></script>
    <script>
    
	tinymce.init({
    	selector: "textarea#elm1",
    	theme: "modern",
    	width: 780,
    	height: 500,
    	plugins: [
         	"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         	"save table contextmenu directionality emoticons template paste textcolor"
   		],
   		content_css: "css/content.css",
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
                     
                     var headline = document.getElementById('headline1').value;
                     var tag = document.getElementById('tag1').value;
                     console.log('the content1 '+ headline + tag);
        			/* store the content in database */
					$('#submit_con').click(function(){
    					$.ajax({
                			url: "storecontent.php",
                			method: "post",
               				data: { 'content_main': ed.getContent() , 'headline' : headline , 'tag' : tag},
                			cache : false,
                			success: function(result) {
                				alert("s");
                			},            
                			error: function(jqXHR, textStatus, errorThrown) {
                    			alert(errorThrown);
               	 			}  
    	   				
    			        });
    			   })
    				/*-------------------------------*/
                  });
               
            }

 		});
 		

	</script>
    <!-- end of editor -->
</head>
<body>
    <div id="top_banner">
        <div id="Top_logo"></div>
        <div id="Top_logo1"><b>门户站</b></div>
        <div id="top_rightpart">
            <div id="top_contact">
                <!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
                <a href="https://api.addthis.com/oexchange/0.8/forward/douban/offer?url=http%3A%2F%2Fwww.addthis.com&pubid=ra-553674d825ba5cfc&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/douban.png" border="0" alt="Douban"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/sinaweibo/offer?url=http%3A%2F%2Fwww.addthis.com&pubid=ra-553674d825ba5cfc&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/sinaweibo.png" border="0" alt="Sina Weibo"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/baidu/offer?url=http%3A%2F%2Fwww.addthis.com&pubid=ra-553674d825ba5cfc&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/baidu.png" border="0" alt="Baidu"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http%3A%2F%2Fwww.addthis.com&pubid=ra-553674d825ba5cfc&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http%3A%2F%2Fwww.addthis.com&pubid=ra-553674d825ba5cfc&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
                <a href="https://www.addthis.com/bookmark.php?source=tbx32nj-1.0&v=300&url=http%3A%2F%2Fwww.addthis.com&pubid=ra-553674d825ba5cfc&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/addthis.png" border="0" alt="Addthis"/></a>

            </div>
        </div>
    </div>
    <div id="menu">
        <div id="menu_container">
            <div id="menu_popup_button"><img src="img/icon/menu.png" title="Menu" alt="Menu" /></div>
            <div class="menu_sub" style="color: white;"><h1>小编推荐</h1></div>
            <div class="menu_sub" style="color: red;"><h1>首页</h1></div>
            <div class="menu_sub" style="color: orange;"><h1>电影</h1></div>
            <div class="menu_sub" style="color: lightgreen;"><h1>咨询</h1></div>
            <div class="menu_sub" style="color: lightblue;"><h1>Top50</h1></div>
            <div class="menu_sub" style="color: white;"><h1>联系我们</h1></div>
            <div id="search_bar">       
                <input style="width: 150px;" type="search" id="mySearch" name="filter" autocomplete="on">
                <input type="submit" class="button" value="搜索" name="page_search">
            </div>

        
        <!--user top panel-->
        <div id="panel">
            <?php
            if($_SESSION["Is_Login"] == 1) {
            ?>
            <div class="signin_container">
                <span>欢迎回来</span>
                <span><?php echo $_SESSION["User_Name"];?></span>
            </div>
            <div class="signin_container">
                <div class="panel_icon"><i class="fa fa-envelope-o" style="color: white;"></i></div>
                <div class="panel_key"><a style="text-decoration: none;" href="http://qafone.sweetgreen.org/user/login.php"><span>&nbsp;&nbsp;收件箱</span></a></div>
            </div>
            <div class="signin_container">
                <div class="panel_icon"><i class="fa fa-sign-out" style="color: white;"></i></div>
                <div class="panel_key"><a style="text-decoration: none;" href="http://qafone.sweetgreen.org/user/Logout.php"><span>&nbsp;&nbsp;退出</span></a></div>
            </div>  
            <?php
            } else {
            ?>
            <div class="signin_container">
                <div class="panel_icon"><i class="fa fa-user fa-1.5x" style="color: white;"></i></div>
                <div class="panel_key"><a  style="text-decoration: none;" href="http://qafone.sweetgreen.org/user/login.php"><p>&nbsp;&nbsp;登录/注册</p></a></div>
            </div>
            <?php   
            }
            ?>
        </div>
        </div>
        <!--panel-->
    </div>
	<div id="M_wholewindow">
		<div id="menu_portrait">   <!-- portrait -->
			<img src="https://41.media.tumblr.com/67ffc8af84a30c01a4cd69816422c2b6/tumblr_nnkxa26X0e1u4j7b5o2_250.jpg" />

		</div>
		<div id="M_topbar">
			
		</div>
		<div id="M_leftbar">
			<div id="left_menu_bar">
				<div id="menu_namebox">
					<p style="text-align: center">阳仔</p>
				</div>
				<div class="left_menu_part">
					<div class="left_menu_item" style="text-align: center">
						<div class="left_sub_part_P" id="a321">文章编辑</div>
					</div>
						<div class="left_mainer" id="submenu1">
							<span class="left_maineritem" style="text-align: center;font-family: Microsoft JhengHei">文章投稿</span>
							<span class="left_maineritem" style="text-align: center;font-family: Microsoft JhengHei">投稿历史</span>
						</div>
						
					<div class="left_menu_item" style="text-align: center">
						<div class="left_sub_part_P">用户查找</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Right Control Window-->
		<div id="M_rightbar">
			<div id="M_rightbar_head">SDF</div>
			<div id="M_rightbar_bot">
				<div id="M_rightbar_bot_main">
					<div id="M_rightbar_bot_main_headline">
						<div class="form-style-5">
						<form>
						<fieldset>
						<legend style="font-family: Microsoft JhengHei"><span class="number">1</span> 标题 </legend>
						<input type="text" id="headline1" name="headline" placeholder="请输入标题" style="font-family: Microsoft JhengHei">		
						</div>
						 
					</div>
					<div id="M_rightbar_bot_main_tag">
						<div class="form-style-5">
						<fieldset>
						<legend style="font-family: Microsoft JhengHei"><span class="number">2</span> 标签 </legend>
						<input type="text" id="tag1" name="tag" placeholder="请输入标签" style="font-family: Microsoft JhengHei">		
						</div>						
					</div>
					<div id="M_rightbar_bot_main_cover">
						<div class="form-style-5">
						<fieldset>
						<legend style="font-family: Microsoft JhengHei"><span class="number">3</span> 文章封面 </legend>
						</fieldset>
						
						</div>
						<div id="M_rightbar_bot_main_coverpic"></div>
						<script>
							
							// Check for the various File API support.
							if (window.File && window.FileReader && window.FileList && window.Blob) {
  							// Great success! All the File APIs are supported.
							} else {
  								alert('The File APIs are not fully supported in this browser.');
							}						
   
							 function submitForm() {
            					console.log("submit event");
            					var fd = new FormData(document.getElementById("fileinfo"));
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
                				
            					});
            				return false;
        					}
						</script>
    					<form method="post" id="fileinfo" name="fileinfo" >
        				<label style="font-family: Microsoft JhengHei">选择文件</label><br>
        				<input type="file" id="file" name="file" required />
        				<input type="submit" value="上传文件" style="font-family: Microsoft JhengHei" onclick="submitForm();"/>
        				<button style="font-family: Microsoft JhengHei" onclick="abortRead();">取消预览</button></br></br>
        				<p style="font-family: Microsoft JhengHei; font-size: 15px;" >请选择您的视频封面图片。封面图片不得包含令人反感的信息，尺寸为480*270像素。请勿使用与内容无关，或分辨率不为16:9的图片作为封面图片。</p>
						<div id="progress_bar"><div class="percent">0%</div></div>
    					</form>
    					<script>
    					       /* preview the pic before upload*/
    						   function readFile (evt) {
       							var files = evt.target.files;
       							/* single select */
       							var file = files[0];           
       							var reader = new FileReader();
       							/* onload function */
       							reader.onload = (function() {
       								return function(e) {
       									var span = document.createElement('span');
          								span.innerHTML = ['<img id="M_rightbar_bot_main_coverpic" src="', e.target.result,'" title="', escape(file.name), '"/>'].join('');
          								document.getElementById('M_rightbar_bot_main_coverpic').insertBefore(span, null);
       								};
       								
         							console.log(this.result);
         							// Render thumbnail.
          							            
       							})(file);
       							reader.readAsDataURL(file);
       							
       							//reader.readAsText(file)
    							}
    							/* reload the onload function each time when change the file */
     							document.getElementById('file').addEventListener('change', readFile, false);
    					</script>
<script>
  var reader;
  var progress = document.querySelector('.percent');

  function abortRead() {
    reader.abort();
  }

  function errorHandler(evt) {
    switch(evt.target.error.code) {
      case evt.target.error.NOT_FOUND_ERR:
        alert('File Not Found!');
        break;
      case evt.target.error.NOT_READABLE_ERR:
        alert('File is not readable');
        break;
      case evt.target.error.ABORT_ERR:
        break; // noop
      default:
        alert('An error occurred reading this file.');
    };
  }

  function updateProgress(evt) {
    // evt is an ProgressEvent.
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        progress.textContent = percentLoaded + '%';
      }
    }
  }

  function handleFileSelect(evt) {
    // Reset progress indicator on new file selection.
    progress.style.width = '0%';
    progress.textContent = '0%';

    reader = new FileReader();
    reader.onerror = errorHandler;
    reader.onprogress = updateProgress;
    reader.onabort = function(e) {
      alert('File read cancelled');
    };
    reader.onloadstart = function(e) {
      document.getElementById('progress_bar').className = 'loading';
    };
    reader.onload = function(e) {
      // Ensure that the progress bar displays 100% at the end.
      progress.style.width = '100%';
      progress.textContent = '100%';
      setTimeout("document.getElementById('progress_bar').className='';", 2000);
    }

    // Read in the image file as a binary string.
    reader.readAsBinaryString(evt.target.files[0]);
  }

  document.getElementById('file').addEventListener('change', handleFileSelect, false);
</script>
												

					</div>
					<div id="M_rightbar_bot_main_article">
					<!-- -->
						<div class="form-style-5">
						<fieldset>
						<legend style="font-family: Microsoft JhengHei"><span class="number">4</span> 写作框 </legend>
						</fieldset>
						
						
                    	<textarea id="elm1" name="area"></textarea>
                    	<!-- <button id="submit_con">submit</button> -->
                    	<input type="submit" id="submit_con" value="提交" style="font-family: Microsoft JhengHei";/>
                    	</div>
                    	</form>
                    <!-- -->
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	
	$(".left_menu_item").click(function() {	
		$("#submenu1").slideToggle("slow");
	});
		
</script>
</body>
</html>