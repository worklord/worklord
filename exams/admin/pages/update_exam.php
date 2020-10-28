<?php
session_start();
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../../db.php';
include '../../includes/uniques.php';
$exam_id = $_POST['examid'];
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$passmark = mysqli_real_escape_string($conn, $_POST['passmark']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));

$sql = "SELECT * FROM examinations WHERE exam_name = '$exam' AND exam_id != '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../edit-exam.php?rp=1185");
    }
} else {

$sql = "UPDATE examinations SET exam_name = '$exam', duration = '$duration', passmark = '$passmark', terms = '$terms' WHERE exam_id='$exam_id'";

if ($conn->query($sql) === TRUE) {
header("location:../edit-exam.php?rp=7823&eid=$exam_id");
} else {
header("location:../edit-exam.php?rp=1298&eid=$exam_id");
}


}
$conn->close();
?>
