<link href="/front/menu.css" rel="stylesheet" type="text/css" />
<!--<div id="menu">-->
	<?
	    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
        $query_port1 = "SELECT `Portrait_Id` FROM `users` WHERE `User_Id` = :id";
        $result_p1 = $pdo->prepare($query_port1);
        $result_p1->bindParam(':id',$_SESSION["User_Id"]); 
        //$result_t->bindColumn('Tag', $Art_Content);
        $result_p1->execute();
        $pnum1 = $result_p1->fetchColumn();        
	?>
	<div id="topbanner">
	<!--<div id="menu_container">-->
	<div class="menuu">    
	<div style="background:rgba(224, 247, 250, 0.3);">
		
	<div style="margin-left: auto; margin-right: auto; width: 1130px;">
	
	<ul style="list-style-type: none;">
	<!--<div id="logoqaf"></div>-->
	<li style="margin-left: 0;"><a id="kuindex" class="active-me" href="/">首页</a></li> 	 
	<li><a id="freports" href="/report/reports.php">专题报道</a></li>
  	<li><a id="nmovie" href="/newmovie/nmovie.php">新片推荐</a></li>
  	<li><a id="kumovie" href="/movie/movie.php">酷儿影库</a></li>
  	<li><a id="mnews" href="/mnews/news.php">影视资讯</a></li>
  	<li><a id="contact" href="/contact/contact.php">联系我们</a></li>
  	<? if(isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?>
    <li><a id="web_update" href="/update/update.php">更新日志</a></li> <?} else{}?>
    </ul>  
		<!--
	<div id="menu_popup_button"><img src="/img/icon/menu.png" title="Menu" alt="Menu" /></div>
	<div class="menu_sub"><h1><a href="/" style="color: white;">首页</a></h1></div>
	<div class="menu_sub" style="color: white;"><h1>专题报道</h1></div>
	<div class="menu_sub" style="color: white;"><h1>影片推荐</h1></div>
	<div class="menu_sub" style="color: white;"><h1>一般新闻</h1></div>
	<div class="menu_sub" style="color: white;"><h1>联系我们</h1></div>

	<div id="search_bar" class="input-control search" data-role="input" style="margin-top: -4em">		
		<input style="width: 180px;" type="search" id="mySearch" name="filter" autocomplete="on" placeholder="搜索">
		<button title="搜索" class="button" style="" name="page_search" id="page_search"><span class="mif-mars"></span></button>
	</div>
	
</div>-->

		<div id="panel" style="height: 55px;">
			<?php
			if(isset($_SESSION["Is_Login"])) {
			?>

            <div class="signin_container">
                <div class="panel_icon"><i class="fa fa-sign-out" style="color: black;"></i></div>
                <div class="panel_key"><a style="text-decoration: none;" href="/user/Logout.php"><span>&nbsp;&nbsp;退出</span></a></div>
            </div>
			<div class="signin_container">
				<div class="panel_icon"><i class="fa fa-envelope-o" style="color: black;"></i></div>
				<div class="panel_key"><a style="text-decoration: none;" href="/notification/notification.php"><span>&nbsp;&nbsp;消息</span>
		            <? 
		            include $_SERVER["DOCUMENT_ROOT"]."/notification/getnotification.php";
		            $numNotifications = getNumNotifications();
		            if ($numNotifications > 0) {
		                    ?><span style="font-color: #03ccAA;">(<span style="font-weight: bold;"><?=$numNotifications?></span>)</span><?
		                }
		            ?>
		            </a></div>
			</div>
            <div class="signin_container">
                <div id="portrait_panel"><img src="/uimg/<?=$_SESSION["User_Id"]?>/<?=$pnum1.'_c'?>.png" align="middle" style="border-radius:22px;width:22px; height:22px"></div>
                <div class="panel_key"><a style="text-decoration: none;"  href="/manage.php"><span><?php echo $_SESSION["User_Name"];?></span></a></div>
            </div>	
			<?php
			} else {
			?>
			<div class="signin_container">
				<div class="panel_icon"><i class="fa fa-user fa-1.5x" style="color: black;"></i></div>
				<div class="panel_key"><a  style="text-decoration: none;" href="/user/login.php">&nbsp;&nbsp;登录/注册</a></div>
			</div>
			<?php	
			}
			?>
		</div>		

</div>	
	
	</div>
    </div>
</div>
    <script>
    
        $( document ).ready(function() {
            <?
              if ($_SERVER['PHP_SELF'] == '/index.php') {
                $_SESSION['choose_op'] = 1;
                ?>           
                $("#kumovie").removeClass("active-me");
                $("#kuindex").addClass("active-me");
                $("#contact").removeClass("active-me");
                $("#freports").removeClass("active-me");
                $("#nmovie").removeClass("active-me");
                $("#mnews").removeClass("active-me");
                $("#web_update").removeClass("active-me");       
                <?
              } else if ($_SERVER['PHP_SELF'] == '/movie/movie.php') {
                ?>  
                $("#kumovie").addClass("active-me");
                $("#kuindex").removeClass("active-me");
                $("#contact").removeClass("active-me");
                $("#freports").removeClass("active-me");
                $("#nmovie").removeClass("active-me");
                $("#mnews").removeClass("active-me");
                $("#web_update").removeClass("active-me");        
                <?
              } else if ($_SERVER['PHP_SELF'] == '/newmovie/nmovie.php') {
                $_SESSION['choose_op'] =  3;
                ?>
                $("#kumovie").removeClass("active-me");
                $("#kuindex").removeClass("active-me");
                $("#contact").removeClass("active-me");
                $("#freports").removeClass("active-me");
                $("#nmovie").addClass("active-me");
                $("#mnews").removeClass("active-me");
                $("#web_update").removeClass("active-me");       
                <?
              } else if ($_SERVER['PHP_SELF'] == '/mnews/news.php') {
                $_SESSION['choose_op'] =  4;
                ?>
                $("#kumovie").removeClass("active-me");
                $("#kuindex").removeClass("active-me");
                $("#contact").removeClass("active-me");
                $("#freports").removeClass("active-me");
                $("#nmovie").removeClass("active-me");
                $("#mnews").addClass("active-me");
                $("#web_update").removeClass("active-me");    
                <?                
              } else if ($_SERVER['PHP_SELF'] == '/report/reports.php') {
                $_SESSION['choose_op'] =  2;
                ?>
                $("#kumovie").removeClass("active-me");
                $("#kuindex").removeClass("active-me");
                $("#contact").removeClass("active-me");
                $("#freports").addClass("active-me");
                $("#nmovie").removeClass("active-me");
                $("#mnews").removeClass("active-me"); 
                $("#web_update").removeClass("active-me");   
                <?
              } else if ($_SERVER['PHP_SELF'] == '/contact/contact.php') {
                ?>
                $("#contact").addClass("active-me");
                $("#kuindex").removeClass("active-me"); 
                $("#kumovie").removeClass("active-me");
                $("#reports").removeClass("active-me");
                $("#nmovie").removeClass("active-me");
                $("#mnews").removeClass("active-me");
                $("#web_update").removeClass("active-me");    
                <?
              }
                else if ($_SERVER['PHP_SELF'] == '/update/update.php') {
                $_SESSION['choose_op'] = 9;
                ?>
                 
                $("#web_update").addClass("active-me");
                $("#kuindex").removeClass("active-me"); 
                $("#kumovie").removeClass("active-me");
                $("#reports").removeClass("active-me");
                $("#nmovie").removeClass("active-me");
                $("#mnews").removeClass("active-me");
                $("#contact").removeClass("active-me");      
                <?
              }  
            ?>
        });
    </script>
<!--</div>-->