<?PHP
session_start();
include_once("db.php");

$userID = $_SESSION["userID"];
$password = $_POST["password"];
echo $password;
echo $userID;

$sql = "UPDATE users SET password = '".hash('md5', $password)."' WHERE ID = $userID;";
echo $sql;
mysqli_query($db, $sql);


$sql = "DELETE FROM resetUsers WHERE userID=$userID;";
mysqli_query($db, $sql);
?>

<html>
    <p>Password has been updated!<br> To return to login click below.</p>
    
    <a href="../index.php"> Click Here</a>
    

    
</html>