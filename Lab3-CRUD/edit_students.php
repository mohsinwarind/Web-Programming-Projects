<?php
include("db.php");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Edit Student</h2>

    <div class="card">
        <form action="update_student.php" method="POST">

            <input type="hidden" name="id" value="<?= $row['id']; ?>">

            <input type="text" name="name" value="<?= $row['name']; ?>" required>
            <input type="email" name="email" value="<?= $row['email']; ?>" required>
            <input type="text" name="phone" value="<?= $row['phone']; ?>" required>
            <input type="text" name="course" value="<?= $row['course']; ?>" required>
            <input type="text" name="city" value="<?= $row['city']; ?>" required>
            <input type="number" name="age" value="<?= $row['age']; ?>" required>
            <input type="text" name="semester" value="<?= $row['semester']; ?>" required>

            <button type="submit">Update Student</button>
        </form>
    </div>
</div>

</body>
</html>