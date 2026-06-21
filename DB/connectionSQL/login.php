<?php
session_start();
include("db.php");

if(isset($_POST['login']))
{
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $check_user = "SELECT * FROM users
                   WHERE username='$username'
                   OR email='$username'";

    $run = mysqli_query($dbcon, $check_user);

    if(mysqli_num_rows($run) > 0)
    {
        $row = mysqli_fetch_assoc($run);

        if($row['password'] == $password)
        {
            $_SESSION['username'] = $row['username'];
            // FIXED: Changed from homepage.html to homepage.php
            echo "<script>window.open('homepage.php','_self')</script>";
            exit();
        }
        else
        {
            echo "<script>alert('Incorrect Password')</script>";
        }
    }
    else
    {
        echo "<script>alert('User Not Found')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            background-image: radial-gradient(circle at top right, #1e1b4b, #0f172a);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
        }

        h1 {
            color: #0f172a;
            text-align: center;
            margin: 0 0 8px 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 32px;
        }

        form div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #334155;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: all 0.2s ease;
            color: #0f172a;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        button[name="login"] {
            width: 100%;
            padding: 12px;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s, transform 0.1s;
        }

        button[name="login"]:hover {
            background-color: #4338ca;
        }

        button[name="login"]:active {
            transform: scale(0.98);
        }

        #forgot-password {
            display: block;
            text-align: right;
            color: #4f46e5;
            text-decoration: none;
            margin-top: 8px;
            font-size: 13px;
            font-weight: 500;
        }

        #forgot-password:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
            margin: 24px 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 24px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider:not(:empty)::before { margin-right: .5em; }
        .divider:not(:empty)::after { margin-left: .5em; }

        .signup-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748b;
            display: block;
        }

        .signup-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .google-login {
            margin-top: 16px;
        }

        #google-login {
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
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        #google-login:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        #google-login i {
            margin-right: 10px;
            color: #ea4335;
            font-size: 16px;
        }

        #error-message {
            color: #ef4444;
            text-align: center;
            margin-top: 16px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Welcome Back</h1>
        <div class="subtitle">Log in to your Complexity Analyzer account</div>
        
        <form id="login-form" action="login.php" method="POST">
            <div>
                <label for="username">Email/Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit" name="login">Log In</button>
            </div>
            <div>
                <a href="#" id="forgot-password">Forgot Password?</a>
            </div>
        </form>

        <div class="divider">or</div>

        <div class="google-login">
            <button id="google-login" type="button">
                <i class="fab fa-google"></i> Login with Google
            </button>
        </div>

        <small class="signup-link">
            Don't have an account? <a href="signup.php">Sign up</a>
        </small>

        <div id="error-message">
            <?php
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']); 
            }
            ?>
        </div>
    </div>
</body>

</html>