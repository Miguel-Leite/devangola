<?php

namespace App\Services;


class NifValidator
{
  public function getInfos($nif)
  {
    $url = 'https://api.gov.ao/consultarBI/v2/?bi=' . $nif;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $result = json_decode(curl_exec($ch));

    return $result;
  }
}
