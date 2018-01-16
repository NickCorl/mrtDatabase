<?php
session_start();
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
<title>Bye!</title>
</head>
<body>
<meta http-equiv="refresh" content="1;url=../index.php"/>

<?php setcookie($_SESSION['username'], "", time() - 3600); ?>

</form>
</body>
</html>