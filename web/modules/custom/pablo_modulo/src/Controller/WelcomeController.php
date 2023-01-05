<?php

namespace Drupal\pablo_modulo\Controller;

class WelcomeController
{
  public function welcome()
  {
    $content = [];
    $content['name'] = file_get_contents('https://jsonplaceholder.typicode.com/users');
    
    return array(
      '#theme' => 'pablotema',
      '#content' => $content
    );
  }
}
