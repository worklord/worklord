<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../../db.php';
include '../../includes/uniques.php';
$exam_id = 'EX-'.get_rand_numbers(6).'';
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$passmark = mysqli_real_escape_string($conn, $_POST['passmark']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));

$sql = "SELECT * FROM examinations WHERE exam_name = '$exam'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../examinations.php?rp=1185");
    }
} else {

$sql = "INSERT INTO examinations (exam_id, exam_name, duration, passmark, terms)
VALUES ('$exam_id', '$exam', '$duration', '$passmark', '$terms')";

if ($conn->query($sql) === TRUE) {
header("location:../examinations.php?rp=2932");
} else {
header("location:../examinations.php?rp=7788");
}


}
$conn->close();
?>
