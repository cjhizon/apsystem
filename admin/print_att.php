<?php
	require_once ("../conn.php"); 
	$dateToday = date('Y-m-d');

	$empid = $_POST['empid'];
	$startdate = $_POST['startdateselection'];
	$enddate = $_POST['enddateselection'];
	$tmpEmpNum = $_POST['tmpEmpNum'];

	if(isset($_POST["export"])) {

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=export-'.$dateToday.'.csv');
			//header('Content-Disposition: attachment; filename=export-'.$startdatetext.' to ' .$enddatetext.'.csv');
		 
		$output = fopen("php://output", "w");
		fputcsv($output, array('Date', 'Employee id', 'Employee name', 'Time_in', 'Break1in ', 'Break1out','Break2in','Break2out','Timeout','Total Hours', 'Total Break', 'Actual Hours'));
		$sql = mysqli_query($db,  " SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE employees.employee_id=$empid AND date >= '$startdate'  and date <= '$enddate' $tmpEmpNum  ORDER BY attendance.date DESC, attendance.time_in DESC ");       
                
		while($row = mysqli_fetch_assoc($sql)) {
			//$date = new date('M-d-Y',strtotime($_POST['date']));


			


			$time_in = new DateTime($row['time_in']);
			$time_out = new DateTime($row['time_out']);
			$interval = $time_in->diff($time_out);
			 $break1_in = new DateTime($row['break1_in']);
             $break1_out = new DateTime($row['break1_out']);
             $interval = $break1_in->diff($break1_out);
             $break2_in = new DateTime($row['break2_in']);
            $break2_out = new DateTime($row['break2_out']);
            $interval = $break2_in->diff($break2_out);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins;
			$int = ($hrs*60) + $mins;
			if($int > 4){
				$int = $int - 1;
			}
			 $break1 = ($hrs*60) + $mins;
             if($break1 > 4){
               $break1 = $break1 - 1;
           }
             $break2 = ($hrs*60) + $mins;
            if($break2 > 4){
              $break2 = $break2 - 1;
          }


			$total = $int ;
			$hrss = number_format(($total)/60,0);
			$mins = ($total)%60;
			$totalHrs = $hrss . " hrs" . $mins . " mins";

			   $hrsss = number_format(($break1+$break2)/60,0);
                     // echo $hrss."hrs ";
                      $minss = ($break1+$break2)%60;
                   //  $minss = ($total)%60;
			$totalBrk = $hrsss . " hrs" . $minss . " mins";

			 $total = $int - ($break1 + $break2);
                            $hrss = number_format(($total)/60,0);
                            //echo $hrss."hrs ";
                            $mins = ($total)%60;
                           //echo $mins." mins";
                        $totalMins = $total;

                        $hrss1 = number_format(($totalMins)/60,0);
                            //echo $hrss."hrs ";
                            $mins1 = ($totalMins)%60;
                           // echo $mins." mins";
                          $Actual = $hrss1. " hrs" . $mins1 . " mins";  

  
			$data = [

				$row['date'],
				$row['empid'],
				$row['firstname'] . " " . $row['lastname'],
				$row['time_in'],
				$row['break1_in'],
				$row['break1_out'],
				$row['break2_in'],
				$row['break2_out'],
				$row['time_out'],
				$totalHrs,
				$totalBrk,
				$Actual
			];
			fputcsv($output, $data);
		}
		fclose($output);
		/*$rows = [];
		while($row = mysqli_fetch_assoc($sql)) {
			$rows[] = $row;
		}
		echo '<pre>',print_r($rows),'</pre>';*/
	}
?>