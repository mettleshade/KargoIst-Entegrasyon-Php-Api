<?php

// MEHMET PAÇAL /https://github.com/mettleshade

namespace App\Libraries\Kargolar\KargoIst\Helper;

class Format
{

    /**
     *
     * Sınıf ayarlamalarını yapar.
     *
     * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
     *
     */
    public static function initialize($query, $data)
    {

        if ($data === true) {
            $data = array();
        }

        if ($query === true) {
            $query = $data;
        }

        $responseList = array();
        foreach ($query as $key => $value) {
            if (!isset($data[$key])) {
                continue;
            }

            if (isset($value['required']) && !in_array($data[$key], $value['required'])) {
                continue;
            }

            if (isset($value['format'])) {
                $formatName = $value['format'];
                $data[$key] = self::$formatName($data[$key]);
            }

            $responseList[$key] = self::trim($data[$key]);
        }

        return $responseList;
    }

    /**
     *
     * Url içerisindeki özel parametleri ayıklar
     *
     * @param string $apiUrl
     * @return array
     *
     * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
     */
    public static function getUrlSpecialParameters($apiUrl)
    {
        if (preg_match_all('@\{(.*?)\}@si', $apiUrl, $output)) {
            return $output[1];
        }
        return array();
    }

    /**
     *
     * UnixTime değerini milisaniye cinsine çevririr.
     *
     * @param int $timestamp
     *
     * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
     */
    public static function unixTime($timestamp)
    {
        return $timestamp * 1000;
    }

    /**
     *
     * Metnin başındaki ve sonundaki boşlukları siler.
     *
     * @param int $timestamp
     *
     * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
     */
    public static function trim($text)
    {
        if (is_string($text)) {
            return trim($text);
        }
        return $text;
    }

}