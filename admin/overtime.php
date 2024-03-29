<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php error_reporting(0);?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Overtime
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Overtime</li>
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
$_SESSION['Agent_batch'] = "";
  $_SESSION['Agent_campaign'] = "";
  
  $tmpEmpNum = "";
  if(!empty($_POST['empid'])){
    $_SESSION['Agent_empid'] = $_POST['empid'];
    $tmpEmpNum = " and employees.employee_id like '".$_POST['empid']."'";
  }
    $tmpBatch = "";
  if(!empty($_POST['batch'])){
    $_SESSION['Agent_batch'] = $_POST['batch'];
    $tmpBatch = " and employees.batch_id like '".$_POST['batch']."'";
    
  }

$tmpCamp = "";
  if(!empty($_POST['campaign'])){
    $_SESSION['Agent_campaign'] = $_POST['campaign'];
    $tmpCamp = " and employees.campaign_id like '".$_POST['campaign']."'";
    
  }

//$sql = "SELECT *, employees.employee_id AS empid , late.late_id AS lateid FROM late LEFT JOIN employees ON employees.id=late.emp_id EFT JOIN batch ON batch.id=employees.batch_id WHERE date >= '$startdate'  and date <= '$enddate' $tmpEmpNum ORDER BY late.date_late DESC";

 // echo $sql;
  ?>
 <div>
        <form action="" method="POST" style=" ">
         <label for="empid">Employee ID:</label>
          <input type="text" name="empid" id="empid" placeholder="Search.." style="margin-right:15px;" value="<?php echo $_SESSION['Agent_empid']; ?>" autocomplete="off"> </input>
           
            <label for="startdateselection">Start Date</label>
            <input type="date" name="startdateselection" id='startdateselection' value="<?php echo $_SESSION['Agent_startdate']; ?>" />  
            <label for="enddateselection">End Date</label>
            <input type="date" name="enddateselection" id='enddateselection' value="<?php echo $_SESSION['Agent_enddate']; ?>" />  

            <input type="submit" class="btn btn-primary btn-user " value="Filter">
         <button onclick="doExport('#datainfo',{type:'excel'});" class="btn btn-primary btn-user" >PRINT</button>

          </form>

          <br>
          <form action="" method="POST">
           <label for="batch" class="col-sm-1 control-label">Batch:</label>

                    <div class="col-sm-2">
                      <select class="form-control" name="batch" id="batch" >
                        <option value="<?php echo $_SESSION['Agent_batch']; ?>" autocomplete="off" selected>- Select -</option>
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

                 <label for="campaign" class="col-sm-1 control-label">Campaign</label>

                    <div class="col-sm-2">
                      <select class="form-control" name="campaign" id="campaign" >
                        <option value="<?php echo $_SESSION['Agent_campaign']; ?>" autocomplete="off" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM campaign";
                          $query = $db->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['campaign_name']."</option>
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
          <button onclick="doExport('#datainfo',{type:'excel'});" class="btn btn-primary btn-user" >PRINT</button>

          </form>
          <br>

            </div>
            <div class="box-body">
              <table id="datainfo" class="table table-bordered table-striped table-hover js-exportable">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                   <th>Campaign</th>
                  <th>Batch</th>
                  <th>No. of Mins</th>
                
                
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, overtime.id AS otid, employees.employee_id AS empid FROM overtime LEFT JOIN employees ON employees.id=overtime.employee_id  LEFT JOIN campaign ON campaign.id=employees.campaign_id LEFT JOIN batch ON batch.id=employees.batch_id WHERE date_overtime >= '$startdate'  and date_overtime <= '$enddate' ORDER BY date_overtime DESC";
                    $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td class='hidden'></td>
                          <td><?php echo "".date('M d, Y', strtotime($row['date_overtime']))."";  ?></td>
                          <td><?php echo "".$row['empid'].""; ?></td>
                          <td><?php echo "".$row['firstname'].' '.$row['lastname'].""; ?></td>
                           <td><?php echo "".$row['campaign_name'].""; ?></td>
                          <td><?php echo "".$row['batch'].""; ?></td>
                          <td><?php echo "" .$row['hours']. ""; ?> mins</td>
                         
                         
                         
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
  <?php include 'includes/undertime_modal.php'; ?>
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
    url: 'undertime_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      var time = response.hours;
      var split = time.split('.');
      var hour = split[0];
    
      hour = hour * 60;
        var min = '.'+split[1];
      console.log(min);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('.otid').val(response.otid);
      $('#datepicker_edit').val(response.date_overtime);
      $('#undertime_date').html(response.date_overtime);
      $('#hours_edit').val(hour);
      $('#mins_edit').val(min);
      
    }
  });
}
</script>
</body>
</html>
