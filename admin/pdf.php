<?php
	include 'includes/session.php';

	function generateRow($db){
		$contents = '';
		  if( !empty($_POST['startdateselection']) && !empty($_POST['enddateselection']) ){
  
    $startdate = date('Y-m-d',strtotime($_POST['startdateselection']));
    $enddate = date('Y-m-d',strtotime($_POST['enddateselection']));

    $startdatetext = date('M-d-Y',strtotime($_POST['startdateselection']));
    $enddatetext = date('M-d-Y',strtotime($_POST['enddateselection']));
  
  }else{
    $startdate = date('Y-m-d');
    $startd=date('Y-m-d');
    $enddate = date('Y-m-d');

    $startdatetext = date('M-d-Y');
    $enddatetext = date('M-d-Y');
  }
  $employee_id= $_POST['employee_id'];
  $_SESSION['Agent_startdate'] = $startdate;
  $_SESSION['Agent_enddate'] = $enddate;
  
   $_SESSION['Agent_empid'] = "";

  
  $tmpEmpNum = "";
  if(!empty($_POST['empid'])){
    $_SESSION['Agent_empid'] = $_POST['empid'];
    $tmpEmpNum = " and employees.employee_id like '".$_POST['empid']."'";
  }
		$sql =    $sql = "SELECT * , employees.employee_id AS empid, attendance.id FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN late ON late.emp_id=attendance.employee_id LEFT JOIN undertime ON undertime.emp_id=attendance.employee_id LEFT JOIN overtime ON overtime.employee_id=attendance.employee_id WHERE  date >= '$startdate'  and date <= '$enddate' $tmpEmpNum  
               
               ORDER BY attendance.date DESC, attendance.time_in DESC";

		$query = $db->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
       $status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                        $statuslt = ($row['status'])?'ontime':'late';
                      
                      if( $row['status_out'] == 0)
                        $status_out = '<span class="label label-warning pull-right">undertime</span>';
                      if( $row['status_out'] == 1)
                        $status_out = '<span class="label label-danger pull-right">overtime</span>';
                      if( $row['status_out'] == NULL)
                        $status_out = '<span class="label label-danger pull-right">NULL</span>';
			$contents .= "
			<tr>
				
				<td>".$row['employee_id']."</td>
        <td>".$row['lastname'].", ".$row['firstname']."</td>
				<td>".date('h:i A', strtotime($row['time_in']))."</td>
			</tr>
			";
		}

		return $contents;
	}

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('TechSoft - Employee Schedule');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">Sterling Global Call Center</h2>
      	<h4 align="center">Agent Attendance</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="40%" align="center"><b>Employee ID</b></th>
                <th width="30%" align="center"><b>Name</b></th>
				<th width="30%" align="center"><b>Time in</b></th> 
           </tr>  
      ';  
    $content .= generateRow($db); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');

?>