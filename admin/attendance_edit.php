<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['edit_date'];
		$time_in = $_POST['edit_time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$break1_in = $_POST['edit_break1_in'];
		$break1_in = date('H:i:s', strtotime($break1_in));
		$break1_out = $_POST['edit_break1_out'];
		$break1_out = date('H:i:s', strtotime($break1_out));
		$break2_in = $_POST['edit_break2_in'];
		$break2_in = date('H:i:s', strtotime($break2_in));
		$break2_out = $_POST['edit_break2_out'];
		$break2_out = date('H:i:s', strtotime($break2_out));
		$time_out = $_POST['edit_time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$sql = "UPDATE attendance SET date = '$date', time_in = '$time_in', break1_in = '$break1_in', break1_out = '$break1_out', break2_in = '$break2_in', break2_out = '$break2_out', time_out = '$time_out' WHERE id = '$id'";
		if($db->query($sql)){
			$_SESSION['success'] = 'Attendance updated successfully';

			$sql = "SELECT * FROM attendance WHERE id = '$id'";
			$query = $db->query($sql);
			$row = $query->fetch_assoc();
			$emp = $row['employee_id'];

			$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
			$query = $db->query($sql);
			$srow = $query->fetch_assoc();

			//updates
			$logstatus = ($time_in > $srow['time_in']) ? 0 : 1;
			$outstatus = ($time_out > $srow['time_out']) ? 0 : 1;
			//

			if($srow['time_in'] > $time_in){
				$time_in = $srow['time_in'];
			}

			if($srow['time_out'] < $time_out){
				$time_out = $srow['time_out'];
			}

			$time_in = new DateTime($time_in);
			$time_out = new DateTime($time_out);
			$interval = $time_in->diff($time_out);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4){
				$int = $int - 1;
			}

			$sql = "UPDATE attendance SET num_hr = '$int', status = '$logstatus' WHERE id = '$id'";
			$db->query($sql);
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance.php');

?>