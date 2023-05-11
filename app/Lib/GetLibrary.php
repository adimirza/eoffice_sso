<?php

namespace App\Lib;

use Illuminate\Support\Facades\Http;

class GetLibrary
{
  public $url;
  public $key;

  public function __construct()
  {
    $this->url = 'https://ponggol.tegalkab.go.id/restapi/public/';
    $this->key = '5e143e98b2aa4';
  }

  function apiLogin($nip, $password)
  {
    // $header = [
    //   'Content-Type: application/x-www-form-urlencoded',
    //   'accesskey: ' . $this->key
    // ];
    $params = [
      'nip' => $nip,
      'password' => md5($password)
    ];
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_POST, false);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    // curl_setopt($ch, CURLOPT_URL, $this->url . 'simpeg/kepegawaian/login/login_pegawai/?'.http_build_query($params));
    // // curl_setopt($ch, CURLOPT_URL, 'https://dummyjson.com/products/1');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // curl_close($ch);
    $response = Http::withOptions([
      'verify' => false,
    ])->withHeaders([
      'accesskey' => $this->key
    ])->get($this->url . 'simpeg/kepegawaian/login/login_pegawai/', $params)->getBody();
    return $response;
  }
}
