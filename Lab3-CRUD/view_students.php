<?php
include("db.php");
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>All Students</h2>

    <div class="nav">
        <a href="add_student.php">Add Student</a>
        <a href="index.php">Home</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Course</th>
            <th>City</th>
            <th>Age</th>
            <th>Semester</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['phone']; ?></td>
            <td><?= $row['gender']; ?></td>
            <td><?= $row['course']; ?></td>
            <td><?= $row['city']; ?></td>
            <td><?= $row['age']; ?></td>
            <td><?= $row['semester']; ?></td>
            <td>
                <a class="edit-btn" href="edit_students.php?id=<?= $row['id']; ?>">Edit</a>
                <a class="delete-btn" href="delete_student.php?id=<?= $row['id']; ?>"
                   onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>