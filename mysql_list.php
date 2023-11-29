<?php
include "mysql_config.php";
include_once "functions.php";
include_once "variables.php";
include_once "constants.php";

if(isset($_COOKIE["userID"])){
	$query = "SELECT *, a.id AS aid FROM action AS a LEFT JOIN apikey AS k ON a.token=k.token WHERE k.userID=".$_COOKIE["userID"]." ORDER BY aid ASC LIMIT 30";
	$result = $conn->query($query);
	$objArr = array();
	while($row = mysqli_fetch_object($result)){
		$objArr[] = $row;
	}
	echo json_encode($objArr);
}
?>