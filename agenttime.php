<?php session_start(); ?>
<?php include 'header.php'; ?>
<?php include 'conn.php';?>
<?php


 $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN campaign ON campaign.id=employees.campaign_id LEFT JOIN batch ON batch.id=employees.batch_id ";
        $query = $db->query($sql);
        while($row = $query->fetch_assoc()){
          $empid= $row['employee_id'];
        $fname = $row['firstname'];
          $lname = $row['lastname'];
          $position= $row['description']; 
          $batch= $row['batch']; 
          $campaign= $row['campaign_name'];   

        }

?>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
      <p id="date"></p>
      <p id="demotime" class="bold"></p>
    </div>


<script>
var myVar = setInterval(momentNow, 1000);

function momentNow(id) {
    var d = new Date();
    var time = document.getElementById("demotime").innerHTML = d.toLocaleTimeString();


    if (id == "in") {
        document.getElementById('timeIn').value=time;

          document.getElementById("in").disabled = true;
           document.getElementById("out").disabled = false;
     }
     if(id == "in1") {
        document.getElementById('breakin1').value=time;
         document.getElementById("in1").disabled = true;
           document.getElementById("in2").disabled = true; 
            document.getElementById("out2").disabled = true;
             document.getElementById("out").disabled = true;
     }
     if(id == "out1") {
        document.getElementById('breakOut1').value=time;
         document.getElementById("out1").disabled = true;
            document.getElementById("in2").disabled = false; 
     }
     if(id == "in2") {
        document.getElementById('breakIn2').value=time;
         document.getElementById("in2").disabled = true;

     }
     if(id == "out2") {
        document.getElementById('breakOut2').value=time;
         document.getElementById("out2").disabled = true;
     }
       if(id == "out") {
        document.getElementById('timeOut').value=time;
         document.getElementById("out").disabled = true;
          document.getElementById("in").disabled = false;
           document.getElementById("in1").disabled = false;
            document.getElementById("in2").disabled = false;
             document.getElementById("out1").disabled = false;
              document.getElementById("out2").disabled = false;

     }


}

</script>

 <form id="attendance">
          <div class="form-group" name="status">
  <input readonly type='text'  id="timeIn" name="timeIn" value=""> 
  <?php

   //$empid = $_GET['employee_id'];
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

    $timein=$_POST['timeIn'];
   $date_now = date('Y-m-d');
    $sql=   "INSERT INTO attendance (employee_id, date, time_in) VALUES ('$empid', '$date_now', NOW())";
   if($db->query($sql)){
          $_SESSION['success'] = 'Attendance added successfully';
          $id = $db->insert_id;

      echo $empid;
      echo $date_now;
      echo $timein;
    }
  }
  ?>  


<button value="in" type="button" id="in" onClick="momentNow(this.id)">Time in</button>

<input readonly type='text' id="breakin1" value="" >
<button value="break1in" id="in1" onClick="momentNow(this.id)">Break1 in</button>

<input readonly type='text' id="breakOut1" value="" >
<button  value="break1out" id="out1" onClick="momentNow(this.id)">Break1 out</button>

<input readonly type='text' id="breakIn2" value="" >
<button value="break2in" id='in2' onClick="momentNow(this.id)">Break2 in</button>

<input readonly type='text' id="breakOut2" value="" >
<button value="break2out" id='out2' onClick="momentNow(this.id)">Break2 out</button>

<input readonly type='text' id="timeOut" value="" >
<button value="out" id='out' onClick="momentNow(this.id)">time out</button>
<br><br><br><br><br>
<div >

  <a href="changepass.php" class="btn btn-default btn-flat">Change password</a>

 
                  <a href="signout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
</div>
</form>




    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
      <?php //include 'changepass.php'; ?>    
</div>
  
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);
  function momentNow(id) {
    var d = new Date();
    var time = document.getElementById("demotime").innerHTML = d.toLocaleTimeString();
}
    
});
</script>
</body>
</html>