<?php
include("db.php");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$course = $_POST['course'];
$city = $_POST['city'];
$age = $_POST['age'];
$semester = $_POST['semester'];

$sql = "UPDATE students SET
        name='$name',
        email='$email',
        phone='$phone',
        course='$course',
        city='$city',
        age='$age',
        semester='$semester'
        WHERE id=$id";

if($conn->query($sql)){
    header("Location: view_students.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>