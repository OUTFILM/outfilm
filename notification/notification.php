<? 
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    $query_port = "SELECT `Portrait_Id` FROM `users` WHERE `User_Id` = :id";
    $result_p = $pdo->prepare($query_port);
    $result_p->bindParam(':id',$_SESSION["User_Id"]); 
    //$result_t->bindColumn('Tag', $Art_Content);
    $result_p->execute();
    $pnum = $result_p->fetchColumn(); 
?>
<html>
<head>
    <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <link href="/main.css" rel="stylesheet" type="text/css" />   
    <link href="/Management.css" rel="stylesheet" type="text/css" /> 
    <link href="/notification/notification.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>

</head>
<body>

     <? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>
        <div id="menu_portrait">   <!-- portrait -->
            <img src="/uimg/<?=$_SESSION["User_Id"];?>/<?="$pnum"; ?>.png" style="margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;"/>

        </div>
        <div id="M_leftbar">
            <div id="left_menu_bar">
                <div id="menu_namebox">
                    <p style="text-align: center; color: white; font-size: 18px;"><?php echo $_SESSION["User_Name"];?></p>
                </div>
                <div class="left-top"></div> <!-- fill up space-->
                <div class="left_header">消息中心</div><!-- header setting-->
                <div class="left_menu_part">
                        <div id="gcode" class="left_menu_item" style="text-align: center">
                           <div class="left_menu_sb"><a href="#showmail" id="allmail">@我的人</a></div>
                        </div>
                        <!--  
                        <div class="left_menu_item" style="text-align: center">
                            <div class="left_menu_sb" id="users"><a  href="#">系统消息</a></div>
                        </div>
                        
                        <div class="left_menu_item" style="text-align: center">
                            <div class="left_menu_sb" id="pict"><a  href="#">好友消息</a></div>
                        </div>
                        -->
                </div>
            </div>
        </div>
        <!-- Right Control Window-->
        <script>
        $(document).ready( function() {
            $("#allmail").on("click", function() {
            	$("#M_rightbar_bot_main").load("/notification/showmail.php");
            });
        });
</script>
            <!--<div id="M_rightbar_head">导航界面</div>-->
            <div id="M_rightbar_bot">
                <div id="M_rightbar_bot_main"></div>                
            </div>
    <?include include $_SERVER['DOCUMENT_ROOT']."/includes/footer.php"; ?>
</body>
</html>