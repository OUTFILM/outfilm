<?

include 'config.php';

function showSlideshow() {
	global $pdo;
	
	?>
	<div style="text-align: center; font-size: 34pt;">
		<? 					
		$slideB = "slide0btn";
		for($slidebtn = 0; $slidebtn < 3; $slidebtn++) {
			$slideB[5]="$slidebtn";
			?> <span class="slideBtn" id="<?="$slideB";?>" style="color: lightgray;">&bullet;</span>	
		<? } ?>				
	</div>
	<?
	
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
         	?>
         	<div class="slide" id="<?="slide"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> >  
         			<a href="/Article/article.php?catlogid=<?="$cat_id"?>"> <img style="width: 700px;" src=" <?="$Pic_Link"; ?>" /> </a></div>
				<div class="Tag_display" id="<?="Tag"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> > <p> <?="$Art_Tag"; ?></p> </div>
				<div class="Article_display" id="<?="Art"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> >
					<div class="Headline_display" style="text-align: center;" id="<?="headline"."$Catalog_Order"; ?>" <?php if($Catalog_Order== 0) echo "style=\"display: block;\"";?> > 
						<p><h3> <?="$Art_Headline"; ?> </h3></p>
					</div>
					<div class="Author_display" style="text-align: center;" id="<?="Author"."$Catalog_Order"; ?>" > 
						<p>&nbsp;&nbsp;&nbsp;&nbsp;发布者：  <?="$Art_Author";   ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp发表于&nbsp&nbsp<?="$Art_Datetime"; ?></p>
					</div>
					<div class="Article_spot" style="text-align: center;" id="<?="Article"."$Catalog_Order"; ?>" > 
						<h3> <?="$Subheadline"; ?></h3> 
					</div>
				</div>
			<?
		 } 

	} else {
		die();
	}
	
}

include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; ?>	

	<!-- live chat -->
	<link rel="stylesheet" href="/scripts/jqwidgets/styles/jqx.base.css" type="text/css" />
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
    <script type="text/javascript" src="/scripts/jqwidgets/jqxcheckbox.js"></script>	
	<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" type="text/css" />	
	<link rel="stylesheet" href="/livechat/livechat.css" type="text/css" />
	<!-- end live chat -->	
	<!--top-->
	 <link rel="stylesheet" href="user/top/style.css"> <!-- Gem style -->
    <script src="user/top/modernizr.js"></script> <!-- Modernizr -->
    <script src="user/top/main.js"></script> <!-- Gem jQuery -->
</head>
<body>
<div id="site_container">
	
    <? //include $_SERVER['DOCUMENT_ROOT']."/includes/top.php"; ?>
    <? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>   
    <? include $_SERVER['DOCUMENT_ROOT']."/includes/foldeffect.php"; ?>  
	<!-- begin page container 'til the end -->
	<div id="page_container" style="/* border-bottom: 1px solid black; border: 10px solid red;*/">
	
	<div style="height: 700px; width: 700px; float: left;">
		<? showSlideshow(); ?>
	</div>	
    <!--
	<div style="float: left; width: 285px; margin-left: 41px;">	   
	    <h1 style="margin-bottom: 0px;">专题栏目</h1>    
	    <div class="reports_block" style="border: none; border-bottom: 1px solid black; padding: 10px 0 20px 0;">
	        <div class="rep_tag" style="margin: 0 2px 0px 0;">明星访谈</div>
	       	<span style="font-size: 12pt">
	       		这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验
	       	</span>
	    </div>
	    <div class="reports_block" style="border: none; border-bottom: 1px solid black; padding: 10px 0 20px 0;">
	        <div class="rep_tag" style="margin: 0 2px 0px 0;">2015年度报告</div><span style="font-size: 12pt">
	      	 这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验</span>
	    </div>
	    <div class="reports_block" style="border: none; border-bottom: 1px solid black; padding: 10px 0 20px 0;">
	   		<div class="rep_tag" style="margin: 0 2px 0px 0;">专题总结</div><span style="font-size: 12pt">
	        	这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验这里是实验</span>
	    </div>
	</div>
	-->		
	<div style="clear: both;"> </div>
	
	<!-- GET 10 MOVIES HERE! -->
	<div><h1 style="text-align: center; margin-top: 4em;">影视作品</h1></div>
	<div class="container_123" style="width: 740px; margin: 0; float: left; border: none; margin-right: 100px;">
            <div id="ca-container" class="ca-container" style="width: 740px; margin-left: 40px;">
                <div class="ca-wrapper" style="width: 740px;">
	<?    
	//include "config.php"; // Include again since PDO was destroyed from livechat!      
	$query_ALL = "SELECT * FROM releases ORDER BY Datetime DESC LIMIT 10";
if($result_t = $pdo->prepare($query_ALL)){
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
    while ($result_t->fetch()) {
                        
?>
    <div class="ca-item" style="width: 247px;">
        <div class="ca-item-main">
            <div class="ca-banner"><h3><? if($status =='1'){echo '<div style="color:red;">'.'正在热播'.'</div>';} else if($status =='0') echo"即将播出";?></h3></div>
            <div class="ca-icon" style="margin-left: 0px;">
                <a><img src="<?=$poster_link;?>" /></a>                
                <a style="cursor: pointer; float: right; margin-right: 13px; display: inline-block;" class="ca-more">详情</a>
            </div>
        </div>
        <div class="ca-content-wrapper" style="margin-right: 10px;">
            <div class="ca-content" style="margin-right: 10px;">
            <h3><?=$ch_name.' '.$en_name;?></h3>
            <h5><?='年份:'.$year;?></h5> <h5><?='地区:'.$region;?></h5> <h5><?='片长:'.$movie_time.'分钟';?></h5> <h5><?='类别:'.$catalog;?></h5>
            <a href="#" class="ca-close">close</a>
            <div class="ca-content-text" style="height: 190px;">
                <p><?=$intro?></p>
            </div>
            <div style="clear: both;">
	            <ul style="margin: 0;">
	                <li><a href="<?=$online_link;?>">在线观看</a></li>
	                <li><a href="<?=$down_link;?>">下载地址</a></li>
	            </ul>
            </div>
            </div>
        </div>
    </div>
<?php           
    }
} else { die(); }
?>  
                </div>
            </div>
        </div>

            <!-- tags -->
            <div id="tag_cont" style="float: left; margin-top: 55px; border-radius: 8px">  
                <div class="tag">喜剧</div>
                <div class="tag">浪漫</div>   
                <div class="tag">肮脏的</div>      
                <div class="tag">戏剧</div>   
                <div class="tag">黑色幽默</div>
                <div class="tag">愚蠢</div>
                <div class="tag">悬念</div>
                <div class="tag">弄乱</div>
                <div class="tag">现实</div>
                <div class="tag">音乐</div>
                <div class="tag">百老汇</div>
                <div class="tag">20世纪90年代</div>
                <div class="tag">科幻</div>
            </div>

		<div style="clear: both"> </div>
        
        </div><!-- end of page container -->


        <script type="text/javascript" src="/front/CircularContentCarousel/js/jquery.easing.1.3.js"></script>
       
        <!-- the jScrollPane script -->
        <script type="text/javascript" src="/front/CircularContentCarousel/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="/front/CircularContentCarousel/js/jquery.contentcarousel.js"></script>
        <script type="text/javascript">
            $('#ca-container').contentcarousel();
        </script>    
	    
	    
	<!-- **********GET RESULTS OF ALL LAEST NEWS FROM DATABASE**************** -->
               	
	<!-- ********************************************************************* -->
	
	<div id="popular_box_headline1">
		<h1 style="text-align: center; margin-top: 2.5em;">最新讯息</h1>
	</div>
	<div id="column_core">	
		<div id="column_0">
		</div>
		<div id="column_1">
		</div>
		<div id="column_2">		
		</div>
	</div>
	<a href="#0" class="cd-top">Top</a>

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
    		$('<div class="latest_box"><div class="latest_picbox"><div class="Tag_display_latest"><p>'+Tag+'</p></div><a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/></a></div><div class="Headline_display_latest"><h5>'+Headline+'</h5></div><div class="Bot_display_latest" ><div class="Time_display_latest"><p valign="top">'+Datetime+'</p></div><a class="QQ_BOX1" href="http://service.weibo.com/share/share.php?url=http://qafone.sweetgreen.org/Article/article.php?catlogid='+Catalog_Id+'&amp;appkey=&amp;title='+Headline+'&amp;pic='+Link+'&amp;ralateUid=1768888052&amp;language=zh_cn"><img src="uploads/LOGO_32x32.png"></a></div></div>'
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
        			    console.logI(value.Link + value.Tag)
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
        	console.log("Chat Error: " + errorThrown);
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
			
		<?	
		$slideB = "slide0btn";
		for($slidebtn = 0;$slidebtn<3;$slidebtn++) {
			$slideB[5] = $slidebtn;
			?>
			$("<?="#"."$slideB";?>").click(function() {
				document.getElementById("<?="slide".(($slidebtn) % 3)."btn";?>").style.color = "black";
				document.getElementById("<?="slide".(($slidebtn+1)%3)."btn";?>").style.color = "lightgray";
				document.getElementById("<?="slide".(($slidebtn+2)%3)."btn";?>").style.color = "lightgray";
				$(".slide,.Tag_display,.Article_display").fadeOut({ "duration" : 1500 }); 
				$("<?="#slide"."$slidebtn"; ?>,<?="#Tag"."$slidebtn"; ?>,<?="#Art"."$slidebtn"; ?>").fadeIn({ "duration" : 1500 });				
			});		
		<? } ?>
	});
    
    
	$( document ).ready(function() {
		slideshowScroll();		
	});
	
	function slideshowScroll() {
		var cur = 0;
		
		function nextpic() {
			cur = (cur + 1)%3;
			$(".slide,.Tag_display,.Article_display").fadeOut({ "duration" : 1500 });
			$("#Tag"+cur).fadeIn({ "duration" : 1500 });
			$("#slide"+cur).fadeIn({ "duration" : 1500 });
			$("#Art"+cur).fadeIn({ "duration" : 1500 });
			document.getElementById("slide"+cur+"btn").style.color = "black";
			document.getElementById("slide"+((cur + 1)%3)+"btn").style.color = "lightgray";
			document.getElementById("slide"+(cur + 2)%3+"btn").style.color = "lightgray";
			setTimeout(nextpic, 5000);
		}
		
		//$(".slide,.Tag_display,.Article_display").fadeOut({ "duration" : 1500 });
		//$("#Tag"+cur).fadeIn({ "duration" : 1500 });
		//$("#slide0").fadeIn({ "duration" : 1500 });
		//$("#Art"+cur).fadeIn({ "duration" : 1500 });
		document.getElementById("slide"+cur+"btn").style.color = "black";
		document.getElementById("slide"+((cur + 1)%3)+"btn").style.color = "lightgray";
		document.getElementById("slide"+(cur + 2)%3+"btn").style.color = "lightgray"; 
		setTimeout(nextpic, 5000);
	}
	
	function myFunction() {
		//var x = document.getElementById("mySearch").required;
	  	//document.getElementById("demo").innerHTML = x;
	}
	
</script>

</div>
</body>
</html>
