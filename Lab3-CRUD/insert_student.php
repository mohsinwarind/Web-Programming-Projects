<?php
include("db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$course = $_POST['course'];
$city = $_POST['city'];
$age = $_POST['age'];
$semester = $_POST['semester'];

$sql = "INSERT INTO students (name,email,phone,gender,course,city,age,semester)
VALUES ('$name','$email','$phone','$gender','$course','$city','$age','$semester')";

if($conn->query($sql)){
    header("Location: view_students.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>