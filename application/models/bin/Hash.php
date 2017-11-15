<?php

class Hash {

    /**
     *
     * @param string $algorithm The algorithm (md5, sha1, whirlpool, etc)
     * @param string $data The data to encode
     * @param string $salt The salt (This should be the same throughout the system probably)
     * @return string The hashed/salted data
     */
    public static function create($algorithm, $data, $salt) {

        $context = hash_init($algorithm, HASH_HMAC, $salt);
        hash_update($context, $data);

        return hash_final($context);
    }

    public static function whirlpool($data) {
        return Hash::create("whirlpool", $data, true);
    }

    public static function md5($data) {
        return Hash::create("md5", $data, true);
    }

    public static function sha1($data) {
        return Hash::create("sha1", $data, true);
    }

    public static function getTimeStamp($date) {
        $date = date_create($date);
        $date = date_format($date, "Y-m-d H:i:s");
        return strtotime($date) * 1000;
    }

    public static function getDate() {
        return date("Y-m-d H:i:s");
    }

    public static function betweenHoras($hms_inicio, $hms_fin, $hms_referencia = NULL) {
        if (is_null($hms_referencia)) {
            $hms_referencia = date('G:i:s');
        }

        list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_inicio), 3, 0);
        $s_inicio = 3600 * $h + 60 * $m + $s;

        list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_fin), 3, 0);
        $s_fin = 3600 * $h + 60 * $m + $s;

        list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_referencia), 3, 0);
        $s_referencia = 3600 * $h + 60 * $m + $s;

        if ($s_inicio <= $s_fin) {
            return $s_referencia >= $s_inicio && $s_referencia <= $s_fin;
        } else {
            return $s_referencia >= $s_inicio || $s_referencia <= $s_fin;
        }
    }

}
