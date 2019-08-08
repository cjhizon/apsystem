<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
      <p id="date"></p>
      <p id="time" class="bold"></p>
    </div>
  
    <div class="login-box-body">
      <h4 class="login-box-msg">Enter Employee ID</h4>

      <form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
               <option value="break1in">Break1 out</option> 
                <option value="break1out">Break1 in</option>
                 <option value="break2in">Break2 out</option>
                  <option value="break2out">Break2 in</option>
              <option value="out">Time Out</option>
            </select>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control input-lg" id="employee" name="employee" placeholder="input Employee ID" onkeyup="this.value = this.value.toUpperCase();"  autocomplete="off" required>
            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
          </div>
           <div class="form-group has-feedback">
            <input type="password" class="form-control input-lg" id="password" placeholder="input Password" name="password" required>
          </div>
          <div class="row">
          <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin" style=" margin-right:50px"><i class="fa fa-sign-in"></i> Sign In</button>

            </div>
             <div class="row">
       <div class="col-xs-7" >
            <a href="changepass.php" > <h5 style=" margin-left:80px"><b>Change Password</b></h5></a>
              <a href="forgotpass.php" > <h5 style=" margin-left:80px"><b>Forgot Password?</b></h5></a>
            
            </div>
          </div>
          </div>
      </form>
      
    </div>
    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
      
</div>
  
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
          $('#password').val('');
        }
      }
    });
  });
    
});
</script>
</body>
</html>
