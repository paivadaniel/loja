<?php

require_once('../conexao.php');

//VERIFICAR SE EXISTE ALGUM CADASTRO NA TABELA USUÁRIOS, CASO NEGATIVO, CADASTRE UM ADMIN
$query = $pdo->query("SELECT * FROM usuarios");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

$senha = '123';
$senha_crip = md5($senha);

if ($total_reg == 0) {
    $pdo->query("INSERT INTO usuarios (nome, cpf, email, senha, senha_crip, nivel, data_cad) values ('Admin', '000.000.000-00', '$email_loja', '$senha', '$senha_crip', 'Administrador', curDate())");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo $nome_loja ?></title>

    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <link href="../css/login.css" rel="stylesheet" type="text/css">
    <script src="../js/login.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/logoicone2.ico" type="image/x-icon">
    <link rel="icon" href="../img/logoicone2.ico" type="image/x-icon">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form ">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1>Login</h1>
                            </div>
                        </div>
                        <form action="autenticar.php" method="post" name="login">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email ou CPF</label>
                                <!-- type text pois pode ser email ou cpf -->
                                <input type="text" name="email_login" id="email_login" class="form-control" aria-describedby="emailHelp" placeholder="Digite seu email ou CPF">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Senha</label>
                                <input type="password" name="senha_login" id="senha_login" class="form-control" aria-describedby="emailHelp" placeholder="Digite sua senha">
                            </div>

                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                            </div>

                            <div class="form-group">
                                <small>
                                    <p class="text-center mt-4">Não possui conta? <a href="#" data-toggle="modal" data-target="#modalCadastro">Cadastre-se aqui!</a></p>
                                </small>

                                <small>
                                    <p class="text-center"><a class="text-danger" href="#" data-toggle="modal" data-target="#modalRecuperar">Recuperar senha</a></p>
                                </small>

                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>



</body>

</html>



<!-- Modal Cadastro -->
<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-fechar-cadastro">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome completo">
                    </div>

                    <div class="form-group">
                        <label for="email_cad">Email</label>
                        <input type="email" class="form-control" name="email_cad" id="email_cad" placeholder="Digite seu email">
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite seu CPF">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="senha_cad">Senha</label>
                                <input type="password" class="form-control" name="senha_cad" id="senha_cad" placeholder="Digite uma senha">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="confirmar-senha">Confirmar Senha</label>
                                <input type="password" class="form-control" name="confirmar-senha" id="confirmar-senha" placeholder="Confirme a senha">
                            </div>
                        </div>

                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="termos">
                        <label class="form-check-label" for="termos">Concordo com os <a href="../termos.php" title="Termos de Uso" target="_blank"> termos de uso </a> do site.</label>
                    </div>

                    <div class="row" style="margin-top:10px">
                        <div class="col-lg-12">
                            <small>
                                <div id="mensagem-cadastro" align="center"></div>
                            </small>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btn-enviar-cadastro">Cadastrar</button>
                    <!-- não precisa ser type="submit", pois o submit ocorrerá por AJAX (e com function onclick(), não submit()), daí pode ser type="button" mesmo -->
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal Recuperar -->
<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" id="btn-fechar-recuperar"s>&times;</span>
                </button>
            </div>
            <form method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label for="email-recuperar-senha">Email</label>
                        <input type="email-recuperar-senha" class="form-control" name="email-recuperar-senha" id="email-recuperar-senha" placeholder="Digite seu email">
                    </div>

                    <div class="row" style="margin-top:10px">
                        <div class="col-lg-12">
                            <small>
                                <div id="mensagem-recuperar" align="center"></div>
                            </small>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btn-recuperar-senha">Enviar Senha por Email</button>
                    <!-- não precisa ser type="submit", pois o submit ocorrerá por AJAX (e com function onclick(), não submit()), daí pode ser type="button" mesmo -->
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#btn-enviar-cadastro').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'cadastrar.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Cadastro efetuado com Sucesso!') {
                    $('#mensagem-cadastro').removeClass();
                    $('#mensagem-cadastro').addClass('text-success');
                    $('#mensagem-cadastro').text(msg);

                    //inserir senha e login recém-cadastradas nos campos do login
                    $('#email_login').val(document.getElementById('email_cad').value);
                    $('#senha_login').val(document.getElementById('senha_cad').value);

                    //limpar os campos
                    $('#nome').val('');
                    $('#email_cad').val('');
                    $('#cpf').val('');
                    $('#senha_cad').val('');
                    $('#confirmar-senha').val('');

                    //fechar modal de cadastro
                    $('#btn-fechar-cadastro').click();

                } else {
                    $('#mensagem-cadastro').removeClass();
                    $('#mensagem-cadastro').addClass('text-danger');
                    $('#mensagem-cadastro').text(msg);

                }
            }
        })

    })
</script>

<script type="text/javascript">
    $('#btn-recuperar-senha').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'recuperar.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Senha Enviada para o Email!') {
                    $('#mensagem-recuperar').removeClass();
                    $('#mensagem-recuperar').addClass('text-success');
                    $('#mensagem-recuperar').text(msg);

                    //limpar os campos
                    $('#email-recuperar-senha').val('');

                    //fechar modal de cadastro
                    //'#btn-fechar-recuperar').click();

                } else {
                    $('#mensagem-recuperar').removeClass();
                    $('#mensagem-recuperar').addClass('text-danger');
                    $('#mensagem-recuperar').text(msg);

                }
            }
        })

    })
</script>

<!-- script mascara.js necessita do jquery para funcionar, e portanto, o jquery deve vir primeiro que o mascara.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="../js/mascara.js"></script>