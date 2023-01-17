<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">

    <table align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f2f2f2" style="padding-top:20px;padding-bottom:20px;">
        <tr>
            <td align="center">
                <table bgcolor="#ffffff" cellpadding="0" cellspacing="0" width="600">
                    <tr>
                        <td align="center" style="padding: 20px 0 0px 0;">
                            <img src="https://www.minharevisao.com.br/assets/img/horizontal.png" alt="header_email" style="display: block; margin-top: 20px;" width="300" height="73" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 40px 0 60px 0;font-weight:bold;font-size:20px;font-family:Calibri;color:#4866b3; ">
                            <b><?php echo "O usuário " . $usuario . " agendou um serviço" ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%;font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color: #4866b3;">Contato do usuário:</b> <?php echo $usuario_telefone ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%;font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color: #4866b3;">Unidade:</b> <?php echo $unidade ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%; font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color: #4866b3;">Data:</b> <?php echo $data ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%;font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color: #4866b3;">Período :</b> <?php echo $periodo ?> (<?php echo $periodo_desc ?>)
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%; font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color: #4866b3;">Serviço:</b><span style="text-transform: uppercase;"> <?php echo $servico ?> </span> <br>
                            <span>- Óleo de motor</span> <br>
                            <span>- Anel de vedação</span> <br>
                            <span>- Filtro de óleo</span> <br>
                            <span>- Filtro de combustível</span> <br>
                            <span>- Filtro de ar </span> <br>
                            <span>- Revisão</span> <br>
                            <?php if ($servico == 'Intermediário' or $servico == 'Premium') : ?>
                                <span>- Alinhamento</span> <br>
                                <span>- Balanceamento</span> <br>
                            <?php endif; ?>
                            <?php if ($servico == 'Premium') : ?>
                                <span>- Filtro cabine</span> <br>
                                <span>- Higienização do AC</span> <br>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%;font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color: #4866b3;">Veículo :</b> <?php echo $veiculo ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%;font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color: #4866b3;">Valor :</b> R$<?php echo $preco ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 0 15px 5%;font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color:#4866b3;">Status do pagamento:</b> <?php echo $status_pagamento ?>
                        </td>
                    </tr>
					<tr>
                        <td style="padding: 0px 0 15px 5%;font-size:16px;font-family:Calibri;color:#595959;">
                            <b style="color:#4866b3;">Em caso de reagendamento favor informar via e-mail:</b> <b style="color:#red;">agendamento@minharevisao.com.br</b>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 30px 0 1px 0; font-size: 35px;font-family:Calibri;color:red;">
                            <b> VOUCHER </b>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 0px 0 20px 0; font-size: 13px;font-family:Calibri;color: #595959;">
                            (Apresente este voucher somente ao prestador de serviço)
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:  0px 15px 40px 0; font-size: 39px;font-family:Calibri;color:#404040;">
                            <b><?php echo $voucher ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family: Calibri;">Pedido realizado via: <?php echo $operation_system ?> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 30px 0px 0px 0px; color: #595959">
                <table cellpadding="0" cellspacing="0" width="600">

                    <tr>
                        <td align="center" style="font-size: 10px;padding: 0px 0px 60px 0px;font-family: Calibri; color:#969696">
                            Este e-mail foi enviado a você após uma compra em minha revisão.
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