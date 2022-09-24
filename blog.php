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
$nome_pag = 'blog.php';

?>

<!-- Breadcrumb Section Begin
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">

            <?php
            $query = $pdo->query("SELECT * FROM blog order by id desc LIMIT $limite, $itens_por_pagina");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($res); $i++) {
                foreach ($res[$i] as $key => $value) {
                }
                $titulo = $res[$i]['titulo'];
                $titulo_url = $res[$i]['titulo_url'];
                $imagem = $res[$i]['imagem'];
                $data = $res[$i]['data'];
                $id = $res[$i]['id'];

                $data_formatada = implode('/', array_reverse(explode('-', $data)));

                //total comentários post
                $query2 = $pdo->query("SELECT * FROM comentarios_blog WHERE id_post = $id");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $total_comentarios_post = @count($res2);

                //total de categorias para paginar
                $query3 = $pdo->query("SELECT * FROM blog");
                $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                $total_postagens = @count($res3);
                $numero_paginas = ceil($total_postagens / $itens_por_pagina);
                /*ceil ARREDONDA SEMPRE PARA CIMA, por exemplo, 
                        
                        se fossem 12 categorias, dividido por 5 itens por página, daria 2,4 página, e nesse caso ceil arredonda para 3 páginas, na primeira e na segunda mostraria 5 itens, e na terceira o resto, ou seja, 2. 

                        */

            ?>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/<?php echo $imagem ?>" alt="" width="100%" height="250px">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> <?php echo $data_formatada ?></li>
                                <li><i class="fa fa-comment-o"></i> <?php echo $total_comentarios_post ?></li>
                            </ul>
                            <h5><a href="postagem-<?php echo $titulo_url ?>"><?php echo $titulo ?></a></h5>
                            <p>Aqui dá para colocar as primeiras palavras da descrição 1 </p>
                            <a href="postagem-<?php echo $titulo_url ?>" class="blog__btn">LEIA MAIS <span class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

            <div class="col-lg-12">
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


                    <a href="<?php echo $nome_pag ?>?pagina=<?php echo $numero_paginas - 1 //pois a primeira página é 0, se tivesse 6 páginas, a última tem que ser a 5, daí numero_paginas - 1 = 5. a página mostra da 1 à 6, porém, na contagem é 0 à 5 ?>"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<?php
require_once('rodape.php');
?>