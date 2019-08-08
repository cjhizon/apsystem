<?php 
require "includes/conn.php";


	$username=$_POST['username'];
	$password=$_POST['password'];
	$question=$_POST['question'];
    $answer=$_POST['answer'];
//$password = password_hash($password, PASSWORD_DEFAULT);
	$password = md5($_POST["password"]);		

	if(strlen($username)==0 || strlen($password)==0)
		die("LOG IN FAILED!!! br />".
		"<a href='register.php'>TRY AGAIN?</a>"); 
			
	$sql = "INSERT INTO admin (id,username, password,question,answer) VALUES (NULL,'$username','$password','$question','$answer')";
	//echo $question; 
	//echo $answer;
	if(mysqli_query($db,$sql))
		echo "
				<script>alert('NEW ACCOUNT ADDED!')</script>
				<script>window.open('index.php','_self')</script>
			";
	else
		die("Creating Account Failed!" . mysqli_error($db) . "<br />");
	?>