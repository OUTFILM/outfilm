<?php
// Logged in session is required before including this file.
if (!isset($_SESSION["User_Id"])) die("Not logged in.");

// Return number of notifications associated with this user
function getNumNotifications() {
    //include $_SERVER["DOCUMENT_ROOT"]."/config.php"; // DB PDO config only
    global $pdo;
    
    $user_id = $_SESSION["User_Id"];
    
    $sql = "SELECT COUNT(*) FROM mail WHERE to_user_id = :user_id AND status='unread' ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $num = $stmt->fetchColumn();
    //$pdo = null;
    return $num;
}




?>