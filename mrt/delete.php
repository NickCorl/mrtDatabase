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
<title>MRT | Delete</title>
<?php require_once('../scripts/base.php'); ?>
		<?php base_header_internal() ?>
</head>
<style type="text/css">
    /* Table results styling */
/*Table 1*/
#t01,#t01 th,#t01 td{
	padding:5px;
	text-align:center;
	border:1px solid black;	
}
caption{ /*Will style all table captions*/
	margin-top: 20px;
	font-family:courier;
	font-size:20px;
}
#t01 thead{
	background-color: black;
	border:1px solid white;
	color:white;
	
}
#t01{
	border-collapse:collapse;
	margin:auto;
}
caption{
    
    text-align: center;
    caption-side: top;
    
}
</style>

		<?php make_nav(5) ?>

<body>
<div class="container">
  
		<div id="main">
        <div class="content noLine"><span class="pageTitle">Delect Records</span><hr size="1"/></div>	
        

            
            
            <div class="content">
            <p>Use the form below to delecte a record from the database by record ID. First search for a record if you are unsure of the record ID.<br />
            If the deletion was succesful or not you will be notified below</p>
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
                    $database = "aceps_database";
                    $dbport = 3306;
                    
                                        
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $database, $dbport);
                
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    } 
                    ?>
                <!-------------------- SEARCH --------------------------------->
                    <form method = "post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <span style = "font-weight:bold"> Search:</span><br />
                        <!-- SELECTING A YEAR -->
                        Year: <select id = "year" name = "year">
                        <?php
    
                        
                        $sql = "SELECT DISTINCT year FROM mortality_report";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                		// output data of each row
                		while($row = $result->fetch_assoc()) {
                                echo "<option value=\"" . $row["year"] . "\">" . $row["year"] . "</option>";
                		}
                    	} else {
                    		echo "0 records in the database";
                    	}  
                        ?>
                        </select>
                        <!-- SELECTING A CITY -->
                        City: <select id = "city" name = "city">
                        <?php
    
                        
                        $sql = "SELECT DISTINCT city FROM mortality_report";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                		// output data of each row
                		while($row = $result->fetch_assoc()) {
                                echo "<option value=\"" . $row["city"] . "\">" . $row["city"] . "</option>";
                		}
                    	} else {
                    		echo "0 records in the database";
                    	}  
                        ?>
                        </select>
                        <br />
                        <input type="submit" value="Submit"/>
                        <br /><br />
                    </form>
                
            
            
            <!--------------- UPDATE ------------------------------>
            <form method = "post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <span style = "font-weight:bold"> Delete:</span><br />
                Record ID: <input type="number" name="record_id" min="0" value = "0" style="width: 60px;"><br />
                <input type="submit" value="Submit"/>
                <br /><br />
            </form>
                </div>
            </div>
            
            <!-------------- Search results ---------------------->
            <div class = "content">
                <?php
                    // Values that will be queried on
                    $year = $_POST["year"];
                    $city = $_POST["city"];
                    
                    $sql = "SELECT * FROM mortality_report WHERE year =" . $year . " AND city = '" . $city ."'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                    echo "<table id = \"t01\">
                    		<caption stlye=\"caption-side:top;\">Mortaltiy Records<br /> City:" . $city . "</caption>
                    		<thead>
                    			<tr>
                    			<th>Record ID</th>
                    			<th>Year</th>
                    			<th>State</th>
                    			<th>Younger than 1</th>
                    			<th>1 to 24</th>	
                    			<th>25 to 44</th>	
                    			<th>45 to 64</th>	
                    			<th>65+</th>	
                    			</tr>
                    		</thead>
                    		<tbody>";
                    
            		// output data of each row
            		while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["record_id"] . "</td><td>" . $row["year"] . "</td><td>" . $row["State"] . "</td><td>" . $row["less_than_one"] . "</td><td>" . $row["one_to_twentyfour"] . "</td><td>". $row["twentyfive_to_fortyfour"] . "</td><td>" . $row["fortyfive_to_sixtyfour"] . "</td><td>" . $row["over_sixtyfive"] . "</td></tr>";
            		}
            		 echo "
            		   </tbody>
            		   </table>";
                	} else {
                		echo "0 records to show";
                	} 
                  
                  // DELETE
			      $record_id = $_POST["record_id"];
			      
                  $stmt = $conn->prepare("DELETE FROM mortality_report WHERE record_id = ?");
                  $stmt->bind_param("i", $record_id);
                    if( $stmt->execute()){
                        echo"<p style = \"margin-left:20px;font-weight:bold\">Delete Succesful!</p>See your changes reflected by searching above or on the 'SELECT' tab.";
                    }else{
                        echo "<p style = \"margin-left:20px;font-weight:bold\">Delete failed! Please try again.</p>";
                    }
                        
                  $stmt->close();
                ?>
            </div>
			
			<?php make_footer() ?>
			<?php $conn->close(); ?>
        </div>  
        
    
</div>
<script type="text/javascript">
    $('#nav').spasticNav();
</script>
</body>
</html>