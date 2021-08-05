<?php
    session_start();

    $username = "";
    $password = "";

    $msg = "";

    if(isset($_POST["username"]))
        $username = $_POST["username"];
    if(isset($_POST["password"]))
        $password = $_POST["password"];
    
    if($username != "" && $password != ""){
        $db = mysqli_connect("localhost", "root", "A12345678");
        mysqli_select_db($db, "login");

        $sql = "SELECT * FROM users WHERE password = '" . $password . "' AND username = '" . $username . "'";
        $rows = mysqli_query($db, $sql);

        if(mysqli_fetch_row($rows) != false){
            $_SESSION["login_session"] = true;
            $_SESSION["username"] = $username;
            header("Location:index.php");
        }
        else
            $msg = "使用者名稱或密碼錯誤！";
        
        mysqli_close($db);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入畫面</title>
</head>
<body>
    <form action="login.php" method="post">
        <h1>登入網站</h1>
        <input type="text" name="username" id="username" placeholder="USERNAME"/>
        <input type="text" name="password" id="password" placeholder="PASSWORD"/>

        <input type="submit" value="LOGIN">
    </form>

    <a href="register.php">NO ACCOUNT?</a>

    <?php echo "<br/>" . $msg; ?>
</body>
</html>