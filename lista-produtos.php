<?php
require_once('cabecalho.php');
require_once('conexao.php');

//pegar página atual para paginação

if (@$_GET['pagina'] != null) {
    $pag = $_GET['pagina'];
} else {
    $pag = 0;
}

$limite = $pag * @$itens_por_pagina;
/*esse limite é o que vai na instrução SQL, como por exemplo

$query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by id desc limit 6, 3"); //limite de 3, a partir do 6

$query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by id desc limit $limite, 3");

ou seja:
$pdo->query("SELECT * FROM subcategorias order by nome asc LIMIT $limite, $itens_por_pagina");

*/

$pagina = $pag;
$nome_pag = 'lista-produtos.php';

//recuperar o nome da subcategoria para filtrar os produtos
$subcategoria_get = @$_GET['nome'];

//recuperando id da subcategoria a ser filtrada
$query = $pdo->query("SELECT * FROM subcategorias WHERE nome_url = '$subcategoria_get'"); //nome_url pois o GET devolve com hífen
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_subcategoria_get = @$res[0]['id']; //se não tiver subcategoria_get, não tem res[0][id], então coloca arroba, ou faz um if(count(res) > 0)

//recuperar o valor inicial e o valor final para filtrar produto por preço
$valorInicial_get = @$_GET['valorInicial'];
$valorFinal_get = @$_GET['valorFinal'];

?>

<!-- Breadcrumb Section Begin
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Categorias</h4>
                        <ul>
                            <?php
                            $query = $pdo->query("SELECT * FROM categorias order by nome asc"); //pode passar sem aspas pois as duas variáveis são inteiras, apenas se fossem string teria que passar com aspas
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_categoria = $res[$i]['nome_url'];
                                $nome_categoria = $res[$i]['nome'];

                            ?>

                                <li><a href="subcategoria-<?php echo $nome_url_categoria ?>"><?php echo $nome_categoria ?></a></li>

                            <?php
                            }
                            ?>
                        </ul>


                    </div>

                    <div class="sidebar__item">
                        <h4>Subcategorias</h4>
                        <ul>

                            <?php
                            $query = $pdo->query("SELECT * FROM subcategorias order by nome asc"); //pode passar sem aspas pois as duas variáveis são inteiras, apenas se fossem string teria que passar com aspas
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_subcategoria = $res[$i]['nome_url'];
                                $nome_subcategoria = $res[$i]['nome'];

                            ?>

                                <li><a href="produtos-<?php echo $nome_url_subcategoria ?>"><?php echo $nome_subcategoria ?></a></li>

                            <?php
                            }
                            ?>


                        </ul>


                    </div>

                    <div class="sidebar__item">
                    <h4>Preço (R$)</h4>
                        <!-- price-range está em js/main.js -->
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="0" data-max="1000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <form action="lista-produtos.php" method="GET" name="form_valor">

                                        <input type="text" name="valorInicial" id="minamount">
                                        <input type="text" name="valorFinal" id="maxamount">
                                        <a href="#" onclick="document.form_valor.submit(); return false;" class="text-dark">
                                            <i class="fa fa-search ml-2"></i>
                        </a>
                                        <!-- se mudar de button para link, não faz o submit, então teve que fazer o que está acima ao invés de criar uma classe CSS para estilizar o botão 
                                    
                                    estava assim:

                                                                            <button type="submit" class="link-botao">
                                            <i class="fa fa-search ml-2"></i>
                                        </button>


                                    -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>
            </div>
            <div class="col-lg-9 col-md-7">

                <div class="row">
                    <div class="hero__search__form mb-4">
                        <form method="GET" >

                        <!--
autor acrescentou action="lista-produtos.php", mas não adianta nada

na ideia dele ao clicar numa subcategoria, por exemplo, "teste" ele estava abrindo "produtos-teste", conforme consta no htaccess RewriteRule ^produtos-(.*)$ lista-produtos.php?nome=$1 [L]

então forçamos ele a abrir ainda em lista-produtos.php


                        -->
                            <!--
                                    <div class="hero__search__categories">
                                Produtos
                                    <span class="arrow_carrot-right"></span>
                                </div>
                                -->
                            <input type="text" name="txtBuscar" id="txtBuscar" value="<?php echo @$_GET['txtBuscar'] ?>" placeholder="O que você precisa?">
                            <button type="submit" class="site-btn">BUSCAR</button>
                        </form>
                    </div>

                </div>

                <?php

                if (@$_GET['txtBuscar'] != "") {
                    $buscar = '%' . @$_GET['txtBuscar'] . '%';
                    //com o operador de porcentagem, se digitar "camisa", tudo que tenha esse termo no nome, como "camisa social", "camisa masculina" vai buscar
                } else {
                    $buscar = '%'; //daí retorna tudo
                }


                if ($subcategoria_get == "" and $valorInicial_get == "") { //query com filtro para mostrar os produtos da subcategoria escolhida
                    //não precisa testar valorFinal pois ele irá enviar os dois

                    $query = $pdo->query("SELECT * FROM produtos WHERE (nome LIKE '$buscar' or palavras LIKE '$buscar') and ativo = 'Sim' and estoque > 0 order by id desc limit $limite, $itens_por_pagina");

                } else if ($valorInicial_get != "") {
                    $query = $pdo->query("SELECT * FROM produtos WHERE valor >= '$valorInicial_get' and valor <= '$valorFinal_get' and ativo = 'Sim' and estoque > 0 order by id desc");

                } else { 
                    $query = $pdo->query("SELECT * FROM produtos WHERE id_subcategoria = '$id_subcategoria_get' and ativo = 'Sim' and estoque > 0 order by id desc limit $limite, $itens_por_pagina");

                }

                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_prod_buscar = @count($res);

                if (@$_GET['txtBuscar'] != "" or @$id_subcategoria_get != "" or @$valorInicial_get != "") {


                    if ($total_prod_buscar == 1) {
                        echo $total_prod_buscar . " produto encontrado!";
                    } else {
                        echo $total_prod_buscar . " produtos encontrados!";
                    }
                }

                echo "<div class='row mt-3'>";

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

                    //BUSCAR O TOTAL DE PRODUTOS PARA PAGINAR
                    $query3 = $pdo->query("SELECT * FROM produtos where ativo = 'Sim' and estoque > 0");
                    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                    $num_total = @count($res3);
                    $numero_paginas = ceil($num_total / $itens_por_pagina);

                    if ($promocao_produto == 'Sim') {
                        $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto'");
                        $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                        $valor_produto_promocao = $resP[0]['valor'];
                        $desconto_produto = $resP[0]['desconto'];
                        $valor_produto_promocao = number_format($valor_produto_promocao, 2, ',', '.');


                ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem_produto ?>">
                                    <div class="product__discount__percent"><?php echo $desconto_produto ?>%</div>
                                    <ul class="product__item__pic__hover">
                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                        <li><a href="produto-<?php echo $nome_url_produto ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#" onclick="carrinhoModal('<?php echo $id_produto ?>', 'Não')"><i class="fa fa-shopping-cart"></i></a></li>

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

                        <div class="col-lg-4 col-md-6 col-sm-6">
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
                    } //fechamento do if
                } //fechamento do for

                ?>

            </div>

            <?php
            if ((@$_GET['txtBuscar'] == "" and @$id_subcategoria_get == "" and @$valorInicial_get == "") or (@$_GET['txtBuscar'] != "" and $total_prod_buscar >= $itens_por_pagina) or (@$id_subcategoria_get != "" and $total_prod_buscar >= $itens_por_pagina) or (@$valorInicial_get != "" and $total_prod_buscar >= $itens_por_pagina)) {

                /*eu adicionei (@$_GET['txtBuscar'] != "" and $total_prod_buscar >= $itens_por_pagina)
                tem que resolver a questão de quando $total_prod_buscar >= $itens_por_pagina, mostra todos os produtos na paginação, não apenas os filtrados
                */

            ?>
                <div class="product__pagination">
                    <a href="<?php echo $nome_pag ?>?pagina=0"><i class="fa fa-long-arrow-left"></i></a>

                    <?php
                    for ($i = 0; $i < @$numero_paginas; $i++) {
                        $estilo = '';
                        if ($pagina == $i) { //vai estar naquela página, é como uma classe active
                            $estilo = 'bg-info text-light';
                        }

                        if ($pagina >= ($i - 2) && $pagina <= ($i + 2)) { //se estiver na página 5, vai mostrar a 3 e a 4, e a 6 e a 7, explicado no mod05 aula20  
                    ?>
                            <a href="<?php echo $nome_pag ?>?pagina=<?php echo $i ?>" class="<?php echo $estilo ?>"><?php echo $i + 1 //para não mostrar o zero em 0, 1, 2... 
                                                                                                                    ?></a>

                    <?php
                        } //fechamento do if
                    } //fechamento do for
                    ?>


                    <a href="<?php echo $nome_pag ?>?pagina=<?php echo $numero_paginas - 1 //pois a primeira página é 0, se tivesse 6 páginas, a última tem que ser a 5, daí numero_paginas - 1 = 5. a página mostra da 1 à 6, porém, na contagem é 0 à 5 
                                                            ?>"><i class="fa fa-long-arrow-right"></i></a>
                </div>


            <?php
            }
            ?>
        </div>
    </div>
    </div>
</section>
<!-- Product Section End -->

<?php

require_once('rodape.php');
require_once('modal-carrinho.php');

?>