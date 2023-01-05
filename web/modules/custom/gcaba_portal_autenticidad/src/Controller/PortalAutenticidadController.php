<?php

namespace Drupal\gcaba_portal_autenticidad\Controller;
class PortalAutenticidadController
{
  public function index()
  {

    $webform = \Drupal::entityTypeManager()->getStorage('webform')->load('portal_autenticidad_webform');
    $webform = $webform->getSubmissionForm();
    return array(
      '#theme' => 'autenticidadtema',
      '#documento' => [
        'webform' => $webform,
      ]
    );
  }


  public function getDocumentoPdf()
  {
    $client = \Drupal::httpClient();
    $request = $client->get('https://jsonplaceholder.typicode.com/users');
    return $request;
  }
}
