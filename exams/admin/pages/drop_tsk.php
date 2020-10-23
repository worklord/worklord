<?php
include '../../../db.php';
$tskid = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "DELETE FROM tasks WHERE task_id='$tskid'";

if ($conn->query($sql) === TRUE) {

$sql = "DELETE FROM task_questions WHERE task_id='$exid'";
if ($conn->query($sql) === TRUE) {
} else {
}

    header("location:../Tasks.php?rp=7823");
} else {
    header("location:../Tasks.php?rp=1298");
}

$conn->close();
?>
