<!DOCTYPE html>
<html>

<head>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MR7H5XW');</script>
<!-- End Google Tag Manager -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('volanty/assetsinclude') ?>
</head>

<body class="index">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


  <video loop muted autoplay id="myVideo">
    <source src="<?= base_url('assets/vid/full.mp4') ?>" type="video/mp4">
  </video>
  <div class="top">
    <button id="mute" onclick="mute(); return false;"><i class="fas fa-volume-off"></i></button>
  </div>
  <div class="content text-right">
    <button id="myBtn"><a href="<?= base_url('volanty/agenda') ?>"><i class="fas fa-car"></i> Comprar Minha Revisão <i class="fas fa-angle-right"></i></a></button>
  </div>


</body>

</html>