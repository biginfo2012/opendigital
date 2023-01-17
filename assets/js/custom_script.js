$(document).ready(function() {
    // SMOOTH SCROLL
    $('a[href*="#"]')
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

    // INDEX PAGE
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 300) {
            $(".floating").show(250, 'linear');
        } else {
            $(".floating").hide(50, 'linear');
        }
    });
    if ($(window).width() < 1279) {
        $(".index .content").css('margin-top', ((($(window).height() + 2) - $(".index .content").height()) / 4));
    }
    $(".fullscreen").css('min-height', ($(window).height() + 2));
    if ($(window).height() <= 475) { $(".icn_scroll").css('margin-top', 0); }
    if ($(window).height() > 709) { $(".pacotes .first-row").css('min-height', $(window).height() + 2); }
    if ($(window).height() > 929) { $(".servicos .first-row").css('min-height', $(window).height() + 2); }
    $(".fullscreen").css('height', $(window).height());
    // $(".icn_scroll").click(function() {
    //   $('.fullpage').fullpage.moveSectionDown();
    // });

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("vinculo");

    if (c !== null) { alert(c); }

    // OUTSIDE VIDEO CONTRLS
    $(".play-button").on("click", function() {
        $('#video').get(0).play();
        $('.background-video').get(0).pause();
    });

    $(".close-video").on("click", function() {
        $('#video').get(0).pause();
        $('.background-video').get(0).play();
    });

});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

jQuery(function($) {
    'use strict';

    $(".chosen").chosen()



    //Esconde o modal de login e coloca o de redefinir
    $("#redefinirBtn").on("click", function() {
        $("#loginModal").modal('toggle');
        $("#redefinirModal").modal('toggle');
    });

    $('#contaMoipCheck').click(function() {
        if ($(this).is(':checked')) {
            $('.contaMoipContainer').slideDown();
            $("#form_unidade_cad").removeAttr('novalidate');
            setTimeout(function() {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#informacoesContaMoip").offset().top - 115
                }, 1500);
            }, 250);
        } else {
            $('.contaMoipContainer').slideUp();
            $("#form_unidade_cad").attr('novalidate', 'true');
        }
    });

    $("#imgInp").change(function() {
        readURL(this);
    });


    $(".km-veiculo").mask('000000000000000');
    $(".cpfMask").mask('000.000.000-00', { reverse: true });
    $(".cepMask").mask('00000-000');
    $(".letterMask").keypress(function(e) {
        var keyCode = (e.keyCode ? e.keyCode : e.which); // Variar a chamada do keyCode de acordo com o ambiente.
        if (keyCode > 47 && keyCode < 58) {
            e.preventDefault();
        }
    });
    $(".numberMask").keypress(function(e) {
        var keyCode = (e.keyCode ? e.keyCode : e.which); // Variar a chamada do keyCode de acordo com o ambiente.
        if (!(keyCode > 47 && keyCode < 58)) {
            e.preventDefault();
        }
    });
    $(".dataMask").mask('00/00/0000');

    // MÁSCARA PARA CAMPO COM VARIAÇÃO ENTRE CELULAR OU TELEFONE
    var paymentCelMask = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        paymentCelOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(paymentCelMask.apply({}, arguments), options);
            }
        };
    $('.telMask').mask(paymentCelMask, paymentCelOptions);



    $(".addressNumMask").mask('0000000000000000000000');
    $(".valMask").mask('00/0000');
    //$("#ano-veiculo").mask('0000');

    $("#telefone").mask('(00) 0000-00009');
    $("#telefone-moip").mask('(00) 0000-0000');
    $("#cpf-moip").mask('000.000.000-00');
    $("#cep-moip").mask('00000-000');
    $("#nascimento-moip").mask('00/00/0000');
    $("#cnpj-moip").mask('00.000.000/0000-00');
    $("#telefone-empresa-moip").mask('(00) 0000-0000');
    $("#cep-empresa-moip").mask('00000-000');


});

function Editar() {
    $(".labelEdit").hide();
    $(".inputEdit").show();

    $("#btnPermitirEditarPerfil").hide();
    $("#btnSalvarPerfil").show();
}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function selecionaServiço(cod_servico) {
    $('#servicoSelecionado').val(cod_servico);
    $(".servicoItemImg").css('outline', 'none');
    $("#servicoItemImg" + cod_servico).css('outline', 'solid');
}

function selecionaServiçoConsulta(tipo_servico) {
    $('#servicoSelecionado').val(0);
    $('#servicoSelecionadoConsulta').val(tipo_servico);
    $(".servicoItemImg").css('outline', 'none');
    $("#servicoItemImg" + tipo_servico).css('outline', 'solid');
}


// function selecionaRegiao(cod_regiao) {
//     $('#regiaoSelecionado').val(cod_regiao);
//     $(".card").removeClass("active");
//     $("#regiao-"+cod_regiao).addClass("active");
// }

function selecionaPeriodo(cod_periodo) {
    $('#periodoSelecionado').val(cod_periodo);
    $(".passo-4 .card").removeClass("active");
    $("#periodo-" + cod_periodo).addClass("active");
}

$(document).on('click', '.navbar-collapse', function(e) {
    if ($(e.target).is('a')) {
        $(this).collapse('hide');


    }
});


$(document).ready(function() {
    var w = $(window);

    setTimeout(function() {
        if (w.width() < 768) {
            // mobile
            $('.fp-section.fp-table, .fp-slide.fp-table').css({ 'display': 'block', 'overflow-y': 'auto' });
        } else {
            // desktop
            $('.fp-section.fp-table, .fp-slide.fp-table').css({ 'display': 'block' });
        }
    }, 250);
});

$(document).ready(function() {
    $('[mobile="false"]').datepicker({
        dateFormat: 'dd/mm/yy',
        minDate: 0,
    });

    $("#numenu #dataPeriodo, #minharevisao #dataPeriodo").datepicker({
        showOn: "button",
        buttonText: '<i class="fas fa-calendar-alt"></i> <span id="textoDataAgendamento">Selecionar Data do Agendamento</span>',
        minDate: 0
    });
    $('#numenu #dataPeriodo, #minharevisao #dataPeriodo').bind('change', function() {
        $('#textoDataAgendamento').html(this.value);
    });

    $(window).bind("resize.colunas", function(e) {
        window.addEventListener("orientationchange", function() {
            if (screen.orientation.type == 'landscape-primary' || $(window).height() < 100) {
                $('#avisoHorizontal').css({ 'display': 'block' });
                $('body#numenu .fullpage-wrapper, .numenu_background_application').css({ 'display': 'none' });
            } else {
                $('#avisoHorizontal').css({ 'display': 'none' });
                $('body#numenu .fullpage-wrapper, .numenu_background_application').css({ 'display': 'block' });
            }

        }, false);
    }).trigger("resize.colunas");

});