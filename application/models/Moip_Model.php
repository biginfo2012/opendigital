<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Moip_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function createAccount($conta, $acess_token_app) {
        //Monta URL de pedido de transação da notificação enviada
        //$url = "https://sandbox.moip.com.br/v2/accounts";
        $url = ENDPOINT . "/v2/accounts";

        /*
          Setta o curl e envia o pedido da transação
         */

        $curl = curl_init($url);

        $content = '{
					   "email":{
					      "address":"' . $conta['email'] . '"
					   },
					   "person":{
					      "name":"' . $conta['nome'] . '",
					      "lastName":"' . $conta['sobrenome'] . '",
					     "taxDocument":{
					         "type":"CPF",
					         "number":"458.343.581-95"
					      },
					      "birthDate":"' . $conta['nascimento'] . '",
					      "phone":{
					         "countryCode":"55",
					         "areaCode":"' . $conta['tel']['ddd'] . '",
					         "number":"' . $conta['tel']['numero'] . '"
					      },
					      "address":{
					         "street":"' . $conta['end']['logradouro'] . '",
					         "streetNumber":"' . $conta['end']['numero'] . '",
					         "district":"' . $conta['end']['bairro'] . '",
					         "zipCode":"' . $conta['end']['cep'] . '",
					         "city":"' . $conta['end']['cidade'] . '",
					         "state":"' . $conta['end']['estado'] . '",
					         "country":"BRA"
					      }
					   },
					    "company":{
				        "name":"' . $conta['nome_empresa'] . '",
				        "businessName":"' . $conta['razao'] . '",
				        "taxDocument":{
				            "type":"CNPJ",
				            "number":"' . $conta['cnpj'] . '"
				        },
				        "phone":{
				            "countryCode":"55",
				            "areaCode":"' . $conta['tel_emp']['ddd'] . '",
				            "number":"' . $conta['tel_emp']['numero'] . '"
				        },
				        "address":{
				            "street":"' . $conta['end_emp']['logradouro'] . '",
				            "streetNumber":"' . $conta['end_emp']['numero'] . '",
				            "district":"' . $conta['end_emp']['bairro'] . '",
				            "zipCode":"' . $conta['end_emp']['cep'] . '",
				            "city":"' . $conta['end_emp']['cidade'] . '",
				            "state":"' . $conta['end_emp']['estado'] . '",
				            "country":"BRA"
				        }
				    },
					   "type":"MERCHANT"
					}';
        //echo $content; die();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: OAuth ' . $acess_token_app;

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);


        $transaction = curl_exec($curl);

        curl_close($curl); //var_dump(json_decode($transaction, true)); die();

        return json_decode($transaction, true);
    }

    /**
     *  Traduz o status do inglês para o português
     *
     * @param      string  $status    o status em inglês a traduzir
     *
     * @return     string  status traduzido para o portugues
     */
    function traduzirStatus($status) {

        $statusPT = "";

        switch ($status) {
            case 'CREATED':
                $statusPT = "Criado";
                break;
            case 'WAITING':
                $statusPT = "Aguardando";
                break;
            case 'PAID':
                $statusPT = "Pago";
                break;
            case 'NOT_PAID':
                $statusPT = "Não pago";
                break;
            case 'REVERTED':
                $statusPT = "Revertido";
                break;
            case 'IN_ANALYSIS':
                $statusPT = "Em análise";
                break;
            case 'AUTHORIZED':
                $statusPT = "Autorizado";
                break;
            case 'SETTLED':
                $statusPT = "Concluído";
                break;
            case 'CANCELLED':
                $statusPT = "Cancelado";
                break;
            case 'REFUNDED':
                $statusPT = "Reembolsado";
                break;
            case 'REVERSED':
                $statusPT = "Estornado";
                break;
        }

        return $statusPT;
    }

    /**
     *  Gera o link para pedir permissão ao costumer para as propriedades
     *  RECEIVE_FUNDS,REFUND,MANAGE_ACCOUNT_INFO,TRANSFER_FUNDS
     *
     * @param      string  $app_id           O id do app do moip connect
     *
     * @param      string  $redirect_link    O link de redirecionamento após permissão aceita
     *
     * @param      string  $lojista_id       O id do lista cadastrado no sistema para vincular a
     *  									 conta moip
     *
     * @return     string  O link para pedir permissão
     */
    function generatePermissionLink($app_id, $redirect_link, $lojista_id) {

        //	$url = ENDPOINT."/v2/accounts";
        //$link = "https://connect-sandbox.moip.com.br/oauth/authorize?";
        $link = ENDPOINT_CONNECT . "/oauth/authorize?";
        $link .= "response_type=code&";
        $link .= "client_id=" . $app_id . "&";
        $link .= "redirect_uri=" . $redirect_link . "?seller=" . $lojista_id . "&";
        $link .= "scope=RECEIVE_FUNDS,REFUND,MANAGE_ACCOUNT_INFO,TRANSFER_FUNDS";



        return $link;
    }

    function createApp($app, $tokenChave) {

        //Monta URL de pedido de transação da notificação enviada
        //$url = "https://sandbox.moip.com.br/v2/channels";
        $url = ENDPOINT . "/v2/channels";



        /*
          Setta o curl e envia o pedido da transação
         */

        $curl = curl_init($url);

        $content = '{
			   "name":"' . $app['name'] . '",
			   "description":"' . $app['desc'] . '",
			   "site":"' . $app['site'] . '",
			   "redirectUri":"' . $app['redirectUri'] . '"
			}';

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


        $headr = array();
        $headr[] = 'Content-type: application/json';

        $headr[] = 'Authorization: Basic ' . base64_encode($tokenChave);


        curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);


        $transaction = curl_exec($curl);

        curl_close($curl);

        return json_decode($transaction, true);
    }

    /**
     *
     * Cria um webhook no moip para enviar atualizações de order e payment para o target informado
     *
     */
    function createWebhookPreference($preference, $tokenChave) {

        //Monta URL de pedido de transação da notificação enviada
        //$url = "https://sandbox.moip.com.br/v2/preferences/notifications";
        $url = ENDPOINT . "/v2/preferences/notifications";



        /*
          Setta o curl e envia o pedido da transação
         */

        $curl = curl_init($url);
        ////base_url('agenda/moipWebhook')
        $content = '{
			  "events": [
			    "PAYMENT.*",
			    "ORDER.*"
			  ],
			  "target": "' . $preference['target'] . '",
			  "media": "WEBHOOK"
			} ';

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


        $headr = array();
        $headr[] = 'Content-type: application/json';

        $headr[] = 'Authorization: OAuth ' . $tokenChave;


        curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);


        $transaction = curl_exec($curl);

        curl_close($curl);

        return json_decode($transaction, true);

        //Minha revisão dominio
        //array(5) { ["events"]=> array(2) { [0]=> string(9) "PAYMENT.*" [1]=> string(7) "ORDER.*" } ["target"]=> string(49) "http://www.minharevisao.com.br/agenda/moipWebhook" ["media"]=> string(7) "WEBHOOK" ["token"]=> string(32) "2794751058474d4e95ba635833313561" ["id"]=> string(16) "NPR-U9KBRKZEH266" }
        //Necessário trocar \u0026 por & no link de password
        //string(1101) "{"id":"MPA-9F58A4A0A6C5","login":"teste.moip@labs.moip.com.br","accessToken":"939b47c85a1a49f1a5aceb9351defa7c_v2","channelId":"APP-D42587Y8CK05","type":"MERCHANT","transparentAccount":false,"email":{"address":"teste.moip@labs.moip.com.br","confirmed":false},"person":{"name":"Runscope","lastName":"Random 9123","birthDate":"1990-01-01","taxDocument":{"type":"CPF","number":"373.035.067-64"},"address":{"street":"Av. Brigadeiro Faria Lima","streetNumber":"2927","district":"Itaim","zipcode":"01234000","zipCode":"01234000","city":"São Paulo","state":"SP","country":"BRA"},"phone":{"countryCode":"55","areaCode":"11","number":"965213244","verified":false,"phoneType":"cellphone"},"identityDocument":{"number":"434322344","issuer":"SSP","issueDate":"2000-12-12","type":"RG"}},"createdAt":"2018-07-04T15:44:27.973Z","_links":{"self":{"href":"https://sandbox.moip.com.br/moipaccounts/MPA-9F58A4A0A6C5","title":null},"setPassword":{"href":"https://desenvolvedor.moip.com.br/sandbox/AskForNewPassword.do?method=confirm\u0026email=teste.moip%40labs.moip.com.br\u0026code=0044e2522ddc771db4634776e94513ba"}}}"
        //var_dump($transaction);
        //http://php.net/manual/pt_BR/function.json-decode.php
        //return json_decode($transaction, true);
    }

    function createOrder($pedido, $acess_token_app) {


        //Monta URL de pedido de transação da notificação enviada
        //$url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/".$_POST['notificationCode']."?email=".$email."&token=".$token;
        //Monta URL de pedido de transação da notificação enviada
        //$url = "https://sandbox.moip.com.br/v2/orders";
        $url = ENDPOINT . "/v2/orders";



        /*
          Setta o curl e envia o pedido da transação
         */

        $curl = curl_init($url);

        // $content = '{
        //    "name":"'.$app['name'].'",
        //    "description":"'.$app['desc'].'",
        //    "site":"'.$app['site'].'",
        //    "redirectUri":"'.$app['redirectUri'].'"
        // }';
        //VERIFICAÇÃO VOLANTY
        $volanty = null;
        $numenu = null;
        // print_r($pedido);
        if ($pedido['volanty_id'] != null) {
            $volanty = ',
				{
					"type": "SECONDARY",
					"feePayor": false,
					"moipAccount": {
						"id": "' . $pedido['volanty_id'] . '"
					},
					"amount": {
						"fixed": ' . $pedido['volanty_valor_a_receber'] . '
					}
				}
			';
        }
        if ($pedido['numenu_id'] != null) {
            $numenu = ',
				{
					"type": "SECONDARY",
					"feePayor": false,
					"moipAccount": {
						"id": "' . $pedido['numenu_id'] . '"
					},
					"amount": {
						"fixed": ' . $pedido['numenu_valor_a_receber'] . '
					}
				}
			';
        }

        $content = '{
			  "ownId": "' . $pedido['cod_agenda'] . '",
			  "items": [
			    {
			      "product": "' . $pedido['servico_nome'] . '",
			      "quantity": 1,
			      "detail": "' . $pedido['servico_nome'] . '",
			      "price": ' . $pedido['servico_preco'] . '
			    }
			  ],
			 "customer": {
			    "ownId": "' . $pedido['servico_nome'] . '",
			    "fullname": "' . $pedido['usuario_nome'] . '",
			    "email": "' . $pedido['usuario_email'] . '",
			    "taxDocument": {
				    "type": "CPF",
				    "number": "' . $pedido['cpf'] . '"
				},
				"shippingAddress": {
			    "city": "' . $pedido['city'] . '",
			    "district": "' . $pedido['district'] . '",
			    "street": "' . $pedido['street'] . '",
			    "streetNumber": "' . $pedido['streetNumber'] . '",
			    "zipCode": "' . $pedido['zipCode'] . '",
			    "state": "' . $pedido['state'] . '",
			    "country": "BRA"
			  }
			},
			"receivers": [
		    {
		      "type": "PRIMARY",
		      "feePayor": true,
		      "moipAccount": {
		        "id": "' . $pedido['marketplace_id'] . '"
		      },
		      "amount": {
		        "fixed": ' . $pedido['marketplace_valor_a_receber'] . '
		      }
		    },
		    {
		      "type": "SECONDARY",
		      "feePayor": false,
		      "moipAccount": {
		        "id": "' . $pedido['seller_id'] . '"
		      },
		      "amount": {
		        "fixed": ' . $pedido['seller_valor_a_receber'] . '
		      }
		    }' . $volanty . $numenu . '
		  ]
			}';

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


        $headr = array();
        $headr[] = 'Content-type: application/json';

        $headr[] = 'Authorization: OAuth ' . $acess_token_app;



        curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);


        $transaction = curl_exec($curl);

        curl_close($curl);

        //var_dump(json_decode($transaction, true)); die();
        //http://php.net/manual/pt_BR/function.json-decode.php
        return json_decode($transaction, true);
    }

    function createAccessToken($permissionInfo, $acess_token_app) {


        //Monta URL de pedido de transação da notificação enviada
        //$url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/".$_POST['notificationCode']."?email=".$email."&token=".$token;
        //Monta URL de pedido de transação da notificação enviada
        //$url = "https://connect-sandbox.moip.com.br/oauth/token?client_id=".$permissionInfo['client_id']."&client_secret=".$permissionInfo['client_secret']."&grant_type=".$permissionInfo['grant_type']."&code=".$permissionInfo['code']."&redirect_uri=".$permissionInfo['redirect_uri'];

        $url = ENDPOINT_CONNECT . "/oauth/token?client_id=" . $permissionInfo['client_id'] . "&client_secret=" . $permissionInfo['client_secret'] . "&grant_type=" . $permissionInfo['grant_type'] . "&code=" . $permissionInfo['code'] . "&redirect_uri=" . $permissionInfo['redirect_uri'];

        var_dump($url);


        /*
          Setta o curl e envia o pedido da transação
         */

        $curl = curl_init($url);

        // $content = '{
        //    "name":"'.$app['name'].'",
        //    "description":"'.$app['desc'].'",
        //    "site":"'.$app['site'].'",
        //    "redirectUri":"'.$app['redirectUri'].'"
        // }';
        // $content = '{
        //   "client_id": "'.$permissionInfo['client_id'].'",
        //   "client_secret": "'.$permissionInfo['client_secret'].'",
        //   "redirect_uri": "'.$permissionInfo['redirect_uri'].'",
        //   "grant_type": "'.$permissionInfo['grant_type'].'",
        //   "code": "'.$permissionInfo['code'].'"
        // }';
        //echo $content; die();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true); //teste
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


        $headr = array();
        $headr[] = 'Content-type: application/x-www-form-urlencoded';
        $headr[] = 'Cache-Control: no-cache';
        $headr[] = 'Content-Length: 0';
        // $headr[] = 'Content-type: application/json';

        $headr[] = 'Authorization: OAuth ' . $acess_token_app;


        curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);

        $transaction = curl_exec($curl);



        curl_close($curl);


        return json_decode($transaction, true);
    }

    function createPayment($pagamento, $acess_token_app) {

        $url = ENDPOINT . "/v2/orders/" . $pagamento['order_id'] . "/payments";


        /*
          Setta o curl e envia o pagamento da transação
         */

        $content = '{
			 "installmentCount":' . $pagamento['parcelas'] . ',
			  "statementDescriptor":"Minha Revisão",
		      "fundingInstrument":{
		        "method":"CREDIT_CARD",
		        "creditCard":{
		          "hash":"' . $pagamento['hash_cc'] . '",
		          "store": false,
		          "holder":{
		            "fullname":"' . $pagamento['nome_cc'] . '",
		            "birthdate":"' . $pagamento['nasc_cc'] . '",
		            "taxDocument":{
		              "type":"CPF",
		              "number":"' . $pagamento['cpf'] . '"
		            }
		          }
		        }
		      }
			}';


        $curl = curl_init($url);

        // $content = '{
        //    "name":"'.$app['name'].'",
        //    "description":"'.$app['desc'].'",
        //    "site":"'.$app['site'].'",
        //    "redirectUri":"'.$app['redirectUri'].'"
        // }';


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


        $headr = array();
        $headr[] = 'Content-type: application/json';

        $headr[] = 'Authorization: OAuth ' . $acess_token_app;



        curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);


        $transaction = curl_exec($curl);

        curl_close($curl);

        //var_dump($transaction);
        //var_dump(json_decode($transaction, true)); die();
        //http://php.net/manual/pt_BR/function.json-decode.php
        return json_decode($transaction, true);
    }

}
