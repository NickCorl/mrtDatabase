<?php
session_start();
include_once("db.php");

if(isset($_POST['create'])) {
	$userName = strip_tags($_POST['username']);
	$passWord = strip_tags($_POST['password']);
	$email = strip_tags($_POST['email']);
	$incompleteUsername = false;
	$incompleteEmail = false;
	
	$title = mysqli_real_escape_string($db, $title);
	$content = mysqli_real_escape_string($db, $content);
	
	// CHECK IF USERNAME EXISTS
	$sql = "SELECT username FROM users WHERE username = '$userName'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	if (isset($row)) {
		$incompleteUsername = true;
	}
	
	// CHECK IF EMAIL EXISTS
	$sql = "SELECT email FROM users WHERE email = '$email'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	if (isset($row)) {
		$incompleteEmail = true;
	}

	//CHECK IF FIELDS ARE UNIQUE FOR BOTH EMAIL AND USERNAME
	if ($incompleteEmail == false || $incompleteUsername== false) {
	$sql = "INSERT INTO users (username, password, email) VALUES ('$userName', '".hash('md5', $passWord)."', '$email');";
	mysqli_query($db, $sql);
	echo '<html><p>Account Successfully Created!</p><a href="../index.php">Click Here</a></html>';
	//IF CHECK FAILS HAVE USER ENTER NEW CRADENTALS
	} else {
				echo '	<form method="post" class="modal-content animate" action="mrt/createLogin.php"><div style="padding: 16px;"><label><b>Create an Account:</b></label><br><label><b>Email</b></label><br><input type="text" placeholder="Enter Email" name="email" required autofocus>';
				if ($incompleteEmail == true){echo '<span style="color:red"> *Email Already Exists</span>';}				
				echo '<br><label><b>Username</b></label><br><input type="text" placeholder="Enter Username" name="username" required autofocus>';
				if ($incompleteUsername == true){echo '<span style="color:red"> *Username Already Exists</span>';}	
				echo '<br>
					  <label><b>Password</b></label><br>
					  <input type="password" placeholder="Enter Password" name="password" required><br><br>
					  <input type="submit" name = "create" value="CreateAccount" class="loginButton">
					</div>
				</form><a href="../index.php"> Go Back </a> ';
	}
}
?>