	<?
	    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
        $query_port1 = "SELECT `Portrait_Id` FROM `users` WHERE `User_Id` = :id";
        $result_p1 = $pdo->prepare($query_port1);
        $result_p1->bindParam(':id',$_SESSION["User_Id"]); 
        //$result_t->bindColumn('Tag', $Art_Content);
        $result_p1->execute();
        $pnum1 = $result_p1->fetchColumn();        
	?>
	<!--<div id="logoqaf"></div>-->
	<a class="FirstItem" id="kuindex" href="/">首页</a>
	<a class="ListItem" id="freports" href="/report/reports.php">专题报道</a>
    <a class="ListItem" id="nmovie" href="/newmovie/nmovie.php">新片推荐</a>
  	<a class="ListItem" id="kumovie" href="/movie/movie.php">酷儿影库</a>
  	<a class="ListItem" id="mnews" href="/mnews/news.php">影视资讯</a>
  	<a class="ListItem" id="contact" href="/contact/contact.php">联系我们</a>
  	<? if(isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) { ?>
    <a class="ListItem" id="web_update" href="/update/update.php">更新日志</a> <?} else{}?>  
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
		
		<div id="panel" class="LastItem">
			<?php
			if(isset($_SESSION["Is_Login"])) {
			?>

            <div class="LastItem">
                <i class="fa fa-sign-out" style="color: black;"></i>
                <a style="text-decoration: none;" href="/user/Logout.php">&nbsp;&nbsp;退出</a>
            </div>
			<div class="LastItem">
				<i class="fa fa-envelope-o" style="color: black;"></i>
				<a style="text-decoration: none;" href="/notification/notification.php">&nbsp;&nbsp;消息
		            <? 
		            include $_SERVER["DOCUMENT_ROOT"]."/notification/getnotification.php";
		            $numNotifications = getNumNotifications();
		            if ($numNotifications > 0) {
		                    ?><span style="font-color: #03ccAA;">(<span style="font-weight: bold;"><?=$numNotifications?></span>)<?
		                }
		            ?>
		            </a>
			</div>
            <div class="LastItem">
                <img src="/uimg/<?=$_SESSION["User_Id"]?>/<?=$pnum1.'_c'?>.png" align="middle" style="border-radius:22px;width:22px; height:22px">
                <a style="text-decoration: none;"  href="/manage.php"><?php echo $_SESSION["User_Name"];?></a>
            </div>	
			<?php
			} else {
			?>
			<div class="LastItem">
				<i class="fa fa-user fa-1.5x" style="color: black;"></i>
				<a  style="text-decoration: none;" href="/user/login.php">&nbsp;&nbsp;登录/注册</a>
			</div>
			<?php	
			}
			?>
		</div>		