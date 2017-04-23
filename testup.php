<?php
session_start();
include 'config.php';



// Requires user id
if (isset($_SESSION["User_Id"])) {


// requires php5
define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/uploads/');

$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
    //if the account's folder not exsist, then creat as uploads/$id/
if (is_dir("uploads/".$_SESSION["User_Id"])) {       
    //console.log("uploads/".$_SESSION["User_Id"]."exsists!");
} else {
    mkdir('uploads/'.$_SESSION["User_Id"], 0777, true);
    //console.log("uploads/".$_SESSION["User_Id"]."made a new one!"); 
}
$ttempis = uniqid();
$file = UPLOAD_DIR .$_SESSION["User_Id"].'/'. $ttempis . '.png';

$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.' . $_POST["img"];



$query_ALL3 = "UPDATE users SET Portrait_Id = :Portrait_Id WHERE User_Id = :uid";
$result_t = $pdo->prepare($query_ALL3);
    $result_t->bindParam(':Portrait_Id', $ttempis);
    $result_t->bindParam(':uid', $_SESSION["User_Id"]);
    $result_t->execute();} 
else {
	die("Not logged in."); 
}  
?>