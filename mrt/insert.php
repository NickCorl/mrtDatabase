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
<title>MRT | Insert</title>
<?php require_once('../scripts/base.php'); ?>
		<?php base_header_internal() ?> 
</head>

		<?php make_nav(3) ?>
<body>
<div class="container">



		


		
           
		<div id="main">
        <div class="content noLine"><span class="pageTitle">Insert Records</span><hr size="1"/></div>	
        
            
            
            <div class="content">
            <p>Use the form below to insert a record for a new or existing city into the database. <br />If the insertion was succesful or not you will be notified below</p>
            
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
                    
                    $doQuery = FALSE;
                    ?>
                   
                    <form method = "post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit = "<?php $doQuery = TRUE; ?>">
                        Year: <input type="number" name="year" min="1990" max="2017" value = "2016">
                        State Code: <select id = "state" name = "state">
                        <!-- Populating the options with only the state codes currently in the database -->
                            <?php
                            
                            $sql = "SELECT DISTINCT State FROM mortality_report";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                    		// output data of each row
                    		while($row = $result->fetch_assoc()) {
                                    echo "<option value=\"" . $row["State"] . "\">" . $row["State"] . "</option>";
                    		}
                        	} else {
                        		echo "0 records in the database";
                        	}  
                            ?>
                        </select>
                        City: <input type="text" name="city" value = "<?php echo $city;?>"/>
                        <br /><br />
                        
                        Mortality Statistics: <br />
                    	Younger than 1: <input type="number" name="less_than_one" min="0" value = "0"><br />
                    	1 to 24: <input type="number" name="one_to_twentyfour" min="0" value = "0"><br />
                    	25 to 44: <input type="number" name="twentyfive_to_fourtyfour" min="0" value = "0"><br />
                    	45 to 64: <input type="number" name="fortyfive_to_sixtyfour" min="0"  value = "0"><br />
                    	65+: <input type="number" name="over_sixtyfive" min="0" value = "0"><br />
                        <br />
                        <input type="submit" value="Submit"/>
                    </form>
                </div>
            
            </div>

			    <?php
			    
			    if($doQuery){
			      $year = $_POST["year"];
			      $region_id  = 1;
			      $state = $_POST["state"]; 
			      $city = $_POST["city"]; 
			      $less_than_one = $_POST["less_than_one"];
			      $one_to_twentyfour = $_POST["one_to_twentyfour"];
			      $twentyfive_to_fourtyfour = $_POST["twentyfive_to_fourtyfour"]; 
			      $fortyfive_to_sixtyfour = $_POST["fortyfive_to_sixtyfour"]; 
			      $over_sixtyfive = $_POST["over_sixtyfive"];
			      
			      if($less_than_one !== 0 || $one_to_twentyfour !== 0 || $twentyfive_to_fourtyfour !== 0 || $fortyfive_to_sixtyfour !== 0 || $over_sixtyfive !== 0){
                        $stmt = $conn->prepare("INSERT INTO mortality_report (year, Region_id, State, City, less_than_one, one_to_twentyfour, twentyfive_to_fortyfour, fortyfive_to_sixtyfour, over_sixtyfive)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("iissiiiii", $year, $region_id, $state, $city, $less_than_one, $one_to_twentyfour, $twentyfive_to_fourtyfour, $fortyfive_to_sixtyfour, $over_sixtyfive);
                        if( $stmt->execute()){
                            echo"<p style = \"margin-left:20px;font-weight:bold\">Insert Succesful!</p>";
                        }else{
                             echo "<p style = \"margin-left:20px;font-weight:bold\">Insert failed! Please try again.</p>";
                        }
                        
                        $stmt->close();
			      }
			      
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