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
    $enddate = date('Y-m-d');

    $startdatetext = date('M-d-Y');
    $enddatetext = date('M-d-Y');
  }
  //$employee_id= $_POST['employee_id'];
  $_SESSION['Agent_startdate'] = $startdate;
  $_SESSION['Agent_enddate'] = $enddate;
  
  $_SESSION['Agent_empid'] = "";

  
  $tmpEmpNum = "";
  if(!empty($_POST['empid'])){
    $_SESSION['Agent_empid'] = $_POST['empid'];
    $tmpEmpNum = " and employees.employee_id like '".$_POST['empid']."'";
  }
    $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE employees.employee_id=$empid AND date >= '$startdate'  and date <= '$enddate' $tmpEmpNum  ORDER BY attendance.date DESC, attendance.time_in DESC";
  
		
	 // $sql = " SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ";
		$query = $db->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
			$contents .= "
			<tr>
          <td>".date('M d, Y', strtotime($row['date']))."</td>
				<td>".$row['lastname'].", ".$row['firstname']."</td>
				<td>".$row['employee_id']."</td>
				<td>".date('h:i A', strtotime($row['time_in']))."</td>
        <td>".date('h:i A', strtotime($row['break1_in']))."</td>
        <td>".date('h:i A', strtotime($row['break1_out']))."</td>
        <td>".date('h:i A', strtotime($row['break2_in']))."</td>
        <td>".date('h:i A', strtotime($row['break2_out']))."</td>
        <td>".date('h:i A', strtotime($row['time_out']))."</td>
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
      	<h2 align="center">TechSoft IT Solutions</h2>
      	<h4 align="center">Employee Schedule</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th align="center"><b>Date</b></th>
                <th align="center"><b>Employee Name</b></th>
                 <th align="center"><b>Employee ID</b></th>
                  <th align="center"><b>Time in</b></th>
                   <th align="center"><b>Break1in</b></th>
                    <th align="center"><b>Break1out</b></th>
                    <th align="center"><b>Break2in</b></th>
                    <th align="center"><b>Break2out</b></th>
                    <th align="center"><b>Timeout</b></th>
				
           </tr>  
      ';  
    $content .= generateRow($db); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('attendance.pdf', 'I');

?>