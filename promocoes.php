<?php
require_once('cabecalho.php');
require_once('cabecalho-busca.php');

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
$nome_pag = 'promocoes.php';

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

                </div>
            </div>
            <div class="col-lg-9 col-md-7">

            <h4>Lista de Promoções</h4>

                <div class="row mt-4">

                    <?php
                    $query = $pdo->query("SELECT * FROM produtos WHERE promocao = 'Sim' and ativo = 'Sim' and estoque > 0 order by id desc LIMIT $limite, $itens_por_pagina");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }
                        $nome_url_produto_promocao = $res[$i]['nome_url'];
                        $nome_produto_promocao = $res[$i]['nome'];
                        $imagem_produto_promocao = $res[$i]['imagem'];
                        $id_produto_promocao = $res[$i]['id'];
                        $valor_sem_promocao = $res[$i]['valor'];

                        $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto_promocao'");
                        $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                        $valor_produto_promocao = $resP[0]['valor'];
                        $desconto_produto_promocao = $resP[0]['desconto'];

                        $valor_sem_promocao = number_format($valor_sem_promocao, 2, ',', '.');
                        $valor_produto_promocao = number_format($valor_produto_promocao, 2, ',', '.');

                        //BUSCAR O TOTAL DE REGISTROS PARA PAGINAR
                        $query3 = $pdo->query("SELECT * FROM produtos where promocao = 'Sim' and ativo = 'Sim' and estoque > 0");
                        $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                        $num_total = @count($res3);
                        $numero_paginas = ceil($num_total / $itens_por_pagina);

                    ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">

                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem_produto_promocao ?>">
                                    <div class="product__discount__percent"><?php echo $desconto_produto_promocao ?>%</div>
                                    <ul class="product__item__pic__hover">
                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                        <li><a href="produto-<?php echo $nome_url_produto_promocao ?>"><i class="fa fa-eye"></i></a></li>


                                                <li><a href="#" onclick="carrinhoModal('<?php echo $id_produto_promocao ?>', 'Não')"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <h5><a href="produto-<?php echo $nome_url_produto_promocao ?>"><?php echo $nome_produto_promocao ?></a></h5>
                                    <div class="product__item__price">R$ <?php echo $valor_produto_promocao ?> <span>R$ <?php echo $valor_sem_promocao ?></span></div>
                                </div>
                            </div>



                        </div>

                    <?php
                    }
                    ?>

                </div>
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
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php
require_once('rodape.php');
require_once('modal-carrinho.php');

?>