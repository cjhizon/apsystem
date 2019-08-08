<?php include 'includes/header.php'; ?>
<?php require "../conn.php"; ?>
<body class="hold-transition login-page">

<div class="login-box">
  	<div class="login-logo">
  		<b>Admin Sign up</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign up to start your session</p>

    	<form action="accountprocess.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="input Username" required autocomplete="off" autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="input Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group">
                <label for="confirmPassword">Secret Question</label>
                <select class="form-control" name="question">
                  <option value="What is your favorite food?">What is your favorite food?</option>
                  <option value="What is your childhood nickname?">What is your childhood nickname?</option>
                  <option value="What is your favorite food?">What is your favorite food?</option>
                </select>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Answer</label>
                <input type="text" class="form-control" name="answer" placeholder="Answer" />
            </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"><i class="fa fa-sign-in"></i> Sign Up</button>

        		</div>
                <div class="col-xs-8">
              <p style= "margin-left:100px; font-size: 15px; margin-top:10px">  <a href="index.php"><b>Back to Login</b></a></p>

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