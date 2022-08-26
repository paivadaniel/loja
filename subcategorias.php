<?php

/*
//testando RewriteRule ^subcategoria-(.*)$ subcategorias.php?nome=$1 [L]
//Rule é para rota
//L é para rota
echo $_GET['nome']; 
*/

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
$nome_pag = 'subcategorias.php';

//recuperar o nome da categoria para filtrar as subcategorias (vindas de categorias.php)
$categoria_get = @$_GET['nome'];

//echo $categoria_get;

//recuperando id da categoria a ser filtrada
$query = $pdo->query("SELECT * FROM categorias WHERE nome_url = '$categoria_get'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_categoria_get = @$res[0]['id']; //se não tiver categoria_get, não tem res[0][id], então coloca arroba, ou faz um if(count(res) > 0)

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

                </div>
            </div>
            <div class="col-lg-9 col-md-7">

            <h4>Lista de Subcategorias</h4>

                <div class="row mt-4">

                    <?php

                    if ($categoria_get != "") { //query com filtro para mostrar as subcategorias da categoria escolhida

                        $query = $pdo->query("SELECT * FROM subcategorias WHERE id_categoria = '$id_categoria_get' order by id desc"); //id_categoria_get não precisa ficar envolto em aspas simples, pois é inteiro, não string


                    } else { //query sem filtro, mostra todas as subcategorias
                        $query = $pdo->query("SELECT * FROM subcategorias order by id desc LIMIT $limite, $itens_por_pagina");
                    }

                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $total_subcategorias = @count($res);

                    if ($total_subcategorias == 0) { //se a categoria não tiver subcategorias dentro dela, isso se refere ao if com categoria_get feito acima, e de maneira geral vale apenas para $categoria_get != "", ou se não todas as categorias não tiverem subcategorias

                        echo "Nenhuma subcategoria foi cadastrada para essa categoria.";

                    }

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }
                        $nome_url_subcategoria = $res[$i]['nome_url'];
                        $nome_subcategoria = $res[$i]['nome'];
                        $imagem_subcategoria = $res[$i]['imagem'];
                        $id_subcategoria = $res[$i]['id'];

                        //total produtos
                        $query2 = $pdo->query("SELECT * FROM produtos WHERE id_subcategoria = $id_subcategoria");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $total_produtos = @count($res2);

                        //total de categorias para paginar (SEM LIMITE)

                        $query3 = $pdo->query("SELECT * FROM subcategorias");
                        $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                        $total_subcategorias = @count($res3);
                        $numero_paginas = ceil($total_subcategorias / $itens_por_pagina);
                        /*ceil ARREDONDA SEMPRE PARA CIMA, por exemplo, 
                        
                        se fossem 12 categorias, dividido por 5 itens por página, daria 2,4 página, e nesse caso ceil arredonda para 3 páginas, na primeira e na segunda mostraria 5 itens, e na terceira o resto, ou seja, 2. 

                        */

                    ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="img/subcategorias/<?php echo $imagem_subcategoria ?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="produtos-<?php echo $nome_url_subcategoria ?>"><i class="fa fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <a href="produtos-<?php echo $nome_url_subcategoria ?>">
                                        <h6><?php echo $nome_subcategoria ?></h6>
                                        <h5><?php echo $total_produtos ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>

                <?php

                if ($categoria_get == "") { //quando filtro uma categoria por subcategoria dela, ou seja, quando em categorias.php clico em uma categoria para ver as subcategorias dela, não mostra a paginação

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
require_once('rodape.php')
?>