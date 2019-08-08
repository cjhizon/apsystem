<?php 
$date = date('Y-m-d');

$datenow =date('H:i A', strtotime($timeout));

 $sql = "SELECT * FROM user WHERE empnum = '$empnum' AND password = '$password'";
  $run_query = mysqli_query($con,$sql);
  $count = mysqli_num_rows($run_query);
 if($count == 1){
    $row = mysqli_fetch_array($run_query);
    $pid =  $row["pid"];

    $sqltime = "SELECT * FROM timestamp_rec WHERE pid = '$pid' and entry_date = '$date' ";
    $run_querytime = mysqli_query($con,$sqltime);
    $counttime = mysqli_num_rows($run_querytime);
?>


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
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
             
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

 // $sql = " SELECT *, employees.employee_id AS empid,  attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN batch ON batch.id=employees.batch_id WHERE date >= '$startdate'  and date <= '$enddate' $tmpEmpNum  ORDER BY attendance.date DESC, attendance.time_in DESC";

  // echo $sql;
  ?>
        <form action="" method="POST">
         <label for="empid">Employee ID:</label>
          <input type="text" name="empid" id="empid" placeholder="Search.." style="margin-right:15px;" value="<?php echo $_SESSION['Agent_empid']; ?>" autocomplete="off"> </input>

             
       
            <label for="startdateselection">Start Date</label>
            <input type="date" name="startdateselection" id='startdateselection' value="<?php echo $_SESSION['Agent_startdate']; ?>" />  
            <label for="enddateselection">End Date:</label>
            <input type="date" name="enddateselection" id='enddateselection' value="<?php echo $_SESSION['Agent_enddate']; ?>" />  

            <input type="submit" class="btn btn-primary btn-user " value="Filter">
           

          </form>
          <br>
 <form action="" method="POST">
         
                    <label for="batch" class="col-sm-1 control-label">Batch:</label>

                    <div class="col-sm-2">
                      <select class="form-control" name="batch" id="batch" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM batch";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['batch']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                

             
       
            <label for="startdateselection">Start Date</label>
            <input type="date" name="startdateselection" id='startdateselection' value="<?php echo $_SESSION['Agent_startdate']; ?>" />  
            <label for="enddateselection">End Date</label>
            <input type="date" name="enddateselection" id='enddateselection' value="<?php echo $_SESSION['Agent_enddate']; ?>" />  

            <input type="submit" class="btn btn-primary btn-user " value="Filter">
         

          </form>
          <br>
            <div class="box-body">
               <div class="text-center">

                    <h1 class="h4 text-gray-900 mb-4">Record for <?php echo $startdatetext; ?> to <?php echo $enddatetext; ?></h1>
                </div>
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Batch</th>
                  <th> Login</th>
            
                  <th>Break1 in</th>
                   <th>Break1 out</th>
                    <th>Break2 in</th>
                     <th>Break2 out</th>
                  <th>Time Out</th>
               
                 
                </thead>
                <tbody>
                  <?php
                     $sql = " SELECT *, employees.employee_id AS empid,  attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN batch ON batch.id=employees.batch_id WHERE date >= '$startdate'  and date <= '$enddate' $tmpEmpNum  ORDER BY attendance.date DESC, attendance.time_in DESC";
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
                    
                      <td><?php echo $row['batch']; ?></td>


                      <td><?php echo "".date('h:i A', strtotime($row['time_in'])).$status.""; ?></td>
                    
                        
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
                  <?php  }
                  ?>
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
       $('#edit_employee_id').val(response.employee_id);
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_break1_in').val(response.break1_in);
      $('#edit_break1_out').val(response.break1_out);
      $('#edit_break2_in').val(response.break2_in);
      $('#edit_break2_out').val(response.break2_out);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
