<?php
	function base_header(){
		?>
		            
            <meta charset="utf-8">
  	        <meta name="viewport" content="width=device-width, initial-scale=1">
			        	<!-- JavaScript -->
            <script type="text/javascript" src="js/cb.js"></script>
		<!--	<script type="text/javascript" src="js/bootstrap.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
            <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		    <script type="text/javascript" src="js/jquery.spasticNav.js"></script>
            <script type="text/javascript" src="js/jquery.cycle.all.js"></script>
        	
        	<!-- CSS -->
            <link href="style.css" type="text/css" rel="stylesheet" />
  			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
		    <!-- FONTS -->
		    <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
		<?php
	}
	
		function base_header_internal(){
		?>
		            
            <meta charset="utf-8">
  	        <meta name="viewport" content="width=device-width, initial-scale=1">
			        	<!-- JavaScript -->
            <script type="text/javascript" src="../js/cb.js"></script>
		<!--	<script type="text/javascript" src="js/bootstrap.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
            <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
		    <script type="text/javascript" src="../js/jquery.spasticNav.js"></script>
            <script type="text/javascript" src="../js/jquery.cycle.all.js"></script>
        	
        	<!-- CSS -->
            <link href="../style.css" type="text/css" rel="stylesheet" />
  			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
		    <!-- FONTS -->
		    <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
		    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<?php
	}


	function make_nav($selectId){
		?>

		<ul class="nav">
        <?php if ($selectId==1) {echo '<li id="nav-item active">';} else {echo '<li class="nav-item">';} ?><a class="nav-link" href="index_internal.php">Home</a></li>
		<?php if ($selectId==2) {echo '<li id="nav-item active">';} else {echo '<li class="nav-item">';} ?><a class="nav-link" href="select.php">SELECT</a></li>
		<?php if ($selectId==3) {echo '<li id="nav-item active">';} else {echo '<li class="nav-item">';} ?><a class="nav-link" href="insert.php">INSERT</a></a></li>
        <?php if ($selectId==4) {echo '<li id="nav-item active">';} else {echo '<li class="nav-item">';} ?><a class="nav-link" href="update.php">UPDATE</a></li>
        <?php if ($selectId==5) {echo '<li id="nav-item active">';} else {echo '<li class="nav-item">';} ?><a class="nav-link" href="delete.php">DELETE</a></li>
        <?php if ($selectId==6) {echo '<li id="nav-item active">';} else {echo '<li class="nav-item">';} ?><a class="nav-link" href="account_info.php">Account Info</a></li>
        <form action="logout.php">
    <input type="submit" value="Logout" />
</form>
        </ul>
		<?php
    }
	
	function make_header(){
	?>
        <div id="logo">
                    <div><a href="http://www.mines.edu"><img src="images/minesLogo.png" alt="Mines Logo" /></a></div>
                    <h1 id = 'headertext'>Morality Reporting Tool</h1>
        </div>
    <?php	
	}
	
	function make_footer(){
	?>

        <footer>
            <div style="clear:both"></div>
            <hr size="1"/>
            <div class=" footer_content">

        	    <img src="images/csm_logo_small.png"/> <span> &copy; 2017 Colorado School of Mines<br />  Contact:<br />  Ryan Fast [rfast@mymail.mines.edu]<br /> Nick Corl [ncorl@mymail.mines.edu]<br />   Bobby Hudson [rhudson@mymail.mines.edu]</span><br />
			
            </div>
            <div style="clear:both"></div>  
        </footer>
    <?php	
	}
?>