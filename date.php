<?php

require_once 'classes/classes.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo 'Подсчитать разницу между 2-мя входными датами без использования любых PHP-функций, связанных с датой.
Входящие данные:
2 даты в формате «YYYY-MM-DD» (2015-03-05, например)
Исходящие данные:
stdClass {
int $years, Кол-во лет между датами
int $months, Кол-во месяцев между датами
int $days, Кол-во дней между датами
int $total_days, Общее кол-во дней между двумя датами 
bool $invert true — если дата старта > дата конца
}

БЕЗ использования любых фреймворков, только чистый PHP
Без использования класса DateTime<br>';

    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    var_dump($date1);
    echo '<br>';
    var_dump($date2);
    echo '<br>';
  // $obDate = new Dates($date1, $date2);
   //var_dump($obDate->getDates1());
   echo '<br>';
   //var_dump($obDate->getDates2());

   //$lolY = $obDate ->getYears();
  // $lolM = $obDate ->getMonth();
  // $lolD = $obDate ->getDays();

    echo '<br>Кол-во лет между датами  ';
    //var_dump($lolY);
    echo '<br>Кол-во месяцев между датами  ';
   // var_dump($lolM);
    echo '<br>Кол-во дней между датами  ';
   // var_dump($lolD);








}


?>