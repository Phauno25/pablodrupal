<?php

namespace Drupal\gcaba_ba_mascotas\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use PhpParser\Node\Expr\Empty_;
use PhpParser\Node\Expr\Isset_;

class FormConfig extends FormBase
{

    const BA_MASCOTAS_CONFIG = 'gcaba_ba_mascotas::values';


    public function getFormId()
    {
        return 'gcaba_ba_mascotas_formconfig';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $valores = \Drupal::state()->get(key: self::BA_MASCOTAS_CONFIG);
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
        \Drupal::state()->set(self::BA_MASCOTAS_CONFIG, $submited_values);

        $mensaje_respuesta = \Drupal::service(id: 'messenger');
        $mensaje_respuesta->addMessage($this->t(string: 'La configuración del modulo BA MASCOTAS ha sido guardada'));
    }
}
