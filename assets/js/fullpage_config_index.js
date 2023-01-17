$(document).ready(function() {
    var once = true;
    var passoOito = false;
    $('.fullpage').fullpage( {
        controlArrows: false,
        anchors: ['index', 'servicos', 'servicos-2', 'servicos-3', 'servicos-4', 'servicos-5', 'servicos-6', 'pricing', 'contato'],
        menu: '#myMenu',
        onLeave: function(origin, destination, direction, item, anchor) {
            console.log("origin:"+origin);
            console.log("dir:"+direction);
            console.log("Dest:"+destination);
            console.log("############################");

            if(destination == 9){
              passoOito = true;
              $('#img1-circle-path').removeClass("img1-circle-path0");
              $('#img1-circle-path').removeClass("img1-circle-path1");
              $('#img1-circle-path').removeClass("img2-circle-path0");
              $('#img3-circle-path').removeClass("img3-circle-path0");
              $('#img3-circle-path').removeClass("img3-circle-path1");

              $('#img1-circle-path').addClass("img1-circle-path2");
              $('#img2-circle-path').addClass("img2-circle-path1");
              $('#img3-circle-path').addClass("img3-circle-path2");

            }

            if(origin == 9){
               console.log("origin == 9");
               once = false;
               setTimeout( function () { $('.fullpage').fullpage.moveTo(2,0)});
            }

            if( destination == 2 && passoOito){
                console.log("destination == 2 && passoNove");
                passoOito = false;
                setTimeout( function () { $('.fullpage').fullpage.moveTo(8,0)});
            }

            if(origin == 8 && !once ){
                console.log("to 8");
               once = true;
               $('.fullpage').fullpage.silentMoveTo(8,0);
            }

             if(destination == 1 || destination == 8){
                $('#logo-servicos').removeClass('animated fadeIn');
                $('.servicos .page-text-left').removeClass('animated fadeInLeft');
                $('.servicos .page-circle').removeClass('animated fadeIn');
                $('.servicos .navbar-brand').removeClass('animated fadeInLeft');
                $('.servicos .navbar-brand').removeClass('animated fadeInLeft');
                $('.servicos .navbar-toggler').removeClass('animated fadeInRight');
             }


            if(destination == 2){

                $('#logo-servicos').addClass('animated fadeIn');

                $('.servicos .page-circle').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-toggler').addClass('animated fadeInRight');
                // $('.servicos .page-text-left span').html("01");
                // $('#img1-circle-path').removeClass("img1-circle-path1");
                // $('#img1-circle-path').addClass("img1-circle-path0");

                $('#passo-img').css("background-image", "url("+passo1+")");

                $('#titulo-passo').html("Veja como funciona");
                $('#texto-passo').html("Basta informar os dados básicos do seu veículo");
                //$('#texto-passo').html("teste");

                $('#img3-circle-path').removeClass("img3-circle-path2");
                $('#img3-circle-path').removeClass("img3-circle-path1");
                $('#img2-circle-path').removeClass("img2-circle-path1");
                $('#img1-circle-path').removeClass("img1-circle-path2");
                $('#img1-circle-path').removeClass("img1-circle-path1");


                $('#img3-circle-path').addClass("img3-circle-path0");
                $('#img2-circle-path').addClass("img2-circle-path0");
                $('#img1-circle-path').addClass("img1-circle-path0");
            }
            if(destination == 3){

                $('#titulo-passo').html("Escolha <br> seu serviço");
                $('#texto-passo').html("Vamos te apresentar os planos de revisão que são ideais para o seu carro");

                $('.slide-carro').removeClass('active');
                $('.servicos').addClass('oioi');

                $('.servicos .page-circle').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-toggler').addClass('animated fadeInRight');
                // $('.servicos .page-text-left span').html("02");

                $('#img3-circle-path').removeClass("img3-circle-path2");
                $('#img3-circle-path').removeClass("img3-circle-path1");
                $('#img3-circle-path').addClass("img3-circle-path0");
                $('#img2-circle-path').removeClass("img2-circle-path1");
                $('#img2-circle-path').addClass("img2-circle-path0");

                $('#img1-circle-path').removeClass("img1-circle-path2");
                $('#img1-circle-path').addClass("img1-circle-path1");
                $('#img1-circle-path').removeClass("img1-circle-path0");

                $('#passo-img').css("background-image", "url("+passo2+")");
            }
            if(destination == 4 ){

                $('#titulo-passo').html("Selecione <br> uma região");
                $('#texto-passo').html("Sempre tem uma oficina credenciada próxima a você");


                $('.servicos .page-circle').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-toggler').addClass('animated fadeInRight');
                // $('.servicos .page-text-left span').html("03");

                $('#img3-circle-path').removeClass("img3-circle-path1");
                $('#img3-circle-path').removeClass("img3-circle-path2");
                $('#img3-circle-path').addClass("img3-circle-path0");

                $('#img1-circle-path').removeClass("img1-circle-path1");
                $('#img1-circle-path').addClass("img1-circle-path2");
                $('#img2-circle-path').addClass("img2-circle-path0");
                $('#img2-circle-path').removeClass("img2-circle-path1");

                $('#passo-img').css("background-image", "url("+passo3+")");
            }
            if(destination == 5 ){

                $('#titulo-passo').html('Escolha <br>');
                $('#titulo-passo').append('<div class="uma-unidade">uma unidade</div>');
                $('#texto-passo').html('Fique tranquilo, a nossa rede de oficinas credenciadas é de extrema qualidade, você pode escolher entre <b>Bosch Car Service</b> ou <b>Porto Seguro</b>');


                $('.servicos .page-circle').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-toggler').addClass('animated fadeInRight');
                // $('.servicos .page-text-left span').html("04");

                $('#img3-circle-path').removeClass("img3-circle-path1");
                $('#img3-circle-path').removeClass("img3-circle-path2");


                if (!($('#img1-circle-path').hasClass("img1-circle-path2")))
                  $('#img1-circle-path').addClass("img1-circle-path2");

                $('#img2-circle-path').removeClass("img2-circle-path0");
                $('#img2-circle-path').addClass("img2-circle-path1");
                $('#img3-circle-path').addClass("img3-circle-path0");
                $('#img3-circle-path').removeClass("img3-circle-path1");

                $('#passo-img').css("background-image", "url("+passo4+")");
            }
            if(destination == 6 ){

                $('#titulo-passo').html("Escolha a forma de pagamento");
                $('#texto-passo').html('Para facilitar e agilizar o atendimento nas oficinas e não ter surpresa o pagamento é feito diretamente na <b>Minha Revisão</b>');


                $('.servicos .page-circle').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-toggler').addClass('animated fadeInRight');
                // $('.servicos .page-text-left span').html("05");

                if (!($('#img1-circle-path').hasClass("img1-circle-path2")))
                  $('#img1-circle-path').addClass("img1-circle-path2");

                if (!($('#img2-circle-path').hasClass("img2-circle-path1")))
                  $('#img2-circle-path').addClass("img2-circle-path1");

                $('#img3-circle-path').removeClass("img3-circle-path0");
                $('#img3-circle-path').addClass("img3-circle-path1");
                 $('#img3-circle-path').removeClass("img3-circle-path2");

                 $('#passo-img').css("background-image", "url("+passo5+")");
            }
            if(destination == 7 ){

                 $('#titulo-passo').html("Pronto! <br> Rapido né!? ");
                 $('#texto-passo').html(
                   "<a href='"+baseurl+"/agenda'>"+
                      "<div class='btn' href='#' style=''>Agendar a Minha Revisão <br> agora mesmo</div>"+
                   "</a>"
                  );


                $('.servicos .page-circle').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-brand').addClass('animated fadeIn');
                $('.servicos .navbar-toggler').addClass('animated fadeInRight');
                // $('.servicos .page-text-left span').html("06");
                // $('#img3-circle-path').removeClass("img3-circle-path1");
                // $('#img3-circle-path').addClass("img3-circle-path2");
                $('#img1-circle-path').removeClass("img1-circle-path0");
              $('#img1-circle-path').removeClass("img1-circle-path1");
              $('#img1-circle-path').removeClass("img2-circle-path0");
              $('#img3-circle-path').removeClass("img3-circle-path0");
              $('#img3-circle-path').removeClass("img3-circle-path1");


              $('#img1-circle-path').addClass("img1-circle-path2");
              $('#img2-circle-path').addClass("img2-circle-path1");
              $('#img3-circle-path').addClass("img3-circle-path2");

               $('#passo-img').css("background-image", "url("+passo6+")");

            }
            if (direction=="down") {
                var animation = "animated fadeIn";
                var animation_2 = "animated fadeIn";
                $('.servicos .page-text-right').addClass("animated fadeInRight").one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass("animated fadeInRight");
                    }
                );
                $('.servicos .page-car').addClass(animation_2).one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass(animation_2);
                    }
                );
                $('.servicos .page-text-left h1').addClass(animation_2).one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass(animation_2);
                    }
                );
                $('.servicos .page-text-left span').addClass(animation).one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass(animation);
                    }
                );

            }
            if (direction=="up") {
                var animation = "animated fadeIn";
                var animation_2 = "animated fadeIn";
                $('.servicos .page-text-right').addClass("animated fadeInRight").one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass("animated fadeInRight");
                    }
                );
                $('.servicos .page-car').addClass(animation_2).one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass(animation_2);
                    }
                );
                $('.servicos .page-text-left h1').addClass(animation_2).one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass(animation_2);
                    }
                );
                $('.servicos .page-text-left span').addClass(animation).one(
                    'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd',
                    function(){
                        $(this).removeClass(animation);
                    }
                );
            }
        }
    });
});
