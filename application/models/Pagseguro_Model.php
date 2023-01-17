<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pagseguro_Model extends CI_Model {

    //public $appId = EMAIL_PAGSEGURO;
    public $appId = APP_ID;
    //public $appKey = TOKEN_PAGSEGURO;
    public $appKey = APP_KEY;
    public $urlPagseguro = URL_PAGSEGURO;
    public $url;
    public $v2 = false;

    public function __construct() {
        parent::__construct();
        $this->v2 = '';
        if ($this->v2 == true) {
            $this->v2 = 'v2/';
        }
    }

    public function redirectAutoriza($code) {

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.pagseguro.uol.com.br/v2/authorization/request.jhtml?code={$code}",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/xml"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

    }
    public function Authorizations() {
        $this->url = $this->urlPagseguro . $this->v2 . 'v2/authorizations/request/?appId=' . $this->appId . '&appKey=' . $this->appKey;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<authorizationRequest>
    <reference>'.time().'</reference>
    <permissions>
        <code>CREATE_CHECKOUTS</code>
        <code>RECEIVE_TRANSACTION_NOTIFICATIONS</code>
        <code>SEARCH_TRANSACTIONS</code>
        <code>MANAGE_PAYMENT_PRE_APPROVALS</code>
        <code>DIRECT_PAYMENT</code>
    </permissions>
    <redirectURL>'.URL_BASE.'/agenda</redirectURL>
    <notificationURL>'.URL_NOTIFICACAO.'</notificationURL>
</authorizationRequest>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/xml'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $xml = simplexml_load_string($response);
        echo json_encode($xml);

        //return json_decode($data);
       
    }

    public function getSession() {
        $this->url = $this->urlPagseguro . $this->v2 . 'sessions?appId=' . $this->appId . '&appKey=' . $this->appKey;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/vnd.pagseguro.com.br.v3+xml'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $xml = simplexml_load_string($response);
        echo json_encode($xml);
    }

    public function Transaction($dados) {
        $this->url = $this->urlPagseguro . $this->v2 . 'transactions?appId=' . $this->appId . '&appKey=' . $this->appKey;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $dados,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "Accept: application/vnd.pagseguro.com.br.v3+xml"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
        /* echo '<pre>';
          var_dump($response);
          echo '</pre>'; */
    }

    function getStatus() {
        sleep(5);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->urlPagseguro . $this->v2 . "transactions/" . $this->input->post('id') . "?appId=" . $this->appId . "&appKey=" . $this->appKey);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $dataXML = simplexml_load_string($data);

        header('Content-Type: application/json; charset=UTF-8');
        $data = (json_encode($dataXML));

        return (json_decode($data)->status);
        curl_close($ch);
    }

}
