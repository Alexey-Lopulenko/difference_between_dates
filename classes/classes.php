<?php
class Dates{
    private $dates1;// start date
    private $dates2;// end date
    private $years;//Кол-во лет между датами
    private $month;//Кол-во месяцев между датами
    private $days;//Кол-во дней между датами
    private $total_days;//Общее кол-во дней между датами

    private $arrMonth = [1 => 31, 28, 31, 30, 31,30, 31, 31, 30, 31, 30, 31];

    public function set_Dates1($dates1){
        $this->dates1 = $dates1;
    }

    public function setDates2($dates2)
    {
        $this->dates2 = $dates2;
    }

    /**
     * @return array
     */
    public function getArrMonth($index_array)
    {if($index_array >12){
        $index_array = $index_array - 12;
    }
        return $this->arrMonth[$index_array];
    }

    /**
     * @return array
     */
    public function getDates1()
    {
        return $this->dates1;
    }

    /**
     * @return array
     */
    public function getDates2()
    {
        return $this->dates2;
    }

    /**
     * @return array
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @return array
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return array
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param $start_date
     * @param $end_date
     */
    private function setYears($start_date, $end_date){


        if($end_date[0] == $start_date[0]){
            $years = 0;
            $this->years = $years;
        }
        elseif($end_date[0] > $start_date[0] && $end_date[1] > $start_date[1]){
            $years = $end_date[0] - $start_date[0];
            $this->years = $years;

        }
        elseif($end_date[2] < $start_date[2] || $end_date[1] < $start_date[1]) {


            $end_date[0] = $end_date[0] - 1;
            $years = $end_date[0] - $start_date[0];
            $this->years = $years;


        }


    }

    /**
     * @param $start_date
     * @param $end_date
     */

    private function setMonth($start_date, $end_date){
        if($end_date[2] < $start_date[2]) {
            $end_date[1] = $end_date[1] - 1;
        }
        if ($end_date[1] < $start_date[1]){

            if( $end_date[0] > $start_date[0]){
                $month = (12 - $start_date[1]) + $end_date[1];
                $this->month = $month;
            }


        }


        else{
            $month = $end_date[1] - $start_date[1];
            $this->month = $month;


        }

    }

    /**
     * @param $start_date
     * @param $end_date
     */
    private function setDays($start_date, $end_date){
        if($end_date[2] >= $start_date[2]){
            $day = $end_date[2] - $start_date[2];
            $this->days = $day;
        }

        elseif ($end_date[2] < $start_date[2]){
            if($this->leap_year($end_date[0]) ==1 && $end_date[1] == 3 ){
                $day = 29 -($start_date[2] - $end_date[2]);
                $this->days = $day;

            }
            else{
                $month = $this->getArrMonth($end_date[1]-1);

                $day = $month -($start_date[2] - $end_date[2]);
                $this->days = $day;
            }


        }


    }

    /**
     * @param $start_date
     * @param $end_date
     */
    public function setTotal_days($start_date , $end_date){


        $years_in_daysys = 0;
        $months_in_daysys = 0;



        if($this ->getYears() != 0){

            for($i = $start_date[0] ; $i < $start_date[0] + $this->getYears(); $i++){


                if($this->leap_year($i) == 1){

                    $years_in_daysys += 366;
                }
                else {
                    $years_in_daysys += 365;
                }
            }

        }
        else{
            $years_in_daysys = 0;
        }


        if($this->getMonth() != 0){

            if($this->leap_year($start_date[0]) == 1 && $start_date[1] <=2 ||
                $this->leap_year($end_date[0]) == 1  && $end_date[1] > 2  ){
                $months_in_daysys += 1;
                for($i = $start_date[1]; $i < $start_date[1] + $this->getMonth(); $i++ ){
                    $months_in_daysys += $this-> getArrMonth($i);
                }

            } else{
                for($i = $start_date[1]; $i < $start_date[1] + $this->getMonth(); $i++ ){
                    $months_in_daysys += $this-> getArrMonth($i);
                }
            }


        }
        else{

            $months_in_daysys += 0;
        }


        $total = $years_in_daysys + $months_in_daysys + $this-> getDays();
        $this->total_days = $total;
    }

    /**
     * @return int
     */
    public function getTotal_days(){
        return $this->total_days;
    }



    /**
     * dates constructor.
     * @param $date_str1
     * @param $date_str2
     */

    function __construct($date_str1, $date_str2)
    {
        $date1 = $this->validate_date($date_str1);
        $date2 = $this->validate_date($date_str2);


        if($date1 != NULL && $date2 != NULL){
            $this->set_Dates($date1, $date2);

        }else  echo 'Error! Fix date!';

        $this->setYears($this->getDates2(), $this->getDates1());
        $this->setMonth($this->getDates2(), $this->getDates1());
        $this->setDays($this->getDates2(), $this->getDates1());

        $this->setTotal_days($this->getDates2(), $this->getDates1());




    }




    /**
     * @param $date
     * @return array
     */
    public function validate_date($date){

        $pattern = "/^[0-9]{2,4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";//регулярное выражение для задание стандарта даты (YYYY-MM-DD)


        if(preg_match($pattern,$date)){ //соответсвие даты регулярному выражению



            $date = explode('-', $date);
            $date =  $this->str_in_int($date);

            if($this->leap_year($date[0])== 1){//если год высокосный
                if($date[2] <= 29){      //если установлен второй месяц то число дней должно быть (<=29)
                    return $date;

                }

            }
            elseif ($date[2] <= $this->getArrMonth($date[1])){
                return $date;

            }
            else{
                $date = NULL;
                return $date;
            }

        }
    }


    /**
     * @param $date_arr(str)
     * @return array(int)
     */
    public function str_in_int($date_arr){//первод строки в массив(int)
        for($i = 0; $i < 3;$i++){
            $date_arr[$i] = (int)$date_arr[$i];

        }
        return $date_arr;
    }


    /**
     * @param $dat1
     * @param $dat2
     */
    public function set_Dates($dat1, $dat2){        //$dates1 - start date  , $dates2 - end date
        if($dat1[0] <= $dat2[0]){
            if ($dat1[1] <= $dat2[1] || $dat1[0] < $dat2[0]) {
                if ($dat1[2] <= $dat2 || $dat1[1] < $dat2[1] || $dat1[0] < $dat2[0]) {

                    $this->set_Dates1($dat2);
                    $this->setDates2($dat1);
                }
            }

        }
        elseif ($dat1 == $dat2){

            echo '<br>Error!Dates are the same!<br>';
        }
        else {
            $this->set_Dates1($dat1);
            $this->setDates2($dat2);
        }

    }


    /**
     * @param $year
     * @return int
     */
    public function leap_year($year){//проверка является ли год высокосным

        return date("L", mktime(0,0,0, 7,7, $year));
    }




}

?>