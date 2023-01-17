$(document).ready(function() {

    /*---------------
          SUBMIT: LOGIN
        -----------------*/
    $("#mainLogin").submit(function(event) {
        // // $("#pleaseWaitDialog").modal('toggle');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Login/login',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                }
            },
            error: function() {
                errorMessage("Não foi possível contatar o servidor");
            },
            success: function(data) {
                setTimeout(function() {
                    setTimeout(function() {
                        if (data.resultado.indexOf("erro") == -1) {
                            $('#loginModal').modal('toggle');
                            $('#liCadastro').hide();
                            $('#liLogin').hide();
                            $('#liPerfil').show();
                            $('#liPedido').show();

                            $('.div_perfil .info').html(
                                '<a onclick="$(\'#perfilModal\').modal(\'toggle\')">' +
                                data.nome.split(" ", 1) +
                                ' | <a  href="#"  data-toggle="modal" data-target="#perfilModal">Perfil</a>' +
                                '</a><span class="logado pl-3"><a onclick="Logout();return false;" href=""> <i class="fas fa-sign-out-alt"></i></a></span>'
                            );

                            $('.cadastrados .row').removeClass("d-none");

                            for (var i = data.listaCadastrados.length - 1; i >= 0; i--) {
                                $("#SelectCadastrado").append(
                                    "<option value='" + data.listaCadastrados[i].cod_veiculo_usuario + "'>" +
                                    data.listaCadastrados[i].modelo + " - " + data.listaCadastrados[i].motor + " - " + data.listaCadastrados[i].ano_carro_cadastro +
                                    "</option>"
                                );
                            }
                            $('#NomeEditContent').html(data.nome);
                            $('#EmailEditContent').html(data.usuario);
                            $('#TelefoneEditContent').html(data.telefone);
                            // // $("#pleaseWaitDialog").modal('toggle');
                            $('.nao-logado').addClass('d-none');
                            if ($('.logado').hasClass('d-none')) {
                                $('.logado').removeClass('d-none');
                                $('.logado.nome').text(data.nome);
                            }
                            successMessage("Login realizado com sucesso.");
                            setTimeout(function() {
                                successMessage("Login realizado com sucesso.", 'hide');
                            }, 2500);
                        } else {
                            // // $("#pleaseWaitDialog").modal('toggle');
                            $('.mensagem-erro').text("Email ou senha incorretos");
                            $('.mensagem-erro').removeClass("d-none");
                        }

                    }, 250);
                }, 250);
            }
        }); //Ajax
    });
    /*---------------
      SUBMIT: ADMIN
    -----------------*/
    $("#admLogin").submit(function(event) {
        $('#loader').toggle();
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Admin/loginInput',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                    $('#loader').toggle();
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                    $('#loader').toggle();
                }
            },
            error: function() {
                errorMessage("Não foi possível contatar o servidor");
                $('#loader').toggle();
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    $('#loader').toggle();
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        if (data.resultado == "sucesso") {
                            window.location.href = baseurl + "admin/index";
                        } else {
                            errorMessage("Não foi possível realizar o login, tente novamente");
                        }
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click

    /*---------------
      SUBMIT: CONTATO
    -----------------*/
    $("#mainContato").submit(function(event) {
        // // $("#pleaseWaitDialog").modal('toggle');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Index/contato',
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'json',
            statusCode: {
                404: function(xhr) {
                    errorMessage("Não foi possível contatar o servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                },
                500: function(xhr) {
                    errorMessage("Ocorreu um erro no servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                }
            },
            error: function(xhr) {
                console.log(xhr);
                // // $("#pleaseWaitDialog").modal('toggle');
                $('#contatoModal').modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    // // $("#pleaseWaitDialog").modal('toggle');
                    setTimeout(function() {
                        var textErr = "";
                        $.each(data.erros, function(k, v) { textErr += v + " \n"; });
                        if (data.resultado == "sucesso") {
                            $('#contatoModal').modal('toggle');
                            successMessage("Mensagem enviada com sucesso");
                        } else {
                            errorMessage(textErr);
                        }
                    }, 200);
                }, 200);
            }
        }); //Ajax
    }); //click

    /*---------------
      CADASTRO/EDIT: GET ENDEREÇO POR CEP
    -----------------*/
    $("#inputCepCad").change(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: 'https://viacep.com.br/ws/' + this.value + '/json/',
            cache: false,
            dataType: 'json',
            statusCode: {
                404: function(xhr) {
                    console.log("Não foi possível contatar o servidor viacep");
                },
                500: function(xhr) {
                    $('.mensagem-erro').text('CEP não encontrado');
                    $('#errorModal').modal('toggle');
                    $(".address .requested").val(null);
                }
            },
            error: function(xhr) {
                console.log("Ocorreu um erro" + xhr.responseText);
                $(".address .requested").val(null);
            },
            success: function(data) {
                // console.log(data);

                //Time out para abrir o carregando
                if (data.erro != true) {
                    $("#inputEstadoCad").val(data.uf);
                    $("#inputCidadeCad").val(data.localidade);
                    $("#inputBairroCad").val(data.bairro);
                    $("#inputRuaCad").val(data.logradouro);
                } else {
                    $('.mensagem-erro').text('CEP não encontrado');
                    $('#errorModal').modal('toggle');

                    $(".address .requested").val(null);
                }
            }
        }); //Ajax
    });

    /*---------------
      SUBMIT: CADASTRO
    -----------------*/
    $("#mainCadastro").submit(function(event) {
        // $("#pleaseWaitDialog").modal('show');
        if (window.location.href.indexOf('volanty') != -1) {
            $("#loader").modal('show');
        }
        event.preventDefault();
        form_data = $(this).serializeArray();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Login/inserir',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'json',
            statusCode: {
                404: function(xhr) {
                    errorMessage("Não foi possível contatar o servidor");
                    // $("#pleaseWaitDialog").modal('hide');
                    if (window.location.href.indexOf('volanty') != -1) {
                        $("#loader").modal('hide');
                    }
                },
                500: function(xhr) {
                    errorMessage("Ocorreu um erro no servidor");
                    if (window.location.href.indexOf('volanty') != -1) {
                        $("#loader").modal('hide');
                    }
                }
            },
            error: function(xhr) {
                errorMessage("Ocorreu um erro" + xhr.responseText);
                // $("#pleaseWaitDialog").modal('hide');
                if (window.location.href.indexOf('volanty') != -1) {
                    $("#loader").modal('hide');
                }
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        var textErr = "";
                        $.each(data.erros, function(k, v) {
                            textErr += v + ". ";
                        });
                        if (data.resultado == "sucesso") {
                            successMessage("Cadastro realizado com sucesso");
                            setTimeout(function() {
                                if (window.location.href.indexOf('volanty') != -1) {
                                    outsideLogin($("#mainCadastro #inputEmailCad").val(), $("#mainCadastro #inputPasswordCad").val());
                                } else {
                                    window.location.href = baseurl + 'agenda';
                                }
                            }, 250);
                        } else {
                            // $("#pleaseWaitDialog").modal('hide');
                            errorMessage(textErr);
                        }
                    }, 250);
                    if (window.location.href.indexOf('volanty') != -1) {
                        $("#loader").modal('hide');
                    }
                }, 250);
            }
        }); //Ajax
    }); //click

    /*---------------
      SUBMIT: UNIDADE
    -----------------*/
    /*---------INSERT----------*/
    $('#form_unidade_cad').on('submit', function(e) {
        $("#loader").modal('toggle');
        e.preventDefault();
        $.ajax({
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            url: baseurl + 'Admin/insert',
            data: new FormData($('#form_unidade_cad')[0]),
            statusCode: {
                404: function(xhr) {
                    errorMessage("Não foi possível contatar o servidor");
                    $("#loader").modal('toggle');
                },
                500: function(xhr) {
                    errorMessage("Ocorreu um erro no servidor");
                    $("#loader").modal('toggle');
                }
            },
            error: function(xhr) {
                errorMessage("Ocorreu um erro" + xhr.responseText);
                $("#loader").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    $("#loader").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {

                        var textErr = "";
                        $.each(data.erros, function(k, v) {
                            textErr += v + " \n";
                        });
                        if (data.resultado == "sucesso") {
                            if (data.criarContaMoip == "1") {
                                var win = window.open(data.setPassword, '_blank');
                            } else {
                                window.location.href = baseurl + 'Admin';
                            }
                            successMessage("Operação realizada com sucesso");
                            window.location.href = baseurl + 'Admin';
                        } else {
                            erros = textErr.split('.');
                            $('.mensagem-erro').text('');
                            for (i in erros) {
                                $('.mensagem-erro').append(erros[i] + '<br>');
                            }
                            $('.mensagem-erro').removeClass('d-none');
                            $(window).scrollTop(0);
                        }
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click
    /*---------EDIT----------*/
    $('#form_unidade_edit').on('submit', function(e) {
        $("#loader").modal('toggle');
        //var url = $(this).attr('action');
        e.preventDefault();
        $.ajax({
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            url: baseurl + 'Admin/update',
            data: new FormData($('#form_unidade_edit')[0]),
            statusCode: {
                404: function(xhr) {
                    errorMessage("Não foi possível contatar o servidor");
                    $("#loader").modal('toggle');
                },
                500: function(xhr) {
                    errorMessage("Ocorreu um erro no servidor");
                    $("#loader").modal('toggle');
                }
            },
            error: function(xhr) {
                errorMessage("Ocorreu um erro" + xhr.responseText);
                $("#loader").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    $("#loader").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        var textErr = "";
                        $.each(data.erros, function(k, v) {
                            textErr += v + " \n";
                        });
                        if (data.resultado == "sucesso") {
                            window.location.href = baseurl + 'Admin';
                        } else {
                            erros = textErr.split('.');
                            $('.mensagem-erro').text('');
                            for (i in erros) {
                                $('.mensagem-erro').append(erros[i] + '<br>');
                            }
                            $('.mensagem-erro').removeClass('d-none');
                            $(window).scrollTop(0);
                        }
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click

    /*---------------
      SUBMIT: PERFIL
    -----------------*/
    $("#mainPerfil").submit(function(event) {
        event.preventDefault();
        // // $("#pleaseWaitDialog").modal('toggle');
        //$("#liberar").ajaxForm({url: 'server.php', type: 'post'});  OU
        $.ajax({
            type: 'POST',
            url: baseurl + 'Login/editar',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'json',
            statusCode: {
                404: function(xhr) {
                    errorMessage("Não foi possível contatar o servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                },
                500: function(xhr) {
                    errorMessage("Ocorreu um erro no servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                }
            },
            error: function(xhr) {
                errorMessage("Ocorreu um erro" + xhr.responseText);
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    // // $("#pleaseWaitDialog").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        var textErr = "";
                        $.each(data.erros, function(k, v) {

                            textErr += v + " \n";
                        });
                        if (data.resultado == "sucesso") {
                            $('#perfilModal').modal('toggle');

                            $(".labelEdit").show();
                            $(".inputEdit").hide();

                            $("#btnPermitirEditarPerfil").show();
                            $("#btnSalvarPerfil").hide();

                            $("#inputConfirmSenhaEdit").val("");
                            $("#inputSenhaEdit").val("");

                            $('.mensagem-sucesso').text("Perfil Editado com sucesso");
                            $('#loader').toggle();
                            $('#successModal').modal('toggle');
                        } else {
                            $('.mensagem-erro').text(textErr);
                            $('#loader').toggle();
                            $('#errorModal').modal('toggle');
                        }
                    }, 250);

                }, 250);
            }
        }); //Ajax
    }); //click

    /*---------------
      SUBMIT: REDEFINIÇÃO
      Envia a solicitação de redefinição de senha
    -----------------*/
    $("#mainRecover").submit(function(event) {
        $("#loader").show();
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Login/requestRecover',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(),
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                    $("#loader").hide();
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                    $("#loader").hide();
                }
            },
            error: function(xhr, status, error) {
                errorMessage('Ocorreu um erro.');
                $("#loader").hide();
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    $("#loader").hide();
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        //Mostrar mensagem de erro
                        if (data.resultado != 'sucesso') {
                            errorMessage("CPF não encontrado.");
                        } else {
                            loginModalChange('success');
                        }
                        $('#redefinirModal').modal('toggle');
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click

    /*---------------
      SUBMIT: REDEFINIÇÃO
      Envia a nova senha para redefinção
    -----------------*/
    $("#passwordRecover").submit(function(event) {
        // // $("#pleaseWaitDialog").modal('toggle');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Login/passwordRecover',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(),
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                }
            },
            error: function(xhr, status, error) {
                errorMessage('Ocorreu um erro.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    // // $("#pleaseWaitDialog").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        //Mostrar mensagem de erro
                        if (data.resultado == 'sucesso') {
                            console.log("SUCESSO");

                            $("#passwordRecover").html(
                                "<h5>" +
                                "Sua senha foi revalidada com sucesso." +
                                "<br> <br>" +
                                "<a href='" + baseurl + "'>Voltar</a>" +
                                "</h5>"
                            );
                        } else {
                            errorMessage(data.erro);
                        }
                        $('#redefinirModal').modal('toggle');
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click

    /*---------------
      SUBMIT: Cadastrar modelo de Veículo
    -----------------*/
    $("#insertVeiculo").submit(function(event) {
        // // $("#pleaseWaitDialog").modal('toggle');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Admin/insertVeiculo',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(),
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                }
            },
            error: function(xhr, status, error) {
                errorMessage('Ocorreu um erro.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    // // $("#pleaseWaitDialog").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        //Mostrar mensagem de erro
                        if (data.resultado == 'sucesso') {
                            location.reload();
                        } else {
                            errorMessage(data.msg);
                        }
                        $('#modalVeículo').modal('toggle');
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click

    $("#form_veiculo_edit").submit(function(event) {
        // // $("#pleaseWaitDialog").modal('toggle');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Admin/editVeiculo',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(),
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                }
            },
            error: function(xhr, status, error) {
                errorMessage('Ocorreu um erro.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    // // $("#pleaseWaitDialog").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        //Mostrar mensagem de erro
                        if (data.resultado == 'sucesso') {
                            location.reload();
                        } else {
                            errorMessage(data.msg);
                        }
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click

    /*---------------
      SUBMIT: Cadastrar Variação de carro
      Cadastra nov avariação pra veículo
    -----------------*/
    $("#insertVariacao").submit(function(event) {
        // // $("#pleaseWaitDialog").modal('toggle');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Admin/insertVariacao',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(),
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                }
            },
            error: function(xhr, status, error) {
                errorMessage('Ocorreu um erro.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    // // $("#pleaseWaitDialog").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        //Mostrar mensagem de erro
                        if (data.resultado == 'sucesso') {
                            location.reload();
                        } else {
                            errorMessage(data.msg);
                        }
                        $('#modalVariacao').modal('toggle');
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click


    $("#updateVariacao").submit(function(event) {
        // // $("#pleaseWaitDialog").modal('toggle');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: baseurl + 'Admin/updateVariacao',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: $(this).serialize(),
            dataType: 'json',
            statusCode: {
                404: function() {
                    errorMessage("Não foi possível contatar o servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                },
                500: function() {
                    errorMessage("Ocorreu um erro no servidor");
                    // // $("#pleaseWaitDialog").modal('toggle');
                }
            },
            error: function(xhr, status, error) {
                errorMessage('Ocorreu um erro.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            success: function(data) {
                //Time out para abrir o carregando
                setTimeout(function() {
                    // // $("#pleaseWaitDialog").modal('toggle');
                    //Time out para fechar o carregando
                    setTimeout(function() {
                        //Mostrar mensagem de erro
                        if (data.resultado == 'sucesso') {
                            location.reload();
                        } else {
                            errorMessage(data.msg);
                        }
                    }, 250);
                }, 250);
            }
        }); //Ajax
    }); //click

    /*========================================*/
    /*========================================*/

    //AGENDA
    /*---------------
      CHANGE: #1 - VEÍCULOS CADASTRADOS
      Seleciona montadora, modelo e motor a partir do item cadastrado selecionado
    -----------------*/
    $("#SelectCadastrado").on('change', function(event) {
        $.ajax({
            type: 'POST',
            url: baseurl + 'agenda/Cadastrado',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: { cadastrado: $("#SelectCadastrado").val() },
            dataType: 'json',
            statusCode: {
                404: function() { errorMessage("Não foi possível contatar o servidor"); },
                500: function() { errorMessage("Ocorreu um erro no servidor"); }
            },
            error: function(xhr, status, error) { console.log(xhr.responseText + status + error); },
            success: function(json) {
                if (json.resultado == "sucesso") {
                    // MONTADORAS
                    $("#SelectMontadora").html("");
                    $("#SelectMontadora").append("<option value=''>Montadora</option>");
                    for (var i = json.lista_montadoras.length - 1; i >= 0; i--) {
                        $("#SelectMontadora").append("<option " + (json.cadastrado.montadora == json.lista_montadoras[i] ? "selected" : "") + " value='" + json.lista_montadoras[i] + "'>" + json.lista_montadoras[i] + "</option>");
                    }
                    // MODELOS
                    $("#SelectModelo").html("");
                    $("#SelectModelo").append("<option value=''>Modelo</option>");
                    for (var i = json.lista_modelos.length - 1; i >= 0; i--) {
                        $("#SelectModelo").append("<option " + (json.cadastrado.modelo == json.lista_modelos[i] ? "selected" : " ") + " value='" + json.lista_modelos[i] + "'>" + json.lista_modelos[i] + "</option>");
                    }
                    // MOTORES
                    $("#SelectMotor").html("");
                    $("#SelectMotor").append("<option value=''>Motor</option>");
                    for (var i = json.lista_motores.length - 1; i >= 0; i--) {
                        $("#SelectMotor").append("<option " + (json.cadastrado.motor == json.lista_motores[i].motor ? "selected" : " ") + " value='" + json.lista_motores[i].cod_modelo + "'>" + json.lista_motores[i].motor + "</option>");
                    }
                    //ANO
                    $("#ano-veiculo").val(json.cadastrado.ano_cadastrado);
                }
            }
        }); //Ajax
    });

    /*---------------
      CHANGE: #1 - MONTADORAS
    -----------------*/
    $("#SelectMontadora").on('change', function(event) {
        $("#SelectModelo").html("<option>...</option>");
        $.ajax({
            type: 'POST',
            url: baseurl + 'agenda/Modelo',
            cache: false,
            data: { montadora: $("#SelectMontadora").val() },
            dataType: 'json',
            async: true,
            headers: { "cache-control": "no-cache" },
            statusCode: {
                404: function() { errorMessage("Não foi possível contatar o servidor"); },
                500: function() { errorMessage("Ocorreu um erro no servidor"); }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText + status + error);
                $("body").html('A problem has occurred.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            success: function(json) {
                if (json.resultado == "sucesso") {
                    $("#SelectMontadora").removeClass('next');
                    $("#SelectMotor").removeClass('next');
                    $("#ano-veiculo").removeClass('next');
                    $("#km-veiculo").removeClass('next');
                    if (!($("#SelectModelo").hasClass('next'))) {
                        $("#SelectModelo").addClass('next');
                    }
                    $("#SelectModelo").html("");
                    $("#SelectMotor").html("");
                    $("#SelectModelo").append("<option value=''>Modelo</option>");
                    $("#SelectMotor").append("<option value=''>Motor</option>");
                    for (var i = json.lista.length - 1; i >= 0; i--) {
                        $("#SelectModelo").append("<option value='" + json.lista[i] + "'>" + json.lista[i] + "</option>");
                    }
                }
            }
        }); //Ajax
    }); //change

    /*---------------
      CHANGE: #1 - MODELO
    -----------------*/
    $("#SelectModelo").on('change', function(event) {
        $("#SelectMotor").html("<option>...</option>");
        $.ajax({
            type: 'POST',
            url: baseurl + 'agenda/Motor',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: { modelo: $("#SelectModelo").val() },
            dataType: 'json',
            statusCode: {
                404: function() { errorMessage("Não foi possível contatar o servidor"); },
                500: function() { errorMessage("Ocorreu um erro no servidor"); }
            },
            error: function(xhr, status, error) { console.log(xhr.responseText + status + error); },
            success: function(json) {
                if (json.resultado == "sucesso") {
                    $("#SelectModelo").removeClass('next');
                    $("#ano-veiculo").removeClass('next');
                    $("#km-veiculo").removeClass('next');
                    if (!($("#SelectMotor").hasClass('next'))) {
                        $("#SelectMotor").addClass('next');
                    }
                    $("#SelectMotor").html("");
                    $("#SelectMotor").append("<option value=''>Motor</option>");
                    for (var i = json.lista.length - 1; i >= 0; i--) {
                        $("#SelectMotor").append("<option value='" + json.lista[i]['cod_modelo'] + "'>" + json.lista[i]['motor'] + "</option>");
                    }
                }
            }
        }); //Ajax
    }); //click

    $("#SelectMotor").on('change', function(event) {
        $("#SelectMotor").removeClass('next');
        $("#km-veiculo").removeClass('next');
        if (!($("#ano-veiculo").hasClass('next'))) {
            $("#ano-veiculo").addClass('next');
        }
    });

    $("#ano-veiculo").on('change', function(event) {
        if ($("#SelectMotor option").length > 1) {
            $("#ano-veiculo").removeClass('next');
            if (!($("#km-veiculo").hasClass('next'))) {
                $("#km-veiculo").addClass('next');
            }
        }
    });

    /*---------------
      CHANGE: #4 - UNIDADE
    -----------------*/
    $("#unidadeSelecionada").on('change', function(event) {
        $('#periodoSelecionado').val(0);
        $("#periodo-1").attr("onclick", "null");
        $("#periodo-1").removeClass('active');
        $("#periodo-1").removeClass('disabled');
        $("#periodo-2").attr("onclick", "null");
        $("#periodo-2").removeClass('active');
        $("#periodo-2").removeClass('disabled');
        $.ajax({
            type: 'POST',
            url: baseurl + 'agenda/UnidadeRegiao',
            cache: false,
            headers: { "cache-control": "no-cache" },
            data: { unidade: $("#unidadeSelecionada").val() },
            dataType: 'json',
            statusCode: {
                404: function() { errorMessage("Não foi possível contatar o servidor"); },
                500: function() { errorMessage("Ocorreu um erro no servidor"); }
            },
            error: function(xhr, status, error) { console.log(xhr.responseText + status + error); },
            success: function(json) {
                //Mostrar mensagem de erro
                if (json.resultado == "sucesso") {
                    if (json.periodo == 1) {
                        $("#periodo-1").attr("onclick", "selecionaPeriodo(1); return false;");
                        $("#periodo-2").attr("onclick", "null");
                        $("#periodo-2").addClass('disabled');
                    } else if (json.periodo == 2) {
                        $("#periodo-1").attr("onclick", "null");
                        $("#periodo-1").addClass('disabled');
                        $("#periodo-2").attr("onclick", "selecionaPeriodo(2); return false;");
                    } else if (json.periodo == 3) {
                        $("#periodo-1").attr("onclick", "selecionaPeriodo(1); return false;");
                        $("#periodo-2").attr("onclick", "selecionaPeriodo(2); return false;");
                    } else {
                        $("#periodo-1").attr("onclick", "null");
                        $("#periodo-1").addClass('disabled');
                        $("#periodo-2").attr("onclick", "null");
                        $("#periodo-2").addClass('disabled');
                    }
                } else {
                    $("#periodo-1").attr("onclick", "null");
                    $("#periodo-1").addClass('disabled');
                    $("#periodo-2").attr("onclick", "null");
                    $("#periodo-2").addClass('disabled');
                }
            }
        }); //Ajax
    }); //change

    $('#loginModal').on('hidden.bs.modal', function() {
        loginModalChange('login');
    })
}); //document


/*
 *  Pega os pedidos do cliente
 */
function Pedido(offset = 0) {
    var modal_loading = $('#pleaseWaitDialog');

    modal_loading.on('shown.bs.modal', function(e) {
        if (modal_loading.attr('aria-modal') === 'true') {
            modal_loading.modal('hide');
        } else {
            modal_loading.modal('show');
        }
    });
    // modal_loading.modal('toggle');
    $("#pedido").css('display', 'none');
    $.ajax({
        type: "POST",
        cache: false,
        headers: { "cache-control": "no-cache" },
        processData: false,
        contentType: false,
        url: baseurl + "agenda/pedidos/" + offset,
        statusCode: {
            404: function() {
                //$("body").html('Could not contact server.');
                errorMessage('Could not contact server.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            500: function() {
                //$("body").html('A server-side error has occurred.');
                errorMessage('A server-side error has occurred.');
                // // $("#pleaseWaitDialog").modal('toggle');
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText + status + error);
            //$("body").html('A problem has occurred.');
            error("Falha ao conectar com o servidor.");
            // $("#pleaseWaitDialog").modal('toggle');
        },
        success: function(data) {
            //Time out para abrir o carregando
            setTimeout(
                function() {

                    // $("#pleaseWaitDialog").modal('toggle');

                    //Time out para fechar o carregando
                    setTimeout(
                        function() {


                            if (data.resultado == "sucesso") {
                                $("#listaPedidos").html("");
                                $(".pagination ul").html("");


                                for (var i = data.lista.length - 1; i >= 0; i--) {

                                    var sqlDateArr1 = data.lista[i]['data'].split("-");
                                    var day = sqlDateArr1[2];
                                    var dateMDY = day + "/" + sqlDateArr1[1] + "/" + sqlDateArr1[0];

                                    var descPeriodo = data.lista[i]['periodo'] == 1 ? "Matutino" : "Vespertino";

                                    var pedido =
                                        "<div class='item animated fadeIn'>" +
                                        "<div class='row'>" +
                                        "<div class='col-3 text-left'>" +
                                        "<b>ID:</b>" +
                                        "</div>" +
                                        "<div class='col-9 text-left'>" +
                                        data.lista[i].cod_agenda +
                                        "</div>" +
                                        "</div>" +
                                        "<div class='row'>" +
                                        "<div class='col-3 text-left'>" +
                                        "<b>Unidade:</b>" +
                                        "</div>" +
                                        "<div class='col-9 text-left'>" +
                                        data.lista[i].unidade +
                                        "</div>" +
                                        "</div>" +
                                        "<div class='row'>" +
                                        "<div class='col-3 text-left'>" +
                                        "<b>Data:</b>" +
                                        "</div>" +
                                        "<div class='col-9 text-left'>" +
                                        dateMDY + " - " + descPeriodo +
                                        "</div>" +
                                        "</div>" +
                                        "<div class='row'>" +
                                        "<div class='col-12 text-center'>" +
                                        "<a class='detalhes-pedido' href='#' onclick='detalhesPedido(" + data.lista[i].cod_agenda + "); return false;'>Detalhes</a>" +
                                        "</div>" +
                                        "</div>" +
                                        "</div>";

                                    $("#listaPedidos").append(pedido);
                                }

                                qtde_paginas = Math.ceil(data.lista[0].num_rows / 5);
                                j = 1;
                                while (j <= qtde_paginas) {
                                    pagina =
                                        "<li>" +
                                        "<a href='#'  class='" + (offset == j - 1 ? 'active' : '') + "' onclick='pedidoPagination(" + (j - 1) + "); return false;'>" + j + "</a>" +
                                        "</li>";
                                    $(".pagination ul").append(pagina);
                                    j++;
                                }

                                $("#pedidosModal").modal('toggle');
                            } else if (data.resultado == "nenhum_pedido") {
                                errorMessage("Não há nenhum pedido.");
                            } else {
                                errorMessage(data.msg);
                            }

                        }, 250);

                }, 250);
        }
    });
}


function pedidoPagination(offset = 0) {
    $.ajax({
        type: "POST",
        cache: false,
        headers: { "cache-control": "no-cache" },
        processData: false,
        contentType: false,
        url: baseurl + "agenda/pedidos/" + offset,
        statusCode: {
            404: function() {
                errorMessage('Could not contact server.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            500: function() {
                errorMessage('A server-side error has occurred.');
                // // $("#pleaseWaitDialog").modal('toggle');
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText + status + error);
            errorMessage("Falha ao conectar com o servidor.");
            // // $("#pleaseWaitDialog").modal('toggle');
        },
        success: function(data) {
            if (data.resultado == "sucesso") {
                $("#listaPedidos").html("");
                $(".pagination ul").html("");

                for (var i = data.lista.length - 1; i >= 0; i--) {

                    var sqlDateArr1 = data.lista[i]['data'].split("-");
                    var day = sqlDateArr1[2];
                    var dateMDY = day + "/" + sqlDateArr1[1] + "/" + sqlDateArr1[0];

                    var descPeriodo = data.lista[i]['periodo'] == 1 ? "Matutino" : "Vespertino";

                    var pedido =
                        "<div class='item animated fadeIn'>" +
                        "<div class='row'>" +
                        "<div class='col-3 text-left'>" +
                        "<b>ID:</b>" +
                        "</div>" +
                        "<div class='col-9 text-left'>" +
                        data.lista[i].cod_agenda +
                        "</div>" +
                        "</div>" +
                        "<div class='row'>" +
                        "<div class='col-3 text-left'>" +
                        "<b>Unidade:</b>" +
                        "</div>" +
                        "<div class='col-9 text-left'>" +
                        data.lista[i].unidade +
                        "</div>" +
                        "</div>" +
                        "<div class='row'>" +
                        "<div class='col-3 text-left'>" +
                        "<b>Data:</b>" +
                        "</div>" +
                        "<div class='col-9 text-left'>" +
                        dateMDY + " - " + descPeriodo +
                        "</div>" +
                        "</div>" +
                        "<div class='row'>" +
                        "<div class='col-12 text-center'>" +
                        "<a class='detalhes-pedido' href='#' onclick='detalhesPedido(" + data.lista[i].cod_agenda + "); return false;'>Detalhes</a>" +
                        "</div>" +
                        "</div>" +

                        "</div>";

                    $("#listaPedidos").append(pedido);
                }

                qtde_paginas = Math.ceil(data.lista[0].num_rows / 5);
                j = 1;
                while (j <= qtde_paginas) {
                    pagina =
                        "<li>" +
                        "<a href='#' class='" + (offset == j - 1 ? 'active' : '') + "' onclick='pedidoPagination(" + (j - 1) + "); return false;'>" + j + "</a>" +
                        "</li>";
                    $(".pagination ul").append(pagina);
                    j++;
                }
            } else {
                errorMessage(data.msg);
            }
        }
    });
}


function detalhesPedido(cod_agenda) {
    $.ajax({
        type: "POST",
        cache: false,
        headers: { "cache-control": "no-cache" },
        processData: false,
        contentType: false,
        url: baseurl + "agenda/detalhesPedido/" + cod_agenda,
        statusCode: {
            404: function() {
                errorMessage('Could not contact server.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            500: function() {
                errorMessage('A server-side error has occurred.');
                // // $("#pleaseWaitDialog").modal('toggle');
            }
        },
        error: function(xhr, status, error) {
            // console.log(xhr.responseText + status + error);
            errorMessage("Falha ao conectar com o servidor.");
            // // $("#pleaseWaitDialog").modal('toggle');
        },
        success: function(data) {
            if (data.resultado == "sucesso") {
                $(".pedidosList").css('display', 'none');
                $("#pedido").css('display', 'block');

                var sqlDateArr1 = data.pedido.data.split("-");
                var day = sqlDateArr1[2];
                var dateMDY = day + "/" + sqlDateArr1[1] + "/" + sqlDateArr1[0];

                var descPeriodo = data.pedido.periodo == 1 ? "Matutino" : "Vespertino";

                $(".id").html("Pedido " + data.pedido.cod_agenda);
                $(".unidade").html(data.pedido.unidade);
                $(".endereco").html(data.pedido.endereco);
                $(".data").html(dateMDY + " - " + descPeriodo);
                $(".modelo").html(data.pedido.modelo.montadora + " " + data.pedido.modelo.modelo + " " + data.pedido.modelo.motor + " - " + data.pedido.ano_carro);
                $(".servico").html(data.pedido.servico.nome);

                $(".preco").html("R$" + (((data.pedido.servico.preco / 100).toFixed(2)).replace('.', ',')));
                $(".voucher").html(data.pedido.voucher);
                $(".status").html(data.pedido.status);
            } else {
                errorMessage(data.msg);
            }
        }
    });
}

function voltarListaPedidos() {
    $("#pedido").css('display', 'none');
    $(".pedidosList").css('display', 'block');
}

/*
 *  Pega os pedidos do cliente
 */
function Logout() {
    // // $("#pleaseWaitDialog").modal('toggle');
    $.ajax({
        type: "POST",
        cache: false,
        headers: { "cache-control": "no-cache" },
        processData: false,
        contentType: false,
        url: baseurl + "login/logout",
        statusCode: {
            404: function() {
                //$("body").html('Could not contact server.');
                errorMessage('Could not contact server.');
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            500: function() {
                //$("body").html('A server-side error has occurred.');
                errorMessage('A server-side error has occurred.');
                // // $("#pleaseWaitDialog").modal('toggle');
            }
        },
        error: function(xhr, status, error) {
            // console.log(xhr.responseText + status + error);
            //$("body").html('A problem has occurred.');
            errorMessage("Falha ao conectar com o servidor.");
            // // $("#pleaseWaitDialog").modal('toggle');
        },
        success: function(data) {
            //Time out para abrir o carregando
            setTimeout(
                function() {
                    //Time out para fechar o carregando
                    setTimeout(
                        function() {
                            if (data.resultado == "sucesso") {
                                $('#perfilModal').modal('hide');

                                $("#SelectCadastrado").hide();
                                $('.div_perfil .info').html(
                                    '<a href="" data-toggle="modal" data-target="#loginModal">Fazer Login</a>'
                                );
                                // // $("#pleaseWaitDialog").modal('toggle');

                                successMessage(data.msg)
                            } else {
                                errorMessage(data.msg);
                            }
                        }, 250);
                }, 250);
        }
    });

}

// REALIZA O LOGOUT DA ÁREA DE ADMIN
function LogoutAdmin() {
    $('#loader').toggle();

    $.ajax({
        type: "POST",
        cache: false,
        headers: { "cache-control": "no-cache" },
        processData: false,
        contentType: false,
        url: baseurl + "admin/logout",
        statusCode: {
            404: function() {
                //$("body").html('Could not contact server.');
                errorMessage('Could not contact server.');
                $('#loader').toggle();
            },
            500: function() {
                //$("body").html('A server-side error has occurred.');
                errorMessage('A server-side error has occurred.');
                $('#loader').toggle();
            }
        },
        error: function(xhr, status, error) {
            // console.log(xhr.responseText + status + error);
            //$("body").html('A problem has occurred.');
            errorMessage("Falha ao conectar com o servidor.");
            $('#loader').toggle();
        },
        success: function(data) {

            //Time out para abrir o carregando
            setTimeout(
                function() {

                    $('#loader').toggle();

                    //Time out para fechar o carregando
                    setTimeout(
                        function() {


                            if (data.resultado == "sucesso") {
                                successMessage(data.msg);
                                window.location.href = baseurl + "admin";
                            } else {
                                errorMessage(data.msg);
                            }

                        }, 250);

                }, 250);
        }
    });

}

/*
 *  Pega os servicos de um veiculo e passa para a segunda etapa
 */
function Veiculo() {
    $('#loader').toggle();
    $('#preco-serv1').html("CARREGANDO");
    $('#preco-serv2').html("CARREGANDO");
    $('#preco-serv3').html("CARREGANDO");

    $.ajax({
        type: "POST",
        cache: false,
        headers: { "cache-control": "no-cache" },
        data: {
            cod_modelo: $("#SelectMotor").val(),
            ano_carro: $("#ano-veiculo").val(),
            km_carro: $("#km-veiculo").val()
        },
        dataType: 'json',
        url: baseurl + "agenda/veiculo",
        statusCode: {
            404: function() {
                errorMessage('Sem acesso ao servidor.');
                $('#loader').toggle();
            },
            500: function() {
                errorMessage('Erro no servidor.');
                $('#loader').toggle();
            }
        },
        error: function(xhr, status, error) {
            // console.log(xhr.responseText + status + error);
            errorMessage("Falha ao conectar com o servidor.");
            $('#loader').toggle();
        },
        success: function(data) {
            setTimeout(function() {
                setTimeout(function() {
                    var textErr = "";
                    $.each(data.erros, function(k, v) {
                        textErr += v + " \n";
                    });
                    if (data.resultado == "sucesso") {
                        if (data.customizado == 0) {
                            $('#loader').toggle();
                            $(".basico .price-value span").text("R$" + (((data.lista[0].preco / 100).toFixed(2)).replace('.', ',')));
                            $(".inter .price-value span").text("R$" + (((data.lista[1].preco / 100).toFixed(2)).replace('.', ',')));
                            $(".premium .price-value span").text("R$" + (((data.lista[2].preco / 100).toFixed(2)).replace('.', ',')));
                            servico_basico = data.lista[0].cod_servicos;
                            servico_inter = data.lista[1].cod_servicos;
                            servico_premium = data.lista[2].cod_servicos;
                            $('.fullpage').fullpage.moveTo(1, 2);
                        } else if (data.customizado == 1) {
                            // SERVIÇO SOB CONSULTA
                            $('#loader').toggle();
                            $('.fullpage').fullpage.right();
                            $('.fullpage').fullpage.right();
                        }
                    } else {
                        erros = textErr.split('.');
                        $('#loader').toggle();
                        errorMessage(erros[0] == 'O campo Código Modelo é obrigatório' ? 'É necessário escolher o veículo' : erros[0])
                    }
                }, 250);
            }, 250);
        }
    });
}

function outsideLogin(user, pass) {
    $.ajax({
        type: "POST",
        cache: false,
        headers: { "cache-control": "no-cache" },
        data: {
            user: user,
            senha: pass,
            ajax: 1
        },
        dataType: 'json',
        url: baseurl + "volanty/login",
        statusCode: {
            404: function() {
                errorMessage('Sem acesso ao servidor.');
                $('#loader').toggle();
            },
            500: function() {
                errorMessage('Erro no servidor.');
                $('#loader').toggle();
            }
        },
        error: function(xhr, status, error) {
            errorMessage("Falha ao conectar com o servidor.");
            $('#loader').toggle();
            window.location.href = baseurl + 'volanty/agenda';
        },
        success: function(data) {
            if (data.resultado == 'sucesso') {
                window.location.href = baseurl + 'volanty/agenda';
            }
        }
    });
}

function successMessage(message, action = 'toggle') {
    $('.mensagem-sucesso').text('');
    $('.mensagem-sucesso').text(message);
    $('#successModal').modal(action);
}

function errorMessage(message, action = 'toggle') {
    $('.mensagem-erro').text('');
    $('.mensagem-erro').text(message);
    $('#errorModal').modal(action);
}

function loginModalChange(page) {
    dnone_login = $("#mainLogin").hasClass('d-none');
    dnone_recover = $("#mainRecover").hasClass('d-none');
    dnone_success = $("#recoverySent").hasClass('d-none');

    switch (page) {
        case 'login':
            if (!dnone_recover) {
                $("#mainRecover").addClass('d-none')
            }
            if (!dnone_success) {
                $("#recoverySent").addClass('d-none')
            }
            if (dnone_login) {
                $("#mainLogin").removeClass('d-none')
            }
            break;
        case 'recover':
            if (!dnone_login) {
                $("#mainLogin").addClass('d-none')
            }
            if (!dnone_success) {
                $("#recoverySent").addClass('d-none')
            }
            if (dnone_recover) {
                $("#mainRecover").removeClass('d-none')
            }
            break;
        case 'success':
            if (!dnone_recover) {
                $("#mainRecover").addClass('d-none')
            }
            if (!dnone_login) {
                $("#mainLogin").addClass('d-none')
            }
            if (dnone_success) {
                $("#recoverySent").removeClass('d-none')
            }
            break;
    }
}

// MUTA O VÍDEO APÓS CLIQUE DO BOTÃO
function mute() {
    if ($("#myVideo").prop('muted')) {
        $("#mute i").removeClass('fa-volume-off');
        $("#mute i").addClass('fa-volume-up');
        $("#myVideo").prop('muted', false);
    } else {
        $("#mute i").removeClass('fa-volume-up');
        $("#mute i").addClass('fa-volume-off');
        $("#myVideo").prop('muted', true)
    }
}


/*---------------
      GET: Pegar
      Cadastra nov avariação pra veículo
    -----------------*/
function getVariacao(cod_variacao) {
    $.ajax({
        type: 'POST',
        url: baseurl + 'Admin/getInfoVariacao',
        cache: false,
        headers: { "cache-control": "no-cache" },
        data: { "cod_variacao": cod_variacao },
        dataType: 'json',
        statusCode: {
            404: function() {
                errorMessage("Não foi possível contatar o servidor");
                // // $("#pleaseWaitDialog").modal('toggle');
            },
            500: function() {
                errorMessage("Ocorreu um erro no servidor");
                // // $("#pleaseWaitDialog").modal('toggle');
            }
        },
        error: function(xhr, status, error) {
            errorMessage('Ocorreu um erro.');
            // // $("#pleaseWaitDialog").modal('toggle');
        },
        success: function(data) {
            //Time out para abrir o carregando
            setTimeout(function() {
                // // $("#pleaseWaitDialog").modal('toggle');
                //Time out para fechar o carregando
                setTimeout(function() {
                    //Mostrar mensagem de erro
                    if (data.resultado == 'sucesso') {
                        $('#updateVariacao #cod_variacao').val(data.response.cod_variacao);
                        $('#updateVariacao #variacao').val(data.response.variacao);
                        $('#updateVariacao #cod_basico').val(data.response.cod_basico);
                        $('#updateVariacao #basico').val(data.response.basico);
                        $('#updateVariacao #cod_inter').val(data.response.cod_inter);
                        $('#updateVariacao #inter').val(data.response.inter);
                        $('#updateVariacao #cod_premium').val(data.response.cod_premium);
                        $('#updateVariacao #premium').val(data.response.premium);
                        $('#updateVariacao #cod_premium').val(data.response.cod_premium);
                        if (data.response.status == 0) {
                            $('#updateVariacao #custom_update').attr('checked', 'checked');
                        } else {
                            $('#updateVariacao #custom_update').removeAttr('checked');
                        }
                        $('#modalUpdateVariacao').modal('toggle');
                    } else {
                        errorMessage(data.msg);
                    }
                }, 250);
            }, 250);
        }
    }); //Ajax
}