<?php

// MEHMET PAÇAL /https://github.com/mettleshade

namespace App\Libraries\Kargolar\KargoIst\Helper;

class Request
{
    public $apiUrl;
    protected $apiUsername;
    protected $apiPassword;
    protected $method;
    protected $datas = array();

    public function __construct($username = "", $password = "", $method = 'POST')
    {
        $this->setApiUsername($username);
        $this->setApiPassword($password);
        $this->setMethod($method);
    }

    public function setApiUsername($username)
    {
        $this->apiUsername = $username;
    }


    public function setApiPassword($password)
    {
        $this->apiPassword = $password;
    }

    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }


    protected function authorizationusername()
    {
        return $this->apiUsername;
    }

    protected function authorizationpass()
    {
        return $this->apiPassword;
    }

    public function getApiUrl($requestData)
    {

        $apiUrl = $this->apiUrl;
        foreach (Format::getUrlSpecialParameters($apiUrl) as $key) {
            if (isset($requestData[$key])) {
                $apiUrl = str_replace('{' . $key . '}', $requestData[$key], $apiUrl);
                unset($requestData[$key]);
            }
        }

        if ($this->method == 'POST' || !is_array($requestData) || count($requestData) <= 0) {
            return $apiUrl;
        }

        return $apiUrl . '?' . http_build_query($requestData);

    }

    public function getResponse($query, $data = "", $Gorev = '', $authorization = true)
    {

        $ch = curl_init();
        $header = [];
        if ($data != "") {
            $requestData = Format::initialize($query, $data);
            curl_setopt($ch, CURLOPT_URL, $this->getApiUrl($requestData));
        } else {
            curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        if ($authorization) {
            $header[] = 'Authorization: ' . $this->authorizationusername();
            $header[] = 'From: ' . $this->authorizationpass();
        }

        if ($this->method == 'POST') {
            $header[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        $requestData =  json_encode($data, JSON_UNESCAPED_UNICODE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $response = trim(curl_exec($ch));
        if (empty($response)) {
            throw new KargoIstException("KargoIst boş yanıt döndürdü.");
        }

        curl_close($ch);

//        if ($Gorev == "VeriYolla") {
            print_r($response);
//        }

    }
}
