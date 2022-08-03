<?php
    session_start();
    require_once("./tmp.php");

    if(isset($_POST["name"]) && isset($_POST["pass"])){
        if(login($_POST["name"], $_POST["pass"])){
            $_SESSION["user"] = $_POST["name"];
            header("Location: ./schedule.php");
            exit;
        } else {
            print("<p>ログインできません。ユーザー名、パスワードを確認してください。</p>");
        }
    }

    tmpTop("サインイン");
?>

<h1>スケジュール帳</h1>
<form action="index.php" method="post">
    <p>ユーザー名：<input type="tel" name="name" id="name"></p>
    <p>パスワード：<input type="password" name="pass" id="pass"></p>
    <input type="submit" value="ログイン">
</form>

<?php
    tmpButtom();
?>