<?php
	session_start();
if ($_POST["label"]) {
    $label = $_POST["label"];
}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 500000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {
        $filename = $label.$_FILES["file"]["name"];
        //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        //echo "Type: " . $_FILES["file"]["type"] . "<br>";
        //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
        
        //if the account's folder not exsist, then creat as uploads/$id/
        if (is_dir("uploads/".$_SESSION["User_Id"])) {       
            //console.log("uploads/".$_SESSION["User_Id"]."exsists!");
        } else {
            mkdir('uploads/'.$_SESSION["User_Id"], 0777, true);
            //console.log("uploads/".$_SESSION["User_Id"]."made a new one!"); 
        }
        // if picture is not exsit, upload it.
        if(file_exists("uploads/".$_SESSION["User_Id"]."/".$filename)) {
            echo "uploads/" .$_SESSION["User_Id"]."/".$filename;
            //console.log("uploads/".$_SESSION["User_Id"]."pic exsists!");                
        } else {
            //file_put_contents('uploads/'.$_SESSION["User_Id"].'/'.uniqid().'.png', $_FILES["file"]["tmp_name"]);
            $teid=uniqid();
            move_uploaded_file($_FILES["file"]["tmp_name"],
            'uploads/'.$_SESSION["User_Id"].'/'.$teid.'.png');
            echo "uploads/" .$_SESSION["User_Id"]."/". $teid . '.png';
            //console.log("uploads/".$_SESSION["User_Id"]."we uploaded it!");
        }
    }
} else {
    echo "Invalid file";
}
  
?>

