<?php

namespace Drupal\gcaba_portal_autenticidad\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\gcaba_portal_autenticidad\Controller\PortalAutenticidadController;
use Exception;
use PhpParser\Node\Expr\Empty_;
use PhpParser\Node\Expr\Isset_;
use PhpParser\Node\Stmt\TryCatch;
use SoapClient;

class FormAutenticidad extends FormBase
{

    /*
$tipoDoc     = 'ACTA';
$ano         = '2019';
$numero      = '22223975';
$reparticion = 'DGRC';
/*
$tipoDoc     = 'ACTA';
$ano         = '2017';
$numero      = '12418769';
$reparticion = 'DGRC';
*/

    public function getFormId()
    {
        return 'form-portal-autenticidad';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form = [];
        $form['documento']['base_url'] = [
            '#type' => 'hidden',
            '#value' => $_SERVER['REQUEST_URI'],
        ];

        $form['documento'] = [
            '#type' => 'fieldset',
            '#title' => $this->t(string: 'Datos del documento'),
            '#collapsible' => false,
        ];
        $form['documento']['tipo_documento'] = [
            '#type' => 'select',
            '#title' => $this->t(string: 'Document Type'),
            '#description' => $this->t(string: 'Select the document type of your document.'),
            '#required' => true,
            '#default_value' => "ACTA",
            '#options' => [
                'ACTA' => "ACTA",
                'CE' => "CE",
                'IF' => "IF",
                'INLEG' => "INLEG",
            ]
        ];
        $form['documento']['numero_documento'] = [
            '#type' => 'number',
            '#title' => $this->t(string: 'Document Number'),
            '#description' => $this->t(string: 'The number of your document'),
            '#required' => true,
            '#default_value' => 0

        ];
        $form['documento']['anio_documento'] = [
            '#type' => 'number',
            '#title' => $this->t(string: 'Year'),
            '#description' => $this->t(string: 'The year of your document'),
            '#required' => true,

        ];
        $form['documento']['reparticion_documento'] = [
            '#type' => 'select',
            '#title' => $this->t(string: 'Repartition'),
            '#description' => $this->t(string: 'The repartition of your document'),
            '#required' => true,
            '#default_value' => "DGRC",
            '#options' => [
                'DGRC' => "DGRC",
                'CE' => "CE",
                'IF' => "IF",
                'INLEG' => "INLEG",
            ]

        ];
        $form['actions']['#type'] = 'actions';
        $form['documento']['submit'] = [
            '#id' => 'btnSubmit',
            '#type' => 'button',
            '#value' => $this->t(string: 'Consultar'),
            '#button_type' => 'primary',
            '#ajax' => [
                'callback' => '::validarDocumento'
            ]
        ];

        $form['#attached']['library'][] = 'gcaba_portal_autenticidad/gcaba_portal_autenticidad';
        return $form;
    }

    public function validarDocumento(array &$form, FormStateInterface $form_state)
    {

        $values = $form_state->getValues();
        //$url = 'http://sade-mule.hml.gcba.gob.ar/GEDOServices/consultaDocumento';
        $documento = $values['tipo_documento'] . '-' . $values['anio_documento'] . '-' . $values['numero_documento'] . '-GCABA-' . $values['reparticion_documento'];
        $url = 'http://sade-mule.gcba.gob.ar/GEDOServices/consultaDocumento';
        $user = 'WSQUERY';

        $requestBody =
            '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
            <Body>
                <consultarDocumentoPdf xmlns="http://ar.gob.gcaba.gedo.satra.services.external.consulta/">
                    <request xmlns="">
                        <usuarioConsulta>' . $user . '</usuarioConsulta>
                        <numeroDocumento>' . $documento . '</numeroDocumento>
                    </request>
                </consultarDocumentoPdf>
            </Body>
        </Envelope>';

        /*
        $options = array('trace' => TRUE);
        $client = new SoapClient($url,$options);
        $client->__setLocation($url);
        
        try {
            $data = $client->__doRequest($requestBody, $url, 'consultarDocumentoPdf', 0);
        } catch (\Throwable $th) {
            throw $th;
        } */

        //Curl
        $headers = array(
            'Content-Type: text/xml; charset="utf-8"',
            'Content-Length: ' . strlen($requestBody),
            'Accept: text/xml',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'SOAPAction: ""',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);


        //Obtengo la respuesta en una variable y cierro el objeto Curl.
        try {
            $data = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            echo $e;
        }


        //Remplazo los caracteres del String para que quede en formato XML
        $data = preg_replace("/(<\/?)(\w+):([^>]*>)/", '$1$2$3', $data);
        //Lo transformo en XML para luego codificarlo en JSON
        $data = @simplexml_load_string($data, 'SimpleXMLElement', LIBXML_COMPACT | LIBXML_PARSEHUGE);
        //Encodeo en JSON
        $data = json_encode($data);
        //Finalmente lo paso a un array de PHP
        $dataArray = json_decode($data, true); //true para obtener array, false para obtener objeto.

        //Busco el nombre de la key que viene en el body de respuesta y la uso para filtrar el resultado de la busqueda. 
        $tipoRespuesta = array_key_first($dataArray['soapBody']);

        //Armamos el array de respuesta
        $respuesta  = array();
        $respuesta['documento'] = $values['tipo_documento'] . '-' . $values['anio_documento'] . '-' . $values['numero_documento'] . $values['reparticion_documento'];

        switch ($tipoRespuesta) {
            case 'soapFault':
                if (str_contains($dataArray['soapBody']['soapFault']['faultstring'], "privilegios")) {

                    $respuesta['estado'] = 'prohibido';
                    $respuesta['titulo'] = 'Documento Confidencial';
                    $respuesta['mensaje'] = 'Se ha validado la autenticidad del documento ' . $respuesta['documento'] . ' pero no se puede visualizar ni descargar ya que es de carácter reservado.';
                    $respuesta['logo'] = ';)';
                } else if (str_contains($dataArray['soapBody']['soapFault']['faultstring'], "GEDO")) {

                    $respuesta['estado'] = 'noEncontrado';
                    $respuesta['titulo'] = 'Documento no encontrado';
                    $respuesta['mensaje'] = 'No se ha encontrado el documento ' . $respuesta['documento'] . '. Verificá que los datos ingresados sean correctos.';
                    $respuesta['logo'] = ':(';
                }
                break;

            case 'ns2consultarDocumentoPdfResponse':

                $respuesta['estado'] = 'encontrado';
                $respuesta['titulo'] = 'Documento Encontrado';
                $respuesta['mensaje'] = 'Se ha validado la autenticidad del documento ' . $respuesta['documento'];
                $respuesta['logo'] = ':)';
                $respuesta['pdf'] = $dataArray['soapBody']['ns2consultarDocumentoPdfResponse']['return'];
                break;

            default:

                $respuesta['estado'] = 'error';
                $respuesta['titulo'] = 'Error';
                $respuesta['mensaje'] = 'Ha ocurrido un error en el servidor. Por favor intente de nuevo mas tarde.';
                $respuesta['logo'] = ':S';
                break;
        }


        $form['documento']['#access'] = FALSE;


        $docFound =
            '<div class="container">
        <div class="row">
            <h1 class="text-center">' . $respuesta['logo'] . '</h1>
        </div>
            <div class="row">
            <h3 class="text-center">' .   $respuesta['titulo'] . '</h3>
            <p class="text-center">' .   $respuesta['mensaje'] . '</p>
            </div>
            <div class="row d-flex justify-content-center">
        ' . (isset($respuesta['pdf']) ?
                '<a class="btn btn-primary col-3" title="Descargar comprobante" download="' . $respuesta['documento'] . '.pdf" href="data:application/octet-stream;base64, ' . $respuesta['pdf'] . '" target="_blank">Descargar Documento</a>'
                : "") . '
            <a class="btn btn-primary col-3" href=' . $form['base_url'] . '>Nueva Consulta</a>
            </div>
        </div>';

        $ajax = new AjaxResponse();
        $ajax->addCommand(new ReplaceCommand(
            '#edit-documento',
            $docFound,
        ));
        $ajax->addCommand(new ReplaceCommand(
            '#btnSubmit',
            "",
        ));
        return $ajax;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        /*  $submited_values = $form_state->cleanValues()->getValues();
        \Drupal::state()->set(self::BA_MASCOTAS_CONFIG, $submited_values); */

        $mensaje_respuesta = \Drupal::service(id: 'messenger');
        $mensaje_respuesta->addMessage($this->t(string: 'La configuración del modulo BA MASCOTAS ha sido guardada'));
    }
}
