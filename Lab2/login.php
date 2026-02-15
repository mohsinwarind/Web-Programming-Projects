<?php
session_start();

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = file("users.txt");

    foreach($users as $user){

        $data = explode("|", trim($user));

        if($data[2] == $username && $data[3] == $password){

            $_SESSION['user'] = $username;

            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Invalid username or password!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0f172a;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #1e293b;
            padding: 40px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        h2 {
            color: #ffffff;
            margin-bottom: 25px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: none;
            border-radius: 6px;
            background: #334155;
            color: #ffffff;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #22c55e;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #16a34a;
        }

        .error {
            background: #7f1d1d;
            color: #fecaca;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #93c5fd;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Login Page</h2>

    <?php if($error != ""): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <input type="submit" name="login" value="Login">
    </form>

    <a href="signup.php">Create Account</a>
</div>

</body>
</html>
