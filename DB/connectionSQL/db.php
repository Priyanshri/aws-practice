

 <?php
$dbcon = mysqli_connect("localhost", "root", "", "demo");

if (!$dbcon) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>