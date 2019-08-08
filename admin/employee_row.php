<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, employees.id as empid FROM employees LEFT JOIN campaign ON campaign.id=employees.campaign_id LEFT JOIN batch ON batch.id=employees.batch_id LEFT JOIN position ON position.id=employees.position_id LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
		$query = $db->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>