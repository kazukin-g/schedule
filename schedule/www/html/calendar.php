<?php

class Calendar{
    private $year;
    private $month;
    private $days;
    private $week = ["日", "月", "火", "水", "木", "金", "土"];
    private $first;  // 1日目の曜日（数字）
    private $whatWeek = 0; // 何曜日かを数字で表す。（例：日曜日＝０、土曜日＝６）

    public function __construct($month, $year){
        $this->year = $year;
        $this->month = $month;
        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->first = date("w", mktime(0, 0, 0, $month, 1, $year));
    }

    public function getYear(){
        return $this->year;
    }

    public function getMonth(){
        return $this->month;
    }

    public function show(){
        print("<h2><span id=\"year\">". $this->year ."</span>年<span id=\"month\">". $this->month ."</span>月のカレンダー</h2>");
        print("<table class=\"month\"><thead><tr>");
        foreach($this->week as $day){
            $this->isHoliday($day, "th");
        }
        print("</tr></thead><tbody>");
        print("<tr>");
        for($i = 0; $i < $this->first; $i++){
            $this->isHoliday("", "td");
        }
        for($i = 1; $i <= $this->days; $i++){
            $str = "<input type=\"radio\" class=\"radio\" name=\"month\" id=\"". $i ."\" value=\"". $i ."\"><label for=\"". $i ."\">". $i ."</label>";
            $this->isHoliday($str, "td");
        }
        for($i = $this->whatWeek; $i <= 6; $i++){
            $this->isHoliday("", "td");
        }
        print("</tbody></table>");
    }

    private function isHoliday($i, $tag){
        if($this->whatWeek === 0){
            print("<". $tag ." class=\"sanday\">". $i ."</". $tag .">");
            $this->whatWeek++;
        } else if($this->whatWeek === 6){
            print("<". $tag ." class=\"saturaday\">". $i ."</". $tag ."></tr><tr>");
            $this->whatWeek = 0;
        } else {
            print("<". $tag .">". $i ."</". $tag .">");
            $this->whatWeek++;
        }
    }
}

?>