<?php
session_start();

if(!isset($_SESSION['username']))
{
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home Page</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Inter', sans-serif;
}

body{
    background:#f8fafc;
    color: #1e293b;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

header{
    background:#0f172a;
    color:white;
    padding:16px 40px;
    display:flex;
    justify-content: space-between;
    align-items:center;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    width: 100%;
}

header h2{
    font-size:20px;
    font-weight: 600;
    letter-spacing: -0.025em;
}

.logout-btn{
    background:#ef4444;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.logout-btn:hover{
    background:#dc2626;
    transform: translateY(-1px);
}

.welcome-wrapper {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.container{
    width:100%;
    max-width: 600px;
    background:white;
    padding:50px 40px;
    border-radius:16px;
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.05), 0 4px 6px -4px rgb(0 0 0 / 0.05);
    border: 1px solid #e2e8f0;
    text-align: center;
}

.avatar-icon {
    font-size: 50px;
    margin-bottom: 20px;
    display: inline-block;
}

.container h1{
    font-size: 32px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom:12px;
    letter-spacing: -0.025em;
}

.container p{
    font-size:16px;
    color: #64748b;
    line-height: 1.6;
}
</style>

</head>

<body>

<header>
    <h2>Complexity Analyzer</h2>
    <a href="logout.php">
        <button class="logout-btn">Logout</button>
    </a>
</header>

<div class="welcome-wrapper">
    <div class="container">
        <div class="avatar-icon">👋</div>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <p>You have successfully authenticated and logged into the system. Your clean workspace is ready.</p>
    </div>
</div>

</body>
</html>