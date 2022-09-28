<?php

require_once('conexao.php');

//recuperar o nome do produto para filtrar as informações (como características) dele
$produto_get = @$_GET['nome']; //esse GET vem do htaccess?

$tem_cor; //essa variável é trabalhada no final dessa página para mostrar a paleta de cores do produto

@session_start();
$nivel_usuario = @$_SESSION['nivel_usuario'];

?>

<?php

//trazer os dados do produto
$query = $pdo->query("SELECT * FROM produtos where nome_url = '$produto_get'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$palavras = $res[0]['palavras'];

//foi colocado aqui para ficar depois de $palavras, confira no $cabecalho, na parte de keywords, que fazemos uso de $palavras, portanto, a variável tem que ser chamada antes
//tem um SELECT relacionado à produtos em cabecalho.php, dessa forma, autor fez o mesmo SELECT, primeiramente apenas para pegar palavras, e depois, em seguida do cabecalho, para pegar o restante dos dados, e não dar conflito de variáveis 
require_once('cabecalho.php');
require_once('cabecalho-busca.php');

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

                        <?php

                        $total_avaliacoes_produto = 0;
                        $nota_avaliacao_produto_media_aritmetica = 0;
                        $soma_nota = 0;

                        $query = $pdo->query("SELECT * FROM avaliacoes where id_produto = '$id_produto'");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        $total_avaliacoes_produto = @count($res);

                        if ($total_avaliacoes_produto > 0) {

                            for ($i = 0; $i < $total_avaliacoes_produto; $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }

                                $nota_avaliacao_produto = $res[$i]['nota'];

                                $soma_nota += $nota_avaliacao_produto;
                            }

                            $nota_avaliacao_produto_media_aritmetica = $soma_nota / $total_avaliacoes_produto;
                        }

                        for ($i2 = 0; $i2 < $nota_avaliacao_produto_media_aritmetica; $i2++) {

                            echo '<i class="fa fa-star"></i>';
                        }

                        ?>


                        <span>(<?php
                                if ($total_avaliacoes_produto != 1) {
                                    echo $total_avaliacoes_produto
                                ?> avaliações)

                        <?php

                                } else {
                                    echo $total_avaliacoes_produto

                        ?>
                            avaliação)

                        <?php

                                }
                        ?>

                        </span>
                    </div>
                    <div class="product__details__price">R$ <?php echo $valor ?></div>
                    <p><?php echo $descricao ?></p>
                    <form method="post" id="form-add">

                        <!-- não tem como passar id_carrinho pois somente depois de adicionar é que será criada a id_carrinho, inserir-carrinho.php não recebe id_carrinho -->
                        <div class="product__details__quantity">
                            <input type="hidden" id="id_produto" name="id_produto" value="<?php echo $id_produto ?>">
                            <input type="hidden" id="combo" name="combo" value="Não">
                            <input type="hidden" id="tem_carac" name="tem_carac" value="Sim">

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

                        <div class="row mt-4 ml-1 mb-4">

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

                                    <select class='form-control form-control-sm' name='<?php echo $i ?>' id='<?php echo $i ?>'>
                                        <?php

                                        echo "<option value='0' > Selecionar " . $nome_carac . "</option>";


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

                    </form> <!-- form fica aqui para enviar os itens das características do produto, por exemplo, cor amarelo e tamanho P -->


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
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Comentários <span>(<?php echo $total_avaliacoes_produto ?>)</span></a>
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
                                <h6>Avaliações dos Clientes</h6>

                                <div class="mt-4">
                                    <?php

                                    $query = $pdo->query("SELECT * from avaliacoes WHERE id_produto = '$id_produto' order by data desc");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($res); $i++) {
                                        foreach ($res[$i] as $key => $value) {
                                        }

                                        $id_avaliacao = $res[$i]['id'];
                                        $id_cliente_avaliacao = $res[$i]['id_usuario'];
                                        $texto = $res[$i]['texto'];
                                        $nota = $res[$i]['nota'];

                                        $data_avaliacao = $res[$i]['data'];
                                        $data_avaliacao_formatada = implode('/', array_reverse(explode('-', $data_avaliacao)));

                                        $query2 = $pdo->query("SELECT * from usuarios WHERE id = '$id_cliente_avaliacao'");
                                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                        $nome_cliente_avaliacao = $res2[0]['nome'];

                                        if ($nota == 5) {
                                            $nota_texto = 'Excelente!';
                                        } else if ($nota == 4) {
                                            $nota_texto = 'Muito Bom!';
                                        } else if ($nota == 3) {
                                            $nota_texto = 'Bom!';
                                        } else if ($nota == 2) {
                                            $nota_texto = 'Mediano!';
                                        } else if ($nota == 1) {
                                            $nota_texto = 'Ruim!';
                                        }

                                        if ($nota >= $nota_minima) {

                                    ?>
                                            <div class="mb-2">

                                                <div>
                                                    <span class="mr-1"><u><i><?php echo $nome_cliente_avaliacao ?></i></u></span>
                                                    <span class="mr-1"><i><?php echo $data_avaliacao_formatada ?></i></span>


                                                    <?php
                                                    for ($i2 = 0; $i2 < $nota; $i2++) {
                                                        echo '<i class="fa fa-star text-warning mr-1"></i>';
                                                    }
                                                    ?>

                                                    <span class="mr-2 text-muted"><i><?php echo $nota_texto ?></i></span>

                                                    <?php
                                                    if ($nivel_usuario == 'Administrador') {
                                                        //tem que colocar nome=echo $_GET['nome'] como parâmetro na url, pois lá em cima nessa página, para filtrar as informações do produto, a página exige a informação $_GET['nome']
                                                    ?>
                                                        <a href="produto.php?nome=<?php echo $produto_get ?>&acao=deletar&id_avaliacao=<?php echo $id_avaliacao ?>">
                                                            <i class="fa fa-trash  text-danger"></i>
                                                        </a>



                                                    <?php

                                                    }
                                                    ?>
                                                    <br>

                                                    <span class="text-muted"><i><small><?php echo $texto ?></small></i></span>
                                                </div>
                                            </div>

                                    <?php } //fechamento if nota mínima
                                    } //fechamento for 
                                    ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<?php
if (@$_GET['acao'] == 'deletar') {

    $id_aval = $_GET['id_avaliacao'];
    $pdo->query("DELETE from avaliacoes WHERE id = '$id_aval'");
}
?>

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
                $query = $pdo->query("SELECT * FROM produtos WHERE id_subcategoria = '$id_subcategoria' and ativo = 'Sim' and estoque > 0 order by id desc");
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
                                        <li><a href="#" onclick="carrinhoModal('<?php echo $id_produto ?>', 'Não')"><i class="fa fa-shopping-cart"></i></a></li>
                                        <!-- autor optou por mandar para carrinho.php, e para isso criou a função irCarrinho, optei por mandar para carrinhoModal que está em modal-carrinho.php -->
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
                                        <li><a href="#" onclick="carrinhoModal('<?php echo $id_produto ?>', 'Não')"><i class="fa fa-shopping-cart"></i></a></li>
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

//modal-carrinho.php tem que ser chamada depois do rodape.php, pois no rodape.php chama o jQuery, e em modal-carrinho.php, as funções com AJAX necessitam de jQuery
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