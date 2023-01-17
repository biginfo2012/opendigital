<style media="screen">
    @media (max-width: 992px) {
        .div_perfil {
            display: none;
        }

        .navbar-collapse .div_perfil {
            display: block;
        }
    }

    @media (min-width: 993px) {
        .navbar-collapse .div_perfil {
            display: none;
        }

        .navbar {
            background-color: #fff;
            padding-left: 75px;
            padding-top: 30px;
        }
    }

    /* AGENDA */
    .logo {
        width: 200px;
        height: 50px;
    }


    .navbar-expand-lg .navbar-toggler {
        display: block;
        right: 0;
        position: absolute;
        margin-right: 15px;
    }

    .navbar-toggler-icon {
        width: 40px !important;
        height: 40px !important;
    }

    .navbar {
        background-color: #fff;
    }

    .navbar .nav-item {
        padding-right: 35px;
    }

    .navbar .item a {
        color: #4866b3;
        font-size: 20px;
    }

    .navbar .item a:hover {
        color: #6afe6f;
        text-decoration: none;
    }

    #navbarSupportedContent {
        background-color: #fff;
    }

    .navbar {
        z-index: 1000;
        border: 0;
        border-radius: 0;
        box-shadow: none;
        top: 0;
    }

    .top-nav {
        margin: auto;
        list-style: none;
        font-family: verdana;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #4866b3;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        color: #83ff36;
    }

    .navbar-light .navbar-nav .nav-link:focus {
        color: #83ff36;
    }

    .navbar-toggler-icon {
        background-image: url(<?php echo base_url("assets/img/menu_azul.png") ?>) !important;
    }

    .navbar-toggler {
        border: 0;
    }
</style>

<nav class="navbar navbar-expand-lgt menu-superior">
    <a id="logo-servicos" class="navbar-brand right" onclick="$('#confirmModal').modal('toggle')">
        <img class="logo img-fluid" src="<?php echo base_url('assets/img/horizontal.png') ?>">
        <img class="logo_numenu img-fluid" src="<?php echo base_url('assets/img/numenu/logo_numenu.png') ?>" >
    </a>
</nav>