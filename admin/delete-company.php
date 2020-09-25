<?php

session_start();

if(empty($_SESSION['loginid'])) {
	header("Location: index.php");
	exit();
}


require_once("../db.php");

if(isset($_GET)) {

	//Deactivate Company using id and redirect
	$sql = "UPDATE company SET active='3' WHERE id_company='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: companies.php");
		exit();
	} else {
		echo "Error";
	}
}