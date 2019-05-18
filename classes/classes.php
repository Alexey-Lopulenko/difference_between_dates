<?php
class Dates{
   private $dates1;
   private $dates2;
   private $years;
   private $month;
   private $days;
   private $total_days;

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
    {
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

    private function setYears($start_date, $end_date){

        if($end_date[2] < $start_date[2]) {

            $end_date[1] = $end_date[1] -1;

            if($end_date[1] < $start_date[1]) {

                $end_date[0] = $end_date[0] - 1;

                $years = $end_date[0] - $start_date[0];

                $this->years = $years;
            }

        }
        else{
            $years = $end_date[0] - $start_date[0];
            $this->years = $years;

        }
    }

    private function setMonth($start_date, $end_date){
        if ($end_date[2] < $start_date[2]){                       //DUDE, FIX THIS!!!!!!!!!!!!!

            $end_date[1] = $end_date[1] -1;

            $month = $end_date[2] - $start_date[2];
            $this->month = $month;
        }
        elseif($end_date[2] = $start_date[2]){
            $month = $end_date[2] - $start_date[2];
            $this->month = $month;
        }

        else{
            $month = $end_date[2] - $start_date[2];
            $this->month = $month;
            $this->month = $month;

        }

    }

    private function setDays($start_date, $end_date){
        if ($end_date[2] < $start_date[2]){
            if($this->leap_year($start_date) && $start_date[1] == 2){
                $day = 29 -($start_date[2] - $end_date[2]);
                $this->days = $day;

            }
            else{
                $day = $this->getArrMonth($start_date[1]) -($start_date[2] - $end_date[2]);
                $this->days = $day;
            }


        }
        else{
            $day = $end_date[2] - $start_date[2];
            $this->days = $day;
        }

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

    //$this->setYears($this->getDates2(), $this->getDates1());
    //$this->setMonth($this->getDates2(), $this->getDates1());
    //$this->setDays($this->getDates2(), $this->getDates1());



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

           if($this->leap_year($date)){//если год высокосный
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
   public function str_in_int($date_arr){
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
     * @return bool
     */
    private function leap_year($year){

        $year = $year[0];
        $arrEnd = (int)$year % 10;
        if($arrEnd == 4||$arrEnd==8||$arrEnd==2||$arrEnd==0 ||$arrEnd==6){
            return true;
        }
        else {return false;}

    }

}

?>