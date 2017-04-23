<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    session_start(); 
	include $_SERVER["DOCUMENT_ROOT"]."/includes/log.php"; // Log every visit of every user and visitor.   
?>
<!doctype html>
<html lang="ch">
<head>
    <meta charset="utf-8">
    <title>酷儿影视</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="queer.css">
</head>
<body>
    <div class="FlexWrapper">
        <div class="FlexItems FlexHeader">
            <div class="Logo">QAFONE</div>
            <a href="#" class="ListItem">首页</a>
            <a href="#" class="ListItem">专题报道</a>
            <a href="#" class="ListItem">新片推荐</a>
            <a href="#" class="ListItem">酷儿影库</a>
            <a href="#" class="ListItem">影视资讯</a>
            <a href="#" class="ListItem">联系我们</a>
            <a href="#" class="LastItem">登录/注册</a>
        </div>     
        <div class="FlexItems FlexContent">
          <!-- The container is used to define the width of the slideshow -->
          <div class="container">
            <div id="slides">
              <img src="queer1.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
              <img src="example-slide-2.jpg" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
              <img src="example-slide-3.jpg" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
              <img src="example-slide-4.jpg" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
              <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
              <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
            </div>
          </div>
          <!-- End SlidesJS Required: Start Slides -->
        </div>
        <div class="FlexItems FlexNot">I am content in the 通知中心.</div>
        <div class="FlexItems FlexChatAndReport" id="ChatnNot">            
            <div class="FlexItems FlexChat" id="ChatRoom">
                <a class="close" id="chat_corss" rolefor="comments"></a>
                热门评论
            </div>
            <div class="FlexItems FlexReport" id="TopRoom" rolefor="Top">
            	<div class="TopBanner">
            		<a class="close" id="top_corss"></a>
            		<div class="TopTabs"></div>
            		<div class="TopTabs"></div>
            		<div class="TopTabs"></div>            		
            	</div>
            	<div class="FlexReport_Body"></div>
            </div>          
        </div>
        <div class="FlexItems FlexPoster">
        	<h3>酷儿影院</h3>
        	<nav class="Scroll_Wrapper">
<?
//Get 10 results from releases movie.    
//include "config.php"; // Include again since PDO was destroyed from livechat!      
$query_ALL = "SELECT * FROM releases ORDER BY Datetime DESC LIMIT 20";
if($result_t = $pdo->prepare($query_ALL)) {
	//$result_t->bindParam(':page_key',$page_key); 
	$result_t->execute();
	$result_t->bindColumn('ch_name', $ch_name);
	$result_t->bindColumn('en_name', $en_name);
	$result_t->bindColumn('intro', $intro);
	$result_t->bindColumn('online_link', $online_link);
	$result_t->bindColumn('down_link', $down_link);
	$result_t->bindColumn('poster_link', $poster_link); 
	$result_t->bindColumn('year', $year);
	$result_t->bindColumn('status', $status);
	$result_t->bindColumn('movie_time', $movie_time);
	$result_t->bindColumn('region', $region);
	$result_t->bindColumn('catalog', $catalog);
	// loop and fetch all the results for displaying.
	while ($result_t->fetch()) {                  
	?>
	<figure class="Item">
	<a href="#"><img src="<?=$poster_link;?>"/></a>
	</figure>
	<?php          
	}
} else { die(); }
?>
            </nav>
        </div>
        <div class="FlexItems FlexTags">
<?
$tags = array("浪漫", "喜剧", "柏林", "2016", "亚洲", "文艺", "戛纳", "欧美", "经典", "亲情", "奥斯卡", "权益", "出柜","威尼斯", "2015");           
foreach($tags as $tag) { ?><div class="FlexTags_Rect" id="<?='Tag'.array_search($tag, $tags);?>" onclick="featureTag('<?=$tag;?>','<?=array_search($tag, $tags);?>')"><p><?=$tag?></p></div><? }
?>
        </div>
        <div class="FlexItems FlexArticle">
            <div class="FlexItems FlexColumn1" id="Column0"></div>
            <div class="FlexItems FlexColumn2" id="Column1"></div>
            <div class="FlexItems FlexColumn3" id="Column2"></div>
        </div>             
    </div>

    <script type="text/javascript" src="/includes/js/jquery-1.11.2.min.js"></script>
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
                width: 1100,
                height: 350,
                navigation: false
            });
        });
    </script>
    <!-- End SlidesJS Required -->
    
    <!-- Transition Required:  -->
    <script>        
        /* Check use if click the cross, yes fade the box away */
        /* Get the element of boxes */
        var ChatRoom = document.getElementById("ChatRoom");
        var TopRoom = document.getElementById("TopRoom");
        var ChatNot = ChatRoom.parentNode; 
        /* Get Crosses */
        var CheckChat = document.getElementById("chat_corss");
        var CheckTop = document.getElementById("top_corss");
        $.fx.speeds._default = 500; //change default speed from 300 to 800
        /* Fire the function if click handler is triggered */
        CheckChat.addEventListener("click", function() {
            $('.FlexChat').transition({ opacity: 0 },  function() { ChatRoom.style.invisibility = "hidden"; // prevent from right window automatically moves to left
            /* if another disappered then the whole box fade away*/
            	if (TopRoom.style.display == "none") {         // if another one is gone too then whole window is gone
            		$('#ChatnNot').transition({ opacity: 0});  // Whole body of chat and top goes hidden 
            		$('.FlexTags').transition({ y: -400, delay:0 }); // Article moves up
            		$('.FlexArticle').transition({ y: -400, delay:0 }); // Article moves up
            	}          
            });
        }, false);
        CheckTop.addEventListener("click", function() { 
            $('.FlexReport').transition({ opacity: 0 }, function() { TopRoom.style.display = "none"; 
	            if (ChatRoom.style.invisibility == "hidden") {
	            	ChatRoom.style.display = "none";
	            	$('#ChatnNot').transition({ opacity: 0});
	            	$('.FlexTags').transition({y: -400 , delay:0});
	            	$('.FlexArticle').transition({y: -400 , delay:0});
	            }            
            });
        }, false);
		/* Check if closed ended */
		var isTagActivated = 0;
		var myTag = "";
		/* Checck if Tags is being cliecked */
		function featureTag (tag , tid) {
			
			var CheckTags = document.getElementById('Tag'+tid); // Get Id 
			$('#Tag'+tid).transition({ perspective: '100px',rotateY: '360deg'} , function (){ CheckTags.style = "none"; }); // Do the rotate effect and clear the style so it can do again when you click it
			page = 1;// Initial the page
			myTag = tag; // Tell SQL to search this Tag
	        $('#ChatnNot').transition({ opacity: 0});  // Whole body of chat and top goes hidden 
    		$('.FlexTags').transition({ y: -400, delay:0 }); // Article moves up
    		$('.FlexArticle').transition({ y: -400, delay:0 }); // Article moves up
			//$('#Column0').transition({ y:-400 , opacity: 0 }, function() { $("#Column0").html('');});
			//$('#Column1').transition({ y:-400 , opacity: 0 }, function() { $("#Column1").html('');});
			//$('#Column2').transition({ y:-400 , opacity: 0 }, function() { $("#Column2").html('');});
			//$("#Column0").html("");
			//$("#Column1").html("");
			//$("#Column2").html("");	
			//Load_more();	
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
     		$(window).scroll(function() {
	    		if($(window).scrollTop() == $(document).height() - $(window).height()) {
	            // ajax call get data from server and append to the div
	            page = page + 1;
	            Load_more();
	    		}
			});
     	});
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
     </script>
</body>
</html>