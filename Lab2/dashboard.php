<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$users = file("users.txt");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0f172a;
            font-family: Arial, sans-serif;
            color: #ffffff;
        }

        .navbar {
            background: #1e293b;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4);
        }

        .navbar h2 {
            margin: 0;
            font-size: 20px;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        .container {
            padding: 40px;
        }

        h3 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background: #334155;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #334155;
        }

        tr:hover {
            background: #2d3b55;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h2>Welcome, <?php echo $_SESSION['user']; ?> 👋</h2>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="container">
    <h3>All Users Data</h3>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
            <th>Phone</th>
        </tr>

        <?php foreach($users as $user):
            $data = explode("|", trim($user));
        ?>
        <tr>
            <td><?php echo $data[0]; ?></td>
            <td><?php echo $data[1]; ?></td>
            <td><?php echo $data[2]; ?></td>
            <td><?php echo $data[3]; ?></td>
            <td><?php echo $data[4]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
