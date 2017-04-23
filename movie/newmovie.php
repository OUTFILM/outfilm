   <? 
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    include $_SERVER['DOCUMENT_ROOT']."/includes/foldeffect1.php"; ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
    <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <link href="/main.css" rel="stylesheet" type="text/css" />
    <link href="/movie/mov.css" rel="stylesheet" type="text/css" />   
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="/front/foldeffect/js/jquery.hoverfold.js"></script>

</head>
    <body>
    <? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>
    <!--
        <div class="container">
            <div id="grid" class="main">
                <div class="view">
                    <div class="view-back">
                        <span data-icon="A">566</span>
                        <span data-icon="B">124</span>
                        <a href="#">&rarr;</a>
                    </div>
                    <img src="http://static.wixstatic.com/media/bb4b88_84489eb0250147d196a6619e08669ff3.jpg/v1/fill/w_316,h_216,al_c,q_75,usm_0.50_1.20_0.00/bb4b88_84489eb0250147d196a6619e08669ff3.jpg" />
                </div>
            </div>
        </div>-->
            <!-- ********************************************************************* -->
    <div id="column_core">
        <div class="main">  
        <div id="mcolumn_0">
        </div>
        <div id="mcolumn_1">
        </div>
        <div id="mcolumn_2">     
        </div>
        <div id="mcolumn_3">     
        </div>
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

$(document).ready(function(){
    Load_more(is_click);

    function Disply_Latest(movielink, moviepic, view, column) {        
        column = column % 4;
        $("#mcolumn_"+column).append(
            $('<div class="view"><div class="view-back"><span data-icon="A">'+ view +'</span><a href="'+ movielink +'">&rarr;</a></div><img src="'+ moviepic +'"/></div> '
        ).css('opacity', 0)
        .delay(300*increment)
        .animate(
            { 'margin-top': '20px', 'opacity': 1 }, 
            { duration: 'slow'}
            )
        );
        column++;
        increment++;
                                $( '#mcolumn_0' ).hoverfold();
                        $( '#mcolumn_1' ).hoverfold();
                        $( '#mcolumn_2' ).hoverfold();
                        $( '#mcolumn_3' ).hoverfold();
        return(column);
    }
    
    function Load_more() {
        $.ajax({
        url: "alphamloop.php.php",
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
                        column=Disply_Latest(value.movielink, value.moviepic, value.view, column);
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
        </script>
    </body>
</html>