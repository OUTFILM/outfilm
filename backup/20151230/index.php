<?
include 'config.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; 
/* *********The slide show design********** */
function showSlideshow() {
	global $pdo;
	//$query = "SELECT * FROM catalog WHERE catalog.Is_Spotlight = 1 ORDER BY Datetime DSC LIMIT 5";	
	$query = "SELECT * FROM catalog ORDER BY Datetime DESC LIMIT 5";
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
            <li><a href="/Article/article.php?catlogid=<?=$cat_id?>"><img src="<?=$Pic_Link?>"/></a><div id="dtag"><?=$Art_Headline?></div></li>
			<?
		 } 

	} else {
		die();
	}
	
}/* The slide show design  ENDS!!!!*/
?>	

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
    <!-- tags -->
    <div id="tag_cont" style="margin-left: auto;margin-right:auto; margin-top: 20px; border-radius: 8px">  
        <?            
        $tags = array("浪漫", "喜剧", "柏林", "2016", "亚洲", "文艺", "戛纳", "欧美", "经典", "亲情", "奥斯卡", "同志权益", "出柜","威尼斯", "2015" );           
        foreach($tags as $tag) { ?><div class="tag" onclick="featureTag('<?=$tag?>')"><?=$tag?></div><? }
        ?>
    </div>
    <!-- The spoltlight session -->
    <div id="showSections"> 
        <div id="spot1" style=" background: url(/front/frame2.jpg)">
            <div id="arrow1"><img src="/front/arrowLeft.png" /></div>    
            <div id="arrow2"><img src="/front/arrowRight.png" /></div>       
            <div id="spotl_container">
                <ul class="demo">
                    <? showSlideshow(); ?>                
                </ul>
            </div> 
                
                 
        </div>
    </div>
     <div style="clear: both;"> </div> 
	<!-- begin page container 'til the end -->
	<div id="page_container">
    <!-- GET 10 MOVIES HERE! -->
    <div id="air_headline"><h1 style="text-align: center; margin-top: 30px;">直播空间</h1></div>
    <div class="container_air">
            <div id="ca-container" class="ca-container">
                <div class="ca-wrapper">
                <?
                //Get 10 results from releases movie.    
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
                // loop and fetch all the results for displaying. 
                while ($result_t->fetch()) {                  
                ?>
                    <div class="ca-item" style="width: 247px;">
                        <div class="ca-item-main">
                            <div class="ca-banner">
                                <h3>
                                <?
                                if (isset($_SESSION["myrank"])){ //detect whether visitor or member 
                                if($_SESSION["myrank"]>=250) {
                                    echo "<div class='change_air'><a>";
                                } 
                                if($status =='1'){echo '<div style="color:red;">'.'正在热播'.'</div>';} else if($status =='0') echo"即将播出"; 
                                                               
                                if($_SESSION["myrank"]>=250) {
                                    echo "</a></div>";
                                }
                                } else {
                                     if($status =='1'){echo '<div style="color:red;">'.'正在热播'.'</div>';} else if($status =='0') echo"即将播出";     
                                }                            
                                ?>
                                </h3>
                            </div>
                            <div class="ca-icon" style="margin-left: 0px;">
                                <a><img src="<?=$poster_link;?>" /></a>                
                                <a style="cursor: pointer; float: right; margin-right: 13px; display: inline-block;" class="ca-more">详情</a>
                            </div>
                        </div>
                        <div class="ca-content-wrapper" style="margin-right: 10px;">
                            <div class="ca-content" style="margin-right: 10px;">
                                <h3><?=$ch_name.' '.$en_name;?></h3><h5><?='年份:'.$year;?></h5> <h5><?='地区:'.$region;?></h5> <h5><?='片长:'.$movie_time.'分钟';?></h5> <h5><?='类别:'.$catalog;?></h5>
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

        <script type="text/javascript" src="/front/CircularContentCarousel/js/jquery.easing.1.3.js"></script>
       
        <!-- the jScrollPane script -->
        <script type="text/javascript" src="/front/CircularContentCarousel/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="/front/CircularContentCarousel/js/jquery.contentcarousel.js"></script>
        <script type="text/javascript">
            $('#ca-container').contentcarousel();
        </script>	    
       
    <div style="clear: both"> </div>    
    <!-- **********GET RESULTS OF ALL LAEST NEWS FROM DATABASE**************** -->  
    <div id="popular_box_headline1">
        <h1 style="text-align: center; margin-top: 0.5em;">最新讯息</h1>
    </div>  
    <div style="clear: both"> </div>
<!-- end of page container -->
	
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


</div>
<script>
var increment = 1;
var page = 1;
var is_click = 0 ;
var num_count = 0;

function featureTag(tag) {
	// Fade out slideshow and filmography sections only
	$("#showSections,#air_headline,.container_air,#popular_box_headline1").transition({ 
		opacity: 0.0, 
		y: '-1000px',
		easing: 'out',
		duration: 1500,
		complete: function () { 
			this.css({ display: 'none' }); 
			// Reset columns
			$("#column_0").html("");
			$("#column_1").html("");
			$("#column_2").html("");
			$(".button-fill").hide();
			Load_more(tag);
		}
	});
}	

function Disply_Latest(Link, Tag, Headline, Content, Datetime, Catalog_Id, column, delayTime) {		
	column = column % 3;
	$("#column_"+column).append(
		$('<div class="latest_box"><div class="latest_picbox"><div class="Tag_display_latest"><p>'+Tag+'</p></div><a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/></a></div><div class="Headline_display_latest"><h5>'+Headline+'</h5></div><div class="Bot_display_latest" ><div class="Time_display_latest"><p valign="top">'+Datetime+'</p></div><a class="QQ_BOX1" href="http://service.weibo.com/share/share.php?url=http://qafone.sweetgreen.org/Article/article.php?catlogid='+Catalog_Id+'&amp;appkey=&amp;title='+Headline+'&amp;pic='+Link+'&amp;ralateUid=1768888052&amp;language=zh_cn"><img src="uploads/LOGO_32x32.png"></a></div></div>'
	).css('opacity', 0)
	.delay(delayTime*increment)
	.animate(
		{ 'margin-top': '20px', 'opacity': 1 }, 
		{ duration: 'slow'}
		)
	);
	column++;
	increment++;
	return(column);
}

function Load_more(tag) {
    var chooseop = <?=$_SESSION['choose_op']?>;
	$.ajax({
    	url: "Looptest.php",
    	dateType: "json",
    	method: "get",
    	data: { 'page': page , 'choose_op' : chooseop },
    	cache : false,
     	success: function(result) {
     		var column = 0;
        	var output = jQuery.parseJSON(result);
	
        	$.each(output, function(key,value) {
        		if (!(value.Count == undefined)) {
        			num_count = value.Count;
        		} else {
        			if (value.Title != "null") {
        				if (tag != "") {
        					if (tag == value.Tag) {
        						column=Disply_Latest(value.Link, value.Tag, value.Headline, value.Content, value.Datetime, value.Catalog_Id, column, 0);
        					}
        				} else {
        					column=Disply_Latest(value.Link, value.Tag, value.Headline, value.Content, value.Datetime, value.Catalog_Id, column, 300);
          				}
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
        	console.log("Load_more Error: " + errorThrown);
       }
    });    
}

$(document).ready(function(){
	//Load_more(is_click);
	Load_more("");
    
    $(".button-fill").click(function(){
    	increment = 1;
    	is_click = 1;
    	$(this).hide();  //hide click button
    	$(".modal").show();
    	
		var end = $(".button-fill").offset().top; var viewEnd = $(window).scrollTop() + $(window).height(); 
		var distance = end - viewEnd; 
		if (distance < 300) {
			page = page + 1;
			Load_more ("");
		}
    })

});

 $(".button-fill").hover(function () {
    $(this).children(".button-inside").addClass('full');
}, function() {
  $(this).children(".button-inside").removeClass('full');
});
</script>
    <!-- this file will effect the load_more function !!! -->
    <!--<script type="text/javascript" src="/scripts/rounfaboutjs/jquery.js"></script>-->
    <script type="text/javascript" src="/scripts/rounfaboutjs/jquery.roundabout2.js"></script>
<script type="text/javascript">  
    
	$( document ).ready(function() {
	   $('.demo').roundabout();
	});	
</script>
    <!-- new spot light roundabout
    <script src="scripts/rounfaboutjs/jquery.js"></script>
    <script src="scripts/rounfaboutjs/jquery.roundabout2.js"></script>
    <script>
    $(document).ready(function(){
        $('.demo').roundabout();
    });
    </script>
    <!-- spotlight end-->
</div>
</body>
</html>
