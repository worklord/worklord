<?php
include '../../../db.php';
$tskid = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "UPDATE tasks SET status='Inactive' WHERE task_id='$tskid'";

if ($conn->query($sql) === TRUE) {
    header("location:../Tasks.php?rp=7823");
} else {
    header("location:../Tasks.php?rp=1298");
}

$conn->close();
?>
