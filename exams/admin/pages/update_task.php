<?php
session_start();
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../../db.php';
include '../../includes/uniques.php';
$task_id = $_POST['taskid'];
$task = ucwords(mysqli_real_escape_string($conn, $_POST['task']));
$question = ucfirst(mysqli_real_escape_string($conn, $_POST['question']));
$passmark = mysqli_real_escape_string($conn, $_POST['passmark']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));

$sql = "SELECT * FROM tasks WHERE task_name = '$task' AND task_id != '$task_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../edit-task.php?rp=1185");
    }
} else {

$sql = "UPDATE tasks SET task_name = '$task', question = '$question', passmark = '$passmark', terms = '$terms' WHERE task_id='$task_id'";

if ($conn->query($sql) === TRUE) {
header("location:../edit-task.php?rp=7823&tid=$task_id");
} else {
header("location:../edit-task.php?rp=1298&tid=$task_id");
}


}
$conn->close();
?>
