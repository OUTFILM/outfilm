<?
include $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; 

?>  
 
    <!--top-->
     <link rel="stylesheet" href="/user/top/style.css"> <!-- Gem style -->
    <script src="/user/top/modernizr.js"></script> <!-- Modernizr -->
    <script src="/user/top/main.js"></script> <!-- Gem jQuery -->
    <link rel="stylesheet" href="/queer.css" />
</head>
<body>
<div id="site_container">
    <? //include $_SERVER['DOCUMENT_ROOT']."/includes/top.php"; ?>
    <? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>   
    <!-- begin page container 'til the end -->
    
         
    <!-- **********GET RESULTS OF ALL LAEST NEWS FROM DATABASE**************** -->   
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
 

    	function Disply_Latest(Link, Tag, Headline, Content, Datetime, Catalog_Id, Clicks , Commts, column, delayTime) {	
			column = column % 3;
			var myDate = new Date(Datetime);
			//Datetime = formatDate(myDate);
			Datetime = myDate.toLocaleTimeString("en-us", {year: "numeric", month: "short",
    day: "numeric", hour: "2-digit", minute: "2-digit"})
			//Datetime = formatDate(Datetime);
			//Datetime = CONVERT(VARCHAR(10),Datetime,110);
			$("#column_"+column).append(
				$('<div class="FlexArticle_NewsContainer"><div class="FlexArticle_NewsContainer_Picture">' +
				  '<a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/>' +
				  '</a></div><div class="FlexArticle_NewsContainer_Headline">' +
				  '<h3>'+Headline+'</h3></div>' +
				  '<div class="FlexArticle_NewsContainer_TimeStamp"><h5>'+Datetime+'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp views&nbsp&nbsp<em>'+Clicks+'</em>&nbsp&nbsp comments&nbsp&nbsp<em>'+ Commts +'</em></h5></div></div>'
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
    var chooseop = <?=$_SESSION['choose_op']?>;
    $.ajax({
        url: "/Looptest.php",
        dateType: "json",
        method: "get",
        data: { 'page': page, 'choose_op' : chooseop},
        cache : false,
        success: function(result) {
            var column = 0;
            var output = jQuery.parseJSON(result);
            $.each(output, function(key,value) {
                if (!(value.Count == undefined)) {
                    num_count = value.Count;
                } else {
                    if (value.Title != "null") {
                        //If it has tag
                        console.log('1'+value.Headline);
                            column = Disply_Latest(value.Link, value.Tag, value.Headline, 
										value.Content, value.Datetime, value.Catalog_Id , value.Clicks , value.Commts , column, 300); 
                        
                    }
                } 
            });
            console.log("ends");
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
    console.log("2");
    Load_more();
    $(".button-fill").click(function(){
        increment = 1;
        is_click = 1;
        $(this).hide();  //hide click button
        $(".modal").show();
        
        var end = $(".button-fill").offset().top; var viewEnd = $(window).scrollTop() + $(window).height(); 
        var distance = end - viewEnd; 
        if (distance < 300) {
            page = page + 1;
            console.log("3");
            Load_more();
        }
    })

});

 $(".button-fill").hover(function () {
    $(this).children(".button-inside").addClass('full');
}, function() {
  $(this).children(".button-inside").removeClass('full');
});
</script>

</div>
</body>
</html>
