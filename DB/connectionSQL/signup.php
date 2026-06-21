<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #0f172a;
            background-image: radial-gradient(circle at top right, #1e1b4b, #0f172a);
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            display: flex;
            width: 100%;
            max-width: 850px;
            overflow: hidden;
        }

        .left-side {
            padding: 45px;
            width: 55%;
        }

        .right-side {
            padding: 45px;
            width: 45%;
            background-color: #f8fafc;
            border-left: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            color: #0f172a;
            margin: 0 0 24px 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            margin-bottom: 16px;
            color: #0f172a;
            outline: none;
            transition: all 0.2s ease;
        }

        input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        button[name="register"] {
            background-color: #4f46e5;
            color: white;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.2s, transform 0.1s;
            margin-top: 8px;
            margin-bottom: 16px;
            border: none;
            width: 100%;
        }

        button[name="register"]:hover {
            background-color: #4338ca;
        }

        button[name="register"]:active {
            transform: scale(0.98);
        }

        small {
            text-align: center;
            display: block;
            font-size: 14px;
            color: #64748b;
        }

        .left-side small a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .left-side small a:hover {
            text-decoration: underline;
        }

        .right-side p {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 16px;
        }

        .google-btn {
            background-color: white;
            border: 1px solid #e2e8f0;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .google-btn:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        .google-btn img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        .google-btn small {
            color: #334155;
            font-weight: 500;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 100%;
                max-width: 450px;
            }

            .left-side, .right-side {
                width: 100%;
                padding: 30px;
            }
            
            .right-side {
                border-left: none;
                border-top: 1px solid #e2e8f0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <h1>Create Account</h1>
            <form id="signupForm" action="signup.php" method="POST">
                <input type="text" id="fullname" name="username" placeholder="Full Name" required>
                <input type="email" id="email" name="email" placeholder="Email Address" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                <button type="submit" name="register">Sign Up</button>
            </form>
            <small>Already have an account? <a href="login.php">Log in</a></small>
        </div>
        <div class="right-side">
            <p>Alternative Options</p>
            <button class="google-btn">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjTHdnduUYB40YP8sC9rx1RFcQj2i7MLsUGg&s" alt="google-logo">
                <small>Sign up with Google</small>
            </button>
        </div>
    </div>
</body>

</html>

<?php
include("db.php");

if(isset($_POST['register']))
{
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if(empty($username) || empty($email) || empty($password) || empty($confirmPassword))
    {
        echo "<script>alert('Please fill all required fields.')</script>";
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "<script>alert('Invalid Email Address')</script>";
        exit();
    }

    if($password != $confirmPassword)
    {
        echo "<script>alert('Passwords do not match')</script>";
        exit();
    }

    $check_username = "SELECT * FROM users WHERE username='$username'";
    $run_username = mysqli_query($dbcon, $check_username);

    if(mysqli_num_rows($run_username) > 0)
    {
        echo "<script>alert('Username already exists')</script>";
        exit();
    }

    $check_email = "SELECT * FROM users WHERE email='$email'";
    $run_email = mysqli_query($dbcon, $check_email);

    if(mysqli_num_rows($run_email) > 0)
    {
        echo "<script>alert('Email already exists')</script>";
        exit();
    }

    $insert_user = "INSERT INTO users(username,email,password)
                    VALUES('$username','$email','$password')";

    if(mysqli_query($dbcon,$insert_user))
    {
        echo "<script>alert('Registration Successful')</script>";
        echo "<script>window.open('login.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Registration Failed')</script>";
    }
}
?>