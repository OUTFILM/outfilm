<?php 
	session_start();
?>
<html xmlns:wb="http://open.weibo.com/wb">
<head>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<meta charset="UTF-8">
	<link href="main.css" rel="stylesheet" type="text/css" />	
	<link href="Front.css" rel="stylesheet" type="text/css" />	
	<script type="text/javascript" src="scripts/jquery-1.11.2.min.js"></script>
</head>
<body>
	<div id="top_banner">
		<div id="Top_logo"><img src="uploads/logo.jpg"/></div>
		<div id="Top_logo1"><b style="font-family: Microsoft JhengHei;">门户站</b></div>
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

		
		<!--i need user panel-->
		<div id="panel">
			<?php
			if($_SESSION["Is_Login"] == 1) {
			?>
			<div class="signin_container">
				<div class="panel_key"><a style="text-decoration: none;"  href="http://qafone.sweetgreen.org/manage.php"><span><?php echo $_SESSION["User_Name"];?></span></a></div>
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
	
	<!-- begin page container 'til the end -->
	<div id="page_container">
		
	
	<div id="spotlight">
		<div id="slide_show">
			<div id="slide_show_container">
				
				<div style="text-align: center; font-size: 24pt;">
				<?php 
					include 'config.php';
					$slideB = "slide0btn";
					for($slidebtn = 0;$slidebtn<3;$slidebtn++) {
						$slideB[5]="$slidebtn";
						?> <span class="slideBtn" id="<?="$slideB";?>" style="color: lightgray;">&bullet;</span>	
				<?	} ?>				
				</div>
				
			<?php 
		        $query = "SELECT * FROM catalog WHERE catalog.Is_Spotlight = 1 ORDER BY order_Spotlight ASC LIMIT 3";
				//$query_top = "Select Link,Catalog_Order,Tag,Headline,Content,Datetime,Author FROM catalog,top_spotlight WHERE catalog.Catalog_Id = top_spotlight.Catalog_Id LIMIT 3";
				if($result_t = $pdo->prepare($query)) {
				     $result_t->execute();
                     $result_t->bindColumn('Link', $Pic_Link);
                     $result_t->bindColumn('order_Spotlight', $Catalog_Order);
                     $result_t->bindColumn('Tag', $Art_Tag);
                     $result_t->bindColumn('Headline', $Art_Headline);
                     $result_t->bindColumn('Content', $Art_Content);
                     $result_t->bindColumn('Datetime', $Art_Datetime);
                     $result_t->bindColumn('Author', $Art_Author);
                     $result_t->bindColumn('Catalog_Id', $cat_id);
					 $result_t->bindColumn('Subheadline', $Subheadline);
                    
                     while ($result_t->fetch()) {
                     
				//$result_t = mysqli_query($mysqli, $query_top);
				//if (!$result_t) { // add this check.
				//	die('Invalid query: ' . mysqli_error());}
				//while (is_array($row = mysqli_fetch_array($result_t))) {					 		
					?>
				<div class="slide" id="<?="slide"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> >   <a href="/Article/article.php?catlogid=<?="$cat_id"?>"> <img src=" <?="$Pic_Link"; ?>" /> </a></div>
				<div class="Tag_display" id="<?="Tag"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> > <p> <?="$Art_Tag"; ?></p> </div>
				<div class='Article_display' id="<?="Art"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> >
					<div class="Headline_display" style="text-align: center;" id="<?="headline"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> > 
						<p><h3> <?="$Art_Headline"; ?> </h3></p>
					</div>
					<div class="Author_display" style="text-align: center;" id="<?="Author"."$Catalog_Order"; ?>" > 
						<p>&nbsp;&nbsp;&nbsp;&nbsp;发布者：  <?="$Art_Author";   ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp发表于&nbsp&nbsp<?="$Art_Datetime"; ?></p>
					</div>
					<div class="Article_spot" style="text-align: center;" id="<?="Article"."$Catalog_Order"; ?>" > 
						<p> <?="$Subheadline"; ?></p> 
					</div>

				</div>

				<?php			
					  }
                        } else { die();}
				?> 		

			</div>
		</div>
	
		<div id="chat_room">
			<span style="font-weight: bold;">Live Chat</span> 	
		</div>	
		
	</div>
		
	<div id="popular_box">
		<div id="popular_box_headline">
			<p style="text-align: center">编辑推荐</p>
		</div>
		<?php
		$query_pop = "SELECT * FROM catalog WHERE catalog.Is_Popular = 1 ORDER BY Order_Popular ASC LIMIT 4";
		if($result_p = $pdo->prepare($query_pop)) {
		$result_p->execute();
        $result_p->bindColumn('Link', $Pic_Pop_Link);
        $result_p->bindColumn('Order_Popular', $Catalog_Pop_Order);
        $result_p->bindColumn('Tag', $Art_Pop_Tag);
        $result_p->bindColumn('Is_showcount', $Is_showcount);
        $result_p->bindColumn('Share_Des', $Share_Des);
		$result_p->bindColumn('Share_Url', $Share_Url);
		$result_p->bindColumn('Datetime', $Art_Pop_Datetime);
		$result_p->bindColumn('Headline', $Art_Pop_Headline);
        $result_p->bindColumn('Catalog_Id', $cat_id2);
        
        while ($result_p->fetch()) {
        ?>   
        
        <script>
             $(document).ready(function(){                     
                $("<?="#popbox"."$Catalog_Pop_Order";?>").fadeIn(<?="1000*".$Catalog_Pop_Order ?> );
             });
        </script>
       	<div class="popular_box"  id="<?="popbox"."$Catalog_Pop_Order"?>">
			<div class="popular_picbox">
				 <div class="Tag_display_pop" id="<?="Tag_id"."$Catalog_Pop_Order"?>"><p><?="$Art_Pop_Tag";?></p></div>
				 <a href="/Article/article.php?catlogid=<?="$cat_id2"?>"> <img src="<?="$Pic_Pop_Link"; ?>" align="middle" /></a>
			</div>
			<div class="Headline_display_pop"><h4><?="$Art_Pop_Headline"; ?></h4></div>			
			<div class="Bot_display_pop">
				<div class="Time_display_pop">
					<p valign="top"><?="$Art_Pop_Datetime"; ?></p>
				</div>
				<div class="QQ_BOX1">
					<a id="shareBtn" href="http://service.weibo.com/share/share.php?url=http://qafone.sweetgreen.org/Article/article.php?catlogid=<?="$cat_id2"?>&amp;appkey=&amp;title=<?="$Art_Pop_Headline"; ?>&amp;pic=<?="$Pic_Pop_Link"; ?>&amp;ralateUid=1768888052&amp;language=zh_cn"><img src="uploads/LOGO_32x32.png"></a>
				</div>
				
				<? /*
				<div class="Share_display_pop">
					<div id="QQ_BOX">
					<!-- QQ -->
					<script type="text/javascript">
					(function(){
					var p = {
					url:location.href,
					showcount:'0', //是否显示分享总数,显示：'1'，不显示：'0' 
					desc:'<?="$Share_Des"; ?>',//默认分享理由(可选)
					summary:'',//分享摘要(可选)
					title:'<?="$Art_Pop_Headline"; ?>',//分享标题(可选)
					site:'<?="$Share_Url"; ?>',//分享来源 如：腾讯网(可选)
					pics:'<?="$Pic_Pop_Link"; ?>', //分享图片的路径(可选)
					style:'203',
					width:22,
					height:22
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
					<!-- zuosi de renren
					<div id="QQ_BOX">
					<!-- RENREN 
					<script type="text/javascript" src="http://widget.renren.com/js/rrshare.js"></script>
					<a name="xn_share" onclick="shareClick()" type="icon" href="javascript:;"></a>
					<script type="text/javascript">
					function shareClick() {
		  				var rrShareParam = {
						resourceUrl : '<?="$Share_Url"; ?>',	//分享的资源Url
						srcUrl : '',	//分享的资源来源Url,默认为header中的Referer,如果分享失败可以调整此值为resourceUrl试试
						pic : '<?="$Pic_Pop_Link"; ?>',		//分享的主题图片Url
						title : '<?="$Art_Pop_Headline"; ?>',		//分享的标题
						description : '<?="$Share_Des"; ?>'	//分享的详细描述
					};
					rrShareOnclick(rrShareParam);
					}
					</script>
					</div>
					-->
					<!-- douban-->
					<div id="QQ_BOX">
					<a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://www.douban.com/recommend/?url='+e(d.location.href)+'&title='+e(d.title)+'&sel='+e(s)+'&v=1',x=function(){if(!window.open(r,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r+'&r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()"><img src="http://img2.douban.com/pics/fw2douban_s.png" alt="推荐到豆瓣" /></a>
					</div>
					<!-- weibo-->
					<div id="QQ_BOX1">
						<wb:share-button addition="number" url="<?="$Share_Url"; ?>" title="<?="$Art_Pop_Headline"; ?>" pic="<?="$Pic_Pop_Link"; ?>" type="icon" ralateUid="1768888052"></wb:share-button>
					</div>
				</div>
				 * 
				 */ 
				?>
			</div>
		</div>
		<? 		
			}
        } else { die();}
		?> 
	</div>
	<!-- **********GET RESULTS OF ALL LAEST NEWS FROM DATABASE**************** -->
               	
	<!-- ********************************************************************* -->
	</div><!-- end of page container -->
		<div id="popular_box_headline1">
		<p style="text-align: center">最新讯息</p>
	</div>
	<div id="column_core">	
		<div id="column_0">
		</div>
		<div id="column_1">
		</div>
		<div id="column_2">		
		</div>
	</div>
	<div align="center">
		<div class="button-fill grey" id="load_more" style="display: none;">
    		<div class="button-text">Load More</div>
    			<div class="button-inside">
      				<div class="inside-text">
      					Click				
      				</div>
   		 		</div>
 		 </div>
		<div class="modal" style="display: none;"> </div>
	</div>
    

<script>
var increment = 1;
var page = 1;
var is_click = 0 ;
var num_count = 0;
$(document).ready(function(){
	Load_more(is_click);
	function Disply_Latest(Link, Tag, Headline, Content, Datetime, Catalog_Id, column) {
		
    	column = column % 3;
    	$("#column_"+column).append(
    		$('<div class="latest_box"><div class="latest_picbox"><div class="Tag_display_latest"><p>'+Tag+'</p></div><a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/></a></div><div class="Headline_display_latest"><h4>'+Headline+'</h4></div><div class="Bot_display_latest" ><div class="Time_display_latest"><p valign="top">'+Datetime+'</p></div></div></div>'
    	).css('opacity', 0)
    	.delay(300*increment)
    	.animate(
    		{ 'margin-top': '20px', 'opacity': 1 }, 
    		{ duration: 'slow'}
    		)
    	);
    	column++;
    	increment++;
    	return(column);
   	}
   	
    function Load_more() {
    	$.ajax({
    	url: "Looptest.php",
    	dateType: "json",
    	method: "get",
    	data: { 'page': page },
    	cache : false,
     	success: function(result) {
     		var column = 0;
        	var output = jQuery.parseJSON(result);
        	
	
        	$.each(output, function(key,value) {
        		if (!(value.Count == undefined)) {
        			num_count = value.Count;
        		} else {
        			if (value.Title != "null") {
        				column=Disply_Latest(value.Link, value.Tag, value.Headline, value.Content, value.Datetime, value.Catalog_Id, column);
        			}
        		} 
        	});
        	
        	$(".button-fill").show();  
        	if(is_click == 1) {
        		$('html,body').animate({scrollTop: $("#load_more").offset().top}, 500);
       			$(".modal").hide();
       		} 
       },            
       error: function(jqXHR, textStatus, errorThrown) {
        	alert(errorThrown);
       }
    })    
    }
    
    
    $(".button-fill").click(function(){
    	increment = 1;
    	is_click = 1;
    	$(this).hide();  //hide click button
    	$(".modal").show();
    	
		var end = $(".button-fill").offset().top; var viewEnd = $(window).scrollTop() + $(window).height(); 
		var distance = end - viewEnd; 
		if (distance < 300) {
			page = page + 1;
			Load_more ();
		}
    })

});

 $(".button-fill").hover(function () {
    $(this).children(".button-inside").addClass('full');
}, function() {
  $(this).children(".button-inside").removeClass('full');
});
</script>

	

<script type="text/javascript">
	$( document ).ready(function() {
		
	$("#menu_popup_button").click(function() {
		$(".menu_popup").fadeToggle({ "duration" : 800 });
	});
		
		
	<?php 
		$slideB = "slide0btn";
		for($slidebtn = 0;$slidebtn<3;$slidebtn++) {
		$slideB[5] = $slidebtn ;
	?>
		$("<?="#"."$slideB";?>").click(function() {
		document.getElementById("<?="slide".(($slidebtn) % 3)."btn";?>").style.color = "black";
		document.getElementById("<?="slide".(($slidebtn+1)%3)."btn";?>").style.color = "lightgray";
		document.getElementById("<?="slide".(($slidebtn+2)%3)."btn";?>").style.color = "lightgray";
		$(".slide,.Tag_display,.Article_display").fadeOut({ "duration" : 1500 });
		$("<?="#slide"."$slidebtn"; ?>,<?="#Tag"."$slidebtn"; ?>,<?="#Art"."$slidebtn"; ?>").fadeIn({ "duration" : 1500 });
		
		
	});
		
	<?php } ?>
    });
    
    
	$( document ).ready(function() {
		slideshowScroll();		
	});
	
	function slideshowScroll() {
		var current = 0;
		
		function nextpic() {
			$(".slide,.Tag_display,.Article_display").fadeOut({ "duration" : 1500 });
			$("#Tag"+current).fadeIn({ "duration" : 1500 });
			$("#slide"+current).fadeIn({ "duration" : 1500 });
			$("#Art"+current).fadeIn({ "duration" : 1500 });
			document.getElementById("slide"+current+"btn").style.color = "black";
			document.getElementById("slide"+((current + 1)%3)+"btn").style.color = "lightgray";
			document.getElementById("slide"+(current + 2)%3+"btn").style.color = "lightgray";
			current = (current + 1)%3;
			setTimeout(nextpic, 5000);
		}
		
		setTimeout(nextpic, 5000);
		$(".slide,.Tag_display,.Article_display").fadeOut({ "duration" : 1500 });
		$("#Tag"+current).fadeIn({ "duration" : 1500 });
		$("#slide0").fadeIn({ "duration" : 1500 });
		$("#Art"+current).fadeIn({ "duration" : 1500 });
		document.getElementById("slide"+current+"btn").style.color = "black";
		document.getElementById("slide"+((current + 1)%3)+"btn").style.color = "lightgray";
		document.getElementById("slide"+(current + 2)%3+"btn").style.color = "lightgray";
	}
	
	function myFunction() {
		//var x = document.getElementById("mySearch").required;
	  	//document.getElementById("demo").innerHTML = x;
	}
	
</script>

</body>
</html>
