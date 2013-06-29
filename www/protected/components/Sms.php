<?php

class Sms extends CComponent {

    const API_URL = 'http://smspilot.ru/api.php';
    const API_KEY = '53G63Q1PEI5O28D10J89HS394XJ4Z0OTQ91U5784Z3T9A82F7LCF756WH09UB522';

    public static function send($to, $message) {
        $url = self::API_URL . '?' . 'send=' . urlencode($message) . '&to=' . $to . '&from=thinktwice&apikey=' . self::API_KEY;
        $result = file_get_contents($url);
        if ( false === $result ) {
            return false;
        }
       return true;
    }

}
