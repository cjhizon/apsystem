<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home.php';
	}

	if(isset($_POST['save'])){
		$curr_password = $_POST['curr_password'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$photo = $_FILES['photo']['name'];
		$password = md5($user['password']);
		if(password_verify($curr_password, md5($user['password'])))
		{
			if(!empty($photo)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);
				$filename = $photo;	
			}
			else{
				$filename = $user['photo'];
			}

			if($password == md5($user['password'])){
				$password = md5($user['password']);
			}
			else{
				$password = md5($user['password']);
				//$password = password_hash($password, PASSWORD_DEFAULT);
			}
$password = md5($user['password']);
			$sql = "UPDATE admin SET username = '$username', password = '$password', firstname = '$firstname', lastname = '$lastname', photo = '$filename' WHERE id = '".['id']."'";
			if($db->query($sql)){
				$_SESSION['success'] = 'Admin profile updated successfully';
			}
			else{
				$_SESSION['error'] = $db->error;
			}
			
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

	header('location:'.$return);

?>