<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ways";

define('HOST','localhost');
define('USERNAME', 'root');
define('PASSWORD','');
define('DB','ways');

$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
mysqli_set_charset($con,"utf8");
mysqli_query($con,"SET NAMES 'utf8'");
mysqli_query($con,'SET CHARACTER SET utf8');


$link = @mysqli_connect("localhost", "root", "");
mysqli_select_db($link,"ways");
mysqli_query($link,"SET NAMES 'utf8'");
mysqli_query($link,'SET CHARACTER SET utf8');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ways');
$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE)or die("Îáá Ýí ÇáÅÊÕÇá");
mysqli_set_charset($connection,"utf8");


error_reporting(0);
$db ="ways";
$user ="root";
$pw ="";
$conn= mysqli_connect("localhost", $user, $pw);
@mysqli_select_db($conn,$db) or die("Îáá Ýí ÇáÅÊÕÇá");
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET CHARACTER SET utf8');
mysqli_set_charset($conn,'utf8');
date_default_timezone_set('Egypt/cairo');

$daaat = date('d/m/Y');



?>
