<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8" />
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Coustard:900' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <div class="container">
            <div id="ca-container" class="ca-container">
                <div class="ca-wrapper">
<? 
include $_SERVER['DOCUMENT_ROOT']."/includes/header.php";

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
    while ($result_t->fetch()) {
                        
?>
                    <div class="ca-item">
                        <div class="ca-item-main">
                            <div class="ca-banner"><h3><? if($status =='1'){echo '<div style="color:red;">'.'正在热播'.'</div>';} else if($status =='0') echo"即将播出";?></h3></div>
                            <div class="ca-icon">
                                <img src="<?=$poster_link;?>" no-repeat center; />
                                <a style="cursor: pointer;" class="ca-more">更多</a>
                            </div>
                        </div>
                        <div class="ca-content-wrapper">
                            <div class="ca-content">
                            <h3><?=$ch_name.' '.$en_name;?></h3>
                            <h5><?='年份:'.$year;?></h5> <h5><?='地区:'.$region;?></h5> <h5><?='片长:'.$movie_time;?></h5> <h5><?='类别:'.$catalog;?></h5>
                            <a href="#" class="ca-close">close</a>
                            <div class="ca-content-text">
                                <p><?=$intro?></p>
                            </div>
                            <ul>
                                <li><a href="<?=$online_link;?>">在线观看</a></li>
                                <li><a href="<?=$down_link;?>">下载地址</a></li>
                            </ul>
                            </div>
                        </div>
                    </div>
<?php           
    }
} else { die();}
          

?>	

				</div>
			</div>
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>
	
    </body>
</html>