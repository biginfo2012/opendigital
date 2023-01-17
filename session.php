<?php

define('APP_ID', 'app2207698362');
define('APP_KEY', '397315CD8383993EE4E6FFA3909D553D');

define('EMAIL_PAGSEGURO', 'freedesign.solution@gmail.com');
$tokenPagseguro = '47c04444-fe08-4957-9d1a-519a10a732e9f3be6bfe42b8b27e3ad6210702315d787aa4-7a63-441e-ba7b-1fa178b11a53';
define('TOKEN_PAGSEGURO', $tokenPagseguro);

define('URL_PAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br/');
define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
define("URL_NOTIFICACAO", "https://loja.exemplo.com/compra/notificacao.php");

$url = URL_PAGSEGURO . 'sessions?appId=' . APP_ID . '&appKey=' . APP_KEY;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
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
