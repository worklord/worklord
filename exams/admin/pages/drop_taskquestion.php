<?php
include '../../../db.php';
$qsid = mysqli_real_escape_string($conn, $_GET['id']);
$tskid = mysqli_real_escape_string($conn, $_GET['tid']);

$sql = "DELETE FROM task_questions WHERE question_id='$qsid'";

if ($conn->query($sql) === TRUE) {
    header("location:../view-taskquestions.php?rp=7823&tid=$tskid");
} else {
    header("location:../view-taskquestions.php?rp=1298&tid=$tskid");
}

$conn->close();
?>
