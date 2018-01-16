<?PHP
session_start();
include_once("db.php");
    $_SESSION["userID"] = $_GET['uid'];

	$sql = "SELECT * FROM mrt_database.users WHERE ID = '".$_GET['uid']."'";
	$result = $db->query($sql);
	$rowUser = $result->fetch_assoc();
	
	$sql = "SELECT * FROM mrt_database.resetUsers WHERE userID = '".$_GET['uid']."'";
	$result = $db->query($sql);
	$rowkey = $result->fetch_assoc();
	
	if ($_GET['key'] == $rowkey['keyValue']){
	    echo '<html>
	            <body>
                    <div>
                        <p> Welcome '.$rowUser['username'].'!</p>
                        <p>Enter New Password Below</p>
                        <form method="post" class="modal-content animate" action="changePassword.php">
							<div style="padding: 16px;">
								<label><b>Password</b></label><br>
								<input type="password" placeholder="Enter Password" name="password" required><br><br>
								<input type="submit" name = "login" value="Reset Password" class="loginButton">
							</div>
						</form>
                        </div>
                    </body>
                </html>';
	}
	else{
	   	    echo "<html>
	                <body>
                        <div>
                            <p style='color:red;'>Invalid Request</p>
                        </div>
                    </body>
                </html>";
	}
	
?>