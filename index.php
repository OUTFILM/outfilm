<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include $_SERVER["DOCUMENT_ROOT"]."/config.php";
session_start(); 
include $_SERVER["DOCUMENT_ROOT"]."/includes/log.php"; // Log every visit of every user and visitor.

function showSlideshow() {
	global $pdo;	
	$query = "SELECT * FROM spotlight ORDER BY time DESC LIMIT 4";
	if($result_s = $pdo->prepare($query)) {
	     $result_s->execute();
         $result_s->bindColumn('pic_path', $Pic_Link);
         $result_s->bindColumn('catalogid', $cat_id);     
         while ($result_s->fetch()) {
         	?>
         	<a href="/Article/article.php?catlogid=<?=$cat_id?>"><img src="<?=$Pic_Link?>" width="100%"/></a>        
			<?
		 } 
	} else {
		die();
	}	
}/* The slide show design  ENDS!!!!*/   
?>
<!doctype html>
<html lang="ch">
<head>
    <meta charset="utf-8">
    <title>酷儿影视</title>
    <meta name="viewport" content="width=device-width">
    <link href="queer.css" rel="stylesheet" type="text/css" />
    <link href="/livechat/top_comments.css" rel="stylesheet" type="text/css" />
	<link href="/Article/article.css" rel="stylesheet" type="text/css" />
	<script  src="/includes/js/jquery-1.11.2.min.js"></script>
	<!-- cloud tag -->
	<script src="/includes/js/jqcloud.min.js"></script>
	<link rel="stylesheet" href="/includes/js/jqcloud.min.css">
	<!-- For the User Panel Icon-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   
<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" type="text/css" />	
</head>
<body>
	<!--	Whole Body Wrapper Begins!				-->
    <div class="FlexWrapper">
    	<div class="FlexLogo"><img src="/img/newlo1.png" height="100px" /></div>
    	<div id="sticky-anchor"></div> 
    	<!--	1.Top	Menu Begins	!	-->
        <div class="FlexItems FlexHeader">
            <!--<div class="Logo"><img src="/img/qaf_w.png" height="40px" /></div> 			logo		-->
            <!--<div id="rainbow"><img src="/img/rainbow.png"></div>-->
            <? include $_SERVER['DOCUMENT_ROOT']."/includes/newmenu.php"; ?>
        </div><!--		Top Menus Ends!			-->
        <!--	2.Slide Show Begins				-->     
        <div class="FlexContent">
          <!-- The container is used to define the width of the slideshow -->
          <div class="container">
            <div id="slides">
              <?showSlideshow();?>        
              <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
              <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
            </div>
          </div>
          <!-- End SlidesJS Required: Start Slides -->
        </div><!--	The Slide Show Ends	!			-->
        <!--	3.The System Notification Bar Begins !				-->
        <div class="flexsearch">
        	<form class="search_box"  method = "GET" action = "search.php">
        	<input type="text" id="search" name="keyword" results="3" placeholder="同志" autosave="some_unique_value">
        	<input type="submit" name="submit" for="search">
        	</form>
        </div><?
        $query_ALL1 = "SELECT * FROM catalog WHERE catalog_op NOT LIKE 8 AND catalog_op NOT LIKE 9 ORDER BY Clicks DESC LIMIT 4";
        $result_t = $pdo->prepare($query_ALL1);
        //$result_t->bindParam(':page_key',$page_key); 
        $result_t->execute();
        $result_t->bindColumn('Link', $Pic_Link);
        $result_t->bindColumn('Tag', $Art_Tag);
        $result_t->bindColumn('Headline', $Art_Headline);
        $result_t->bindColumn('Catalog_Id', $Catalog_Id);
        $result = array();?>
        <div class="MainBody_1">
        	<div class="LeftSideColumn">
        		<div class="Articlecolumn">
        			<div class="Articlecolumn_Head"><h2>NEWS  实时新闻</h2></div>
        			<div class="Articlecolumn_Art" id="art0"></div>
        		</div>
        		<div class="Articlecolumn">
        			<div class="Articlecolumn_Head"><h2>FILMS 最佳新片</h2></div>
        			<div class="Articlecolumn_Art" id="art1"></div>
        		</div>
        		<div class="Articlecolumn">
        			<div class="Articlecolumn_Head"><h2>MOVIE'S NEWS 影视资讯</h2></div>
        			<div class="Articlecolumn_Art" id="art2"></div>
        		</div>
        		<div class="Articlecolumn">
        			<div class="Articlecolumn_Head"><h2>REPORTS 专题报道</h2></div>
        			<div class="Articlecolumn_Art" id="art3"></div>
        		</div>
        		<div class="Articlecolumn">
        			<div class="Articlecolumn_Head"><h2>OUT FILM 酷儿影库</h2></div>
        			<div class="Articlecolumn_Art" id="art4"></div>
        		</div>
        	</div>	
        	<div class="SideBar">
            <!-- Display Top news in mini size on right side-->
            <!--<div class="Rightbody_GapBox"></div>-->
            <div id="Rightbody_Top1">
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
            <div id="cloudTag" class="Rightbody_AD" style="margin-right: 0; margin-top: 0;">
                
            </div>
            <div id="Rightbody_Weibo" style="margin-right: 0;">
                <iframe width="100%" height="1000" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=1768888052&verifier=78e29345&dpc=1"></iframe>
            </div>
            

            <!--<div class="Rightbody_GapBox"></div>-->
        
        	</div>	
        </div>
        <div class="RelateLink">
        	<div class="RelateLink_head"><h2>RELATED LINKS 友情链接</h2></div>
        	<div class="RelateLink_body">
        		<div class="RelateLink_logo"><a href="http://www.qafone.co"><img src="/img/link1.png" style="width: 100%;" /></a></div>
        		<div class="RelateLink_logo"><a href=""><img src="" style="width: 100%;" /></a></div>
        		<div class="RelateLink_logo"></div>
        		<div class="RelateLink_logo"></div>
        		<div class="RelateLink_logo"></div>
        		<div class="RelateLink_logo"></div>
        		<div class="RelateLink_logo"></div>
        		<div class="RelateLink_logo"></div>
        		<div class="RelateLink_logo"></div>
        	</div>
        </div>
		<div class=" Footer_1">
			<div class="Footer_Head"><h3>关于我们</h3></div><div class="Footer_Head"><h3>商业合作</h3></div><div class="Footer_Head"><h3>官方网站</h3></div>
			<div class="Footer_Title">组织介绍</div><div class="Footer_Title">加入我们</div><div class="Footer_Title">LGBT合作</div><div class="Footer_Title">广告合作</div>
			<div class="Footer_Title">同志亦凡人中文站论坛</div><div class="Footer_Title">同志亦凡人微博</div><div class="Footer_Title">QAF中文站 2017 @ All rights reserved</div>
		</div>	
		<!--	The System Notification Bar Ends!				-->
		<!-- <div class="FlexItems FlexHeadline"><h3 class="sectionT">专题报道</h3><hr/></div>
		
        <!--   Wrapper for comments and top FlexItems FlexChat
        <div class="FlexItems FlexChatAndReport" id="ChatnNot"> 										
            <!--	Comments Board Ends!				-->
            <!--	5.Top Five News Begins	!			-->
            <!--<div class="FlexItems FlexReport" id="TopRoom" rolefor="Top">
            </div>-->
            <!--	Top Five Ends				-->          
        </div><!--	Wrapper for comments and Top Five ends!				-->
        <!--	6. Movie Theater Begins!				-->

        
         <!--<div class="FlexItems FlexSchedule"></div>-->
        <!--	8.Article Begins!			-->
        <!--
        <div class="FlexItems FlexHeadline1"><h3 class="sectionT">更多新闻</h3><hr/></div>
        <div class="FlexItems FlexArticle">
        	
            <div class="FlexItems FlexColumn1" id="Column0"></div>
            <div class="FlexItems FlexColumn2" id="Column1"></div>
            <div class="FlexItems FlexColumn3" id="Column2"></div>
            <div class="FlexItems FlexColumn4 displaynone" id="Column3"></div>
        </div><!--	Article Ends			-->  
        <div id="elevator_item"> 
		<a id="elevator" onclick="return false;" title="Back To Top"></a> 
		<a class="qr"></a>
		<div class="qr-popup"> <a class="code-link"> <img class="code" src="/img/barc.jpg" width="150px"/> </a><span>关注微信 QAF中文站</span>
		<div class="arr"></div>
		</div>
		</div>           
    </div>
	<script type="text/javascript" src="/includes/lib/app.js"></script>
    <!-- SlidesJS Required: Link to jquery.slides.js -->
    <script src="/includes/lib/jquery.slides.min.js"></script>
    <!-- End SlidesJS Required -->
    <!-- tansiation Required: Link to jquery.transit.js -->
    <script src="/includes/lib/jquery.transit.js"></script>
    <!-- End transit Required -->
    </script>
     
    <!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
    <script>
        $(function() {
            $('#slides').slidesjs({
                width: 1579,
                height: 473,
                navigation: false
            });
        })
    </script>
    <!-- End SlidesJS Required -->
    <script>
  	
  	var words = [
  	{text: "同志", weight: 3.5, link: 'http://outfilm.org/search.php?keyword=同志&submit=Submit'},
  	{text: "浪漫", weight: 4.5, link: 'http://outfilm.org/search.php?keyword=浪漫&submit=Submit'},
  	{text: "2016", weight: 4.4, link: 'http://outfilm.org/search.php?keyword=2016&submit=Submit'},
  	{text: "文艺", weight: 4.0, link: 'http://outfilm.org/search.php?keyword=文艺&submit=Submit'},
  	{text: "戛纳", weight: 3.4, link: 'http://outfilm.org/search.php?keyword=戛纳&submit=Submit'},
  	{text: "经典", weight: 4.4, link: 'http://outfilm.org/search.php?keyword=经典&submit=Submit'},
  	{text: "亲情", weight: 3.8, link: 'http://outfilm.org/search.php?keyword=亲情&submit=Submit'},
  	{text: "喜剧", weight: 4.4, link: 'http://outfilm.org/search.php?keyword=同志权益&submit=Submit'},
  	{text: "出柜", weight: 3.4, link: 'http://outfilm.org/search.php?keyword=出柜&submit=Submit'}
  	
	/* ... */
	];
  	$('#cloudTag').jQCloud(words);
    </script>
    <!-- Transition Required:  -->
    <script>        
		/* Check if closed ended */
		var isTagActivated = 1;
		var myTag = "";
		var top1 = 0; // count articles
     	var increment = 1;	
		var page = 1;
		var column = 0;
		
     	$(document).ready(function() {
     		//Load_more();
     		SearchArticle();
			
			$(function() {
			    $(window).scroll(sticky_relocate);
			    sticky_relocate();
			});
			//getComments();
			//Notification();
     	});
     	
		function sticky_relocate() {
		    var window_top = $(window).scrollTop();
		    var div_top = $('#sticky-anchor').offset().top;
		    if (window_top > div_top) {
		        $('.FlexHeader').addClass('stickytop');
		        $('#sticky-anchor').height($('.FlexHeader').outerHeight());
		    } else {
		        $('.FlexHeader').removeClass('stickytop');
		        $('#sticky-anchor').height(0);
		    }
		}
			
 	 	function Disply_Top2(row, picsrc, headline, Datetime, catid, top1, Clicks, Commts, delayTime) {
 	 		var myDate = new Date(Datetime.replace(/-/g, "/"));
			myDate = myDate.toDateString();
			//myDate = myDate.toLocaleTimeString("en-us", {year: "numeric", month: "short",
    		//day: "numeric", hour: "2-digit", minute: "2-digit"});
			//Datetime = formatDate(Datetime);
			//Datetime = CONVERT(VARCHAR(10),Datetime,110);
			//var Tags = Tag.split(" ");
			$("#art"+row).append(
				$('<div class="FlexArticle_NewsContainer"><div class="FlexArticle_NewsContainer_Picture">' +
				  '<a href="/Article/article.php?catlogid='+catid+'"><img src="'+picsrc+'" align="middle"/>' +
				  '</a></div><div class="FlexArticle_NewsContainer_Headline">' +
				  '<h3>'+headline+'</h3></div>' +
				  '<div class="FlexArticle_NewsContainer_TimeStamp"><h5>'+myDate+'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp views&nbsp&nbsp<em>'+Clicks+'</em>&nbsp&nbsp comments&nbsp&nbsp<em>'+ Commts +'</em></h5></div></div>'
			).css('opacity', 0)
			.delay(delayTime*increment)
			.transition(
				{ 'margin-top': '20px', 'opacity': 1 }, 
				{ duration: 'slow'}
				)
			);
			top1++;
			//console.log(row);	
			return (top1);

     	}    	

		function SearchArticle () {
			//console.log('top starts');
			$.ajax({
		    	url: "/search_top.php",
		    	dateType: "json",
		    	method: "post",
		    	data: {},
		    	cache: false,
		     	success: function(result) {
		        	var output1 = jQuery.parseJSON(result);
		        	
		        	var html;
		        	var div;
		        	var text;
		        	//var counttemp = 1;   	
		        	$.each(output1, function(key,value) {       			
						 if (value.Title != "null") {					 
							Disply_Top2(value.Row, value.Link, value.Headline, value.Datetime, value.Catalog_Id, top1, value.Clicks, value.Commts, 300);
							//counttemp++; 
							console.log(value.Headline);	
						 }
						        			
		        	});      	  
		       },            
		       error: function(jqXHR, textStatus, errorThrown) {
		        	console.log("1_more Error: " + errorThrown);
		       }
		    });   
		}  
		
		function formatDate(date) {
			  var hours = date.getHours();
			  var minutes = date.getMinutes();
			  var ampm = hours >= 12 ? 'pm' : 'am';
			  hours = hours % 12;
			  hours = hours ? hours : 12; // the hour '0' should be '12'
			  minutes = minutes < 10 ? '0'+minutes : minutes;
			  var strTime = hours + ':' + minutes + ' ' + ampm;
			  return date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
		}
		
			
</script>
</body>
</html>