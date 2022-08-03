<?php

function sqlConnect(){
    $dsn = "mysql:host=schedule_db;dbname=ol4m4_schedule";
    $user = "ol4m4_schedule";
    $password = "schedule@0501";

    try{
        $pdo = new PDO($dsn, $user, $password);
        return $pdo;
    } catch(PDOException $e){
        print($e);
    }
}

function tmpTop($title){
    $str = <<<DOM
<!DOCTYPE html><html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/schedule.css">
    <title>{$title}</title>
</head>
<body>
DOM;
    print($str);
}

function tmpButtom(){
    $str=<<<DOM
</body>
</html>
DOM;
    print($str);
}

function arrayCount($array){
    if(is_array($array)){
        return count($array);
    } else {
        return 0;
    }
}

function login($name, $pass){
    try{
        $pdo = sqlConnect();
        $sql = "select * from user where name = :name and pass = :pass;";
        $prepare = $pdo->prepare($sql);
        $prepare->bindValue(":name", $name, PDO::PARAM_STR);
        $prepare->bindValue(":pass", $pass, PDO::PARAM_STR);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        if(isset($result[0]["name"])){
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e){
        print($e);
    }
}

?>