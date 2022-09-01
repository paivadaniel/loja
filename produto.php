<?php
require_once('cabecalho.php');
require_once('cabecalho-busca.php');
require_once('conexao.php');

//recuperar o nome do produto para filtrar as informações (como características) dele
$produto_get = @$_GET['nome']; //esse GET vem do htaccess?

$tem_cor;

?>

<?php

//trazer os dados do produto

$query = $pdo->query("SELECT * FROM produtos where nome_url = '$produto_get'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$id_produto = $res[0]['id'];
$nome = $res[0]['nome'];
$imagem = $res[0]['imagem'];
$id_categoria = $res[0]['id_categoria'];
$id_subcategoria = $res[0]['id_subcategoria'];
$valor = $res[0]['valor'];
$estoque = $res[0]['estoque'];
$descricao = $res[0]['descricao'];
$descricao_longa = $res[0]['descricao_longa'];
$tipo_envio = $res[0]['tipo_envio'];
$palavras = $res[0]['palavras'];
$ativo = $res[0]['ativo'];
$peso = $res[0]['peso'];
$largura = $res[0]['largura'];
$altura = $res[0]['altura'];
$comprimento = $res[0]['comprimento'];
$modelo = $res[0]['modelo'];
$valor_frete = $res[0]['valor_frete'];
$promocao = $res[0]['promocao'];

if ($modelo == '') {
    $modelo = 'Nenhum';
}

if ($promocao == 'Sim') {

    $query = $pdo->query("SELECT * FROM promocoes where id_produto = '$id_produto'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $valor = $res[0]['valor'];
    $desconto = $res[0]['desconto'];
}

$valor = number_format($valor, 2, ',', '.');


?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="img/produtos/<?php echo $imagem ?>" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">

                        <?php
                        $query = $pdo->query("SELECT * FROM imagens where id_produto = '$id_produto' ");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i = 0; $i < count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }

                            $imagem_prod = $res[$i]['imagem'];
                        ?>

                            <img data-imgbigurl="img/produtos/detalhes/<?php echo $imagem_prod ?>" src="img/produtos/detalhes/<?php echo $imagem_prod ?>" alt="">

                        <?php } ?>


                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?php echo $nome ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price">R$ <?php echo $valor ?></div>
                    <p><?php echo $descricao ?></p>
                    <form method="post" id="form-add">
                        
                        <!-- não tem como passar id_carrinho pois somente depois de adicionar é que será criada a id_carrinho, inserir-carrinho.php não recebe id_carrinho -->
                        <div class="product__details__quantity">
                        <input type="hidden" id="id_produto" name="id_produto" value="<?php echo $id_produto ?>">
                        <input type="text" id="combo" name="combo" value="Não">
                        <!-- precisa de combo, pois esse é um dos campos da tabela carrinho, e recebido por POST em inserir-carrinho.php -->

                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantidade" value="1">
                                </div>
                            </div>
                        </div>
                        <button href="#" class="primary-btn bg-info">ADICIONAR</button>
                        <!--
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        -->

                    </form>
                    <div class="row mt-4 ml-1">

                        <?php

                        $query2 = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto' order by id desc");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < count($res2); $i++) {
                            foreach ($res2[$i] as $key => $value) {
                            }

                            $id_carac = $res2[$i]['id_carac'];
                            $id_carac_prod = $res2[$i]['id'];

                            $query3 = $pdo->query("SELECT * from carac WHERE id = '$id_carac'");
                            $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                            $nome_carac = $res3[0]['nome'];

                            if ($nome_carac == 'Cor') {
                                @$tem_cor = 'Sim';
                            }


                        ?>

                            <div class="mr-3 mt-3">


                                <select class="form-control form-control-sm" name="categoria" id="categoria">
                                    <?php

                                    echo "<option value='" . $nome_carac . "' > Selecionar " . $nome_carac . "</option>";


                                    $query4 = $pdo->query("SELECT * from carac_itens WHERE id_carac_prod = '$id_carac_prod'");
                                    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i2 = 0; $i2 < count($res4); $i2++) {
                                        foreach ($res4[$i2] as $key => $value) {
                                        }



                                        echo "<option value='" . $res4[$i2]['id'] . "' >" . $res4[$i2]['nome_item'] . "</option>";
                                    }

                                    ?>
                                </select>




                            </div>

                        <?php
                        }

                        ?>



                    </div>

                    <?php
                    if (@$tem_cor == 'Sim') {
                    ?>
                        <div class="mt-4">

                            <?php
                            echo "<span class='mr-2'>Cores disponíveis: </span>";

                            $query2 = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto' order by id desc");
                            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($res2); $i++) {
                                foreach ($res2[$i] as $key => $value) {
                                }

                                $id_carac = $res2[$i]['id_carac'];
                                $id_carac_prod = $res2[$i]['id'];

                                $query3 = $pdo->query("SELECT * from carac WHERE id = '$id_carac'");
                                $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                                $nome_carac = $res3[0]['nome'];

                                if ($nome_carac == 'Cor') {
                                    $query4 = $pdo->query("SELECT * from carac_itens WHERE id_carac_prod = '$id_carac_prod'");
                                    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i2 = 0; $i2 < count($res4); $i2++) {
                                        foreach ($res4[$i2] as $key => $value) {
                                        }

                                        $valor_item = $res4[$i2]['valor_item'];

                                        echo "<span> <i class='fa fa-circle ml-1 mr-1' style='color:" . $valor_item . "'></i>" . $res4[$i2]['nome_item'] . "</span>";
                                    }
                                }
                            }

                            ?>


                        </div>

                    <?php
                    }

                    ?>


                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Descrição Longa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Informações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Descrição Longa</h6>
                                <p>
                                    <?php echo $descricao_longa ?>
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Informações Técnicas</h6>
                                <li><b>Peso: </b> <span><?php echo $peso ?>g</span></li>
                                <li><b>Altura: </b> <span><?php echo $altura ?>cm</span></li>
                                <li><b>Largura: </b> <span><?php echo $largura ?>cm</span></li>
                                <li><b>Comprimento: </b> <span><?php echo $comprimento ?>cm</span></li>
                                <li><b>Modelo: </b> <span><?php echo $modelo ?></span></li>
                                <li><b>Estoque: </b> <span><?php echo $estoque ?> unidades</span></li>


                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                    sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                    eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                    Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                    sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                    diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                    Proin eget tortor risus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Produtos Relacionados</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="categories__slider owl-carousel">

                <?php
                $query = $pdo->query("SELECT * FROM produtos WHERE id_subcategoria = '$id_subcategoria' order by id desc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome_url_produto = $res[$i]['nome_url'];
                    $nome_produto = $res[$i]['nome'];
                    $valor_produto_sem_promocao = $res[$i]['valor'];
                    $imagem_produto = $res[$i]['imagem'];
                    $promocao_produto = $res[$i]['promocao'];
                    $id_produto = $res[$i]['id'];

                    $valor_produto_sem_promocao = number_format($valor_produto_sem_promocao, 2, ',', '.');

                    if ($promocao_produto == 'Sim') {
                        $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto'");
                        $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                        $valor_produto_promocao = $resP[0]['valor'];
                        $desconto_produto = $resP[0]['desconto'];
                        $valor_produto_promocao = number_format($valor_produto_promocao, 2, ',', '.');

                ?>

                        <div class="col-lg-4">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem_produto ?>">
                                    <div class="product__discount__percent"><?php echo $desconto_produto ?>%</div>
                                    <ul class="product__item__pic__hover">
                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                        <li><a href="produto-<?php echo $nome_url_produto ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="produto-<?php echo $nome_url_produto ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <h5><a href="produto-<?php echo $nome_url_produto ?>"><?php echo $nome_produto ?></a></h5>
                                    <div class="product__item__price">R$ <?php echo $valor_produto_promocao ?> <span>R$ <?php echo $valor_produto_sem_promocao ?></span></div>
                                </div>
                            </div>
                        </div>

                    <?php
                    } else {

                    ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 mix sapatos fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem_produto ?>">
                                    <ul class="featured__item__pic__hover">
                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                        <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                        <li><a href="produto-<?php echo $nome_url_produto ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <a href="produto-<?php echo $nome_url_produto ?>">
                                        <h6><?php echo $nome_produto ?></h6>
                                        <h5>R$ <?php echo $valor_produto_sem_promocao ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>

                <?php
                    } //fechamento if
                } //fechamento for
                ?>


            </div>


        </div>
    </div>
</section>
<!-- Related Product Section End -->

<?php

require_once('rodape.php');
?>

<script>
    //esse script tem que ser chamado após rodape.php, pois a chamada do jQuery é feito em rodape.php
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function() {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
</script>