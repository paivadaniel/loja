<?php

require_once('conexao.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descadastrar - <?php echo $nome_loja ?></title>

    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <link href="css/login.css" rel="stylesheet" type="text/css">
    <script src="js/login.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/logoicone2.ico" type="image/x-icon">
    <link rel="icon" href="img/logoicone2.ico" type="image/x-icon">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form ">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1>Descadastrar</h1>
                            </div>
                        </div>
                        <form method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <!-- type text pois pode ser email ou cpf -->
                                <input type="text" name="email_descadastrar" id="email_descadastrar" class="form-control" aria-describedby="emailHelp" placeholder="Digite seu email ou CPF">
                            </div>


                            <small>
                                <div id="mensagem-descadastrar" align="center" class="mt-3"></div>
                            </small>

                            <div class="col-md-12 text-center mt-4">
                                <button id="btn_descadastrar" name="btn_descadastrar" class=" btn btn-block mybtn btn-primary tx-tfm">Descadastrar</button><!-- não precisa de type=submit no ajax, apenas se usar action -->
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $('#btn_descadastrar').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'ajax-descadastrar.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Descadastrado da Lista com Sucesso!') {
                    $('#mensagem-descadastrar').removeClass();
                    $('#mensagem-descadastrar').addClass('text-success');
                    $('#mensagem-descadastrar').text(msg);

                    //limpar os campos
                    $('#email_descadastrar').val('');

                    //fechar modal de cadastro
                    //'#btn-fechar-recuperar').click();

                } else {
                    $('#mensagem-descadastrar').removeClass();
                    $('#mensagem-descadastrar').addClass('text-danger');
                    $('#mensagem-descadastrar').text(msg);

                }
            }
        })

    })
</script>



<!-- script mascara.js necessita do jquery para funcionar, e portanto, o jquery deve vir primeiro que o mascara.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="js/mascara.js"></script>