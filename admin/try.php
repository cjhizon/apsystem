
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="../exporthtml/jquery-3.2.1.min.js"></script>		
	<script type="text/javascript" src="../exporthtml/tableExport.js"></script>	
</head>
<body>
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

   
                          ?>  
	<table id="issue51lb" border="1" style="border-collapse: collapse;">
      <thead>
        <tr>
        <th rowspan="2">Date</th>
        <th rowspan="2">Employee ID</th>
        <th rowspan="2">Name</th>
        <th rowspan="2">Campaign</th>
        <th colspan="2">Batch</th>
        <th colspan="2">Timein</th>
         <th colspan="1">Break1 in</th>
        <th colspan="1">Break1 out</th>
        <th colspan="1">Break2 in</th>
        <th colspan="1">Break2 out</th>
        <th rowspan="2">Time out</th>
        </tr>
       
      </thead>
      <tbody>
        <?php
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

        ?>
        <tr>
        <td rowspan="1"><?php echo "".date('M d, Y', strtotime($row['date'])).""; ?></td>
        <td><?php echo "".$row['empid'].""; ?></td>
        <td><?php echo "".$row['firstname'].' '.$row['lastname'].""; ?></td>
        <td><?php echo "".$row['campaign_name'].""; ?></td>
        <td><?php echo $row['batch']; ?></td>
        <td><?php echo "".date('h:i A', strtotime($row['time_in'])).""; ?></td>
       <?php if(empty($row['break1_in'])){ ?>
                       <td></td>
                      <?php }else{ ?>
                        
                         <td><?php echo "".date('h:i A', strtotime($row['break2_in'])).""; ?></td>
                      <?php } ?>

         <?php if(empty($row['break1_out'])){ ?>
                       <td></td>
                      <?php }else{ ?>
                        
                         <td><?php echo "".date('h:i A', strtotime($row['break1_out'])).""; ?></td>
                      <?php } ?>
        <?php if(empty($row['break2_in'])){ ?>
                        <td></td>
                      <?php }else{ ?>
                        <td><?php echo "".date('h:i A', strtotime($row['break2_in'])).""; ?></td>
                      <?php } ?>
         <?php if(empty($row['break2_out'])){ ?>
                       <td></td>
                      <?php }else{ ?>
                         <td><?php echo "".date('h:i A', strtotime($row['break2_out'])).""; ?></td>
                      <?php } ?>

         <?php if(empty($row['time_out'])){ ?>
                          <td></td>
                        <?php }else{ ?>
                      
                        <td><?php echo "".date('h:i A', strtotime($row['time_out'])).$status_out.""; ?></td>
                      <?php } ?>      
        </tr>
       
      </tbody>
    </table>


	<a href="#" onclick="doExport('#issue51lb', {type: 'excel'});"> <img src="icons/csv.png" alt="CSV" style="width:24px"> CSV (colspan + rowspan)</a>
	<script>
		 function doExport(selector, params) {
	      var options = {
	        //ignoreRow: [1,11,12,-2],
	        //ignoreColumn: [0,-1],
	        //pdfmake: {enabled: true},	        
	      };

	      $.extend(true, options, params);

	      $(selector).tableExport(options);
	    }
	</script>
</body>
</html>
