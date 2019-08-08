<?php
session_start();
include 'conn.php';
 
 
  $empnum = $_POST['empnum'];
  $password = $_POST['newpassword'];
  $sq = $_POST['sq'];
  $ans = $_POST['ans'];

  $res = mysqli_query($db, "SELECT * FROM employees WHERE employee_id='$empnum'");
    
    if($row = mysqli_fetch_array($res)) {
      if ($empnum != $row['employee_id']) {
        echo "<script>
            alert('Please enter correct employee id');
            location.href = 'forgotpass.php';
          </script>";
      }else if ($sq != $row['sq']) {
        echo "<script>
            alert('Please choose correct Secret Question.');
            location.href = 'forgotpass.php';
          </script>";
      }else if ($ans != $row['ans']) {
        echo "<script>
            alert('Please enter correct answer!');
            location.href = 'forgotpass.php';
          </script>";
      }else{
        $password = md5($password);
        $query="UPDATE employees SET password = '$password' WHERE employee_id = '$empnum'";
        if(mysqli_query($db,$query)){
          echo "<script>
              alert('Password has been updated!');
              location.href = 'index.php';
            </script>";
        }
      }
    }else{
      echo "<script>
            alert('Please enter correct employeeid!');
            location.href = 'forgotpass.php';
          </script>";
    }
  
  ?>