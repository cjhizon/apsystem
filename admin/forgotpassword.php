<?php include 'includes/header.php'; ?>
<?php require "../conn.php"; ?>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
      <b>Reset Password</b>
    </div>
  
    <div class="login-box-body">
      <p class="login-box-msg">Forgot you password?<br>Enter your username and answer your secret question to reset your password.</p>

      <form action="passwordforgot.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="user" placeholder="Input username" required autocomplete="off" autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group">
                <label for="confirmPassword">Secret Question</label>
                <select class="form-control" name="sq">
                  <option value="What is your favorite food?">What is your favorite food?</option>
                  <option value="What is your childhood nickname?">What is your childhood nickname?</option>
                  <option value="What is your favorite food?">What is your favorite food?</option>
                </select>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Answer</label>
                <input type="text" class="form-control" name="ans" placeholder="Answer" />
            </div>
            <div class="form-group has-feedback">
            <input type="password" class="form-control" name="newpassword" placeholder="New Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
          <div class="col-xs-6">
                <button type="submit" value="Reset Password" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Reset Password</button>

            </div>
                <div class="col-xs-4">
              <p style= "margin-left:90px; font-size: 15px; margin-top:10px">  <a href="index.php"><b>Back</b></a></p>

            </div>
          </div>
      </form>
    </div>
    <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center mt20'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
</div>
  

<?php include 'includes/scripts.php' ?>
</body>
</html>