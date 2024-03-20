<?php
namespace App\Orangebd;
class Utility
{
    private static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    private static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    private static $enMonth = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10","11","12");
    private static $bnMonth = array("জানুয়ারি", "ফেব্রুয়ারী ", "মার্চ ", "এপ্রিল ", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বর", "অক্টোবর ","নভেম্বর","ডিসেম্বর");

    public static  function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }

    public static function enMonth2bnMonth($strMonth) {
        return str_replace(self::$enMonth, self::$bnMonth, $strMonth);
    }

    public static function getTodayDateEnToBnMonth()
    {
        $month = date("m"); $day = date("d"); $year = date("Y");
        $banMonth = self::enMonth2bnMonth($month);
        $banDay = self::en2bn($day);
        $banYear = self::en2bn($year);
        return $banDay." ".$banMonth." ".$banYear;
    }

    public static function getTodayDateEnToBn()
    {
        $month = date("m"); $day = date("d"); $year = date("Y");
        $banMonth = self::en2bn($month);
        $banDay = self::en2bn($day);
        $banYear = self::en2bn($year);
        return $banDay."-".$banMonth."-".$banYear;
    }

    public static function getTodayDate(){
        $month = date("m"); $day = date("d"); $year = date("Y");
        $today_date = $year . '-' . $month . '-' . $day;
        return $today_date;
    }


    public static function getFullMonthTodayDateEn(){
        $month = date("F"); $day = date("d"); $year = date("Y");
        $today_date = $day . '-' . $month . '-'.$year;
        return $today_date;
    }

    // public function packageDateBangla()
    // {
    //     bangla_date(time()) // OUTPUT ১২ চৈত্র ১৪২৫
    //     bangla_date(time(),"en") // OUTPUT ২৬ মার্চ ২০১৯
    //     bangla_date(time(),"bn") // OUTPUT ১২ চৈত্র ১৪২৫
    //     bangla_date(time(),"bn","d-m-y") // OUTPUT  ১২-চৈত্র-১৪২৫
    // }

    // public static function getTodayBanglaDate()
    // {
    //     return bangla_date(time(),"bn");
    // }

}