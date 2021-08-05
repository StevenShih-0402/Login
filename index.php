<?php
    $msg = "";

    session_start();
    if($_SESSION["login_session"] != true)
        header("Location:login.php");
    else
        $msg = "歡迎使用者 " . $_SESSION["username"] . " 進入網站<br/>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
</head>
<body>
    <?php echo $msg; ?>
    <a href="login.php">登出</a>
</body>
</html>