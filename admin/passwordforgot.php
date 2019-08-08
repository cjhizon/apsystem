<?php
session_start();
include 'includes/conn.php';
 
 
  $user = $_POST['user'];
  $password = $_POST['newpassword'];
  $sq = $_POST['sq'];
  $ans = $_POST['ans'];

  $res = mysqli_query($db, "SELECT * FROM admin WHERE username='$user'");
    
    if($row = mysqli_fetch_array($res)) {
      if ($user != $row['username']) {
        echo "<script>
            alert('Please enter correct username');
            location.href = '../admin/forgotpassword.php';
          </script>";
      }if ($sq != $row['question']) {
        echo "<script>
            alert('Please choose correct Secret Question.');
            location.href = '../admin/forgotpassword.php';
          </script>";
      }if ($ans != $row['answer']) {
        echo "<script>
            alert('Please enter correct answer!');
            location.href = '../admin/forgotpassword.php';
          </script>";
      }else{
        $password = md5($password);
        $query="UPDATE admin SET password = '$password' WHERE username = '$user'";
        if(mysqli_query($db,$query)){
          echo "<script>
              alert('Password has been updated!');
              location.href = '../admin/index.php';
            </script>";
        }
      }
    }else{
      echo "<script>
            alert('Please enter correct username!');
            location.href = '../admin/forgotpassword.php';
          </script>";
    }
  
  ?>