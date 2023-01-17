var root = 'https://' + document.location.hostname + '/';

const capitalize = (s) => {
    if (typeof s !== 'string')
        return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}


function iniciarSessao() {
    $.ajax({
        url: root + 'agenda/criarSessaoPagSeguro',
        type: 'post',
        dataType: 'json',
        success: function (data) {
            //console.log(data.id)
            PagSeguroDirectPayment.setSessionId(data.id);
        },
        error: function (response) {
            alert('error iniciar sessao')
            //window.location.reload()
        },
        complete: function () {
            listaMeiosPagamento();
        }
    });
}

//iniciarSessao();
function redirectAutorizacao(code){
    $.ajax({
        url: root + 'agenda/redirectAutoriza',
        data:'code='+code,
        type: 'post',
        dataType: 'html',
        success: function (data) {
            console.log(data)
        },
        error: function (response) {
            alert('error iniciar sessao')
            //window.location.reload()
        },
        complete: function () {
            
        }
    });
}
function listaMeiosPagamento() {
    PagSeguroDirectPayment.getPaymentMethods({
        amount: valor,
        success: function (response) {
            //console.log(response)
            $.each(response.paymentMethods.CREDIT_CARD.options, function (i, obj) {
                $('.cartao_de_credito').append('<img id="imagem-bandeira" class="imagem-bandeira ' + obj.name + '" style="float:left;margin:1px;" src="https://stc.pagseguro.uol.com.br' + obj.images.SMALL.path + '">');
            })
        },
        error: function (response) {
            //console.log(response)
            // alert('error payment methods')
        },
        complete: function (response) {

        }
    });
}

$('#pag-cc-cvv').on('keyup', function () {

    var expiracao = $('#pag-cc-expiration').val().split('/');

    PagSeguroDirectPayment.createCardToken({
        cardNumber: $('#pag-cc-number').val(),
        brand: $('#bandeira').val(),
        cvv: $('#pag-cc-cvv').val(),
        expirationMonth: expiracao[0],
        expirationYear: expiracao[1],
        success: function (response) {
            //console.log(response)
            $('#token_cartao').val(response.card.token)
        }
        /*error: function (response) {},
         complete: function (response) {}*/
    })
})
$('#pag-cc-number').on('keyup', function () {

    var numero_cartao = $(this).val();
    var qtdCaracteres = numero_cartao.length;

    if (qtdCaracteres == 6) {

        PagSeguroDirectPayment.getBrand({
            cardBin: numero_cartao,
            success: function (response) {
                //console.log(response)
                var bandeira_img = response.brand.name;
                $('#bandeira').html('<option style="background-image:url(https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/' + bandeira_img + '.png);" value="' + response.brand.name + '">' + capitalize(response.brand.name) + '</option>');
                $('.mostra_bandeira').html('<img style="float:left;margin:1px;" src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/' + bandeira_img + '.png">');
                getParcelas(bandeira_img);
            },
            error: function (response) {
                alert('Cartão não reconhecido');
                $('.mostra_bandeira').empty();
                $('#bandeira').html('<option value="" class="text-left">Bandeira</option>');
            },
            complete: function (response) {

            }

        });
    }
});

//exibe a quantidade de valor das parcelS

function getParcelas(bandeira) {
    PagSeguroDirectPayment.getInstallments({
        amount: valor,
        maxInstallmentNoInterest: 3,
        brand: bandeira,
        success: function (response) {
            $.each(response.installments, function (i, obj) {
                $.each(obj, function (i2, obj2) {
                    if (obj2.quantity <= 3) {
                        $('#pag-installments').append('<option value="' + obj2.quantity + '" data-valor="' + obj2.installmentAmount + '">' + obj2.quantity + 'x de: R$ ' + obj2.installmentAmount.toLocaleString('pt-br', {minimumFractionDigits: 2}) + '</option>');
                    }
                })
            })
        },
        error: function (response) {},
        complete: function (response) {}
    })
}

//obter o token do cartao de credito

function PagamentoPS() {
    $('.btn-continuar').attr('disabled', true);
    $('.btn-continuar').attr('onclick', " ");
    $('.btn-continuar').attr('style', "margin: auto; background-color: #eee");
    //$('#loader').toggle();

    PagSeguroDirectPayment.onSenderHashReady(function (response) {
        if (response.status == 'error') {
            console.log(response.message);
            return false;
        }
        var hash = response.senderHash;
        $('#hashCard').val(hash)

        var dado = $('#pag-installments').find(':selected').attr('data-valor');
        $.ajax({
            url: root + 'agenda/checkout',
            data: $('#form-pagamento').serialize() + '&valor_installments=' + dado + '&os=' + getOperationSystem(),
            dataType: 'json',
            type: 'post',
            success: function (data) {
                console.log(data)
            }
        });
        //console.log(hash)
    });
    //var cardHash = $('#hashCard').val()
    //console.log(cardHash)
    /*var cc = new Moip.CreditCard({
     number: $("#pag-cc-number").val(),
     cvc: $("#pag-cc-cvv").val(),
     expMonth: $("#pag-cc-expiration").val().split("/")[0],
     expYear: $("#pag-cc-expiration").val().split("/")[1],
     pubKey: publickey
     });
     
     if (cc.isValid()) {
     
     $.ajax({
     type: "POST",
     cache: false,
     data: {
     nome: $("#pag-cc-name").val(),
     hash: cc.hash(),
     installments: $("#pag-installments").val(),
     nascimento: $("#pag-nasc").val(),
     cpf: $("#pag-cpf").val(),
     telefone: $("#pag-tel").val(),
     email: $("#pag-email").val(),
     os: getOperationSystem()
     },
     dataType: 'json',
     url: baseurl + "agenda/pagamento",
     statusCode: {
     404: function () {
     errorMessage('Servidor não encontrado.');
     $('#loader').toggle();
     },
     500: function () {
     errorMessage('Erro ao contatar o servidor.');
     $('#loader').toggle();
     }
     },
     error: function (xhr, status, error) {
     // console.log(xhr.responseText + status + error);
     errorMessage("Erro ao acessar servidor. Contate o administrador.");
     $('#loader').toggle();
     },
     success: function (data) {
     setTimeout(function () {
     setTimeout(function () {
     var textErr = "";
     $.each(data.erros, function (k, v) {
     textErr += v + " \n";
     });
     
     if (data.resultado == "sucesso") {
     $('.modelo').html(data.veiculo.montadora + " " + data.veiculo.modelo + " " + data.veiculo.motor + " (" + data.veiculo.ano + ")");
     $('.unidade').html(data.unidade.nome_unidade + " - " + data.unidade.endereco);
     $('.data').html(data.data_agenda + (data.periodo == "1" ? " - Matutino" : " - Vespertino"));
     $('.voucher').html(data.voucher);
     $('#loader').toggle();
     $('.fullpage').fullpage.moveSlideRight();
     
     } else {
     if (data.errType == 'login') {
     $('#loginModal').modal('toggle');
     $('#loginException').show();
     $('#loader').toggle();
     } else {
     $('.mensagem-erro').text('');
     $('.mensagem-erro').text(textErr);
     $('#loader').toggle();
     $('#errorModal').modal('toggle');
     }
     $('.btn-continuar').attr('disabled', false);
     $('.btn-continuar').attr('onclick', "Pagamento(); return false;");
     $('.btn-continuar').attr('style', "margin: auto; background-color: #6afe6f");
     }
     
     }, 250);
     }, 250);
     }
     });
     } else {
     $("#encrypted_value").val('');
     $("#card_type").val('');
     $('.mensagem-erro').text('Cartão de crédito inválido');
     $('#errorModal').modal('toggle');
     
     $('.btn-continuar').attr('disabled', false);
     $('.btn-continuar').attr('onclick', "Pagamento(); return false;");
     $('.btn-continuar').attr('style', "margin: auto; background-color: #6afe6f");
     $('#loader').toggle();
     }*/
}
