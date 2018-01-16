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
		<title>MRT | Home</title>
<?php require_once('../scripts/base.php'); ?>

		<?php base_header_internal() ?>
	</head>
	<body>
			<?php make_nav(1) ?>
		<div class="container">      


		
		<div id="highlight">
			<div class="highlight_content">
				<blockquote>
				<p>Welcome to the Morality Reporting Tool (MRT). </p> <br />
				<p>This site allow users to view, update, and delete mortality statistics in a database. 
				Please refer to the tab information below and use the above navigation bar to move through the site.</p>
				<br>
				</blockquote>
			</div>	
		</div>
		<div id="main">
			<div class="content">
				<p style = "text-decoration: underline">Tab Description: </p>
				<ul>
				<li><p>Home - this page holds basic site information and allows users to login, logout, and create an account</p></li>
				<li><p>SELECT - this page allows users to select records from the database for viewing</p></li>
				<li><p>INSERT - this page allows the user to insert data into the database</p></li>
				<li><p>UPDATE - this page allows user to update records in the database</p></li>
				<li><p>DELETE - this page allows the user to delete data from the database</p></li>
				<li><p>Account Info - this page allows the user to change their password</p></li>
				</ul>
				</div>
			</div>	

			<?php make_footer() ?>  		
        </div>  
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

</script>


<script type="text/javascript">
    $('#nav').spasticNav();
</script>
</body>
</html>