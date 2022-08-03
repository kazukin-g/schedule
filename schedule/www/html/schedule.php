<?php
    session_start();
    require_once("./tmp.php");
    require_once("./calendar.php");
    tmpTop("スケジュール帳");
    //var_dump($_SESSION["name"]);

    $month = intval(date("n"));
    $year = intval(date("Y"));
    if(isset($_GET["month"]) && isset($_GET["year"])){
        $month = intval($_GET["month"]);
        $year = intval($_GET["year"]);
    }
    $calendar = new Calendar($month, $year);
    print("<input type=\"hidden\" id=\"user\" value=\"". $_SESSION["user"] ."\">");
?>

<div class="calendar">
    <form action="" id="monthCalendar">
        <?php $calendar->show(); ?>
    </form>
</div>
<div class="plans">
    <h2 id="days"></h2>
    <div id = "text"></div>
</div>

<script src="./schedule.js"></script>
<?php
    tmpButtom();
?>