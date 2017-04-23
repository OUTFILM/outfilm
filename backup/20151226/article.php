<? include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; 
@session_start();
include $_SERVER["DOCUMENT_ROOT"]."/config.php";?>
<link href="/Article/article.css" rel="stylesheet" type="text/css" />
<link href="/Article/css-social-buttons/social-buttons.css" rel="stylesheet" type="text/css" /> 
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<!-- comments -->
<link href="/livechat/comments.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" type="text/css" /> 
<!--<link rel="stylesheet" href="/scripts/jqwidgets/styles/jqx.base.css" type="text/css" />
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
<script type="text/javascript" src="/scripts/jqwidgets/jqxcheckbox.js"></script>-->

<? 
// only show if admin? 
if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
?>
<script>
/*$("#editPageBtn").kendoButton({
})*/

$(document).ready(function() {
    
    // Panel only
    $("#adminpanel").kendoPanelBar();    
    
    $("#Leftbody_Article").kendoEditor({
        tools: [
            "bold",
            "italic",
            "underline",
            "strikethrough",
            "justifyLeft",
            "justifyCenter",
            "justifyRight",
            "justifyFull",
            "createLink",
            "unlink",
            "insertImage",
            "createTable",
            "addColumnLeft",
            "addColumnRight",
            "addRowAbove",
            "addRowBelow",
            "deleteRow",
            "deleteColumn",
            "foreColor",
            "backColor"
        ]
    });
    
    // Tag editor
    $("#Leftbody_Headline_t").kendoEditor({
        tools: []
    });
    
    // headline editor
    $("#article_headline").kendoEditor({
        tools: []
    });

    // subheadline editor
    $("#article_subheadline").kendoEditor({
        tools: []
    });
    
    $("#photoEditBox").hide();
    $("#editPhoto").click(function() {
            
        // Turn photo area into photo upload and edit function
        $("#photoEditBox").toggle();
        $("#Leftbody_Poster").toggle();
        
       // update src of photo if changed...
    });
    
    $("#saveArticle").click(function() {
        var catid =  <?=$_GET["catlogid"]?>;
        var article = $("#Leftbody_Article").html();
        var headline = $("#article_headline").text();
        var subheadline = $("#article_subheadline").text();
        var link = $("#article_picture").attr('src');
        var tag = $("#Leftbody_Headline_t").text();        
        var is_spotlight = $("#spotlight_switch").is(':checked');        
        if (is_spotlight) {
            is_spotlight = "1";
        } else {
            is_spotlight = "0";
        }
        
        // Save article to database
        $.ajax({
            url: "/Article/savearticle.php",
            method: "post",
            data: { 
                'aid': catid,
                'article' : article,
                'tag' : tag,
                'headline' : headline,
                'subheadline' : subheadline,
                'link' : link,
                'is_spotlight' : is_spotlight
                },
            cache : false,
            success: function(result) {
                //console.log("R:" + result);
                //$('#Leftbody_Article').append(result);
                console.log("Article saved to server.");

            },            
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }   

            });
    });

    
});

</script>

<style>
.k-editor-inline p {
    font-size: 13px;
}
.k-editor-inline {
    margin: 0;
    padding: 21px 21px 11px;
    border-width: 0;
    box-shadow: none;
    background: none;
}

.k-editor-inline.k-state-active {
    border-width: 1px;
    padding: 20px 20px 10px;
    background: none;
}
.k-editor-inline, .k-state-active, .k-state-active:hover {
    color: #000;
}
</style>
<!-- end of editor -->
   
<? } ?>
    
</head>
<body>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>
    <!--
        Whole Article Page design
        By Daniel Lee 6/8/2015
     -->
     <?
       //database update
       //07/03/2015
       //by daniel lee
       $cat_key = $_GET["catlogid"];
       $query = "SELECT * FROM catalog WHERE catalog.Catalog_Id = :catkey";    
       if($result_c = $pdo->prepare($query)) {
           //$result_t->bindParam(':cat_key',$_GET["catlogid"]);
           $result_c->bindParam(":catkey", $cat_key);
           $result_c->execute();
           $result_c->bindColumn('Link', $Pic_Link);
           $result_c->bindColumn('order_Spotlight', $Catalog_Order);
           $result_c->bindColumn('Tag', $Art_Tag);
           $result_c->bindColumn('Headline', $Art_Headline);
           $result_c->bindColumn('Content', $Art_Content);
           $result_c->bindColumn('Datetime', $Art_Datetime);
           $result_c->bindColumn('Author', $Art_Author);
           $result_c->bindColumn('Catalog_Id', $cat_id);
           $result_c->bindColumn('Subheadline', $Subheadline);
           $result_c->bindColumn('Is_Spotlight', $is_spotlight);
                    
           while ($result_c->fetch()) {
            
     ?>
    <div id="ArticleBody">
<? if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?> 
        <ul id="adminpanel">
            <li class="k-state-inactive">
                <span class="k-link k-state-selected">文章管理</span>
                <div style="padding: 10px;">
                    
                   聚光灯 Spotlight <input type="checkbox" style="width: 15px; height: 15px; vertical-align: middle;" id="spotlight_switch" <? if($is_spotlight == 1) echo 'checked="checked"'; ?> />
                
                    <p>临提示: 点击以下项目初始化弹出编辑器工具栏</p>     
                </div>
               
            </li>
            
        </ul>
        
<? } ?>
        
        <div id="Article_Leftbody">
            <div class="Leftbody_Headline ">
                <div id="Leftbody_Headline_t" style="text-align: center; font-weight: bold;">
                    <?=$Art_Tag?>
                </div>
                <div class="Leftbody_Headline_l"></div>
                <div id="Leftbody_Headline_c" style="text-align: center">
                    <p id="article_headline"><?=$Art_Headline?></p>
                </div>  
            </div>
                
            <? if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?> 
                <div>
                    <div>
                    <button id="editPhoto" type="button" style="float: right; border-radius: 4px; clear: both; margin-top: 1em;">
                        <span class="k-icon"></span> 编辑图片
                    </button>
                    </div>
            <link rel="stylesheet" href="/Article/uploadphoto.css" type="text/css" />
            <script type="text/javascript" src="/user/portrait/cropbox.js"></script>

            <div class="container" id="photoEditBox">
              <div class="imageBox">
                <div class="thumbBox"></div>
                <div class="spinner" style="display: none">Loading...</div>
              </div>
              <div class="action"> 
                <!-- <input type="file" id="file" style=" width: 200px">-->
                  <form method="post" id="fileinfo2" name="fileinfo2" onsubmit="return submitport2();">
                  <input type="file" name="file" id="file" value="123"/>
                  <input type="submit" value="上传文件"/> 
                  </form>
                <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
                <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
                <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >

              </div>
          <div class="cropped"></div>

            </div>
            <script type="text/javascript">
            console.log('1');
            var dataURL;
            var temppath;
            function submitport2() {
                console.log("submit event");
                var imgTitle = $("#article_headline").text(); 
                $.ajax({
                    url: "/articlecover_up.php",
                    type: "POST",
                    data: {
                        'img': dataURL,
                        'title' : imgTitle,
                        'cid' : '<?=$_GET["catlogid"]?>'
                    },
                    success: function(result) {
                        console.log("QQ");
                    }
                }).done(function( data ) {
                    console.log("PHP Output:");
                    console.log( data );
                    temppath = data;
                    console.log('upload pp successfully!');
                    //alert('上传成功！快去首页看看哪~');
                });
                return false;
            }


            $(document).ready(function() {
                var options =
                {
                    thumbBox: '.thumbBox',
                    spinner: '.spinner',
                    imgSrc: '<?=$Pic_Link?>'
                }
                var cropper = $('.imageBox').cropbox(options);
                $('#file').on('change', function(){
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        options.imgSrc = e.target.result;
                        cropper = $('.imageBox').cropbox(options);
                    }

                    reader.readAsDataURL(this.files[0]);
                    //var source = reader.result;
                    this.files = [];
                })
                $('#btnCrop').on('click', function(){
                    var img = cropper.getDataURL();  
                    dataURL = cropper.getDataURL(); 
                    $('.cropped').html('');
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
                    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
                })
                $('#btnZoomIn').on('click', function(){
                    cropper.zoomIn();
                })
                $('#btnZoomOut').on('click', function(){
                    cropper.zoomOut();
                })
            });

            </script></div>
            <? } ?>
            <div id="Leftbody_Poster">    
                <img id="article_picture" src="<?=$Pic_Link?>" />
            </div>
            <div id="Leftbody_SubHeadline">
                <div id="Leftbody_SubHeadline_up" style="text-align: center">
                    <p id="article_subheadline"><?=$Subheadline?></p>
                </div>
                <div id="Leftbody_SubHeadline_down" style="text-align: center">
                    <p>发布于<?=$Art_Datetime?></p>
                </div>
                <div id="Leftbody_SubHeadline_MED">
                    <div id="Leftbody_SubHeadline_iconcontainer">
                    <div class="Leftbody_SubHeadline_icn"><a href="#" class="sb gray flat small twitter">Twitter</a></div>
                    <div class="Leftbody_SubHeadline_icn"><a href="#" class="sb blue flat small facebook">facebook</a></div>
                    <div class="Leftbody_SubHeadline_icn"><a href="#" class="sb red flat small heart">facebook</a></div>
                    <div class="Leftbody_SubHeadline_icn"><a href="#" class="sb pink flat small rss">facebook</a></div>
                    <div class="Leftbody_SubHeadline_icn"><a href="#" class="sb purple flat small linkedin">facebook</a></div>
                    </div>
                </div>
            </div>

            <? if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?> 
                <div>
                <button id="saveArticle" type="button" style="float: right; border-radius: 4px; clear: both; margin-top: 1em;">
                    <span class="k-icon"></span> 保存
                </button>
                <!--<button id="editPageBtn">Edit Page</button><button id="viewPageBtn">View Page</button>-->
                </div>
            <? } ?>
            <div id="Leftbody_Article">

            </div>
            
<script>
/* store the content in database */
$( document ).ready(function(){
var catid =  <?php echo json_encode($cat_key); ?>;
//console.log(catid);
$.ajax({
    url: "/Article/getarticle.php",
    method: "get",
    data: { 'aid': catid },
    cache : false,
    success: function(result) {
        //console.log("R:" + result);
        $('#Leftbody_Article').append(result);
                
    },            
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }   
    
    });
});
    /*-------------------------------*/
</script>
            <div id="Leftbody_CommentWindow">
                <div>                   
                    <? include $_SERVER["DOCUMENT_ROOT"]."/livechat/comments.php"; ?>
                </div>
            </div>
             <!-- Editor 
             <div id="Leftbody_Editor">
                    <!-- 
                    <textarea id="elm1" name="area"></textarea>
                    <!-- 
             </div>
             -->
        </div>
        <?

        $query_ALL1 = "SELECT * FROM catalog ORDER BY Clicks DESC LIMIT 4";
        $result_t = $pdo->prepare($query_ALL1);
        //$result_t->bindParam(':page_key',$page_key); 
        $result_t->execute();
        $result_t->bindColumn('Link', $Pic_Link);
        $result_t->bindColumn('Tag', $Art_Tag);
        $result_t->bindColumn('Headline', $Art_Headline);
        $result_t->bindColumn('Catalog_Id', $Catalog_Id);
        $result = array();?>
        <div id="Article_Rightbody">
            <!-- Display Top news in mini size on right side-->
            <!--<div class="Rightbody_GapBox"></div>-->
            <div id="Rightbody_Top">
                <div id="Topmini_body">
                    <div id="Topmini_headline">
                        <h3 style="text-align: center;">QAF站 TOP推荐</h3>
                    </div>
                    <?
                    while ($result_t->fetch()) {?>
                        <div class="Topmini_box">
                        <div class="Topmini_box_pic"><a href="/Article/article.php?catlogid=<?="$Catalog_Id"?>"><img src="<?="$Pic_Link";?>"/></a></div>
                        <div class="Topmini_box_tag"><?="$Art_Tag"; ?></div>
                        <div class="Topmini_box_headline"><?="$Art_Headline"; ?></div>
                        </div><?    
                
                    }       
                    ?>
                    <!--

                    <div class="Topmini_box"></div>
                    -->
                </div>
            </div>
            <!-- weibo window on air-->
            <!--<div class="Rightbody_GapBox"></div>-->
            <?php           
                }
            } else {  die();}
            ?> 
            <div id="Rightbody_Weibo">
                <iframe width="100%" height="1000" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=1768888052&verifier=78e29345&dpc=1"></iframe>
            </div>
            
            <!--<div class="Rightbody_GapBox"></div>-->
            <div class="Rightbody_AD">
                <wb:bulkfollow uids="1768888052" type="1" width="250" count="1" color="C2D9F2,FFFFFF,0082CB,666666" ></wb:bulkfollow>
            </div>
            <!--<div class="Rightbody_GapBox"></div>-->
            
        </div>
    </div>
    </body>
    </html>