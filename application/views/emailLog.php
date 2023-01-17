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
          <?php foreach ($data as $key) { ?>
            <tr>
              <td align="center" style="padding: 0px 0 0px 0;"> <?php var_dump($key) ?> </td>
            </tr>
          <?php } ?>
        </table>
      </td>
    </tr>

  </table>
</body>

</html>