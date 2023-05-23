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

  function periksanip($nip)
  {
    $response = Http::withOptions([
      'verify' => false,
    ])->withHeaders([
      'accesskey' => $this->key
    ])->get($this->url . 'simpeg/kepegawaian/detail/pegawai/' . $nip)->getBody();
    return $response;
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

  function getIP($ip)
  {
    $result  = array('country' => 'Local', 'city' => 'Local', 'latitude' => '-6.996612', 'longitude' => '109.1267785');
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if ($ip_data && $ip_data->geoplugin_countryName != null) {
      $result['country'] = $ip_data->geoplugin_countryName;
      $result['city'] = $ip_data->geoplugin_city;
      $result['latitude'] = $ip_data->geoplugin_latitude;
      $result['longitude'] = $ip_data->geoplugin_longitude;
    }
    return $result;
  }
}
