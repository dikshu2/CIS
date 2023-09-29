<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','tms');

$dbh=mysqli_connect("localhost","root","","tms");
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
try
{
$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>