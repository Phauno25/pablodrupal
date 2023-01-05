<?php

namespace Drupal\pablo_modulo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use PhpParser\Node\Expr\Empty_;
use PhpParser\Node\Expr\Isset_;

class ConfigForm extends FormBase
{

    const PABLO_MODULO_CONFIG_PAGE = 'pablo_modulo_config_page::values';

public function getFormId()
{
    return 'pablo_modulo_configForm' ;
}

public function buildForm(array $form, FormStateInterface $form_state)
{
    $valores = \Drupal::state()->get(key: self::PABLO_MODULO_CONFIG_PAGE);
    if (!isset($valores['api_base_url'])) {
        $valores['api_base_url'] = "";
    }

    $form = [];
    $form['api_base_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t(string: 'Api Base Url'),
        '#description' => $this->t(string: 'Esta es la url que consume al servicio.'),
        '#required' => true,
        '#default_value' =>  $valores['api_base_url'] ? $valores['api_base_url'] : "",

    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t(string: 'save'),
        '#button_type' => 'primary',
    ];

    

    return $form;

}

public function submitForm(array &$form, FormStateInterface $form_state)
{
    $submited_values = $form_state->cleanValues()->getValues();
    \Drupal::state()->set(self::PABLO_MODULO_CONFIG_PAGE, $submited_values);
    
    $mensaje_respuesta = \Drupal::service(id:'messenger');
    $mensaje_respuesta->addMessage($this-> t(string:'La configuración del modulo Pablo ha sido guardada'));
}

}
