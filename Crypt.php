<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 11/4/16
 * Time: 5:20 PM
 */

namespace crypto;

class Crypt {

    /**
     * Generates a secure random number
     * @param int $min the inclusive lower bound of the randomly generated number
     * @param int $max the inclusive upper bound of the randomly generated number
     * @return int a randomly generated number.
     */
    public static function randInt(int $min, int $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    /**
     * Generates a secure random string
     * @param int $length the length of the randomly generated token..
     * @return string the generated token
     */
    public static function randString(int $length=30){
        $token = "";
        $code_alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code_alphabet .= "abcdefghijklmnopqrstuvwxyz";
        $code_alphabet .= "0123456789";
        for($i=0; $i<$length; $i++) {
            $token .= $code_alphabet[self::randInt(0, strlen($code_alphabet) - 1)];
        }
        return $token;
    }
}