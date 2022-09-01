<?php

// MEHMET PAÇAL /https://github.com/mettleshade

namespace App\Libraries\Kargolar\KargoIst;

use App\Libraries\Kargolar\KargoIst\Helper\Format;
use App\Libraries\Kargolar\KargoIst\Helper\Request;
use App\Libraries\Kargolar\KargoIst\Helper\KargoIstException;

class KargoIst
{
    public function __construct()
    {
        $this->req = new Request('', '');
    }

    public function VeriYolla($data = [])
    {
        $this->req->setApiUrl('https://webpostman.kargoist.com/restapi/client/consignment/add');
        $this->req->setMethod("POST");
        $query = [
            'items' => [
                'barcode' => '', // SİPARİŞ BARKOD TAKİP NO
                'customer' => '', // ALICI ADI
                'province_name' => '', // İL
                'county_name' => '', // İLCE
                'address' => '', // ADRES
                'telephone' => '', // TELEFON
                'branch_code' => '', // ŞUBE KODU
                'amount' => '', // TUTAR
                'amount_type_id' => '', // ÜCRET TÜRÜ // KAPIDA ÖDEME 1 => Toplu Gönderi, 2 => Ücret Alıcı 3 => Peşin Ödeme (KAPIDA ÖDEME VEYA ÖDENMİŞ İSE), 4 =>  Kredi Kartı (Müşteri), 5 => Kapıda Kredi Kartı
                'order_number' => '' // SİPARİŞ NO || SİPARİŞ ID
            ]
        ];


        return $this->req->getResponse($query, $data, 'VeriYolla');
    }

    public function VeriGuncelle($data = [], $barkod)
    {

        // ŞUBE KODU VE BARKOD AYNI KALMAK ZORUNDA !

        $this->req->setApiUrl('https://webpostman.kargoist.com/restapi/client/consignment/edit/' . $barkod);
        $this->req->setMethod("PUT");
        $query = [
            'barcode' => '', // SİPARİŞ BARKOD TAKİP NO
            'customer' => '', // ALICI ADI
            'province_name' => '', // İL
            'county_name' => '', // İLCE
            'address' => '', // ADRES
            'telephone' => '', // TELEFON
            'branch_code' => '', // ŞUBE KODU
            'amount' => '', // TUTAR
            'amount_type_id' => '', // ÜCRET TÜRÜ // KAPIDA ÖDEME 1 => Toplu Gönderi, 2 => Ücret Alıcı 3 => Peşin Ödeme (KAPIDA ÖDEME VEYA ÖDENMİŞ İSE), 4 =>  Kredi Kartı (Müşteri), 5 => Kapıda Kredi Kartı
            'order_number' => '' // SİPARİŞ NO || SİPARİŞ ID
        ];


        return $this->req->getResponse($query, $data, 'VeriGuncelle');
    }

    public function KayitDetay($data = [])
    {

        $this->req->setApiUrl('https://webpostman.kargoist.com/restapi/client/consignments');
        $this->req->setMethod("GET");
        $query = [
            'id' => '', // VERİ YOLLADAN DÖNEN record_id
            'barcode' => '' // OLUŞAN YADA GÖNDERDİĞİNİZ BARKOD
        ];

        return $this->req->getResponse($query, $data, 'KayıtDetay');
    }

    public function KayitSil($barkod)
    {
        $this->req->setApiUrl('https://webpostman.kargoist.com/restapi/client/consignment/delete/' . $barkod);
        $this->req->setMethod("DELETE");

        return $this->req->getResponse('','','KayıtSil');

    }
    public function KargoDurum($data = [])
    {
        $this->req->setApiUrl('https://webpostman.kargoist.com/restapi/client/cargo');
        $this->req->setMethod("GET");
        $query = [
            'barkod' => ''
        ];

        return $this->req->getResponse($query,$data,'KargoDurumu');

    }
    public function KargoHareketleri($data = [])
    {
        $this->req->setApiUrl('https://webpostman.kargoist.com/restapi/client/movements/{barkod}');
        $this->req->setMethod("GET");
        $query = [
            'barkod' => ''
        ];

        return $this->req->getResponse($query,$data,'KargoHareketi');

    }
}