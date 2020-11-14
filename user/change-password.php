<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

	//Escape Special Characters in String
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));
	$sql2 = "select email from users where id_user=$_SESSION[id_user]";
	$result = $conn->query($sql2);
	if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) 
	{
     $email=$row['email'];
	}
	}
	//sql query to check user login
	$sql = "UPDATE login SET password='$password' WHERE email='$email'";
	if($conn->query($sql) === true) {
		header("Location: index.php");
		exit();
	} else {
		echo $conn->error;
	}

 	//Close database connection. Not compulsory but good practice.
 	$conn->close();

} else {
	//redirect them back to login page if they didn't click login button
	header("Location: settings.php");
	exit();
}