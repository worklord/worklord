<?php
include '../../../db.php';
$exid = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "UPDATE examinations SET status='Active' WHERE exam_id='$exid'";

if ($conn->query($sql) === TRUE) {
    header("location:../examinations.php?rp=7823");
} else {
    header("location:../examinations.php?rp=1298");
}

$conn->close();
?>
