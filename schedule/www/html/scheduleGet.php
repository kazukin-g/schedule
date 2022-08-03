<?php
    require_once("./tmp.php");

    if(isset($_GET["year"]) && isset($_GET["month"]) && isset($_GET["day"])){
        try{
            $pdo = sqlConnect();
            $sql = "select * from schedule where month = ". $_GET["month"] ." and year = ". $_GET["year"] ." and day = ". $_GET["day"] .";";
            $prepare = $pdo->prepare($sql);
            $prepare->execute();
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
            $pdo = "";
        } catch(PDOException $e){
            print($e);
        }
        
        header("Content-Type: application/json");
        if(isset($_SESSION["user"])){
            $result += ["user" -> $_SESSION["user"]];
        }
        $json_array = json_encode($result);
        print($json_array);
    }
?>