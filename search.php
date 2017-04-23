<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include $_SERVER["DOCUMENT_ROOT"]."/config.php";
session_start(); 
include $_SERVER["DOCUMENT_ROOT"]."/includes/log.php"; // Log every visit of every user and visitor.

$page = 0;
  	
 	
if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
	$key = $_GET['keyword']	;
} else {
	die("请返回输入搜索的内容，空白是什么玩意！");
}

  
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
	<!-- For the User Panel Icon-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   
<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" type="text/css" />	
</head>
<body>
	<!--	Whole Body Wrapper Begins!				-->
    <div class="FlexWrapper">
    	    	<!--	1.Top	Menu Begins	!	-->
        <div class="FlexItems FlexHeader">
            <div class="Logo">QAFONE</div> <!--			logo		-->
            <? include $_SERVER['DOCUMENT_ROOT']."/includes/newmenu.php"; ?>
        </div><!--		Top Menus Ends!			-->
        <!--	8.Article Begins!			-->
        <div class="FlexItems FlexArticle">
            <div class="FlexItems FlexColumn1" id="Column0"></div>
            <div class="FlexItems FlexColumn2" id="Column1"></div>
            <div class="FlexItems FlexColumn3" id="Column2"></div>
        </div><!--	Article Ends			-->           
    </div>
	<script type="text/javascript" src="/includes/lib/app.js"></script>
    <!-- SlidesJS Required: Link to jquery.slides.js -->
    <script src="/includes/lib/jquery.slides.min.js"></script>
    <!-- End SlidesJS Required -->
    <!-- tansiation Required: Link to jquery.transit.js -->
    <script src="/includes/lib/jquery.transit.js"></script>
    <!-- End transit Required -->
    <script>	
 	    var increment = 1;	
		var page = 1;
		var myTag = "<?=$key?>";
		
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
		    	data: { 'page': page , 'key' : myTag},
		    	cache: false,
		     	success: function(result) {
		     		//console.log(result[.length]]);
		     		if (result.length == 2 ) {
		     			//console.log('0');
		     			//$(".FlexArticle").prepend('<h2>对不起，文章没有找到，再试试搜索别的</h2>'); 
		     		}
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