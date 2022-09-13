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

$query = $pdo->query("SELECT * FROM combos where nome_url = '$produto_get'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$id_combo = $res[0]['id'];
$nome = $res[0]['nome'];
$imagem = $res[0]['imagem'];
$valor = $res[0]['valor'];
//$estoque = $res[0]['estoque']; //autor definiu que combo não tem estoque, apenas os produtos
$descricao = $res[0]['descricao'];
$descricao_longa = $res[0]['descricao_longa'];
$tipo_envio = $res[0]['tipo_envio'];
$palavras = $res[0]['palavras'];
$ativo = $res[0]['ativo'];
$peso = $res[0]['peso'];
$largura = $res[0]['largura'];
$altura = $res[0]['altura'];
$comprimento = $res[0]['comprimento'];
$valor_frete = $res[0]['valor_frete'];

$valor_frete = number_format($valor_frete, 2, ',', '.');
$valor = number_format($valor, 2, ',', '.');

$query_e = $pdo->query("SELECT * FROM tipo_envios where id = '$tipo_envio'");
$res_e = $query_e->fetchAll(PDO::FETCH_ASSOC);
$tipo_frete = @$res_e[0]['tipo'];

?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="img/combos/<?php echo $imagem ?>" alt="">
                    </div>

                    <!-- em produto.php aqui aqui há uma div que exibe um carousel com as imagens secundárias do produto, porém, para o combo o autor optou por não usar carousel por não permitir imagens secundárias do combo, portanto, esse trecho de código foi removido -->

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
                            <input type="hidden" id="id_produto" name="id_produto" value="<?php echo $id_combo ?>">
                            <input type="hidden" id="combo" name="combo" value="Sim">

                            <!-- precisa de combo, pois esse é um dos campos da tabela carrinho, e recebido por POST em inserir-carrinho.php -->

                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantidade" value="1">
                                </div>
                            </div>
                        </div>
                        <button href="#" class="primary-btn bg-info" id="btn-add-carrinho">ADICIONAR</button>

                        <small>
                            <div id="mensagem-carrinho-produto" align="center" style="margin-top:15px"></div>
                        </small>

                        <!--
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        -->

                    </form>

                    <h4 class="mt-2 mb-2">Produtos do Combo</h4>

                    <?php

                    $query = $pdo->query("SELECT * FROM prod_combos where id_combo = '$id_combo' order by id");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $id_produto_combo = $res[$i]['id_produto'];

                        $query2 = $pdo->query("SELECT * FROM produtos where id = '$id_produto_combo' order by id");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                        $nome_produto_combo = $res2[0]['nome'];
                        $nome_url_produto_combo = $res2[0]['nome_url'];

                        echo '<a href="produto-' . $nome_url_produto_combo . '" title="Ver Produto" class="text-dark"><i class="fa fa-check text-info mr-1"></i><span>' . $nome_produto_combo . '</span></a><br>';
                    }

                    //calcular frete
                    if ($tipo_frete == 'sem frete') {
                        echo '<div class="product__details__text mt-2"> <p>Esse produto está com frete gratuito!</p></div>';
                    } else if ($tipo_frete == 'fixo') {
                        echo '<div class="product__details__text mt-2"> <p>Esse produto possui frete fixo de R$ ' . $valor_frete . '!<p></div>';
                    } else if ($tipo_frete == 'digital') {
                        echo '<div class="product__details__text mt-2"> <p>Esse é um produto digital, e por isso não possui frete!</p></div>';
                    } else if ($tipo_frete == 'correios') {

                    ?>

                        <div class="checkout__order__total mt-3">Calcular Frete<br>

                            <form method="post" id="form-correios">
                                <input type="hidden" id="total_peso" name="total_peso" value="<?php echo $peso ?>">
                                <input type="hidden" id="nome_produto" name="nome_produto" value="<?php echo $nome_produto ?>">


                                <div class="row mt-2">

                                    <div class="col-md-7">
                                        <div class="checkout__input">

                                            <input type="text" name="cep2" id="cep2" placeholder="Digite o CEP">
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="checkout__input">
                                            <select name="codigo_servico_correios" id="codigo_servico_correios">
                                                <option value="0">Envio</option>
                                                <option value="40010">Sedex</option>
                                                <option value="41106">PAC</option>
                                            </select>
                                        </div>

                                    </div>
                                    <big>
                                        <div id="listar-frete"></div>
                                    </big>
                                </div>
                            </form>

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
                    <h2>Outros Combos</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="categories__slider owl-carousel">

                <?php
                $query = $pdo->query("SELECT * FROM combos order by id desc limit 10");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome_url_produto = $res[$i]['nome_url'];
                    $nome_produto = $res[$i]['nome'];
                    $valor_produto_sem_promocao = $res[$i]['valor'];
                    $imagem_produto = $res[$i]['imagem'];
                    $id_produto = $res[$i]['id'];

                    $valor_produto_sem_promocao = number_format($valor_produto_sem_promocao, 2, ',', '.');

                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix sapatos fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="img/combos/<?php echo $imagem_produto ?>">
                                <ul class="featured__item__pic__hover">
                                    <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                    <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                    <li><a href="combo-<?php echo $nome_url_produto ?>"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#" onclick="carrinhoModal('<?php echo $id_produto ?>', 'Sim')"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <a href="combo-<?php echo $nome_url_produto ?>">
                                    <h6><?php echo $nome_produto ?></h6>
                                    <h5>R$ <?php echo $valor_produto_sem_promocao ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php
                } //fechamento for
                ?>


            </div>


        </div>
    </div>
</section>
<!-- Related Product Section End -->

<?php

require_once('rodape.php');

//tem que ser chamada depois do rodape.php, pois no rodape.php chama o jQuery, e em modal-carrinho.php, as funções com AJAX necessitam de jQuery
require_once('modal-carrinho.php');
//mantive o require da modal-carrinho.php por conta dos produtos relacionados ao final da página, eles tem o ícone do carrinho
//ao clicar no botão adicionar, preferi redirecionar para carrinho.php com window.location após clique em btn-add-carrinho

?>

<script>
    /*
    //desnecessário, pois modal-carrinho.php já tem um script que faz isso, se descomentar, vai mostrar duas sinal de menos e dois de mais (para remover e adicionar produtos)
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
*/
</script>




<script type="text/javascript">
    $('#btn-add-carrinho').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'carrinho/inserir-carrinho.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Produto Inserido no Carrinho!') {

                    window.location = 'carrinho.php'
                    //$('#modal-carrinho').modal('show'); //abre a modal carrinho


                } else {
                    $('#mensagem-carrinho-produto').removeClass();
                    $('#mensagem-carrinho-produto').addClass('text-danger');
                    $('#mensagem-carrinho-produto').text(msg);

                }
            }
        })

    })
</script>

<script type="text/javascript">
    $('#codigo_servico_correios').change(function(event) {
        event.preventDefault();

        $.ajax({
            url: "correios/pegarDadosFrete.php",
            method: "post",
            data: $('#form-correios').serialize(),
            dataType: "html",
            success: function(result) {

                $('#listar-frete').html(result)

            },
        })


    })
</script>