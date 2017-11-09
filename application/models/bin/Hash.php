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

}
