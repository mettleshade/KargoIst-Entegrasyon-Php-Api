# KargoIst-Entegrasyon-Php

- 01.09.2022
- Codeigniter4 ile yapılmıştır.

---

-- KargoIst görevlinizden 
- Api key ve form id almanız gerekli.
- Bilgileri aldıktan sonra
- KargoIst.php -> __construct -> Request içine tanımlama yapalım.
- Göndermeniz zorunlu alanları girdim onun dışındaki alanlar isteğinize göre doldurabilirsiniz.
- Verdiğim dökümanda gerekli alanlar ve isteğe bağlı alanlar yazmaktadır.
---

Apiyi bağladıktan sonra tanımlayalım :

```
$veri = new KargoIst();
```

Veri gönderme :

```
        $data = [
            'barcode' => 'testbarkod', // SİPARİŞ BARKOD TAKİP NO // BENZERSİZ OLMALI
            'customer' => 'Mehmet Paçal', // ALICI ADI
            'province_name' => 'NİĞDE', // İL
            'county_name' => 'MERKEZ', // İLCE
            'address' => 'Mehmet Paçal', // ADRES
            'telephone' => '5555555555', // TELEFON
            'branch_code' => '21', // ŞUBE KODU
            'amount' => 100.00, // TUTAR // DECİMAL ÖRN 100.00
            'amount_type_id' => 3, // ÜCRET TÜRÜ // KAPIDA ÖDEME 1 => Toplu Gönderi, 2 => Ücret Alıcı 3 => Peşin Ödeme (KAPIDA ÖDEME VEYA ÖDENMİŞ İSE), 4 =>  Kredi Kartı (Müşteri), 5 => Kapıda Kredi Kartı
            'order_number' => '2' // SİPARİŞ NO || SİPARİŞ ID
        ];
        $veri->VeriYolla($data);
```

Veri güncelleme :

```
        $data = [
            'barcode' => 'testbarkod', // SİPARİŞ BARKOD TAKİP NO
            'customer' => 'Mehmet Paçal', // ALICI ADI
            'province_name' => 'NİĞDE', // İL
            'county_name' => 'MERKEZ', // İLCE
            'address' => 'Mehmet 123123 Paçal', // ADRES
            'telephone' => '5555555555', // TELEFON
            'branch_code' => '21', // ŞUBE KODU
            'amount' => 100.00, // TUTAR // DECİMAL ÖRN 100.00
            'amount_type_id' => 3, // ÜCRET TÜRÜ // KAPIDA ÖDEME 1 => Toplu Gönderi, 2 => Ücret Alıcı 3 => Peşin Ödeme (KAPIDA ÖDEME VEYA ÖDENMİŞ İSE), 4 =>  Kredi Kartı (Müşteri), 5 => Kapıda Kredi Kartı
            'order_number' => '2' // SİPARİŞ NO || SİPARİŞ ID
        ];
        $veri->VeriGuncelle($data, 'TESTMEHMETPACAL');
```

Kayıt detayına bakma : 

```
        $data = [
            'id' => '0',
            'barcode' => 'testbarkod'
        ];

        $veri->KayitDetay($data);
```

Kayıt Silme :
```
$veri->KayitSil('testbarkod'); // BARKOD
```

Kargo durumunu öğrenme :
```
        $data = [
            'barkod' => 'testbarkod'
        ];
        $veri->KargoDurum($data);
```

Kargo hareketlerini alma :
```
        $data = [
            'barkod' => 'testbarkod'
        ];
        $veri->KargoHareketleri($data);
```