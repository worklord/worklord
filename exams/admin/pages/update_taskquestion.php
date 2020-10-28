<?php
session_start();
include '../../../db.php';
include '../../includes/uniques.php';
$question_id = $_POST['question_id'];
$question = mysqli_real_escape_string($conn, $_POST['question']);
$taskid = mysqli_real_escape_string($conn, $_POST['task_id']);

$sql = "SELECT * FROM task_questions WHERE task_id = '$taskid' AND question = '$question' AND question_id != '$question_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
 header("location:../edit-taskquestion.php?id=$question_id");
    }
} else {

$sql = "UPDATE task_questions SET question='$question' WHERE question_id='$question_id'";

if ($conn->query($sql) === TRUE) {
	
    header("location:../edit-taskquestion.php?rp=7823&id=$question_id");	
} else {
 header("location:../edit-taskquestion.php?rp=1298&id=$question_id");	
}

}



?>