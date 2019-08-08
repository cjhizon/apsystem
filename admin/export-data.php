<?php
  include 'includes/session.php';

  function generateRow($db){
    $contents = '';
    
    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id";

    $query = $db->query($sql);
    $total = 0;
    while($row = $query->fetch_assoc()){
      $contents .= "
      <tr>
        <td>".$row['lastname'].", ".$row['firstname']."</td>
        <td>".$row['employee_id']."</td>
        <td>".date('h:i A', strtotime($row['time_in'])).' - '. date('h:i A', strtotime($row['time_out']))."</td>
        <td>".$totalMins."</td>
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
              <th width="40%" align="center"><b>Employee Name</b></th>
                <th width="30%" align="center"><b>Employee ID</b></th>
        <th width="30%" align="center"><b>Schedule</b></th> 
           </tr>  
      ';  
    $content .= generateRow($db); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');
  $time_in = new DateTime($row['time_in']);
  $time_out = new DateTime($row['time_out']);
  $interval = $time_in->diff($time_out);
  $hrs = $interval->format('%h');
  $mins = $interval->format('%i');
  $mins = $mins;
  $int = ($hrs*60) + $mins;
  if($int > 4){
  $int = $int - 1;
  }

  // echo $int - ($break1 + $break2);
  $total = $int - ($break1 + $break2);
  $hrss = number_format(($total)/60,0);
  echo $hrss."hrs ";
  $mins = ($total)%60;
  echo $mins." mins";
  $totalMins += $total;
?>