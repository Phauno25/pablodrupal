<?php

namespace Drupal\gcaba_ba_mascotas\Controller;

class BAMascotasController
{
  public function index()
  {
    $animales = $this->getAnimales();
    return array(
      '#theme' => 'mascotastema',
      '#mascotas' => [
        "mascotas" => $animales,
        'total' => count($animales)
      ]
    );
    

  }

  public function getAnimales(){
    $client = \Drupal::httpClient();
    $request = $client->get('https://animalesba-back-qa.gcba.gob.ar/prestacion');
    $data = json_decode($request->getBody()->getContents(),true);
    $data = $data['data'];
    return $data;
  }

}
