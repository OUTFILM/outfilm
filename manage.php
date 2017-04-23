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
    <link href="/Management/airpost/airpost.css" rel="stylesheet" type="text/css" /> 
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<meta charset="UTF-8">
	<link href="main.css" rel="stylesheet" type="text/css" />	
	<link href="Management.css" rel="stylesheet" type="text/css" />	
	<script type="text/javascript" src="scripts/jquery-1.11.2.min.js"></script>
	 <!-- CDN hosted by Cachefly -->

    <!-- end of editor -->
</head>
<body>

     <? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>
		<div id="menu_portrait">   <!-- portrait -->
			<img src="/uimg/<?=$_SESSION["User_Id"];?>/<?="$pnum".'_c'; ?>.png" style="margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;"/>

		</div>
		<div id="M_leftbar">
			<div id="left_menu_bar">
				<div id="menu_namebox">
					<p style="text-align: center; color: white; font-size: 18px;"><?php echo $_SESSION["User_Name"];?></p>
				</div>
				<!--<div id="status"><div class="online_b"></div>在线</div>-->
				<div class="left-top"></div> <!-- fill up space-->
				<div class="left_header">设置</div><!-- header setting-->
				<div class="left_menu_part">
				    <? if($_SESSION["myrank"]>=250) { ?>
						<div id="gcode" class="left_menu_item" style="text-align: center">
						   <div class="left_menu_sb"><a href="#gcode.php">发邀请码</a></div>
                        </div>	
					<? } if ($_SESSION["myrank"]>=150){?>
					    <div class="left_menu_item" id="art_edit" style="text-align: center" >
                        <div class="left_menu_sb" id="a321"><a href="#">文章编辑</a></div>
                        </div>      
                        <ul class="left_mainer hidden" id="submenu1">
                            <li class="left_maineritem" id="writearticle"><a  href="#writearticle.php">文章投稿</a></li>
                            <li class="left_maineritem" ><a  href="#">投稿历史</a></li>
                            <li class="left_maineritem" id="kumovies"><a  href="#kumovies">酷儿影库</a></li>
                            <li class="left_maineritem" id="cover"><a  href="#cover">修改封面</a></li>
                        </ul>
                        <div class="left_menu_item" id="art_edit" style="text-align: center" >
                        <div class="left_menu_sb" id="a31"><a href="#">首页编辑</a></div>
                        </div> 
                        <ul class="left_mainer hidden" id="submenu2">
                            <li class="left_maineritem" id="air"><a  href="#air.php">直播添加</a></li>
                            <li class="left_maineritem" id="spot"><a  href="#spot.php">滚动栏添加</a></li>
                        </ul>
						<div class="left_menu_item" id="art_edit" style="text-align: center" >
                        <div class="left_menu_sb" id="a3"><a href="#">通知编辑</a></div>
                        </div> 
                        <ul class="left_mainer hidden" id="submenu3">
                            <li class="left_maineritem" id="insertsys"><a  href="#insert.php">通知添加</a></li>
                            <li class="left_maineritem" id="adjustsyst"><a  href="#adjust.php">通知调整</a></li>
                        </ul>                       
                            
                        
                    <? } ?>
                        <div class="left_menu_item" style="text-align: center">
                            <div class="left_menu_sb" id="users"><a  href="#cards.php">用户说明</a></div>
                        </div>
                        <div class="left_menu_item" style="text-align: center">
                            <div class="left_menu_sb" id="pict"><a  href="#pict.php">更换头像</a></div>
                        </div>
				</div>
			</div>
		</div>
		<!-- Right Control Window-->
		<script>
		$(document).ready( function() {
  			$("#writearticle").on("click", function() {
        	$("#M_rightbar_bot_main").load("writearticle.php");
    		});
    		$("#users").on("click", function() {
            $("#M_rightbar_bot_main").load("/cards.html");
            });
            $("#kumovies").on("click", function() {
            $("#M_rightbar_bot_main").load("/Management/movie/addmovie.php");
            });
            $("#gcode").on("click", function() {
            $("#M_rightbar_bot_main").load("/Management/register/register.code.php");
            });
            $("#pict").on("click", function() {
            $("#M_rightbar_bot_main").load("/user/portrait/uploadpic.php");
            });
            $("#air").on("click", function() {
            $("#M_rightbar_bot_main").load("Management/airpost/airpost.php");
            });
            $("#spot").on("click", function() {
            $("#M_rightbar_bot_main").load("Management/spotadmin/spotchange.php");
            });
           	$("#cover").on("click", function() {
            $("#M_rightbar_bot_main").load("Management/changecover/changecover.php");
            });
            $("#insertsys").on("click", function() {
            $("#M_rightbar_bot_main").load("Management/system/manage_sysmsg.php");
            });
            $("#adjustsyst").on("click", function() {
            $("#M_rightbar_bot_main").load("#");
            });
		});
</script>
			<!--<div id="M_rightbar_head">导航界面</div>-->
			<div id="M_rightbar_bot">
			    <div id="M_rightbar_bot_main"></div>                
			</div>
	<?include $_SERVER['DOCUMENT_ROOT']."/includes/footer.php"; ?>
	
<script type="text/javascript">
   // var toogle = 0;	
	$("#a321").click(function() {
		$("#submenu1").slideToggle("slow");
		      $("#submenu1").removeClass("hidden");
	});
	$("#a31").click(function() {

        $("#submenu2").slideToggle("slow");
              $("#submenu2").removeClass("hidden");
             
    });
	$("#a3").click(function() {
        $("#submenu3").slideToggle("slow");
              $("#submenu3").removeClass("hidden");
             
    });		
</script>

</body>
</html>