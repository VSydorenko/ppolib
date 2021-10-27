<?php

namespace   PPOLib ;

use \PPOLib\Algo\Hash ; 
 
 // вспомагательный функции
class Util
{

    public static function hex2array($hex, $to8 = false) {
        $s = str_split($hex, 2);
        $a = array();
        for ($i = 0; $i < count($s); $i++) {
            $a[$i] = hexdec($s[$i]);
        }
        if ($to8) {
            $c = 8 - count($a) % 8;

            for ($i = 0; $i < $c; $i++) {
                $a = array_merge($a, array(0));
            }

        }

        return $a;
    }


    public static function array2hex($a) {
      
         $ss = "";
         foreach($a as $v){
            $ss .= sprintf("%02X", $v);
            
         }
        return $ss;
    }

    //аналог >>>
    public static function rrr($a, $b) {
        if ($b >= 32 || $b < -32) {
            $m = (int)($b / 32);
            $b = $b - ($m * 32);
        }

        if ($b < 0) {
            $b = 32 + $b;
        }

        if ($b == 0) {
            return (($a >> 1) & 0x7fffffff) * 2 + (($a >> $b) & 1);
        }

        if ($a < 0) {
            $a = ($a >> 1);
            $a &= 0x7fffffff;
            $a |= 0x40000000;
            $a = ($a >> ($b - 1));
        } else {
            $a = ($a >> $b);
        }
        return $a;
    }


    public static function str2array($str, $to8 = false) {
        $a = unpack('C*', $str);

        if ($to8) {
            $c = 8 - count($a) % 8;

            for ($i = 0; $i < $c; $i++) {
                $a = array_merge($a, array(0));
            }

        }
        return $a;
    }


    public static function alloc($length,$v=0) {
        $a = array();
        for ($i = 0; $i < $length; $i++) {
            $a[$i] = $v;
        }
        return $a;
    }

    public static function bstr2array($str, $to8 = false) {
        $a = array();
        foreach (str_split($str, 1) as $c) {
         
            $a[] = ord($c);
        }

        if ($to8) {
            $c = 8 - count($a) % 8;

            for ($i = 0; $i < $c; $i++) {
                $a = array_merge($a, array(0));
            }

        }
        return $a;
    }

    public static function  array2bstr($array ) {
    
        $bstr  = pack('H*',Util::array2hex($array)  );; 
        return $bstr;
    }
    
  
    /*
    
    public static function convert_password($pass,$n=10000){
        $data = Util::str2array($pass)   ;
        $hash = new Hash();
        $hash->update($data);

        $ret = $hash->finish();
        $n--;
        while($n--){
          $hash = new Hash();
          $hash->update32($ret);

          $ret = $hash->finish();
            
        }
        return $ret;
    }   
    */
    
    public  static  function invert($in){
      
      $ret = array();
        for ($i = count($in) - 1; $i >= 0; $i--) {
            $cr = $in[$i];
            $cr = (
                $cr >> 7          | ($cr >> 5) &  2 | ($cr >> 3) &  4 | ($cr >> 1) & 8
                | ($cr << 1) & 16 | ($cr << 3) & 32 | ($cr << 5) & 64 | ($cr << 7) & 128
            );
            $ret[]=$cr;
        }   
        
        return  $ret;   
    }
    public  static  function addzero($in,$reorder=false){
 
        $ret = array();

       
        if ($reorder !== true) {
            $ret[]=0;
        }
        for ($i = 0; $i < count($in); $i++) {
            $ret[]=$in[$i];
        }

        if ($reorder === true) {
            $ret[]=0;
            $ret = array_reverse($ret) ;
        }
        return $ret;       
    }
    
    
}

