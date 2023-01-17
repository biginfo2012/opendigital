$(document).ready(function(){  


    $("#mainLogin").submit(function(event) {   

    event.preventDefault();     
//$("#liberar").ajaxForm({url: 'server.php', type: 'post'});  OU
        $.ajax({
            type:'POST',
            url:baseurl+'login/login',
            cache:false,
            data: $(this).serialize(), // it will serialize the form data
            dataType: 'json',
            statusCode: { 
                    404: function() {
                      $("body").html('Could not contact server.');
                    },
                    500: function() {
                      $("body").html('A server-side error has occurred.');
                    }
            },
            error: function() {
                $("body").html('A problem has occurred.');
            }, 
            success: function(data) {
                if(data.resultado.indexOf("erro") == -1)
                    window.location.href = baseurl+"/principal";
                else
                    alert("Não foi possível realizar o login, tente novamente");
            }
        }); //Ajax
    });//click

    //Envia o form da redefinição de senha  via ajax tipo post
    $("#redefinir").submit(function(event) {   

    event.preventDefault();     
        $.ajax({
            type:'POST',
            url:baseurl+'Login/redefinir',
            cache:false,
            data: $(this).serialize(), 
            dataType: 'json',
            statusCode: {
                    404: function() {
                      $("body").html('Could not contact server.');
                    },
                    500: function() {
                      $("body").html('A server-side error has occurred.');
                    }
            },
            error: function(xhr, status, error) { console.log(xhr.responseText+ status+ error);
                $("body").html('A problem has occurred.');
            },
            success: function(json) {
            

                //Mostrar mensagem de erro
                if(json.msg.indexOf("não") !== -1)
                    alert(json.msg);
                 else
                    alert(json.msg);             
                                
                $('#modalRedefinir').modal('toggle');

            }
        }); //Ajax
    });//click 

});//document

 