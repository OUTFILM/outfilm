<?php 
session_start();
include $_SERVER["DOCUMENT_ROOT"]."/config.php";

// Redirect to link (referal) if id is entered
if (isset($_GET["id"])) { // Update db with "visit"
    $movie_id = $_GET["id"]; // Should be a number only
    
    $stmt = $pdo->prepare("SELECT idmovie,movielink FROM movie WHERE idmovie=:id ");
    $stmt->bindParam(":id", $movie_id);
    $stmt->execute();
    $stmt->bindColumn("movielink", $movielink);
    $stmt->fetch();
    
    if ($movielink != "") { // Link must exist in order to count as a "view"
        $stmt = $pdo->prepare("UPDATE movie SET view = view + 1 WHERE idmovie=:id ");
        $stmt->bindParam(":id", $movie_id); // Update this value for the world to see that you made a new message
        $stmt->execute();
        
        // Redirect to link
        header("Location: " . trim($movielink));
    }
}
include $_SERVER['DOCUMENT_ROOT']."/includes/foldeffect1.php";?> 
<!DOCTYPE html>
<html lang="en">
    <head>
    <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <link href="/Front.css" rel="stylesheet" type="text/css" /> 
    <link href="/main.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="/front/foldeffect/js/jquery.hoverfold.js"></script>

</head>
    <body>
    <? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>
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
       <!--
        <script type="text/javascript"> 
            
            Modernizr.load({
                test: Modernizr.csstransforms3d && Modernizr.csstransitions,
                yep : ['http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js','/front/foldeffect/js/jquery.hoverfold.js'],
                nope: '/front/foldeffect/css/fallback.css',
                callback : function( url, result, key ) {
                        
                    if( url === '/front/foldeffect/js/jquery.hoverfold.js' ) {
                        $( '#mcolumn_0' ).hoverfold();
                        $( '#mcolumn_1' ).hoverfold();
                        $( '#mcolumn_2' ).hoverfold();
                        $( '#mcolumn_3' ).hoverfold();
                    }

                }
            });
      </script>-->
<script>
var increment = 1;
var page = 1;
var is_click = 0 ;
var num_count = 0;


function Disply_Latest(Link, Tag, Headline, Content, Datetime, Catalog_Id, column, delayTime) {     
    column = column % 3;
    $("#column_"+column).append(
        $('<div class="latest_box"><div class="latest_picbox"><div class="Tag_display_latest"><p>'+Tag+'</p></div><a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/></a></div><div class="Headline_display_latest"><h5>'+Headline+'</h5></div><div class="Bot_display_latest" ><div class="Time_display_latest"><p valign="top">'+Datetime+'</p></div><a class="QQ_BOX1" href="http://service.weibo.com/share/share.php?url=http://qafone.sweetgreen.org/Article/article.php?catlogid='+Catalog_Id+'&amp;appkey=&amp;title='+Headline+'&amp;pic='+Link+'&amp;ralateUid=1768888052&amp;language=zh_cn"><img src="/uploads/LOGO_32x32.png"></a></div></div>'
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

function Load_more() {
    var chooseop = <?=$_SESSION['choose_op']?>;
    console.log('1'+chooseop);
    $.ajax({
        url: "/Looptest.php",
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
                            column=Disply_Latest(value.Link, value.Tag, value.Headline, value.Content, value.Datetime, value.Catalog_Id, column, 300);
                            console.log('is:'+value.Headline); 
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
    </body>
</html>