<?php
session_start();

if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    if($name && $email && $username && $password && $phone){

        $data = $name."|".$email."|".$username."|".$password."|".$phone."\n";

        file_put_contents("users.txt", $data, FILE_APPEND);

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0f172a; /* Dark navy */
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
        input[type="email"],
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

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #cbd5e1;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #3b82f6;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #2563eb;
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
    <h2>Signup Page</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone" placeholder="Phone Number" required>

        <input type="submit" name="signup" value="Signup">
    </form>

    <a href="login.php">Already have an account?</a>
</div>

</body>
</html>
