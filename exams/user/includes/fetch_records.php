<?php
include '../../db.php';

$active_examinations = 0;
$passed_exam = 0;
$failed_exam = 0;
$attended_exams = 0;
$locked_exams = 0;
$myid=$_SESSION['id_user'];

$sql = "SELECT * FROM examinations WHERE status = 'Active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $active_examinations++;
    }
} else {

}

$sql = "SELECT * FROM assessment_records WHERE id_user = '$myid' AND status = 'PASS'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $passed_exam++;
    }
} else {

}

$sql = "SELECT * FROM assessment_records WHERE id_user = '$myid' AND status = 'FAIL'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $failed_exam++;
    }
} else {

}


$sql = "SELECT * FROM assessment_records WHERE id_user = '$myid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $attended_exams++;
    }
} else {

}


$sql = "SELECT * FROM examinations WHERE category = '$mycategory' AND status = 'Inactive'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $locked_exams++;
    }
} else {

}

$conn->close();