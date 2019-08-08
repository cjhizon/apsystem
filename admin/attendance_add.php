<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		//$password = md5($_POST["password"]);
		$date = $_POST['date'];
$dateot= $_POST['date'];
$dateut= $_POST['date'];
$datelt= $_POST['date'];
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$break1_in = $_POST['break1_in'];
		$break1_in = date('H:i:s', strtotime($break1_in));
		$break1_out = $_POST['break1_out'];
		$break1_out = date('H:i:s', strtotime($break1_out));
		$break2_in = $_POST['break2_in'];
		$break2_in = date('H:i:s', strtotime($break2_in));
		$break2_out = $_POST['break2_out'];
		$break2_out = date('H:i:s', strtotime($break2_out));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));
		$dateinput= date('Y-m-d');

		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $db->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Employee not found';
		}
		else{
			$row = $query->fetch_assoc();
			$emp = $row['id'];

			$sql = "SELECT * FROM attendance WHERE employee_id = '$emp' AND date = '$date'";
			$query = $db->query($sql);

			if($query->num_rows > 0){
				$_SESSION['error'] = 'Employee attendance for the day exist';
			}
			else{
				//echo "pasok <br/>";
				//updates
				$sched = $row['schedule_id'];
				//$lognow = date('H:i:s');

				$sql = "SELECT * FROM schedules WHERE id = '$sched'";
				$squery = $db->query($sql);
				$scherow = $squery->fetch_assoc();

				$logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;
				$outstatus = ($time_out > $scherow['time_out']) ? 0 : 1;


				$sql = "INSERT INTO attendance (employee_id, date, time_in, break1_in, break1_out, break2_in, break2_out, time_out, status,status_out) VALUES ('$emp', '$date', '$time_in', '$break1_in', '$break1_out', '$break2_in' , '$break2_out' , '$time_out', '$logstatus','$outstatus')";
				if($db->query($sql)){
					$_SESSION['success'] = 'Attendance added successfully';
					$id = $db->insert_id;

					$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
					$query = $db->query($sql);
					$srow = $query->fetch_assoc();

					if($srow['time_in'] > $time_in){
						$time_in = $srow['time_in'];

					}

					if($srow['time_out'] < $time_out){
						$time_out1 = $srow['time_out'];
					}

					$time_in1 = new DateTime($time_in);
					$time_out1 = new DateTime($time_out1);
					$interval = $time_in1->diff($time_out1);
					$hrs = $interval->format('%h');
					$mins = $interval->format('%i');
					$mins = $mins/60;
					$int = $hrs + $mins;
					if($int > 4){
						$int = $int - 1;
					}

					$sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '$id'";
					$db->query($sql);

//echo "outstatus ".$outstatus." <br/>";
					if($outstatus == 0){

				//	$sql = "SELECT * FROM overtime WHERE employee_id = '$emp' AND date_overtime = '$date'";
						// $query = $db->query($sql);			
						$outstatusnow = new DateTime($time_out);
						
						$time_outvar = new DateTime($srow['time_out']);
						
						$interval = $outstatusnow->diff($time_outvar);
					
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins;
						$intot = ($hrs*60) + $mins;
						echo "ot=".$intot."<br>";
						//echo $int." int overtime";
						//echo $dateot;
						$sql = "INSERT INTO overtime (employee_id, hours, date_overtime) VALUES ('$emp', '$intot', '$dateot')";

						$db->query($sql);

					}else if($outstatus == 1){
							//$sql = "SELECT * FROM undertime WHERE employee_id = '$emp' AND date_ut = '$date'";	
						$outstatusnow = new DateTime($time_out);
						
						$time_outvar = new DateTime($srow['time_out']);
						
						$interval = $time_outvar->diff($outstatusnow);
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins;
						$intut = ($hrs*60) + $mins;
							echo "ut=".$intut."<br>";
						//echo $int." int undertime";
						//echo 'EMP'.$emp;
						//echo $dateut;

						$sql = "INSERT INTO undertime (emp_id, mins_ut, date_ut) VALUES ('$emp', '$intut', '$dateut')";
						
						$db->query($sql);
					}

//echo "logstatus ".$logstatus." <br/>";
					if($logstatus == 0){
						
						
						$lognow = new DateTime($time_in);
						$time_in_var = new DateTime($srow['time_in']);
						$interval = $lognow->diff($time_in_var);
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins;
						$intlt = ($hrs*60) + $mins;
							echo "lt=".$intlt."<br>";

						//echo $int." int late";

						//echo 'EMP'.$emp;
						//echo $datelt;

						$sql = "INSERT INTO late (emp_id, mins_late, date_late) VALUES ('$emp', '$intlt', '$datelt')";
						$db->query($sql);
					}

				}
				else{
					$_SESSION['error'] = $db->error;
				}
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: attendance.php');

?>