<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view(header);
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Base</title>	

	<?php $this->load->view('assetsinclude'); ?>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
	</div>

</div>

	<!-- Modal -->
     <div class="modal fade" id="modal1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></span>Título</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Funcao: </label>
                            <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Digite o nome da funcao">
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
</body>
</html>
<?php
//$this->load->view(header);
?>