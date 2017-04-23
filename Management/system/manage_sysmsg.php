<?
/* Feature； Editing contents from the Notification 
 * Dcsc: Only allowed by admin
 * Designer: Daniel Li
 * Programming: Daniele Li
 * Date: /06/02/2016
 *
 */
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
session_start(); 

if(isset($_SESSION["User_Id"]) && $_SESSION["myrank"]>=150) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>编辑公告栏</title>
    <link href="/main.css" rel="stylesheet" type="text/css" />
    <link href="/Management/spotadmin/spotchange.css" rel="stylesheet" type="text/css" />   
    <link href="/Management.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
    <script  src="/includes/js/jquery-ui.js"></script>
</head>
<body>
	
<div id="form_container">
<form class="form-style-7">
<ul>
<li>
    <label for="click_url">点击链接</label>
    <input id="click_url" type="url" name="click_url" maxlength="150">
    <span>请填写链接http://，没有写#</span>
</li>
<li>
    <label for="notification">通知内容</label>
    <input id="notification" type="text" name="notification" maxlength="60">
    <span>字符不要超过50个</span>
</li>

<li>
    <input type="button" id="submit_con" value="提交">
</li>
</ul>
</form>
</div>

                       
<script>

/* store the content in database */
$('#submit_con').click(function(){
    var click_url = document.getElementById('click_url').value;
    var notification = document.getElementById('notification').value;
    var author =  "<?=$_SESSION["User_Name"];?>";
    console.log('the head and tag: '+ notification + author);
    
    if(notification == '') {/* || ch_name == '' || s_year =='' || s_time =='' || region ==''*/
        alert("notification can not be empty!");
    } else {
        //console.log("Run ajax");
    $.ajax({
        url: "/Management/system/addsysmsg.php",
        method: "post",
        data: {       	
            'click_url': click_url , 
            'notification' : notification , 
            'author' : author
            },
        cache: false,
        success: function(result) {
            //console.log('123 Posted successfully!');
            alert("Sys msg Posted successfully!");
                
            },            
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }  
        
        });
    }
});
</script>         
</body>
</html>
<? } else die("illeagal pass");?>