<?php
    $username = "";
    $email = "";

    $msg = "";

    if(isset($_POST["username"]))
        $username = $_POST["username"];
    if(isset($_POST["email"]))
        $email = $_POST["email"];

    if($username != "" && $email != ""){
        $db = mysqli_connect("localhost", "root", "A12345678");
        mysqli_select_db($db, "login");

        $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
        $rows = mysqli_query($db, $sql);

        if(mysqli_fetch_row($rows) == false){
            $password = rand(100000, 999999);
            $sql = "INSERT INTO users(username, password, email) VALUES ('$username', '$password', '$email')";
            mysqli_query($db, $sql) or die("SQL字串執行錯誤！");

            $msg = "使用者註冊成功！<br/>";
            $msg .= "使用者密碼： " . $password . "<br/>";
            $body = "使用者名稱： " . $username . "\r\n";
            $body .= "使用者密碼： " . $password . "\r\n";

            if(mail($email, "密碼通知", $body))
                $msg .= "寄送密碼通知到 " . $email . " 成功...<br/>";
            else
                $msg .= "寄送密碼錯誤！<br/>";
        }
        else
            $msg = "使用者名稱已經存在！<br/>";
        
        mysqli_close($db);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊帳號</title>
</head>
<body>
    <form action="register.php" method="post">
        <h1>註冊帳號</h1>
        <label for="user">使用者名稱：</label><input type="text" name="username" id="username"/><br/>
        <label for="mail">電子郵件：</label><input type="text" name="email" id="email"/><br/>
        
        <input type="submit" value="註冊會員"/>
    </form>

    <p>密碼將使用電子郵件寄出 <a href="login.php">登入網站</a></p>

    <?php echo $msg; ?>
</body>
</html>