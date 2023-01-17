<style media="screen">
    @media (max-width: 992px) {
        .agenda .div_perfil {
            display: none;
        }

        .agenda .navbar-collapse .div_perfil {
            display: block;
        }
    }

    @media (min-width: 993px) {
        .agenda .navbar-collapse .div_perfil {
            display: none;
        }

        .agenda .navbar {
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

    .agenda .div_perfil {
        min-width: 250px;
        width: auto;
        height: 50px;
        float: right;
        right: 0;
        top: 0;
        margin-top: 35px;
        margin-right: 120px;
        font-style: verdana;
        font-size: 20px;
        color: #4866b3;
        line-height: 50px;
        position: absolute;
    }

    .agenda .navbar-collapse .div_perfil {
        position: relative;
        margin: auto;
    }

    .agenda .div_perfil a {
        font-style: verdana;
        font-size: 20px;
        color: #4866b3;
    }

    .agenda .div_perfil a:hover {
        text-decoration: none;
        color: #6afe6f;
    }

    .agenda .div_perfil img {
        width: 30px;
        height: 30px;
        margin-right: 15px;
        margin-bottom: 10px;
    }

    .agenda .navbar-expand-lg .navbar-toggler {
        display: block;
        right: 0;
        position: absolute;
        margin-right: 15px;
    }

    .agenda .navbar-toggler-icon {
        width: 40px !important;
        height: 40px !important;
    }

    .agenda .navbar {
        background-color: #fff;
    }

    .agenda .navbar .nav-item {
        padding-right: 35px;
    }

    .agenda .navbar .item a {
        color: #4866b3;
        font-size: 20px;
    }

    .agenda .navbar .item a:hover {
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

    /* .logo{
        background-image: url(<?php echo base_url("assets/img/horizontal.png") ?>);
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    } */
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
    <a id="logo-servicos" class="navbar-brand right">
        <img class="logo img-fluid" src="<?php echo base_url('assets/img/horizontal.png') ?>" onclick="$('#confirmModal').modal('toggle')">
    </a>
    <div class="div_perfil">
        <i class="fas fa-user-circle" onclick="$('#perfilModal').modal('toggle')"></i>
        <span class="info">
            <?php echo $logado ? (explode(" ", $_SESSION['nome'])[0]): '<a href="" data-toggle="modal" data-target="#loginModal">Fazer Login</a>'; ?>
            <?php echo $logado ? '| <a  href="#"  data-toggle="modal" data-target="#perfilModal">Perfil</a>' : '' ?> 
            <?php echo $logado ? '<span class="logado pl-3"><a onclick="Logout();return false;" href=""> <i class="fas fa-sign-out-alt"></i></a></span>' : '' ?>
        </span>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="nav flex-column text-right">
            <li class="nav-item ">
                <div class="div_perfil">
                    <i class="fas fa-user-circle" onclick="$('#perfilModal').modal('toggle')"></i>
                    <span class="info">
                        Olá, <?php echo $logado ? '<span onclick="$(\'#perfilModal\').modal(\'toggle\')">' . (explode(" ", $_SESSION['nome'])[0]) . '</span>' : 'visitante'; ?>!
                        <!-- <?php //echo $logado ? '| <a  href="#"  data-toggle="modal" data-target="#perfilModal">Perfil</a>' : '| <a  href="#"  data-toggle="modal" data-target="#loginModal">Login</a>' 
                                ?> -->
                        <?php echo $logado ? '<span class="logado"><a onclick="Logout();return false;" href=""> <i class="fas fa-sign-out-alt"></i></a></span>' : '| <a  href="#"  data-toggle="modal" data-target="#loginModal">Login</a>' ?>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</nav>