
<? 
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    session_start();
    // requires php5
    //define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/uploads/');
    define('UPLOAD_DIR', '/uploads/');
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
    if ($success) {
        echo $file;
    } else {
        echo "error";
    }
    
    
?>