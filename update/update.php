<?
include $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; 

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
     <link rel="stylesheet" href="/user/top/style.css"> <!-- Gem style -->
    <script src="/user/top/modernizr.js"></script> <!-- Modernizr -->
    <script src="/user/top/main.js"></script> <!-- Gem jQuery -->
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
 

function Disply_Latest(Link, Tag, Headline, Content, Datetime, Catalog_Id, column, delayTime) { 
    //console.log(column+':'+Catalog_Id);   
    column = column % 3;
    
    $("#column_"+column).append(
        $('<div class="latest_box"><div class="latest_picbox">' +
          '<a href="/Article/article.php?catlogid='+Catalog_Id+'"><img src="'+Link+'" align="middle"/>' +
          '</a></div><div class="Headline_display_latest"><div class="Tag_display_latest"><p>' + Tag + '</p></div>' +
          '<h5>'+Headline+'</h5></div><div class="Bot_display_latest" >' +
          '<div class="Time_display_latest"><p valign="top">'+Datetime+'</p></div></div></div>'
    ).css('opacity', 0)
    .delay(delayTime*increment)
    .animate(
        { 'margin-top': '20px', 'opacity': 1 }, 
        { duration: 'slow'}
        )
    );
    column++;
    //console.log('after'+column);
    increment++;
    return(column);
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
                        console.log('1'+value.Tag);
                            column=Disply_Latest(value.Link, value.Tag, value.Headline, value.Content, value.Datetime, value.Catalog_Id, column, 0);
                        
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
