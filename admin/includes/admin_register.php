<?php
  include "conn.php";
  session_start();
  if(!isset($_SESSION['login_admin'])) {
    header("location: index.php");
  } 
?>
<?php
  include_once("config.php");
  if (isset($_POST['Submit'])) {
    $un = $_POST['username'];
    $pw = md5($_POST['password']);
    
    if (empty($un) ||empty($pw)) {
      die("Adding Failed: Empty fields supplied.<br />".
      "<a href=\"registration.php\">Try Again?</a>"); 
    } else {
        $result = mysqli_query($mysqli, "INSERT INTO `admin`(`username`, `password`) VALUES ('$un', '$pw')");
        echo "<script>alert('Added Successfully!')</script>
        <script>window.open('registration.php','_self')</script>";
    }
  }
?>
<?php
  include_once("config.php");
  $result = mysqli_query($mysqli, "SELECT * FROM tbl_type");
?>