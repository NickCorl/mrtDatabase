<?php
session_start();
include_once("mrt/db.php");

$sql = "SELECT  ID, username, email FROM users WHERE username = '".$_GET['username']."';";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$randomKey = rand(1000, 1000000);
if (!isset($row)) {
   header('Location: forgotPassword.php?usernameExists=0');
}
else{
    //LINK TO RESET PASSWORD ********NEED TO CHANGE TO DOMAIN OF REAL SERVER! ***********
 $resetPassLink = 'https://web-programming-finalproject-rfast077.c9users.io/MRT/mrt/resetPassword.php?key='.$randomKey.'&uid='.$row['ID'];

 
 //We need to check if this particular user already made a request, if he/she did reset it.
 $sql = "DELETE FROM resetUsers WHERE userID=".$row['ID'].";";
 mysqli_query($db, $sql);
 
 //update the table with the ID and generated key!
 $sql = "INSERT INTO resetUsers (userID, keyValue) VALUES (".$row['ID'].", $randomKey);";
 mysqli_query($db, $sql);
 
//CRADENTIALS FOR SENDING EMAIL
$to = $row['email'];
$subject = "Password Update Request";
$mailContent = 'Hello '.$row['username'].', 
    <br/>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
    <br/>To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
    <br/><br/>Regards,
    <br/>CodexWorld';
    //set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    //additional headers
    $headers .= 'From: MRT Database <sender@mrt.com>' . "\r\n";

 mail($to,$subject,$mailContent,$headers);
 
 // TEST IS EMAIL WAS CORRECTLY SENT
 if(@mail($to, $subject, $mailContent, $headers))
{
  echo "Mail Sent Successfully";
  echo '<div><a href = "index.php"> Click Here </a> to return to home page.</div>';
}else{
  echo "Mail Not Sent";
}

}


?>