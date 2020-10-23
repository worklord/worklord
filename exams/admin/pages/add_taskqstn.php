<?php
include '../../../db.php';
session_start();
include '../../includes/uniques.php';
$taskid = mysqli_real_escape_string($conn, $_POST['task_id']);
$question_id = 'QS-'.get_rand_numbers(6).'';
$question = mysqli_real_escape_string($conn, $_POST['question']);

$sql = "SELECT * FROM task_questions WHERE task_id = '$taskid' AND question = '$question'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
 header("location:../add_taskqstn.php?rp=1185&tid=$taskid");
    }
} else {

$sql = "INSERT INTO task_questions (question_id, task_id, question)
VALUES ('$question_id', '$taskid', '$question')";

if ($conn->query($sql) === TRUE) {
    header("location:../Tasks.php?rp=0357&tid=$taskid");	
} else {
 header("location:../add-taskqstn.php?rp=3903&tid=$taskid");	
}

}

?>