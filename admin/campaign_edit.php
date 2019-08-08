<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$campid = $_POST['id'];
		$title = $_POST['title'];
		

		$sql = "UPDATE campaign SET campaign_name = '$title' WHERE id = '$campaignid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Campaign updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:campaign.php');

?>