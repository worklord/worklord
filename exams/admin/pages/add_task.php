<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../../db.php';
include '../../includes/uniques.php';
$task_id = 'TA-'.get_rand_numbers(6).'';
$question_id = 'QS-'.get_rand_numbers(6).'';
$task = ucwords(mysqli_real_escape_string($conn, $_POST['task']));
$question=ucfirst(mysqli_real_escape_string($conn, $_POST['question']));

$passmark = mysqli_real_escape_string($conn, $_POST['passmark']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));

$sql = "SELECT * FROM tasks WHERE task_name = '$task'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../tasks.php?rp=1185");
    }
} else {

$sql = "INSERT INTO tasks (task_id, task_name, question, passmark, terms)
VALUES ('$task_id', '$task', '$question', '$passmark', '$terms')";
$sql2 = "INSERT INTO task_questions (question_id, task_id, question)
VALUES ('$question_id', '$task_id', '$question')";

if(($conn->query($sql))&&($conn->query($sql2))===TRUE) {
header("location:../tasks.php?rp=2932");
} else {
header("location:../tasks.php?rp=7788");
}


}
$conn->close();
?>
