<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Email</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

    <body style="margin: 0; padding: 0;">

     <table align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f2f2f2" style="padding-top:20px;padding-bottom:20px;">
            <tr>
                <td align="center" >
                    <table bgcolor="#ffffff" cellpadding="0" cellspacing="0" width="600">
                        <tr>
                            <td align="center" style="padding: 0px 0 0px 0;">
                                <!-- <img src="<?php echo base_url('assets/img/cabecalho_email.png') ?>" alt="header_email" style="display: block;" width="600" height="220" /> -->
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 40px 0 60px 0; font-size: 20px;font-family:Calibri;color:#404040;">
                               <b><?php echo $nome ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0 15px 60px; font-size:16px;font-family:Calibri;color:#595959;">
                               <b>Email:</b> <?php echo $email ?>
                            </td>
                        </tr>
                         <tr>
                            <td style="padding: 0px 0 15px 60px;font-size:16px;font-family:Calibri;color:#595959;">
                              <b>Telefone:</b>  <?php echo $telefone ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 30px 0 15px 60px;font-size:16px;font-family:Calibri;color:#595959;">
                               <b>Mensagem:</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 15px 40px 60px;font-size:16px;font-family:Calibri;color:#595959;">
                               <?php echo $msg ?>
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
