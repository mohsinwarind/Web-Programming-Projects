<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Add New Student</h2>

    <div class="card">
        <form action="insert_student.php" method="POST">

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone" required>

            <select name="gender" required>
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
            </select>

            <input type="text" name="course" placeholder="Course" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="semester" placeholder="Semester" required>

            <button type="submit">Add Student</button>
        </form>
    </div>
</div>

</body>
</html>