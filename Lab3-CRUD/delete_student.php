<?php
include("db.php");

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id=$id";

if($conn->query($sql)){
    header("Location: view_students.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>