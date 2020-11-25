<?php
error_reporting(0);

session_start();
$_SESSION['record_id'] = $record;
include '../../../db.php';
$task_id=$_POST['tid'];
$link=$_POST['link'];
$today_date = date("Y-m-d");
$myid=$_SESSION['id_user'];
$sql="INSERT INTO task_assessment_records (id_user, task_id, link, date) VALUES ('$myid', '$task_id', '$link', '$today_date')";
if ($conn->query($sql) === TRUE) {

	
   header("location:../tasks.php");
} else {
   header("location:../");
}

$conn->close();
?>
