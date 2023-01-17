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
  <title>Volanty</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url('assets/img/preferencial_favicon.png') ?>">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">


  <!-- Full page -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fullPage.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css') ?>">

  <!-- Estilos variados -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/volantyrevisao_styles.css') ?>?v=<?php echo filemtime('assets/css/volantyrevisao_styles.css') ?>">

  <!-- Script Necessários -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js') ?>"></script>

  <!-- FullPage JS -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.fullPage.js') ?>"></script>
  <!-- Bootstrap JS -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-material-design.min.js') ?>"></script>

  <!-- Chosen -->
  <link rel="stylesheet" href="<?php echo base_url('assets/chosen/chosen.css') ?>">

  <!-- JQuery Mask -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.mask.min.js') ?>"></script>

  <!-- Chosen JS -->
  <script type="text/javascript" src="<?php echo base_url('assets/chosen/chosen.jquery.min.js') ?>"></script>

  <!-- Moip JS -->
  <script type="text/javascript" src="//assets.moip.com.br/v2/moip.min.js"></script>

  <!-- JS -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/script_ajax.js') ?>?v=<?php echo filemtime('assets/js/script_ajax.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/custom_script.js') ?>?v=<?php echo filemtime('assets/js/custom_script.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/fullpage_config_agenda.js') ?>?v=<?php echo filemtime('assets/js/fullpage_config_agenda.js'); ?>"></script>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript">
    function animateCSS(element, animationName, callback) {
      const node = document.querySelector(element)
      node.classList.add('animated', animationName)

      function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
      }

      node.addEventListener('animationend', handleAnimationEnd)
    }

    $(document).ready(function() {
      animateCSS('.logoImg', 'bounceInDown', function() {
        $('.logoNumenuName').css({
          'opacity': '1'
        });
        $('.linhaDivisoria').css({
          'opacity': '1'
        }).fadeIn();
        animateCSS('.logoNumenuName', 'bounceInUp', function() {
          setTimeout(function() {
            location.href = '<?php echo base_url('volanty/agenda'); ?>';
          }, 500);
        });
      });
    });
  </script>
  <meta name="theme-color" content="#6B5DD3">
  <meta name="msapplication-TileColor" content="#6B5DD3">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="#6B5DD3">
  <meta name="msapplication-navbutton-color" content="#6B5DD3">

</head>

<body class="index" id="indexHome">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  <div id="avisoHorizontal">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12"><img src="<?php echo base_url('assets/img/numenu/rotate_device_numenu.svg'); ?>" alt="Rotacionar Device" width="120"><br /><br />
          Olá! Para melhor visualização e experiencia da página é necessário que o aparelho esteja na posição vertical. Atualmente ele está na horizontal, isso pode ser ruim para sua experiencia.
        </div>
      </div>
    </div>
  </div>



  <div class="numenu_background_application">
    <div class="numenu_welcome_page">
      <div class="container">
        <div class="logoImg">
          <img src="<?php echo base_url('assets/img/horizontal_branca.png'); ?>" alt="Minha Revisão" class="img-fluid" />
        </div>
        <div class="linhaDivisoria">
          <hr />
        </div>
        <div class="logoNumenuName">
          <img src="<?php echo base_url('assets/img/volanty/logo_branco_volanty.png'); ?>" alt="Numenu" class="img-fluid" />
        </div>
      </div>
    </div>

  </div>
</body>

</html>