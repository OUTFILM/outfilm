<?php
require "config.php";
session_start();
if (isset($_SESSION["myrank"]) and $_SESSION["myrank"] >= 150) {
    
    

    $tep = '/';
    $content_main = $_POST['content_main'];
	$Tag = $_POST['tag'];
    $headline = $_POST['headline'];
	//$link = $tep.trim($_SESSION['tem_path_cc'], " ");
	$link = $tep.$_POST['picsrc'];
    $mlink = $_POST['mlink'];
    $cata = $_POST['cata'];
    $init = 0;
        
    $query_ALL = "INSERT INTO catalog (Content,Tag,Headline,Datetime,Link,catalog_op,catalogmov,Is_Spotlight) VALUES (:content_main,:Tag,:Headline,:Now,:Link,:cata,:catalogmov,:init)";
    $result_t = $pdo->prepare($query_ALL);
        $result_t->bindParam(':content_main', $content_main);
        $result_t->bindParam(':Headline', $headline);
        $result_t->bindParam(':Tag', $Tag);
        $result_t->bindParam(':Now', date("Y-m-d H:i:s"));
        $result_t->bindParam(':Link', $link);
        $result_t->bindParam(':cata', $cata);
        $result_t->bindParam(':catalogmov', $mlink[8]);
        $result_t->bindParam(':init', $init);
        $result_t->execute();
        $_SESSION['tem_path'] = '';
        $_SESSION['tem_path_cc'] = '';   
    foreach( $mlink as $key => $value )
    {
        if( empty( $value ) )
        {
           unset( $mlink[$key] );
        }
    }
	if(!empty( $mlink )) {
	    /*
	    $link_c = "<table cellspacing='0'>
                   <tr bgcolor='#0055AA'><td><strong><font color='#FFFFFF'>".$mlink[8]."</font></strong></td></tr>
                    <tr bgcolor='#FFFFFF'><td><strong><font color='#FF0000'>文件扩展名 .qafone 修改为 .mkv 即可自动关联</font></strong></td></tr>
                    <tr bgcolor='#E0E0E0'><td style='padding:0px'><br>
                <table cellspacing='0' style='width:90%;'><tbody><tr bgcolor='#FFFFFF'><td style='padding: 10px 30px'>
                    <strong>国内网盘下载：<div class='showhide'><h4>本帖隐藏的内容需要回复才可以浏览</h4>
                        <a href='".$mlink[0]."' target='_blank'><u>CTDisk网盘</u></a> | <a href='".$mlink[1]."' target='_blank'><u>QQ旋风</u></a> | <a href='".$mlink[2]."' 
                        target='_blank'><u>迅雷快传</u></a> | <a href='".$mlink[3]."' target='_blank'><u>百度网盘</u></a>【密码: ".$mlink[6]."】 | <a href='".$mlink[4]."' target='_blank'>
                        <u>360云盘</u></a>【访问密码 ".$mlink[7]."】<br>
                <br>-<br>
                <font color='Teal'>以下电驴地址永久有效，可直接复制到迅雷进行离线下载，或者使用电驴软件下载：
                    <br><br>
                <code>
                    ".$mlink[5]."
                </code>
                </font></div><br>
                </strong></td></tr></tbody></table><br>
                </td></tr></table>";
        $content_main = $content_main.$link_c;*/

     /* oricle
    $query_ins = "WITH ins (down_link, name) AS
                    ( VALUES
                    ( 'more testing',   '伦敦谍影') ,
                    )  
                    INSERT INTO releases
                    (description, catalog_id) 
                    SELECT 
                        ins.down_link, catalog.Catalog_Id
                    FROM 
                    catalog JOIN ins
                        ON ins.name = catalog.catalogmov ;
                 ";*/
    /* releases
    $query_ins = "SELECT catalog.Catalog_Id FROM catalog JOIN releases ON releases.ch_name = catalog.catalogmov AND catalog.catalogmov = $mlink[8]";
    $result_t1 = $pdo->prepare($query_ins);
    //$result_t->bindParam(':m_name', $mlink[8]);
    $result_t1->bindColumn('catalog.Catalog_Id', $cata_id);
    $result_t1->execute();
    */
    if (isset($mlink[8])) {
        $query_ins = "SELECT `Catalog_Id` FROM catalog WHERE catalogmov = :m_name";
        $result_t1 = $pdo->prepare($query_ins);
        $mli = $mlink[8];
        //$result_t1->bindParam(':m_name', $mli);
        $result_t1->bindParam(':m_name', $mli, PDO::PARAM_STR);
        $result_t1->execute();
        $cata_id = $result_t1->fetchColumn(); 
        $cata = intval($cata_id) ;
        //echo $cata_id;
    } else {
        die("No mlink8.");
    }
    
    if (isset($cata)) {
    /*1.ct 2.qq 3.xunlei 4.baidu 5.360 6.emute 7.baidupw 8.360pw 9.name*/
    $query_ALL1 = "INSERT INTO download_link(catalog_id,link1,link2,link3,link4,link5,link6,pw1,pw2,move_name,acfun,bili) 
                                    VALUES (:catalog_id,:link1,:link2,:link3,:link4,:link5,:link6,:pw1,:pw2,:mname,:ac,:bi)";
    $result_t2 = $pdo->prepare($query_ALL1);
        $result_t2->bindParam(':catalog_id', $cata);
        $slink0 = $mlink[0];
        $slink1 = $mlink[1];
        $slink2 = $mlink[2];
        $slink3 = $mlink[3];
        $slink4 = $mlink[4];
        $slink5 = $mlink[5];
        $slink6 = $mlink[6];
        $slink7 = $mlink[7];
        $slink9 = $mlink[9];
        $slink10 = $mlink[10];
        $result_t2->bindParam(':link1', $slink0);
        $result_t2->bindParam(':link2', $slink1);
        $result_t2->bindParam(':link3', $slink2);   
        $result_t2->bindParam(':link4', $slink3);
        $result_t2->bindParam(':link5', $slink4);
        $result_t2->bindParam(':link6', $slink5);
        $result_t2->bindParam(':pw1', $slink6);
        $result_t2->bindParam(':pw2', $slink7);
        $result_t2->bindParam(':mname', $mli);
        $result_t2->bindParam(':ac', $slink9);
        $result_t2->bindParam(':bi', $slink10);
        $result_t2->execute();
    } else {
        die("No cata id");
    }    
    
    } else { die();}
    

}
    
?>