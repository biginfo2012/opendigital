<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MR7H5XW');</script>
    <!-- End Google Tag Manager -->
    <!-- Title -->
    <title>Minha Revisão</title>
    <!-- Meta -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style_login.css') ?>?v=<?php echo filemtime('assets/css/style_login.css') ?>">
    <!-- Google Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Raleway:100,300,400" type="text/css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,300" type="text/css" rel="stylesheet">

    <!-- javascript -->
    <!-- Script Necessários -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery-ui/jquery-ui.js') ?>"></script>
    
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-material-design.min.js') ?>"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/script_ajax.js') ?>"></script>
</head>


<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR7H5XW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div id="loader"></div>
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
                    <div class="form-wrap text-center">
                        <img class="logo" src="<?php echo base_url('assets/img/logo_login.png') ?>">
                        <form id="admLogin" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Usuário</label>
                                <input type="text" name="user" id="user" value="" class="form-control" placeholder="Usuário">
                            </div>
                            <div class="form-group">
                                <label for="key" class="sr-only">Password</label>
                                <input type="password" name="senha" id="password" value="" class="form-control" placeholder="Senha">
                            </div>
                            <button type="submit" class="btn btn-success btn-custom btn-lg btn-block">Login</button>
                        </form>

                        <hr>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-4">
                    <div style="display: none" class="alert alert-danger" id="loginInvalido" role="alert"></div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                    <div class="text-center mx-auto">
                        <img src="<?php echo base_url('assets/img/powered_by.png') ?>">
                        <br /><br /><br />
                        <p>Minha Revisão</p>
                        Compatível:<br /> <img src="<?php echo base_url('assets/img/logo_firefox.png') ?>">&nbsp;<img src="<?php echo base_url('assets/img/logo_chrome.png') ?>">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        var baseurl = "<?php echo base_url(); ?>"
    </script>


    <!--        <script>
            var url = window.location.href;
            var parametrosUrl = url.split("?")[1];
            var resultadoLogin = parametrosUrl.split("=")[1];
            if (resultadoLogin === "invalido") {
                document.getElementById("loginInvalido").style.display = 'block';
                document.getElementById("loginInvalido").innerHTML = "<strong>Invalid login!</strong>";
            } else if (resultadoLogin === "naoLogado") {
                document.getElementById("loginInvalido").style.display = 'block';
                document.getElementById("loginInvalido").innerHTML = "<strong>You need to login!</strong>";
            } else if (resultadoLogin === "logout") {
                document.getElementById("loginInvalido").style.display = 'block';
                document.getElementById("loginInvalido").innerHTML = "<strong>You have successfully logged out!</strong>";
            } else if (resultadoLogin === "departamento") {
                document.getElementById("loginInvalido").style.display = 'block';
                document.getElementById("loginInvalido").innerHTML = "<strong>You don't belong to a department</strong>";
            } else if (resultadoLogin === "conexao") {
                document.getElementById("loginInvalido").style.display = 'block';
                document.getElementById("loginInvalido").innerHTML = "<strong>It was not possible to find the server</strong>";
            }
        </script> -->
</body>


</html>