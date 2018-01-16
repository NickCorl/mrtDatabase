<?php session_start();
session_start();
include_once("db.php");
//RETURN TO LOGIN IF NO USER FOUND
if(!isset($_SESSION['username'])) {
	header("Location: login.php");
	return;
}
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MRT | Select</title>
<?php require_once('../scripts/base.php'); ?>
		<?php base_header_internal() ?>
</head>
		<?php make_nav(6) ?>
<body>
<div class="container">
		


		
           
		<div id="main">
        <div class="content noLine"><span class="pageTitle">Account Infomation</span><hr size="1"/></div>	
        
            
            
            <div class="content">
            <p>Use the submission below to change your account password.</p>
            
            <br />
                <div class="cbb">
                    <?php
                    #connecting to the database
                    
                    // A simple PHP script demonstrating how to connect to MySQL.
                    // Press the 'Run' button on the top to start the web server,
                    // then click the URL that is emitted to the Output tab of the console.
    
                    $servername = getenv('IP');
                    $username = getenv('C9_USER');
                    $password = "";
                    $database = "mrt_database";
                    $dbport = 3306;
                    
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $database, $dbport);
                
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    } 
                    ?>
                    
                    <div>
                    Username: <?php echo $_SESSION['username']; ?>
                    <br /> <br />
                    Would you like to change you password? 
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <input type="password" name="password"/>
                        <input type="submit" value="Change Password"/>
                        </form>
                    </div>
                    
                   
                   <?php
                   
                   if (isset($_POST["password"])) {
                   //change password
                   $password = $_POST['password'];
                   $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                   $stmt->bind_param("ss", hash('md5', $password), $_SESSION['username']);
                   $stmt->execute();
                   $conn->close(); 
                   }
                   
                   ?>
                   
			
			<?php make_footer() ?>
			
        </div>  
        
    
</div>
<script type="text/javascript">
    $('#nav').spasticNav();
</script>
</body>
</html>