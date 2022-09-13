<?php

require_once('conexao.php');
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

//VERIFICAR TOTAIS DO CARRINHO DE COMPRAS
$res = $pdo->query("SELECT * from carrinho where id_usuario = '$id_usuario' and id_venda = 0 order by id asc"); //id_venda = 0 pois a venda ainda não ocorreu
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

if ($linhas == 0) {
  $linhas = 0;
  $total_carrinho = 0;
}

$total;

for ($i = 0; $i < count($dados); $i++) {
  foreach ($dados[$i] as $key => $value) {
  }

  $id_produto = $dados[$i]['id_produto'];
  $quantidade = $dados[$i]['quantidade'];
  $combo = $dados[$i]['combo'];

  if ($combo == 'Sim') { //para combos
    $res_p = $pdo->query("SELECT * from combos where id = '$id_produto' ");
    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);

    $valor_produto = $dados_p[0]['valor'];

  } else { //para produtos
    $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);

    $valor_produto = $dados_p[0]['valor'];
    $promocao_produto = @$dados_p[0]['promocao'];

    if ($promocao_produto == 'Sim') { //para produtos em promoção
      $res_p2 = $pdo->query("SELECT * from promocoes where id_produto = '$id_produto' ");
      $dados_p2 = $res_p2->fetchAll(PDO::FETCH_ASSOC);
      $valor_produto = $dados_p2[0]['valor'];
    }

  }

  $total_item = $valor_produto * $quantidade;
  @$total_carrinho = @$total_carrinho + $total_item;

  $valor_produto = number_format($valor_produto, 2, ',', '.');
  $total_item = number_format($total_item, 2, ',', '.');

}

$total_carrinho = number_format($total_carrinho , 2, ',', '.');

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Venda de Roupas Feminina e Masculina">
    <meta name="keywords" content="vestido, botas feminina, tênis, sobretudo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $nome_loja ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/logoicone2.ico" type="image/x-icon">
    <link rel="icon" href="img/logoicone2.ico" type="image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <!--
    <div id="preloder">
        <div class="loader"></div>
    </div>

-->
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="index.php"><img src="img/logo-azul-pequena.png" alt=""></a> <!-- essa logo é do mobile, e ainda a do menu hamburguer -->
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                <li><a href="carrinho.php"><i class="fa fa-shopping-bag"></i> <span><?php echo $linhas ?></span></a></li>
            </ul>
            <div class="header__cart__price"><span>Total: R$<?php echo $total_carrinho ?></span></div>
            <div class="header__top__right__auth ml-4">


                <?php
                if (@$_SESSION['nivel_usuario'] == null) {


                ?>

                    <a href="sistema"><i class="fa fa-user"> Login</i>

                    <?php
                } else if ($_SESSION['nivel_usuario'] == 'Administrador') {
                    ?>
                        <a href="sistema/painel-admin/"><i class="fa fa-user"> Painel</i>

                        <?php

                    } else if ($_SESSION['nivel_usuario'] == 'Cliente') {
                        ?>

                            <a href="sistema/painel-cliente/"><i class="fa fa-user"> Painel</i>

                            <?php
                        }

                            ?>

                            </a>
            </div>


        </div>


        <div class="humberger__menu__widget">

            <!--
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanish</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>

-->
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Início</a></li>
                <li><a href="./categorias.php">Categorias</a></li>
                <li><a href="#">Produtos</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="produtos.php">Lista de Produtos</a></li>
                        <li><a href="subcategorias.php">Subcategorias</a></li>
                        <li><a href="./blog-postagem.php">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.php">Blog</a></li>
                <li><a href="./carrinho.php">Carrinho</a></li>

                <li><a href="./contatos.php">Contato</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#" target="_blank"><i class="fa fa-facebook text-primary"></i></a>
            <!-- <a href="#"><i class="fa fa-twitter"></i></a> -->
            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_loja_link ?>" title="<?php echo $whatsapp_loja ?>" target="_blank"><i class="fa fa-whatsapp text-success"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> <?php echo $email_loja ?></li>
                <li><?php echo $texto_destaque ?></li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin (menu responsivo) -->
    <!-- esse é o menu que aparece no celular -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <?php echo $email_loja ?></li>
                                <li><?php echo $texto_destaque ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#" target="_blank" title="Acessar nosso Facebook"><i class="fa fa-facebook text-primary"></i></a>
                                <!-- <a href="#"><i class="fa fa-twitter"></i></a> -->
                                <a href="#" target="_blank" title="Acessar nosso Instagram"><i class="fa fa-instagram"></i></a>
                                <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_loja_link ?>" title="Fale Conosco no Whatsapp"><i class="fa fa-whatsapp text-success"></i></a>
                            </div>
                            <!--

                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>

-->
                            <div class="header__top__right__auth">

                                <?php
                                if (@$_SESSION['nivel_usuario'] == null) {


                                ?>

                                    <a href="sistema"><i class="fa fa-user"> Login</i>

                                    <?php
                                } else if ($_SESSION['nivel_usuario'] == 'Administrador') {
                                    ?>
                                        <a href="sistema/painel-admin/"><i class="fa fa-user"> Painel</i>

                                        <a href="sistema/logout.php"><i class="fa fa-user"> Sair</i>

                                        <?php

                                    } else if ($_SESSION['nivel_usuario'] == 'Cliente') {
                                        ?>

                                            <a href="sistema/painel-cliente/"><i class="fa fa-user"> Painel</i>

                                            <a href="sistema/logout.php"><i class="fa fa-user"> Sair</i>


                                            <?php
                                        }

                                            ?>







                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo-azul-pequena.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Início</a></li>
                            <li><a href="#">Produtos</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="lista-produtos.php">Lista de Produtos</a></li>
                                    <li><a href="produtos.php">Produtos</a></li>
                                    <li><a href="subcategorias.php">Subcategorias</a></li>
                                    <li><a href="categorias.php">Categorias</a></li>
                                    <li><a href="promocoes.php">Promoções</a></li>
                                    <li><a href="combos.php">Combos</a></li>

                                    <li><a href="./blog-postagem.php">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.php">Blog</a></li>
                            <li><a href="./contatos.php">Contato</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                            <li><a href="carrinho.php"><i class="fa fa-shopping-bag"></i> <span><?php echo $linhas ?></span></a></li>
                        </ul>
                        <div class="header__cart__price"><span>Total: R$<?php echo $total_carrinho ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->