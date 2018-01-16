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
<title>MRT | Update</title>
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

		<?php make_nav(4) ?>

<body>
<div class="container">

		


		
           
		<div id="main">
        <div class="content noLine"><span class="pageTitle">Update Records</span><hr size="1"/></div>	

            
            
            <div class="content">
            <p>Use the form below to update an existing record for a city into the database. First search for a record you wish to update then use the feilds below to provide the new information<br />
            If the update was succesful or not you will be notified below</p>
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
                <span style = "font-weight:bold"> Update:</span><br />
                Record ID: <input type="number" name="record_id" min="0" value = "0" style="width: 60px;"><br />
                Year: <input type="number" name="year" min="1990" max = "2017" value = "2016"><br />
                Younger than 1: <input type="number" name="less_than_one" min="0" value = "0" style="width: 40px;">
                1 to 24: <input type="number" name="one_to_twentyfour" min="0" value = "0" style="width: 40px;">
            	25 to 44: <input type="number" name="twentyfive_to_fourtyfour" min="0" value = "0" style="width: 40px;">
                45 to 64: <input type="number" name="fortyfive_to_sixtyfour" min="0"  value = "0" style="width: 40px;">
                65+: <input type="number" name="over_sixtyfive" min="0" value = "0" style="width: 40px;"><br />
                <input type="submit" value="Submit"/>
                <br /><br />
            </form>
                </div>
            </div>
            
            <!-------------- Searach results ---------------------->
            <div class = "content">
                <?php
                    // Values that will be queried on
                    $year = $_POST["year"];
                    $city = $_POST["city"];
                    
                    $sql = "SELECT * FROM mortality_report WHERE year =" . $year . " AND city = '" . $city ."'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                    echo "<table id = \"t01\">
                    		<caption align=\"top\">Mortaltiy Records<br /> City:" . $city . "</caption>
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
                  
                  // UPDATE 
                  $year = $_POST["year"];
			      $less_than_one = $_POST["less_than_one"];
			      $one_to_twentyfour = $_POST["one_to_twentyfour"];
			      $twentyfive_to_fourtyfour = $_POST["twentyfive_to_fourtyfour"]; 
			      $fortyfive_to_sixtyfour = $_POST["fortyfive_to_sixtyfour"]; 
			      $over_sixtyfive = $_POST["over_sixtyfive"];
			      $record_id = $_POST["record_id"];
			      
                  $stmt = $conn->prepare("UPDATE mortality_report SET year = ?, less_than_one = ?, one_to_twentyfour = ?, twentyfive_to_fortyfour = ?, fortyfive_to_sixtyfour = ?, over_sixtyfive = ?
                                          WHERE record_id = ?");
                  $stmt->bind_param("iiiiiii", $year, $less_than_one, $one_to_twentyfour, $twentyfive_to_fourtyfour, $fortyfive_to_sixtyfour, $over_sixtyfive, $record_id);
                    if( $stmt->execute()){
                        echo"<p style = \"margin-left:20px;font-weight:bold\">Update Succesful!</p>See your changes reflected by searching above or on the 'SELECT' tab.";
                    }else{
                        echo "<p style = \"margin-left:20px;font-weight:bold\">Update failed! Please try again.</p>";
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