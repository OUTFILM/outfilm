<?php  
    require "../config.php";
    include "User_Function.php";
    // session_start(); // Not needed -- it is already placed in the above script. Will produce warnings in error log if used twice. 

if (!function_exists('hash_equals')) {

    /**
     * Timing attack safe string comparison
     * 
     * Compares two strings using the same time whether they're equal or not.
     * This function should be used to mitigate timing attacks; for instance, when testing crypt() password hashes.
     * 
     * @param string $known_string The string of known length to compare against
     * @param string $user_string The user-supplied string
     * @return boolean Returns TRUE when the two strings are equal, FALSE otherwise.
     */
    function hash_equals($known_string, $user_string)
    {
        if (func_num_args() !== 2) {
            // handle wrong parameter count as the native implentation
            trigger_error('hash_equals() expects exactly 2 parameters, ' . func_num_args() . ' given', E_USER_WARNING);
            return null;
        }
        if (is_string($known_string) !== true) {
            trigger_error('hash_equals(): Expected known_string to be a string, ' . gettype($known_string) . ' given', E_USER_WARNING);
            return false;
        }
        $known_string_len = strlen($known_string);
        $user_string_type_error = 'hash_equals(): Expected user_string to be a string, ' . gettype($user_string) . ' given'; // prepare wrong type error message now to reduce the impact of string concatenation and the gettype call
        if (is_string($user_string) !== true) {
            trigger_error($user_string_type_error, E_USER_WARNING);
            // prevention of timing attacks might be still possible if we handle $user_string as a string of diffent length (the trigger_error() call increases the execution time a bit)
            $user_string_len = strlen($user_string);
            $user_string_len = $known_string_len + 1;
        } else {
            $user_string_len = $known_string_len + 1;
            $user_string_len = strlen($user_string);
        }
        if ($known_string_len !== $user_string_len) {
            $res = $known_string ^ $known_string; // use $known_string instead of $user_string to handle strings of diffrent length.
            $ret = 1; // set $ret to 1 to make sure false is returned
        } else {
            $res = $known_string ^ $user_string;
            $ret = 0;
        }
        for ($i = strlen($res) - 1; $i >= 0; $i--) {
            $ret |= ord($res[$i]);
        }
        return $ret === 0;
    }

}
        
$username = $_POST['username'];
$supposed_password = $_POST['password'];

$query_ALL = "SELECT * FROM users WHERE User_Name = :username";
$result_t = $pdo->prepare($query_ALL);
$result_t->bindParam(':username', $username);
$result_t->execute();
$result_t->bindColumn('Verified',$activated);
$result_t->bindColumn('User_Password',$check_pw);
$result_t->bindColumn('User_Name',$user_name);
$result_t->bindColumn('User_Id',$user_id);
$result_t->bindColumn('Class_Rank',$myrank);
if($result_t->rowCount()>0) {
    $result_t->fetch();
     // Check with password hash; never store raw passwords in database - Added 15-1108 Doug
    if ($user_name == $username && hash_equals($check_pw, crypt($supposed_password, $check_pw)) && $activated) {
        Create_Session($user_name, $user_id, $myrank);
        echo "200";
    }
    else if ($user_name == $username && hash_equals($check_pw, crypt($supposed_password, $check_pw)) && ($activated == 0)) echo "400";
    else echo "300";
} else {
    echo "100";
}

?>