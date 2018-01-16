<?php
session_start();
?>
<h2>Enter the username of Your Account to Reset New Password</h2>
<div class="container">
    <div class="regisFrm">
        <form action="sendEmail.php" method="get">
            <input type="username" name="username" placeholder="Provide an username" required="">
            <span class="send-button">
                <input type="submit" name="forgotSubmit" value="Submit">
            </span>
        </form>
        <?PHP if ($_GET['usernameExists'] == 0){
            echo "<p style = 'color: 'red''> Username Does not exist </p>";
        }
        ?>
    </div>
</div>