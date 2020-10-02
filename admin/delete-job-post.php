<?php

session_start();

//If user Not logged in then redirect them back to homepage. 
if((!empty($_SESSION['id_company'])) || (!empty($_SESSION['id_user']))) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

if(isset($_GET)) {
	$sql = "UPDATE job_post SET active=0 where id_jobpost='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: active-jobs.php");
		exit();
	} else {
		echo "<script> alert('Error') </script>";
	}
}