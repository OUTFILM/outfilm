<?php
/*	$db = mysql_connect('localhost','root','56muL8Poli%t') or 
	die("Could not connect: " . mysql_error());
	@mysql_select_db('qafone','$db'); 
 * 
 
	$mysqli = new mysqli("localhost", "qafone", ")K9w46Y3=,3Ii", "qafone", 3306);
	if ($mysqli->connect_errno) {
    	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
//echo $mysqli->host_info . "\n";
*/

// Much safer and faster way to connect to MySQL database is PDO (as of year 2013)
// Also, note that charset=utf8 ONLY works with PHP 5.4 or greater
$dsn = 'mysql:host=localhost;dbname=sweetgre_qafone;charset=utf8';
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn,'sweetgre_qafone','y\](NI1Annh3-52', $opt);
	
?>