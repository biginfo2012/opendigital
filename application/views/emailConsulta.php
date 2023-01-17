<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MR7H5XW');</script>
    <!-- End Google Tag Manager -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Email</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
    <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <table align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f2f2f2" style="padding-top:20px;padding-bottom:20px;">
    <tr>
      <td align="center">
        <table bgcolor="#ffffff" cellpadding="0" cellspacing="0" width="600">
          <tr>
            <td align="center" style="padding: 10px 0 0px 0;">
              <img src="https://www.minharevisao.com.br/assets/img/horizontal.png" alt="header_email" style="display: block; margin-top: 20px;" width="300" height="73" />
            </td>
          </tr>
          <tr>
            <td align="center" style="padding: 40px 5px 10px 5px; font-size:18px; font-family:Verdana; color:#4866b3; font-weight:bold;">
               Nova solicitação de serviço sob consulta
            </td>
          </tr>
          <tr>
            <td style="padding: 0px 30px 0px 30px;font-size:16px;font-family:Verdana;color:#595959;">
              Nome: <?= $usuario['nome'] ?> <br>
              Email: <?= $usuario['email'] ?> <br>
              Telefone: <?= $usuario['telefone'] ?> <br>
            </td>
          </tr>
          <tr>
            <td style="padding: 30px 30px 5px 30px;font-size:18px;font-family:Verdana;color:#404040;">
              <b>Veículo:</b>
            </td>
          </tr>
          <tr>
            <td style="padding: 0px 30px 0px 30px;font-size:16px;font-family:Verdana;color:#595959;">
              <?= $veiculo['montadora'] ?> <?= $veiculo['modelo'] ?> <?= $veiculo['motor'] ?> (<?= $veiculo['ano'] ?>) - <?= $veiculo['quilometragem'] ?> KM rodados.
            </td>
          </tr>
          <tr>
            <td style="padding: 30px 30px 5px 30px;font-size:18px;font-family:Verdana;color:#404040;">
              <b>Unidade:</b>
            </td>
          </tr>
          <tr>
            <td style="padding: 0px 30px 0px 30px;font-size:16px;font-family:Verdana;color:#595959;">
              <?= $unidade['nome_unidade'] ?> - <?= $unidade['endereco'] ?> <br>
              Contato: <?= $unidade['email_contato'] ?>
            </td>
          </tr>
          <tr>
            <td style="padding: 30px 30px 5px 30px;font-size:18px;font-family:Verdana;color:#404040;">
              <b>Data:</b>
            </td>
          </tr>
          <tr>
            <td style="padding: 0px 30px 15px 30px;font-size:16px;font-family:Verdana;color:#595959;">
              <?= $data ?>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align="center" style="font-family: Calibri;">Pedido realizado via: <?php echo $operation_system ?> </td>
    </tr>
    <tr>
      <td align="center" style="padding: 30px 0px 0px 0px;">
        <table cellpadding="0" cellspacing="0" width="600">

          <tr>
            <td align="center" style="font-size: 10px;padding: 0px 0px 60px 0px;font-family: Calibri; color:#969696">
              E-mail enviado devido a solicitação de seviço sob consulta.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>

<?php
//$this->load->view(header);
?>