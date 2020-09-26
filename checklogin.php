<?php

session_start();

require_once("db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

	//Escape Special Characters in String
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	//sql query to check user login
	$sql2 = "SELECT loginid,email,password FROM login WHERE email='$email' AND password='$password'";
	
	$user = "SELECT id_user, firstname, lastname, email FROM users WHERE email='$email'";
	$company = "SELECT id_company, companyname, email, active FROM company WHERE email='$email'";

	$role = "SELECT role FROM login WHERE email='$email' AND password='$password'";
	
    $result = $conn->query($role);
    $value = $result->fetch_assoc();
	
    if($value["role"] == "user")
	{
	$result = "";
	if($conn->query($sql2)->num_rows > 0) {
		$result = $conn->query($user);
	}
	//if user table has this this login details
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//Set some session variables for easy reference
			$_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
			$_SESSION['id_user'] = $row['id_user'];
				header("Location: user/index.php");
				exit();
		}
 	}
	}
	else if($value["role"] == "company")
	{
		$result = "";
		if($conn->query($sql2)->num_rows > 0)  {
			$result = $conn->query($company);
		}
		//if company table has this this login details
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['active'] == '2') {
					$_SESSION['loginActiveError'] = "Your Account Is Still Pending Approval By Admin.";
					header("Location: login.php");
					exit();
				} else if($row['active'] == '0') {
					$_SESSION['loginActiveError'] = "Your Account Is Rejected. Please Contact Admin For More Info.";
					header("Location: login.php");
					exit();
				} else if($row['active'] == '1') {
					$_SESSION['name'] = $row['companyname'];
					$_SESSION['id_company'] = $row['id_company'];

					header("Location: company/index.php");
					exit();
				} else if($row['active'] == '3') {
					$_SESSION['loginActiveError'] = "Your Account Is Deactivated. Contact Admin For Reactivation.";
					header("Location: login.php");
					exit();
				}
			}
		}
	}
	else if($value["role"] == "admin")
	{
	$result = "";
	if($conn->query($sql2)->num_rows > 0)  {
		$result = $conn->query($sql2);
	}
	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {
			$_SESSION['loginid'] = $row['loginid'];
			header("Location: admin/index.php");
			exit();
		}
 	}
	}
	else {
	$_SESSION['loginError'] = true;
	header("Location: login.php");
	exit();
}

 	$conn->close();

}