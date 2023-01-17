<!DOCTYPE html>

<html>
	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	    <!-- Title -->
	    <title>Portal de Acesso - Voyale</title>  

	    <!-- Compatibility -->
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	    <!-- Viewport -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
 
	    <!-- Favicon -->
	    <link rel="shortcut icon" href="#">

	    <!-- Folhas de Estilo -->
	    <link href="assets/css/css.css" rel="stylesheet">
	    <link href="assets/css/login.css" rel="stylesheet">
        <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	    

    </head>
    <body>
        <section id="aluno" class="a-login">
            <div class="a-login-background a-login-background-6"></div>

            <div class="a-login-wrapper">
                <form id="mainLogin"  method="post" class="a-login-form">
                    <input type="hidden" name="">

                    <h1 class="a-login-title">
                        Portal de <span class="a-login-title-highlight">Acesso</span>
                    </h1>


                    <div class="a-login-columns">
                        <div class="a-login-column">
                            <label for="usuario" class="a-login-label">
                                Usuário
                            </label>

                            <input id="usuario" name="usuario" type="text" class="a-login-input" value="">
                        </div>

                        <div class="a-login-column">
                            <label for="senha" class="a-login-label">
                                Senha
                            </label>

                            <input id="senha" name="senha" type="password" class="a-login-input">
                        </div>
                    </div>

                    <div class="a-login-footer">
                        <input type="submit" class="a-login-btn" value="Conectar">

                        <a data-dismiss="modal" data-toggle="modal" href="#modalRedefinir" class="a-login-link">
                            Esqueceu a senha?
                        </a>
                    </div>
                </form>
            </div>

                <div class="a-login-caption">
                        <span><a href="http://www.insignus.com.br" target="_blank" name="Insignus Tecnologia"><img src="assets/imagens/powered_by.png" alt="Insignus Tecnologia"></a></span>
                </div>

            <div class="a-login-copyright">
                Voyale 2017 | Todos os direitos reservados.
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="modalRedefinir" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Digite o email para redefinir a senha</h4>
                    </div>
                    <div class="modal-body">
                        <form action='POST' id="redefinir">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input  class="form-control" type="email" name="email" >
                                        </div>        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button  type="submit" class="btn  btn-info">Redefinir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
           <!-- /Modal content-->
            </div>
        </div>
        <!-- Modal -->

        <!-- Scripts -->
        <script src="assets/js/jquery.js"></script>   
        <script src="assets/bootstrap/js/bootstrap.js"></script>   

        <script> var baseurl ="<?php echo base_url();?>"</script>
        

        <script type="text/javascript" src="<?php echo base_url("assets/js/login.js");?>"></script>

        <!-- <script type="text/javascript" async="" src="assets/js/conversion_async.js"></script>-->
        

    </body>

</html>