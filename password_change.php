
<?php
session_start();
include 'conn.php';

$empnum = $_POST['empnum'];
        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $confirmnewpassword = $_POST['confirmnewpassword'];
      $question=$_POST['question'];
    $answer=$_POST['answer'];
        $password = md5($password);
        $newpassword = md5($newpassword);
        $confirmnewpassword = md5($confirmnewpassword);

        $result = mysqli_query($db,"SELECT password FROM employees WHERE employee_id='$empnum'");


        if (!$result)
  {
  //code to be executed if condition is true;
    echo "The username you entered does not exist";
  }
else if ($password!= $password)
  {
 // code to be executed if condition is true;
    
    echo "You entered an incorrect password";
 }
 else if ($newpassword==$confirmnewpassword)
  {
 // code to be executed if condition is true;
   $sql=mysqli_query($db,"UPDATE employees SET sq='$question', ans='$answer', password='$newpassword'  where 

 employee_id='$empnum'");
   echo $question;
   echo $answer;
   if ($sql) {
     # code...
    
    echo "<script>
    alert('Congratulations You have successfully changed your password')
    location.href='index.php';</script>";
  
   // echo $password."<br>"; 
   // echo $newpassword;
   // echo $confirmnewpassword;
   }
}
else
  {
  //code to be executed if condition is false;
      echo "<script>
    alert('Password do not match')
    location.href='changepass.php';</script>";
 } 

      ?>
