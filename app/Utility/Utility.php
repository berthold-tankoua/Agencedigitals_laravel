<?php
namespace App\Utility;
use App\Models\Currency;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Utility{

    public static function number_format_short( $n, $precision = 1 ) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

      // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
      // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }

        return $n_format . $suffix;
    }

    public static function currency_load(){
        if(session()->has('system_default_currency_info')==false){
            session()->put('system_default_currency_info', Currency::find(4));
        }
    }

    public static function currency_converter($amount){
     return self::convert_price($amount);
    }

    public static function convert_price($price_val){
        Utility::currency_load();
        $system_default_currency_info=session('system_default_currency_info');
        if (Session::has('currency_exchange')) {
            $exchange = session('currency_exchange');
        }else{
            $exchange = $system_default_currency_info->exchange_rate;
        }
        $price = intval($price_val)*$exchange;
        $retVal = ($system_default_currency_info->code=='XAF') ? number_format($price, 0, ',', ' ') : number_format($price, 1, ',', ' ') ;
        return $retVal;
    }

    public static function rounded_price($price_val){
        $price = $price_val;
        return number_format($price, 2);
    }

    public static function currency_symbol(){
        Utility::currency_load();
        $system_default_currency_info=session('system_default_currency_info');
        if (Session::has('currency_symbol')) {
            $symbol = session('currency_symbol');
        }else{
            $symbol = $system_default_currency_info->symbol;
        }
        return $symbol;
    }

    public static function currency_code(){
        Utility::currency_load();
        $system_default_currency_info=session('system_default_currency_info');
        if (Session::has('currency_code')) {
            $code = session('currency_code');
        }else{
            $code = $system_default_currency_info->code;
        }
        return $code;
    }

    public static function get_price($amount): float {
        Utility::currency_load();
        $system_default_currency_info = session('system_default_currency_info');
        $exchange = session('currency_exchange') ?? $system_default_currency_info->exchange_rate;

        $price = floatval($amount)*floatval($exchange);

        // Arrondi selon la devise, sans formater en string
        return ($system_default_currency_info->code == 'XAF') ? round($price, 0) : round($price, 1);
    }

    public static function specific_currency_convert($currency,$amount){

        $system_default_currency_info = session('system_default_currency_info');
        $currency=Currency::where('code',$currency)->first();
        $exchange = $currency->exchange_rate;

        $price = floatval($amount)*floatval($exchange);
                // Arrondi selon la devise, sans formater en string
        return ($system_default_currency_info->code == 'XAF') ? round($price, 0) : round($price, 1);
    }

    public static function language_load(){
        if(session()->has('system_lang_name')==false){
            session()->put('system_lang_name', 'Francais');
            session()->put('system_lang_code', 'fr');
            session()->put('system_lang_icon', 'flag-icon-fr');
        }
    }
}
