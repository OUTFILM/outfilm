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
    <link rel="stylesheet" href="queer.css" />
    <link href="/livechat/top_comments.css" rel="stylesheet" type="text/css" />

	<script  src="/includes/js/jquery-1.11.2.min.js"></script>
	<!-- For the System Notification -->
	<script  src="/includes/lib/notify.js"></script>
	<!-- For tabs() -->
	<script  src="/includes/js/jquery-ui.js"></script>
	<script type="text/javascript" src="/scripts/moment/moment-with-locales.js"></script>
	<script type="text/javascript" src="/scripts/livestamp.min.js"></script>
	<!-- For the User Panel Icon-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   
<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" type="text/css" />	
</head>
<body>
	<!--	Whole Body Wrapper Begins!				-->
    <div class="FlexWrapper">
    	<!--	1.Top	Menu Begins	!	-->
        <div class="FlexItems FlexHeader">
            <div class="Logo"><img src="/img/qaf_w.png" height="40px" /></div> <!--			logo		-->
            <!--<div id="rainbow"><img src="/img/rainbow.png"></div>-->
            <? include $_SERVER['DOCUMENT_ROOT']."/includes/newmenu.php"; ?>
        </div><!--		Top Menus Ends!			-->
        <!--	2.Slide Show Begins				-->     
        <div class="FlexItems FlexContent">
          <!-- The container is used to define the width of the slideshow -->
          <div class="container">
            <div id="slides" style="padding-bottom: 20px;">
              <?showSlideshow();?>        
              <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
              <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
            </div>
          </div>
          <!-- End SlidesJS Required: Start Slides -->
        </div><!--	The Slide Show Ends	!			-->
        <!--	3.The System Notification Bar Begins !				-->
        <div class="FlexItems FlexNot">
        	<div class="box Nothead">公告</div>
        	<div class="scroll">
			<ul class="list" id="listnot">
			</ul>
			</div>
        	<form class="search_box"  method = "GET" action = "search.php">
        	<input type="text" id="search" name="keyword" results="3" placeholder="同志" autosave="some_unique_value">
        	<input type="submit" name="submit" for="search">
        	</form>
		</div><!--	The System Notification Bar Ends!				-->
        <!--   Wrapper for comments and top -->
        <div class="FlexItems FlexChatAndReport" id="ChatnNot">
        	<!--	4.Comments Board Begins!				-->            
            <div class="FlexItems FlexChat" id="ChatRoom">
            	<div class="TopBanner"><h3 style="margin:0;">最新评论</h3>
                <!--<a class="close" id="chat_corss" rolefor="comments"></a>-->
                <!--<h3 style="display: inline-block; clear: both;"></h3>   -->                     
                <div style="clear: both;">					
					<? include $_SERVER["DOCUMENT_ROOT"]."/livechat/top_comments.php"; ?>
				</div>
				</div>
            </div><!--	Comments Board Ends!				-->
            <!--5.Top Five News Begins	!			-->
            <div class="FlexItems FlexReport" id="TopRoom" rolefor="Top">
            	<div id="tobscontrol">
            	<div class="TopBanner">
	            	<!--<a class="close" id="top_corss"></a>-->
	            	<ul> <!-- class="TopBanner"--> 
	            		<!--<li><a href="#fragment-1">TOP影视</a></li>-->
	            		<li><a href="#fragment-2">TOP专题</a></li>
	            		<li><a href="#fragment-3">TOP新闻</a></li>     		
	            	</ul>
            	</div>
            	<div class="FlexReport_Body">
            		  <!--div id="fragment-1"><ul></ul>
					  </div>-->
					  <div id="fragment-2"><ul></ul>
					  </div>
					  <div id="fragment-3"><ul></ul>
					  </div>
            	</div>
            	</div>
            </div>
            <div class="FlexSche">
            	<div class="TopBanner"><h3 style="margin:0;">放映表</h3></div>
            	<div class="FlexSche_Body">
            		<div class="FlexSche_Body_left">
            		<time datetime="2014-09-24" class="date-as-calendar position-pixels">
					<span class="weekday">星期天</span>
					<span class="day">8</span>
					<span class="month">五月</span>
					<span class="year">2016</span>
					</time>
					</div>
					<div class="FlexSche_Body_right">
						<span>抱紧他</span>
						<span>Hold The Man</span>						
					</div>           		
            	</div>
            	<div class="FlexSche_Body">
            		<div class="FlexSche_Body_left">
            		<time datetime="2014-09-24" class="date-as-calendar position-pixels">
					<span class="weekday">星期三</span>
					<span class="day">11</span>
					<span class="month">五月</span>
					<span class="year">2016</span>
					</time>
					</div>
					<div class="FlexSche_Body_right">
						<span>分手后</span>
						<span>The Outs S2E3</span>						
					</div> 
            	</div>
            	<div class="FlexSche_Body">
            		            		<div class="FlexSche_Body_left">
            		<time datetime="2014-09-24" class="date-as-calendar position-pixels">
					<span class="weekday">星期天</span>
					<span class="day">15</span>
					<span class="month">五月</span>
					<span class="year">2016</span>
					</time>
					</div>
					<div class="FlexSche_Body_right">
						<span>爱别自有方</span>
						<span>Like You Mean It </span>						
					</div> 
            	</div>
            	<div class="FlexSche_Body">
            		<div class="FlexSche_Body_left">
            		<time datetime="2014-09-24" class="date-as-calendar position-pixels">
					<span class="weekday">星期天</span>
					<span class="day">18</span>
					<span class="month">五月</span>
					<span class="year">2016</span>
					</time>
					</div>
					<div class="FlexSche_Body_right">
						<span>分手后</span>
						<span>The Outs S2E3</span>						
					</div> 
            	</div>
            </div>
            <!--	Top Five Ends				-->          
        </div><!--	Wrapper for comments and Top Five ends!				-->
        <!--	6. Movie Theater Begins!				-->
        <div class="FlexItems FlexPoster">
        	<h3>酷儿影院</h3>
        	<nav class="Scroll_Wrapper">
<?
//Get 10 results from releases movie.    
//include "config.php"; // Include again since PDO was destroyed from livechat!      
$query_ALL = "SELECT * FROM releases WHERE `isshow`='1' ORDER BY Datetime DESC LIMIT 20";
if($result_t = $pdo->prepare($query_ALL)) {
	//$result_t->bindParam(':page_key',$page_key); 
	$result_t->execute();
	$result_t->bindColumn('ch_name', $ch_name);
	$result_t->bindColumn('en_name', $en_name);
	$result_t->bindColumn('intro', $intro);
	$result_t->bindColumn('catalog_id', $catalog_id);
	$result_t->bindColumn('down_link', $down_link);
	$result_t->bindColumn('poster_link', $poster_link); 
	$result_t->bindColumn('year', $year);
	$result_t->bindColumn('status', $status);
	$result_t->bindColumn('movie_time', $movie_time);
	$result_t->bindColumn('region', $region);
	$result_t->bindColumn('catalog_id', $catalog_id);
	// loop and fetch all the results for displaying.
	while ($result_t->fetch()) {                  
	?>
	<figure class="Item">
	<a href="/Article/article.php?catlogid=<?=$catalog_id?>"><img src="<?=$poster_link;?>"/></a>
	</figure>
	<?php          
	}
} else { die(); }
?>
            </nav>
            <!--<div id="testan" style="height: 40px; width: 40px; background:black;"></div>-->
        </div><!--	 Movie Theater Begins! Ends				-->
        
         <!--<div class="FlexItems FlexSchedule"></div>-->
        <!--	7.Tags Begins			-->
        <div class="FlexItems FlexTags"><!--	Whole Body Wrapper Begins!				-->
<?
$lgbt_c =array(
			0 => "#FF545D",
			1 => "#FFA845",
			2 => "#FFF945",
			3 => "#45FF51",
			4 => "#459CFF",
			5 => "#B545FF"
		);
$tags = array("浪漫", "喜剧", "柏林", "2016", "亚洲", "文艺", "戛纳", "欧美", "经典", "亲情", "奥斯卡", "权益", "出柜","威尼斯", "2015","纪录片","另类","家庭");           
foreach($tags as $tag) { ?><div class="FlexTags_Rect" id="<?='Tag'.array_search($tag, $tags);?>" style="border-bottom-color:<?=$lgbt_c[rand(0,5)];?>" onclick="featureTag('<?=$tag;?>','<?=array_search($tag, $tags);?>')"><p><?=$tag?></p></div><? }
?>
        </div><!--	Tags Ends			-->
        <!--	8.Article Begins!			-->
        <div class="FlexItems FlexArticle">
            <div class="FlexItems FlexColumn1" id="Column0"></div>
            <div class="FlexItems FlexColumn2" id="Column1"></div>
            <div class="FlexItems FlexColumn3" id="Column2"></div>
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
    /*
    	$('#testan').click(function(){
    		$('#testan').transition({
  				y:300			
    	});
    	$('.FlexSchedule').transition({ marginTop: '0px', height: '300px'});
    	});
    	*/
        $(function() {
            $('#slides').slidesjs({
                width: 1100,
                height: 330,
                navigation: false
            });
        })
    </script>
    <!-- End SlidesJS Required -->
    <script>
    $(function() {
    	$( "#tobscontrol" ).tabs({
      		event: "mouseover"
    	});
  	});
    </script>
    <!-- Transition Required:  -->
    <script>        
		/* Check if closed ended */
		var isTagActivated = 1;
		var myTag = "";
		/* Checck if Tags is being cliecked */
		function featureTag (tag , tid) {
			myTag = tag;
			var NotBody = document.getElementById('#ChatnNot');
			var CheckTags = document.getElementById('Tag'+tid); // Get Id 
			$('#Tag'+tid).transition({ perspective: '100px',rotateY: '360deg'} , function (){ CheckTags.style = "none"; }); // Do the rotate effect and clear the style so it can do again when you click it
			page = 1;// Initial the page
			myTag = tag; // Tell SQL to search this Tag
			if(isTagActivated) {
				$('#ChatnNot').transition({ opacity: 0 }, function() { NotBody.style.display = "none"; });
            	$('.FlexTags').transition({y: -450 , delay:0});
            	$('.FlexArticle').transition({y: -450 , delay:0});
            	isTagActivated = 0;
			}
			$("#Column0").html('');
			$("#Column1").html('');
			$("#Column2").html('');
			Load_more();
				
				
		}
		 /* END Checck if Tags is being cliecked*/    
    </script>
     <!-- END Transition Required:  -->
     
     <!-- Display News Required:  Function display() and Function Loadmore()-->
     <script>
     	var increment = 1;	
		var page = 1;
		var myTag = "";
		
     	$(document).ready(function() {
     		Load_more();
     		SearchTop5();
     		$(window).scroll(function() {
	    		if($(window).scrollTop() == $(document).height() - $(window).height()) {
	            // ajax call get data from server and append to the div
	            page = page + 1;
	            Load_more();
	    		}
			});
			
			getComments();
			Notification();
     	});

     	function Disply_Top(row, picsrc, headline, content, catid, top1) {
     		//console.log(row+'dod');
     		top1 = top1 % 4;  // evry 0 will be treat 1th one , so that have different layout
     		//console.log(top1);
     		row += 1;
			if(!top1) {// if its the first one, we add image as well
				$('#fragment-'+row+' ul').append('<li class="FlexReport_FirstBody"><img src="'+picsrc+'"/><div class="FirstBody_headline"><h4><a href="/Article/article.php?catlogid='+catid+'">'+headline+'</a></h4><hr /><p>'+content+'...</p></div></li><hr/>');
				top1++;
			} else {// rest of topp only shows headline
				$('#fragment-'+row+' ul').append('<li class="FlexReport_RestBody"><h4><a href="/Article/article.php?catlogid='+catid+'">'+headline+'</a></h4><p class="overflow ellipsis">'+content+'</p></li>');
				top1++;
			}
			return top1;      		
     	}
     	function Disply_Latest(Link, Tag, Headline, Content, Datetime, Catalog_Id, Clicks , Commts, column, delayTime) {	
			column = column % 3;
			$("#Column"+column).append(
				$('<div class="FlexArticle_NewsContainer"><div class="FlexArticle_NewsContainer_Picture">' +
				  '<a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/>' +
				  '</a></div><div class="FlexArticle_NewsContainer_Headline">' +
				  '<h3>'+Headline+'</h3></div>' +
				  '<div class="FlexArticle_NewsContainer_TimeStamp"><h5>'+Datetime+'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp浏览<em>'+Clicks+'</em>&nbsp&nbsp评论<em>'+ Commts +'</em></h5></div></div>'
			).css('opacity', 0)
			.delay(delayTime*increment)
			.transition(
				{ 'margin-top': '20px', 'opacity': 1 }, 
				{ duration: 'slow'}
				)
			);
			
			//console.log(Catalog_Id + " C" + column + " I" + increment);
			column++;
			increment++; 
			return column;
		};
		
		function Load_more() {
			$.ajax({
		    	url: "looptag.php",
		    	dateType: "json",
		    	method: "get",
		    	data: { 'page': page , 's_tag' : myTag},
		    	cache: false,
		     	success: function(result) {
		     		
		     		var column = 0;
		        	var output = jQuery.parseJSON(result);
		        	$.each(output, function(key,value) {       			
						 if (value.Title != "null") {
							column = Disply_Latest(value.Link, value.Tag, value.Headline, 
										value.Content, value.Datetime, value.Catalog_Id , value.Clicks , value.Commts , column, 300); 
						 }        			
		        	});
		        		        	  
		       },            
		       error: function(jqXHR, textStatus, errorThrown) {
		        	console.log("Load_more Error: " + errorThrown);
		       }
		    }); 
		    
		    increment = -1; // Resets the delay time on display load more  
		}
		
		function SearchTop5 () {
			//console.log('top starts');
			$.ajax({
		    	url: "/search_top.php",
		    	dateType: "json",
		    	method: "post",
		    	data: {},
		    	cache: false,
		     	success: function(result) {
		        	var output1 = jQuery.parseJSON(result);
		        	var top1 = 0; // count articles
		        	var html;
		        	var div;
		        	var text;	   	
		        	$.each(output1, function(key,value) {       			
						 if (value.Title != "null") {					 
						 	html = value.Content;//Get Content
						 	div = document.createElement("div"); // ctret <div>
							div.innerHTML = html; // <div>article content</div>
							text = div.textContent || div.innerText || ""; // clean all the html tags
							div= null; html=null; // clear it out
							text = text.slice(0,100); // only get first 100 chars
						 	//console.log('row:'+value.Row+'\nlink:'+ value.Link+'\nHeadline:'+value.Headline+ '\ncontent:'+text + '\ntop0:'+top1);
							top1 = Disply_Top(value.Row, value.Link, value.Headline, text, value.Catalog_Id, top1);
							//console.log(top1);	
						 }        			
		        	});      	  
		       },            
		       error: function(jqXHR, textStatus, errorThrown) {
		        	console.log("Load_more Error: " + errorThrown);
		       }
		    });   
		}
		
		function Notification () {
			//console.log('top starts');
			$.ajax({
		    	url: "/get_notification.php",
		    	dateType: "json",
		    	method: "post",
		    	data: {},
		    	cache: false,
		     	success: function(result) {
		     		var outputn = jQuery.parseJSON(result);
		     		$.each(outputn, function(key,value) { 
			     		if (value.Title != "null") {
			     			$("#listnot").append('<li><a href="'+value.link+'" target="_blank">'+value.content+'</a></li>');	
			     			console.log("2")
			     		}
		     		});
		     		autoScroll();
		     		//rotator(outputn);	  
		       },            
		       error: function(jqXHR, textStatus, errorThrown) {
		        	console.log("Load_more Error: " + errorThrown);
		       }
		    });   
		}
		
		function rotator(arr) {			    				 					
		    var iterator = function (index) {
		        if (index >= arr.length) {
		            index = 0;
		        }
		        //console.log(arr[index]);
		        setTimeout(function () {
		        	ShowNotification(arr[index]["content"]);
		            iterator(++index);	            
		            //console.log(arr[index]["Headline"]);	
		        }, 6000);
		    };
		
		    iterator(0);
		};
		
		function ShowNotification(content) {
			$(".Nothead").notify(
			content,
			 { 
			 	elementPosition: 'right middle',
			 	//arrowShow: false,
			 	style: 'bootstrap',
			 	className: 'success'
			 }
			);
		} 	
		
		/**
		 * @author tugenhua
		 * @email tugenhua@126.com
		 * 一行一行文字向上滚动js
		 * 运用了Jquery中的animate动画方法
		 * 运用了一个小技巧 滚动的高度和每个li的高度一样
		 * 先找到外层ul的容器 然后相对于外层的容器进行向上滚动 ul没有设置他的高度 默认情况下是n个li×li的高度 向上是marginTop： -li.height(每个li的高度);
		 * 当滚动到最后一个li时候 那么最外层的容器应该滚动到0了 那么我就把第一个li加到ul里面去 这样就实现了循环滚动
		 * 而不会滚动到最后一个就停止下来了
		 */
		function autoScroll(obj){
			$(obj).find(".list").animate({
				marginTop : "-45px"
			},500,function(){
				$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
			})
		}
		$(function(){
			setInterval('autoScroll(".scroll")',6000)
		})	
		
			
</script>
</body>
</html>