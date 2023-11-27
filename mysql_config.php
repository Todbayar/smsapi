<?php
date_default_timezone_set("Asia/Ulaanbaatar");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zarchimn_smsapi";

if($_SERVER['HTTP_HOST']!="localhost"){
	$username = "zarchimn_99213557";
	$password = "m?OzHo6&&~w$";
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("<MySQL Connection>:".$conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>