<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		

		$sql = "INSERT INTO campaign (campaign_name) VALUES ('$title')";
		if($db->query($sql)){
			$_SESSION['success'] = 'Campaign name added successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: campaign.php');

?>