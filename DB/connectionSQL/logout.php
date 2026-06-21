<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body{
            margin:0;
            padding:20px;
            font-family: 'Inter', sans-serif;
            background:#0f172a;
            background-image: radial-gradient(circle at top right, #1e1b4b, #0f172a);
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .logout-box{
            background:white;
            padding:40px;
            border-radius:16px;
            box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.25);
            text-align:center;
            width:100%;
            max-width:400px;
        }

        h2{
            margin-bottom:24px;
            font-size: 20px;
            color: #0f172a;
            font-weight: 600;
            line-height: 1.4;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#ef4444;
            color:white;
            font-size:15px;
            font-weight: 500;
            cursor:pointer;
            transition: background 0.2s;
        }

        button:hover{
            background:#dc2626;
        }

        a{
            text-decoration:none;
            width: 100%;
            display: block;
        }
    </style>
</head>
<body>

<div class="logout-box">

    <h2>Are you sure you want to logout?</h2>

    <a href="logout.php">
        <button>Logout</button>
    </a>

</div>

</body>
</html>

<?php
session_start();

session_unset();
session_destroy();

echo "<script>alert('Logged Out Successfully');</script>";
echo "<script>window.open('login.php','_self');</script>";
?>