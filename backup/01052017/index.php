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
    	<div class="FlexLogo"><img src="/img/newlo1.png" height="100px" /></div>
    	<div id="sticky-anchor"></div> 
    	<!--	1.Top	Menu Begins	!	-->
        <div class="FlexItems FlexHeader">
            <!--<div class="Logo"><img src="/img/qaf_w.png" height="40px" /></div> 			logo		-->
            <!--<div id="rainbow"><img src="/img/rainbow.png"></div>-->
            <? include $_SERVER['DOCUMENT_ROOT']."/includes/newmenu.php"; ?>
        </div><!--		Top Menus Ends!			-->
        <!--	2.Slide Show Begins				-->     
        <div class="FlexItems FlexContent">
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
        <div class="FlexItems flexsearch">
        	<form class="search_box"  method = "GET" action = "search.php">
        	<input type="text" id="search" name="keyword" results="3" placeholder="同志" autosave="some_unique_value">
        	<input type="submit" name="submit" for="search">
        	</form>
        </div>	
		<!--	The System Notification Bar Ends!				-->
		<div class="FlexItems FlexHeadline"><h3 class="sectionT">专题报道</h3><hr/></div>
		
        <!--   Wrapper for comments and top FlexItems FlexChat-->
        <div class="FlexItems FlexChatAndReport" id="ChatnNot">
        	<div id="tabs">
					<ul>
						<li><a href="#tabs-1"  id="tabh1"></a></li>
						<li><a href="#tabs-2"  id="tabh2"></a></li>
						<li><a href="#tabs-3"  id="tabh3"></a></li>
						<li><a href="#tabs-4"  id="tabh4"></a></li>
						<li><a href="#tabs-5"  id="tabh5"></a></li>
					</ul>
        	<!--	4.Comments Board Begins!				-->            
            
		  <div  id="tabs-1">
		    <embed height="500px" width="828px" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="http://static.hdslb.com/miniloader.swf" flashvars="aid=7024910&page=1" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>

		  </div>
		  <div  id="tabs-2">
			<embed height="500px" width="828px" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="http://static.hdslb.com/miniloader.swf" flashvars="aid=7024910&page=1" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>
		  </div>
		  <div  id="tabs-3">
			<embed height="500px" width="828px" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="http://static.hdslb.com/miniloader.swf" flashvars="aid=7024910&page=1" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>
		  </div>
		  <div  id="tabs-4">
			<embed height="500px" width="828px" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="http://static.hdslb.com/miniloader.swf" flashvars="aid=7024910&page=1" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>
		  </div> 
		  <div  id="tabs-5">
			<embed height="500px" width="828px" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="http://static.hdslb.com/miniloader.swf" flashvars="aid=7024910&page=1" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>
		  </div>  
		  </div>    										
            <!--	Comments Board Ends!				-->
            <!--	5.Top Five News Begins	!			-->
            <!--<div class="FlexItems FlexReport" id="TopRoom" rolefor="Top">
            </div>-->
            <!--	Top Five Ends				-->          
        </div><!--	Wrapper for comments and Top Five ends!				-->
        <!--	6. Movie Theater Begins!				-->
        <div class="FlexItems FlexPoster">
        	<h3 class="sectionTitle">酷儿影院</h3>
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
        <!--	8.Article Begins!			-->
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
     
   <script>
  $( function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  } );
  </script>
  <style>
  .ui-tabs-vertical { width: 100%;}
  .ui-tabs-vertical .ui-tabs-nav {float: right; width: 30%; background-color: #3C3A4A; height:500px;}
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom: 2px solid white;}
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; border-right-width: 1px;background-color: lightblue  }
  .ui-tabs-vertical .ui-tabs-panel { padding: 1em 0; float: left;}
  
  </style>
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
                width: 1579,
                height: 473,
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
			$("#Column3").html('');
			Load_more();
				
				
		}
		 /* END Checck if Tags is being cliecked*/    
    </script>
     <!-- END Transition Required:  -->
     
     <!-- Display News Required:  Function display() and Function Loadmore()-->
     <script>
     	var top1 = 0; // count articles
     	var increment = 1;	
		var page = 1;
		var myTag = "";
		var column = 0;
		var win_size = $(window).width();
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
			
			$(function() {
			    $(window).scroll(sticky_relocate);
			    sticky_relocate();
			});
			//getComments();
			Notification();
     	});

	 	function Disply_Top1(row, picsrc, headline, content, catid, top1) {
	 		//console.log(row);
 			if(row==1) {
 			//console.log("1");
			$('#tabh1').append('<div class="FlexChat_headline"><h4>'+headline+'</h4><p>'+content+'...</p></div>');}
			//$('#ChatRoom').append('<div class="FlexChat_img"><img width="100%" src="'+picsrc+'"/></div><div class="FlexChat_headline"><h4><a href="/Article/article.php?catlogid='+catid+'">'+headline+'</a></h4><p>'+content+'...</p></div>');
	  		else {
	  		console.log("1");
	  		$('#tabh2').append('<div class="FlexChat_headline"><h4>'+headline+'</h4><p>'+content+'...</p></div>');}
	  		//$('#TopRoom').append('<div class="FlexChat_img"><img src="'+picsrc+'" align="middle"/></div><div class="FlexChat_headline"><h4><a href="/Article/article.php?catlogid='+catid+'">'+headline+'</a></h4><p>'+content+'...</p></div>');
     	}
 	 	function Disply_Top2(row, picsrc, headline, content, catid, top1) {
 	 		if(row==0) {
			$('#tabh'+ top1).append('<div class="FlexChat_headline"><h4>'+headline+'</h4><p>'+content+'...</p></div>');
			top1++;
			}
			//console.log(top1);
			return (top1);

     	}    	
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
     		if(screen.width >= 1500) {
     		//console.log($(window).height()+"w");
    		$('#Column3').removeClass("displaynone");
     		column = column % 4;
     		console.log("large screen");
     		}
     		else {
			column = column % 3;
			//console.log("small screen");
			}
			var myDate = new Date(Datetime.replace(/-/g, "/"));
			myDate = myDate.toDateString();
			//myDate = myDate.toLocaleTimeString("en-us", {year: "numeric", month: "short",
    //day: "numeric", hour: "2-digit", minute: "2-digit"});
			//Datetime = formatDate(Datetime);
			//Datetime = CONVERT(VARCHAR(10),Datetime,110);
			var Tags = Tag.split(" ");
			$("#Column"+column).append(
				$('<div class="FlexArticle_NewsContainer"><div class="FlexArticle_NewsContainer_Picture">' +
				  '<a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/>' +
				  '</a></div><div class="FlexArticle_NewsContainer_Headline">' +
				  '<h3>'+Headline+'</h3></div>' +
				  '<div class="FlexArticle_NewsContainer_TimeStamp"><h5>'+myDate+'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp views&nbsp&nbsp<em>'+Clicks+'</em>&nbsp&nbsp comments&nbsp&nbsp<em>'+ Commts +'</em></h5></div></div>'
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
		
		function Load_more() {
			$.ajax({
		    	url: "looptag.php",
		    	dateType: "json",
		    	method: "get",
		    	data: { 'page': page , 's_tag' : myTag},
		    	cache: false,
		     	success: function(result) {
		     		
		     		
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
		        	
		        	var html;
		        	var div;
		        	var text;
		        	//var counttemp = 1;   	
		        	$.each(output1, function(key,value) {       			
						 if (value.Title != "null") {					 
						 	html = value.Content;//Get Content
						 	div = document.createElement("div"); // ctret <div>
							div.innerHTML = html; // <div>article content</div>
							text = div.textContent || div.innerText || ""; // clean all the html tags
							div= null; html=null; // clear it out
							text = text.slice(0,70); // only get first 100 chars
						 	//console.log('row:'+value.Row+'\nlink:'+ value.Link+'\nHeadline:'+value.Headline+ '\ncontent:'+text + '\ntop0:'+top1);
							top1 = Disply_Top2(value.Row, value.Link, value.Headline, text, value.Catalog_Id, top1);
							//counttemp++; 
							console.log(top1);	
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
			     			//console.log("2");
			     		}
		     		});
		     		//autoScroll();
		     		//rotator(outputn);	  
		       },            
		       error: function(jqXHR, textStatus, errorThrown) {
		        	console.log("Load_more Error: " + errorThrown);
		       }
		    });   
		}	
			
</script>
</body>
</html>