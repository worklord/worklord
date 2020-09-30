<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//if user Actually clicked Add Post Button
if(isset($_POST)) {

	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary = mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);

	//Insert Job Post Query 
	$sql = "INSERT INTO job_post(id_company, jobtitle, description, minimumsalary, maximumsalary, experience, qualification) VALUES ('$_SESSION[id_company]','$jobtitle', '$description', '$minimumsalary', '$maximumsalary', '$experience', '$qualification')";

	if($conn->query($sql)===TRUE) {
	//If data Inserted successfully then redirect to dashboard
		$_SESSION['jobPostSuccess'] = true;
		header("Location: create-job-post.php");
	 	exit();
	 } else {
	    $_SESSION['jobPostFailed'] = true;
		header("Location: create-job-post.php");
	 }

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click Add Post button
	header("Location: create-job-post.php");
	exit();
}