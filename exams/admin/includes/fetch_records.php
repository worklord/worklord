<?php
include '../../db.php';

$users = 0;
$examination = 0;
$notice = 0;
$questions = 0;
$users_fails = 0;
$users_pass = 0;

$sql = "SELECT * FROM users WHERE role = 'user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $users++;
    }
} else {

}


$sql = "SELECT * FROM examinations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $examination++;
    }
} else {

}

$sql = "SELECT * FROM notice";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $notice++;
    }
} else {

}

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $questions++;
    }
} else {

}

$sql = "SELECT * FROM assessment_records";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $status = $row['status'];
	 if ($status == "PASS"){
		 $users_pass++;
	 }else{
		$users_fails++; 
		 
	 }
	 
    }
} else {

}



$conn->close();
?>