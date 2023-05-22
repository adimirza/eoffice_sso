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
    $params = [
      'nip' => $nip,
      'password' => md5($password)
    ];
    $response = Http::withOptions([
      'verify' => false,
    ])->withHeaders([
      'accesskey' => $this->key
    ])->get($this->url . 'simpeg/kepegawaian/login/login_pegawai/', $params)->getBody();
    return $response;
  }
}
