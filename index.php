<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>MRT | Home</title>
		<?php require_once('scripts/base.php'); ?>

		<?php base_header() ?>
	</head>
	<body>
		<div id = "topHeader"><?php make_header() ?></div>

		<div class="container">      
							<img src="images/crossbones.png" height = '300px' id = 'skullImage'>
		<div id="topTxt">

			<div class="topBar_text">


				<p>Welcome to the Morality Reporting Tool (MRT). This site allow users to view, update, and delete mortality statistics in a database. This site requires users to first create or login to access further page information and connect to the database.
				</p>
				<br>
				<p>Please login or create an account below to below to begin.</p>
			</div>	
		</div>
		<div id="main">
			<div class="content">
				<div class="cbb">

				
				<br />
				<br />
<!--LOGIN BUTTON-->				
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myLogin">Login</button>
<!--LOGIN PAGE (POPS UP)-->
			<div class="modal fade" id="myLogin">
    			<div class="modal-dialog">
      				<div class="modal-content">

        				<!-- Modal Header -->
        				<div class="modal-header">
          					<img src="images/minesLogo.png" alt="logo"/>
          					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        
        				<!-- Modal body -->
        				<div class="modal-body">
	         				<form method="post" class="modal-content animate" action="mrt/login.php">
							
							<div style="padding: 16px;">
								<label><b>Login:</b></label><br>
								<label><b>Username</b></label><br>
								<input type="text" placeholder="Enter Username" name="username" required autofocus><br>
								<label><b>Password</b></label><br>
								<input type="password" placeholder="Enter Password" name="password" required><br><br>
								<input type="submit" name = "login" value="Login" class="loginButton">
								<a href="forgotPassword.php?usernameExists=1">Forgot password?</a>
							</div>
						</form>
        				</div>
        
       					 <!-- Modal footer -->
        				<div class="modal-footer">
         					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				</div>
        
      				</div>
    			</div>
  			</div>
<!--LOGIN PAGE (POPS UP) ENDS-->

<!--MAKE ACCOUNT BUTTON-->				
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAccount">Create an Account</button>
<!--MAKE ACCOUNT PAGE (POPS UP)-->
			<div class="modal fade" id="createAccount">
    			<div class="modal-dialog">
      				<div class="modal-content">

        				<!-- Modal Header -->
        				<div class="modal-header">
          					<img src="images/minesLogo.png" alt="logo"/>
          					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        
        				<!-- Modal body -->
        				<div class="modal-body">
						<form method="post" class="modal-content animate" action="mrt/createLogin.php">
							<div style="padding: 16px;">
								<label><b>Create an Account:</b></label><br>
								<label><b>Email</b></label><br>
								<input type="text" placeholder="Enter Email" name="email" required autofocus><br>
								<label><b>Username</b></label><br>
								<input type="text" placeholder="Enter Username" name="username" required autofocus><br>
								<label><b>Password</b></label><br>
								<input type="password" placeholder="Enter Password" name="password" required><br><br>
								<input type="submit" name = "create" value="CreateAccount" class="loginButton">
							</div>
						</form>
        				</div>
        
       					 <!-- Modal footer -->
        				<div class="modal-footer">
         					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				</div>
        
      				</div>
    			</div>
  			</div>				
				
	<!--LOGIN PAGE (POPS UP) ENDS-->			

				</div>
			</div>	
 		
        </div>  
</div>
			<?php make_footer() ?> 
<script>
// Get the modal
var modal = document.getElementById('id01');

</script>


<script type="text/javascript">
    $('#nav').spasticNav();
</script>
</body>
</html>