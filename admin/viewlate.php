<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
        $empid = $_GET['employee_id'];
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="employee.php" class="btn btn-primary btn-user" ><i ></i>Back</a>
              <br><br>
              <?php
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

    ?>
      <form action="" method="POST">
         
           
            <label for="startdateselection">Start Date</label>
            <input type="date" name="startdateselection" id='startdateselection' value="<?php echo $_SESSION['Agent_startdate']; ?>" />  
            <label for="enddateselection">End Date</label>
            <input type="date" name="enddateselection" id='enddateselection' value="<?php echo $_SESSION['Agent_enddate']; ?>" />  

            <input type="submit" class="btn btn-primary btn-user " value="Filter">
          <button onclick="doExport('#data',{type:'excel'});" class="btn btn-primary btn-user" >PRINT</button>
           
          </form>
         

          

 
            </div>
            <div class="box-body">
              <table id="data" class="table table-bordered table-striped table-hover js-exportable">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Time In</th>
                  <th>Break1 in</th>
                   <th>Break1 out</th>
                    <th>Break2 in</th>
                     <th>Break2 out</th>
                  <th>Time Out</th>
                  <th>Total Hrs</th>
                  <th>Total Break</th>
                  <th>Actual Hrs</th>
               
                
                </thead>
                <tbody>
                  <?php 
                  $totalMins = 0;
                   // $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE employees.employee_id=$empid ORDER BY attendance.date DESC, attendance.time_in DESC";
                    $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                    
                      $status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      
                      if( $row['status_out'] == 1)
                        $status_out = '<span class="label label-warning pull-right">undertime</span>';
                      if( $row['status_out'] == 0)
                        $status_out = '<span class="label label-danger pull-right">overtime</span>';

                      //  $status_out = ($row['status_out'])?'<span class="label label-warning pull-right">undertime</span>':'<span class="label label-danger pull-right">overtime</span>';

                    ?>
                    <tr>
                      <td><?php echo "".date('M d, Y', strtotime($row['date'])).""; ?></td>
                    
                     
                      <td><?php echo "".$row['empid'].""; ?></td>
                    
                     
                      <td><?php echo "".$row['firstname'].' '.$row['lastname'].""; ?></td>
                    
                     
                      <td><?php echo "".date('h:i A', strtotime($row['time_in'])).$status.""; ?></td>
                    
                        
                     <?php if(!empty($row['break1_in'])){ ?>
                        <td><?php echo "".date('h:i A', strtotime($row['break2_in'])).""; ?></td>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
                    
                      
                      <?php if(!empty($row['break1_out'])){ ?>
                        <td><?php echo "".date('h:i A', strtotime($row['break1_out'])).""; ?></td>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
                    
                      
                        <?php if(!empty($row['break2_in'])){ ?>
                        <td><?php echo "".date('h:i A', strtotime($row['break2_in'])).""; ?></td>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
                    
                      
                       <?php if(!empty($row['break2_out'])){ ?>
                        <td><?php echo "".date('h:i A', strtotime($row['break2_out'])).""; ?></td>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
                    
                      <?php if(!empty($row['time_out'])){ ?>
                        <td><?php echo "".date('h:i A', strtotime($row['time_out'])).$status_out.""; ?></td>
                      <?php }else{ ?>
                        <td></td>
                      <?php } ?>
                   
                     <td>
                    <?php

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
                          $total = $int ;
                            $hrss = number_format(($total)/60,0);
                            echo $hrss."hrs ";
                            $mins = ($total)%60;
                            echo $mins." mins";

                       ?>
                    </td>

                    <td>                      
                      <?php 
                      $break1 = 0;
                      $break2 = 0;
                      if(!empty($row['break1_in']) || !empty($row['break1_out'])){
                          $break1_in = new DateTime($row['break1_in']);
                          $break1_out = new DateTime($row['break1_out']);
                          $interval = $break1_in->diff($break1_out);
                          $hrs = $interval->format('%h');
                          $mins = $interval->format('%i');
                          $mins = $mins;
                          $break1 = ($hrs*60) + $mins;
                          if($break1 > 4){
                            $break1 = $break1 - 1;
                          }
                          // echo $break1;
                      }

                      if(!empty($row['break2_in']) || !empty($row['break2_out'])){
                          $break2_in = new DateTime($row['break2_in']);
                          $break2_out = new DateTime($row['break2_out']);
                          $interval = $break2_in->diff($break2_out);
                          $hrs = $interval->format('%h');
                          $mins = $interval->format('%i');
                          $mins = $mins;
                          $break2 = ($hrs*60) + $mins;
                          if($break2 > 4){
                            $break2 = $break2 - 1;
                          }
                          // echo $break2;
                      }
                      // echo $break1+$break2;
                      $hrss = number_format(($break1+$break2)/60,0);
                      echo $hrss."hrs ";
                      $mins = ($break1+$break2)%60;
                      echo $mins." mins";

                    ?>
                  </td>
                  <td>
                    <?php

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
                    </td>
                      
                     
                    
                     </tr>
                  <?php  }
                  ?>

                  <tr> 
                    <td colspan="11">TOTAL</td>
                    <td><?php 
                    

                            $hrss = number_format(($totalMins)/60,0);
                            echo $hrss."hrs ";
                            $mins = ($totalMins)%60;
                            echo $mins." mins";
                     ?></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
function export(id){
  $.ajax({
    type: 'POST',
    url: 'printcsv.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $output = fopen("php://output", "w");
    }
  });
}



</script>

</body>
</html>
