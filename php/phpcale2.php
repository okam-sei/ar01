<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>カレンダー</title>
<style type="text/css">
    .frame-box{width:600px;}
    .calender-box{width:300px;float:left;}
    .diary-box{margin-top:50px;width:280px;float:right;}
    .diary-date{font-size:9pt;}
    .calendar{float:left;margin:4px}
    .calendar * {text-align: center;font-size:9pt;}
    .calendar {border:solid 1px #a9a9a9;width:280px;}
    .calendar caption{border:solid 1px #a9a9a9;border-bottom:none;background:#c0c0c0;}
    .calendar td.today{background:#c0c0c0;}
    .calendar td{border:solid 1px #a9a9a9;width:70px;height:40px;}
    .calendar .sat{color:#4169e1}
    .calendar .sun{color:#ff0000;}
</style>
</head>
<body>

<?php
  date_default_timezone_set('Asia/Tokyo');

  if(isset($_POST["select_year"])){
      $year=$_POST["select_year"];
  }else{
      $year=date("Y");
  }

  if(isset($_POST["select_month"])){
        $month=$_POST["select_month"];
    }else{
        $month=date("n");
    }

    $tableTitle=$year . "年" . $month . "月";
    $captionHtml = "<caption>" . $tableTitle . "</caption>" . "\n";

  $firstDay = date("w",mktime(0,0,0,$month,1,$year));
  $lastDate = date("t",mktime(0,0,0,$month,1,$year));

  $weekDays=["日","月","火","水","木","金","土",];


  //曜日の表示
  $weekDayStr="<tr>";
  for($i=0;$i<7;$i++){
      if($i==0){
          $weekDayStr .="<td class='sun'>" . $weekDays[$i] . "</td>";
      }else if($i==6){
          $weekDayStr .= "<td class='sat'>" . $weekDays[$i] . "</td>";
      }else{
          $weekDayStr .= "<td>"  .$weekDays[$i] . "</td>";
      }
  }
  $weekDayStr .= "</tr>" . "\n";


    //日付の表示
    //1日目まで空白
  for($i=0;$i<$firstDay;$i++){
      if($i==0){
          $htmlStr .= "<tr>" ;
      }
      $htmlStr .= '<td>&nbsp;</td>';
  }

  for($i=1;$i<=$lastDate;$i++){
      $weekDay=date("w",mktime(0,0,0,$month,$i,$year));
      $cellStr="" . $i . "";
      
      if($weekDay==0){
          $htmlStr.="<tr><td class='sun'>";
      }else if($weekDay==6){
          $htmlStr.="<td class='sat'>";
      }else{
          $htmlStr.="<td>";
      }

      $htmlStr.=$cellStr . "</td>";
      
      if($weekDay==6){
          $htmlStr.="</tr>\n";
      }
  }

  $tableHtml="<table>" . $captionHtml . $weekDayStr . $htmlStr . "</table>";
  echo "\n<div class='calendar'>\n";
  echo $tableHtml;
  echo "\n</div>\n"
?>
<form method="POST" action="PHP2.php">
<select name="select_year">
    <option value="2018">2018年</option>
    <option value="2019">2019年</option>
    <option value="2020">2020年</option>
</select>
<select name="select_month">
    <option value="1">1月</option>
    <option value="2">2月</option>
    <option value="3">3月</option>
</select><br>
<input type="submit" value="カレンダーの表示">
</form>
</body>
</html>