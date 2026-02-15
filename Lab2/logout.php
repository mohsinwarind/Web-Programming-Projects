<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>

    <!-- Auto Redirect after 3 seconds -->
    <meta http-equiv="refresh" content="3;url=login.php">

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

        .box {
            background: #1e293b;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        h2 {
            color: #ffffff;
            margin-bottom: 10px;
        }

        p {
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }

        a:hover {
            background: #2563eb;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>You have been logged out</h2>
    <p>Redirecting to login page...</p>
    <a href="login.php">Go to Login Now</a>
</div>

</body>
</html>
