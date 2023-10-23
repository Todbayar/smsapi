<?php
if(isset($_POST["email"]) && isset($_POST["pass"])){
	echo $_POST["email"].", ".$_POST["pass"];
}
?>