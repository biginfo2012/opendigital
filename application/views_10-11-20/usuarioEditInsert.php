<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$this->load->view(header);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Cadastrar</title>

    <?php $this->load->view('assetsinclude'); ?>
</head>

<body class="usuarioForm">
    <?php $this->load->view('nav', array("logado" => (isset($_SESSION['logado']) ? $_SESSION['logado'] : 0), "agenda" => 0, 'outfromindex' => true)); ?>
    <div class="container" style="margin-top:150px !important;">
        <div>
            <div class="conteudo">
                <div class="row">
                    <div class="col-md-6">
                        <!-- icone colocado com font awesome dia 23/08/19 Iago k. -->
                        <h1><?php echo $title ?></h1>
                    </div>
                </div>
                <br>
                <form class="form-signin" id="<?php echo $form ?>" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- <h4>Informações de usuário</h4> -->
                            <div class="form-group">
                                <input class="form-control letterMask" name="nome" type="text" id="inputNomeCad" value="<?php echo $user->nome ?>" required="" placeholder="Nome">
                                <div class="invalid-feedback">Nome</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="data_nascimento" type="date" id="inputDtNasc" value="<?php echo $user->data_nascimento ?>" placeholder="Data de nascimento">
                                <div class="invalid-feedback">Data de nascimento</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control cpfMask" name="cpf" type="text" id="inputCpfCad" value="<?php echo $user->cpf ?>" required="" placeholder="CPF">
                                <div class="invalid-feedback">CPF</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="user" type="email" id="inputEmailCad" value="<?php echo $user->email ?>" required="" placeholder="Email">
                                <div class="invalid-feedback">Email</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="senha" type="password" id="inputPasswordCad" <?php echo $senha ?> placeholder="Senha">
                                <div class="invalid-feedback">Senha</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="confirm_senha" type="password" id="inputConfirmPassword" <?php echo $senha ?> placeholder="Confirmação de senha">
                                <div class="invalid-feedback">Confirmação de senha</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control cepMask" name="cep" type="text" id="inputCepCad" value="<?php echo $user->cep ?>" required="" placeholder="CEP">
                                <div class="invalid-feedback">CEP</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control requested" name="rua" type="text" id="inputRuaCad" value="<?php echo $user->rua ?>" required="" placeholder="Rua">
                                <div class="invalid-feedback">Rua</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control addressNumMask" name="numero_casa" type="text" id="inputNumeroCad" value="<?php echo $user->numero_casa ?>" required="" placeholder="Nº">
                                <div class="invalid-feedback">Número</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control requested" name="bairro" type="text" id="inputBairroCad" value="<?php echo $user->bairro ?>" required="" placeholder="Bairro">
                                <div class="invalid-feedback">Bairro</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input class="form-control requested" name="complemento" type="text" id="inputComplementoCad" value="<?php echo $user->complemento ?>" required="" placeholder="Complemento">
                                <div class="invalid-feedback">Complemento</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input class="form-control letterMask requested" name="cidade" type="text" id="inputCidadeCad" value="<?php echo $user->cidade ?>" required="" placeholder="Cidade">
                                <div class="invalid-feedback">Cidade</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control requested" name="estado" id="inputEstadoCad" required style="background: url(<?php echo base_url('assets/img/seta-select.png') ?>) 94% / 4% no-repeat #fff;">
                                    <option value="">Selecione um estado</option>
                                    <option value="" disabled></option>
                                    <option value="AC" <?php echo $user->estado == 'AC' ? 'selected' : null ?>>Acre</option>
                                    <option value="AL" <?php echo $user->estado == 'AL' ? 'selected' : null ?>>Alagoas</option>
                                    <option value="AP" <?php echo $user->estado == 'AP' ? 'selected' : null ?>>Amapá</option>
                                    <option value="AM" <?php echo $user->estado == 'AM' ? 'selected' : null ?>>Amazonas</option>
                                    <option value="BA" <?php echo $user->estado == 'BA' ? 'selected' : null ?>>Bahia</option>
                                    <option value="CE" <?php echo $user->estado == 'CE' ? 'selected' : null ?>>Ceará</option>
                                    <option value="DF" <?php echo $user->estado == 'DF' ? 'selected' : null ?>>Destrito Federal</option>
                                    <option value="ES" <?php echo $user->estado == 'ES' ? 'selected' : null ?>>Espírito Santo</option>
                                    <option value="GO" <?php echo $user->estado == 'GO' ? 'selected' : null ?>>Goiás</option>
                                    <option value="MA" <?php echo $user->estado == 'MA' ? 'selected' : null ?>>Maranhão</option>
                                    <option value="MT" <?php echo $user->estado == 'MT' ? 'selected' : null ?>>Mato Grosso</option>
                                    <option value="MS" <?php echo $user->estado == 'MS' ? 'selected' : null ?>>Mato Grosso do Sul</option>
                                    <option value="MG" <?php echo $user->estado == 'MG' ? 'selected' : null ?>>Minas Gerais</option>
                                    <option value="PA" <?php echo $user->estado == 'PA' ? 'selected' : null ?>>Pará</option>
                                    <option value="PB" <?php echo $user->estado == 'PB' ? 'selected' : null ?>>Paraíba</option>
                                    <option value="PR" <?php echo $user->estado == 'PR' ? 'selected' : null ?>>Paraná</option>
                                    <option value="PE" <?php echo $user->estado == 'PE' ? 'selected' : null ?>>Pernambuco</option>
                                    <option value="PI" <?php echo $user->estado == 'PI' ? 'selected' : null ?>>Piauí</option>
                                    <option value="RJ" <?php echo $user->estado == 'RJ' ? 'selected' : null ?>>Rio de Janeiro</option>
                                    <option value="RN" <?php echo $user->estado == 'RN' ? 'selected' : null ?>>Rio Grande do Norte</option>
                                    <option value="RS" <?php echo $user->estado == 'RS' ? 'selected' : null ?>>Rio Grande do Sul</option>
                                    <option value="RO" <?php echo $user->estado == 'RO' ? 'selected' : null ?>>Rondôdia</option>
                                    <option value="RR" <?php echo $user->estado == 'RR' ? 'selected' : null ?>>Roraima</option>
                                    <option value="SC" <?php echo $user->estado == 'SC' ? 'selected' : null ?>>Santa Catarina</option>
                                    <option value="SP" <?php echo $user->estado == 'SP' ? 'selected' : null ?>>São Paulo</option>
                                    <option value="SE" <?php echo $user->estado == 'SE' ? 'selected' : null ?>>Sergipe</option>
                                    <option value="TO" <?php echo $user->estado == 'TO' ? 'selected' : null ?>>Tocantins</option>
                                </select>
                                <div class="invalid-feedback">Estado</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <input class="form-control telMask" name="telefone" type="text" id="inputTelefone" value="<?php echo $user->telefone_contato ?>" required="" placeholder="Telefone">
                                <div class="invalid-feedback">Telefone</div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-5 mx-auto text-center">
                            <button type="submit" name="button" class="btn-enviar"><?php echo $button ?> &nbsp;<i class="fas fa-angle-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row poweredby">
        <br />
        <div class="col-12 text-center">
            <img class="mx-auto img-fluid" src="<?php echo base_url('assets/img/poweredby_black.png') ?>" alt="">
        </div>
    </div>
</body>

<!-- LOADING MODAL -->
<div class="modal fade" id="pleaseWaitDialog" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header mx-auto text-center">
                <h3 class="loading">CARREGANDO</h3>
            </div>
            <!-- <br>
            <br>
            <div class="modal-body text-center loading-body">
                <div id="loader" style="display:block; position:relative; z-index:1;"></div>
            </div> -->
        </div>
        <!-- /Modal content-->
    </div>
</div>

<!-- ERROR MODAL -->
<div class="modal fade" id="errorModal" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center col-md-10 mx-auto">
                    <h5 class="col-12 text-center mensagem-erro">Descrição do Erro</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
<div class="modal fade" id="successModal" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center col-md-10 mx-auto">
                    <h5 class="col-12 text-center mensagem-sucesso">Mensagem de retorno</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var baseurl = '<?php echo base_url(); ?>';
</script>
<?php $this->load->view('modal_centralAjuda'); ?>

</html>