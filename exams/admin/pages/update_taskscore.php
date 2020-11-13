<?php
session_start();
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../../db.php';
include '../../includes/uniques.php';
$task_id=$_POST['tid'];
$tscore=$_POST['tscore'];
$assess_id=$_POST['aid'];

$sql="UPDATE task_assessment_records SET score='$tscore',status=1 WHERE task_id='$task_id' && record_id='$assess_id'";

if ($conn->query($sql)=== TRUE) {
header("location:../view-tasks.php?tid=$task_id");
} else {
header("location:../reviewtask.php");
}

$conn->close();
?>
