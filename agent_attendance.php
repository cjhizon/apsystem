<?php
	if(isset($_POST)){
		$output = array('error'=>false);

		include 'conn.php';
		include 'timezone.php';

		$employee = $_POST['employee'];
		//$password = $_POST['password'];
		$status = $_POST['status'];
		//$password = md5($password);

		$sql = "SELECT * FROM employees WHERE employee_id = '$employee' ";
		$query = $db->query($sql);

		if($query->num_rows > 0){	
			$row = $query->fetch_assoc();
			$id = $row['id'];

			$date_now = date('Y-m-d');

			if($status == 'timeIn'){
				//$sql = "SELECT * FROM employees WHERE employee_id = '$employee' AND password = '$password' ";
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
				$query = $db->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have timed in for today';
				}
				else{
					//updates
					$sched = $row['schedule_id'];
					$lognow = date('H:i:s');
					
					$sql = "SELECT * FROM schedules WHERE id = '$sched'";
					$squery = $db->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;

					if($logstatus == 0){
						$lognow = new DateTime($lognow);
						$time_in = new DateTime($srow['time_in']);
						$interval = $lognow->diff($time_in);
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins;
						$int = ($hrs*60) + $mins;

						
						
						$sql = "INSERT INTO late (emp_id, mins_late, date_late) VALUES ('$id', '$int', NOW())";
						$db->query($sql);
					}
					//
					$sql = "INSERT INTO attendance (employee_id, date, time_in, status) VALUES ('$id', '$date_now', NOW(), '$logstatus')";
					if($db->query($sql)){
						$output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $db->error;
					}
				}
			}
			//end of time in
			if($status == 'break1in'){
				
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND break1_in ";
				$query = $db->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have break1 in for today';
				}
				else{
					//updates
					
					//
			$sql = "UPDATE attendance SET break1_in = NOW()  WHERE employee_id = '$id'";
					if($db->query($sql)){
						$output['message'] = 'Break1 in: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $db->error;
					}
				}
			} 
//break1in
				if($status == 'break1out'){
				
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND break1_out ";
				$query = $db->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have break1 out for today';
				}
				else{
					//updates
					
					//
					$sql = "UPDATE attendance SET break1_out = NOW()  WHERE employee_id = '$id'";
					if($db->query($sql)){
						$output['message'] = 'Break1 out: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $db->error;
					}
				}
			} 
			//breakout1
			
				if($status == 'break2in'){
				
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND break2_in ";
				$query = $db->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have break2 in for today';
				}
				else{
					//updates
					
					//
				$sql = "UPDATE attendance SET break2_in = NOW()  WHERE employee_id = '$id'";
					if($db->query($sql)){
						$output['message'] = 'Break2 in: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $db->error;
					}
				}
			} 
			//break2in

				if($status == 'break2out'){
				
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND break2_out ";
				$query = $db->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have break2 out for today';
				}
				else{
					//updates
					
					//
					$sql = "UPDATE attendance SET break2_out = NOW()  WHERE employee_id = '$id'";
					if($db->query($sql)){
						$output['message'] = 'Break2 out: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $db->error;
					}
				}
			} 
			//breakout2
			else if($status == 'out'){
				$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
				$query = $db->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'Cannot Timeout. No time in.';
				}
				else{
					$row = $query->fetch_assoc();
					if( $row['time_out'] != NULL ){
						$output['error'] = true;
						$output['message'] = 'You have timed out for today';
					}
					else{

						$sched = $row['schedule_id'];
					$outnow = date('H:i:s');
					
					$sql = "SELECT * FROM schedules WHERE id = '$sched'";
					$squery = $db->query($sql);
					$srow = $squery->fetch_assoc();

					$outstatus = ($outnow > $srow['time_out']) ? 0 : 1;

					if($outstatus == 0){
						
						$outstatusnow = new DateTime($outnow);
						$time_out = new DateTime($srow['time_out']);
						$interval = $outstatusnow->diff($time_out);
					
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins;
						$int = ($hrs*60) + $mins;
						
						
						$sql = "INSERT INTO overtime (employee_id, hours, date_overtime) VALUES ('$id', '$int', NOW())";

						$db->query($sql);

					}else if($outstatus == 1){
						
						$outstatusnow = new DateTime($outnow);
						$time_out = new DateTime($srow['time_out']);
						$interval = $time_out->diff($outstatusnow);
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins;
						$int = ($hrs*60) + $mins;

						$sql = "INSERT INTO undertime (emp_id, mins_ut, date_ut) VALUES ('$id', '$int', NOW())";
						
						$db->query($sql);
					}


						$sql = "UPDATE attendance SET time_out = NOW() , status_out = '$outstatus' WHERE id = '".$row['uid']."'";
						

						if($db->query($sql)){
							$output['message'] = 'Time out: '.$row['firstname'].' '.$row['lastname'];

							$sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
							$query = $db->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
							$query = $db->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in']){
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

							$sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$row['uid']."'";
							$db->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $db->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Employee ID not found';
		}
		
	}
	
	echo json_encode($output);

?>