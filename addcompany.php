<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php
require_once("db.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$website = mysqli_real_escape_string($conn, $_POST['website']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$country = mysqli_real_escape_string($conn, $_POST['country']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);

	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);

	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	//sql query to check if email already exists or not
	$sql = "SELECT email FROM company WHERE email='$email'";
	$result = $conn->query($sql);

	//if email not found then we can insert new data
	if($result->num_rows == 0) {

		//This variable is used to catch errors doing upload process. False means there is some error and we need to notify that user.
		$uploadOk = true;

		//Folder where we save logos
		$folder_dir = "uploads/logo/";

		//Getting Basename of file.
		$base = basename($_FILES['image']['name']); 

		//This will get us extension of file. So myimage.pdf will return pdf. If it was image.doc then this will return doc.
		$imageFileType = pathinfo($base, PATHINFO_EXTENSION); 

		//Setting a random non repeatable file name. Uniqid will create a unique name based on current timestamp.
		$file = uniqid() . "." . $imageFileType; 
	  
		//This is where files will be saved so in this case it will be uploads/image/newfilename
		$filename = $folder_dir .$file;  

		//We check if file is saved to our temp location or not.
		if(file_exists($_FILES['image']['tmp_name'])) { 

			

				//Next need to check file size with our limit size. 
				if($_FILES['image']['size'] < 500000) { // File size is less than 5MB

					//If all above condition are met then copy file from server temp location to uploads folder.
					move_uploaded_file($_FILES["image"]["tmp_name"], $filename);

				} else {
					//Size Error
					$_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
					$uploadOk = false;
				}
			
		} else {
				//File not copied to temp location error.
				$_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
				$uploadOk = false;
			}

		//If there is any error then redirect back.
		if($uploadOk == false) {
			header("Location: register-company.php");
			exit();
		}

		//sql new registration insert query
		$sql = "INSERT INTO company(name, companyname, country, state, city, contactno, website, email, aboutme, logo) VALUES ('$name', '$companyname', '$country', '$state', '$city', '$contactno', '$website', '$email', '$aboutme', '$file')";
		$sql2 = "INSERT INTO login(email,password,role) VALUES ('$email','$password','company')";

		if(($conn->query($sql))&&($conn->query($sql2))===TRUE) {

			//If data inserted successfully then Set some session variables for easy reference and redirect to company login
			$_SESSION['uploadSuccess'] = "Registered Successfully";
			header("Location: login.php");
			exit();

		} else {
			//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//if email found in database then show email already exists error.
		$_SESSION['uploadError'] = "Already registered.";
		header("Location: register-company.php");
		exit();
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to register page if they didn't click register button
	header("Location: register-company.php");
	exit();
}