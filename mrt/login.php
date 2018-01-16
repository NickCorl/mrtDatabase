<?php
session_start();
//CHECK IF LOGIN IS PRESSED
if(isset($_POST['login'])){
	include_once("db.php");
	
	// PREVENT SQL INJECTION!
	// (strip_tags) -> REMOVES TAG AND SYMBOLS IN STRING
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	
	// (strip_tags) -> REMOVES TAG AND SLASHES IN STRING
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	$username = mysqli_real_escape_string($db, $username);
	$password = mysqli_real_escape_string($db, $password);
	
	//BASI ENCRYPTION TO PREVENT DB BREECH
	$password = md5($password);
	
	$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1"; //SET LIMIT 1 TO PREVENT MORE THEN ONE USERNAME
	$query = mysqli_query($db, $sql);	
	$row = mysqli_fetch_array($query);
	$id = $row['id'];
	$db_password = $row['password'];
	
	if($password == $db_password) {
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $id;
		$cookie_name = $username;
		$cookie_value = $id;
		$expire = time() + 60;
		setcookie($cookie_name, $cookie_value, $expire, "/", "c9users.io");
		$_COOKIE[$cookie_name] = $id;
		if (isset($_COOKIE[$cookie_name])) {
			echo "SUCCESS\n" . $_COOKIE[$cookie_name] . "\n";
		} else {
			echo "FAIL\n" . $cookie_name . "\n";
		}
		print_r($_COOKIE);
		
		header("Location: ../mrt/index_internal.php");
	} else {
		echo "You didn't enter the correct Username/Password!";
	}
	
}
?>

<html>
<head>
<title>Login</title>
</head>
<body>
	<h1 style="font-family:Tahoma;">Login</h1>
	<form action="login.php" method="post" enctype="multipart/form-data">
		<input placeholder= "Username" name="username" type="text" autofocus>
		<input placeholder= "Password" name="password" type="password">
		<input name="login" type="submit" value="Login">
		<a href="../forgotPassword.php?usernameExists=1">Forgot password?</a>
</body>
</html>