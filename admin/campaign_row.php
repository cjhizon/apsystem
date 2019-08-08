<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT id,campaign_name FROM campaign WHERE id = '$id'";
		$query = $db->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>