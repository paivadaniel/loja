<?php

require_once('../../conexao.php');
require_once('verificar.php'); //já executa session_start()

//variaveis para o menu
$pag = @$_GET["pag"]; //arroba pois o GET[pag] pode não existir
$menu1 = "pedidos";
$menu2 = "categorias";

//recupera dados do usuário
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$_SESSION[id_usuario]' and nivel = 'Cliente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_usuario = $res[0]['nome'];
$cpf_usuario = $res[0]['cpf'];
$email_usuario = $res[0]['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hugo Vasconcelos">

    <title>Painel do Cliente</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../../img/logoicone2.ico" type="image/x-icon">
    <link rel="icon" href="../../img/logoicone2.ico" type="image/x-icon">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="sidebar-brand-text mx-3">Cliente</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Consultas
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i>
                    <span>Home</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="index.php?pag=<?php echo $menu1 ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pedidos</span></a>
            </li>
     
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Consultas
            </div>
   
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome_usuario ?></span>
                                <img class="img-profile rounded-circle" src="../../img/sem-foto.jpg">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#modalPerfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Editar Perfil
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if ($pag == null) {
                        include_once("home.php");
                    } else if ($pag == $menu1) {
                        include_once($menu1 . ".php");
                    } else if ($pag == $menu2) {
                        include_once($menu2 . ".php");
                    } else {
                        include_once("home.php");
                    }
                    ?>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!--  Modal Perfil-->
    <div class="modal fade" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>


                <!-- desnecessário no form
            
            enctype="multipart/form-data"
        
            pois não trabalharemos com imagem, apenas texto
        -->
                <form id="form-perfil" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nome</label>

                            <!-- Não pode recuperar value com $_SESSION['nome_usuario'], $_SESSION['cpf_usuario'], $_SESSION['email_usuario'], pois se editar nome, cpf e email, e abrir a modal Editar Perfil novamente, irá carregar os dados que não foram editados, pois foi com eles que a sessão foi iniciada  -->
                            <input value="<?php echo $nome_usuario ?>" type="text" class="form-control" id="nome-editar-perfil " name="nome-editar-perfil" placeholder="Nome">
                        </div>

                        <div class="form-group">
                            <label>CPF</label>
                            <input value="<?php echo $cpf_usuario ?>" type="text" class="form-control" id="cpf" name="cpf-editar-perfil" placeholder="CPF">
                            <!-- mantive id="cpf" pois em js/mascara.js a máscara para CPF é para id="cpf" -->
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input value="<?php echo $email_usuario ?>" type="email" class="form-control" id="email-editar-perfil" name="email-editar-perfil" placeholder="Email">
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Senha</label>
                                    <input value="" type="password" class="form-control" id="senha-editar-perfil" name="senha-editar-perfil">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Confirmar Senha</label>
                                    <input value="" type="password" class="form-control" id="confirmar-senha-editar-perfil" name="confirmar-senha-editar-perfil">
                                </div>
                            </div>
                        </div>






                        <!--
                            <div class="col-md-6 col-sm-12">
                                <div class="col-md-12 form-group">
                                    <label>Foto</label>
                                    <input value="<?php //echo $img 
                                                    ?>" type="file" class="form-control-file" id="imagem" name="imagem" onchange="carregarImg();">

                                </div>
                                <div class="col-md-12 mb-2">
                                    <img src="../img/profiles/<?php //echo $img 
                                                                ?>" alt="Carregue sua Imagem" id="target" width="100%">
                                </div>
                            </div>

                            -->



                        <small>
                            <div id="mensagem-perfil" class="mr-4" align="center">

                            </div>
                        </small>



                    </div>
                    <div class="modal-footer">

                        <input value="<?php echo $_SESSION['id_usuario'] ?>" type="hidden" name="txtid" id="txtid">
                        <input value="<?php echo $cpf_usuario ?>" type="hidden" name="cpfAntigo" id="cpfAntigo">
                        <input value="<?php echo $email_usuario ?>" type="hidden" name="emailAntigo" id="emailAntigo">


                        <button type="button" id="btn-fechar-perfil" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                    </div>
                </form>


            </div>
        </div>
    </div>


  
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>

<!-- script mascara.js necessita do jquery para funcionar, e portanto, o jquery deve vir primeiro que o mascara.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="../../js/mascara.js"></script>


<!-- AJAX PARA SALVAR PERFIL -->

<script type="text/javascript">
    $('#btn-salvar-perfil').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'editar-perfil.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Perfil Editado com Sucesso!') {
                    $('#mensagem-perfil').removeClass();
                    $('#mensagem-perfil').addClass('text-success');
                    $('#mensagem-perfil').text(msg);

                    //fechar modal perfil
                    //$('#btn-fechar-perfil').click();

                } else {
                    $('#mensagem-perfil').removeClass();
                    $('#mensagem-perfil').addClass('text-danger');
                    $('#mensagem-perfil').text(msg);

                }
            }
        })

    })
</script>