<?php
require_once('conexao.php');

@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$titulo_url_get = $_GET['nome']; //o termo dentro do GET, ou seja, 'nome', é definido como 'nome' no htaccess

$query = $pdo->query("SELECT * FROM blog WHERE titulo_url = '$titulo_url_get'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$palavras = $res[0]['palavras'];

//tem que vir depois de $palavras, confira porquê em cabecalho.php no if (@$palavras != "") 

require_once('cabecalho.php');
require_once('cabecalho-busca.php');

?>

<!-- Blog Details Hero Begin
    <section class="blog-details-hero set-bg" data-setbg="img/blog/details/details-hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>The Moment You Need To Remove Garlic From The Menu</h2>
                        <ul>
                            <li>By Michael Scofield</li>
                            <li>January 14, 2019</li>
                            <li>8 Comments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
  Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
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

                    <div class="blog__sidebar__item">
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

                    <!--
                    <div class="blog__sidebar__item">
                        <h4>Recent News</h4>
                        <div class="blog__sidebar__recent">
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-1.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>09 Kinds Of Vegetables<br /> Protect The Liver</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-2.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>Tips You To Balance<br /> Nutrition Meal Day</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-3.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>4 Principles Help You Lose <br />Weight With Vegetables</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    -->

                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <?php
                $query = $pdo->query("SELECT * FROM blog WHERE titulo_url = '$titulo_url_get'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                if (@count($res) > 0) {
                    $id_autor = $res[0]['id_autor'];
                    $titulo = $res[0]['titulo'];
                    $descricao_1 = $res[0]['descricao_1'];
                    $descricao_2 = $res[0]['descricao_2'];
                    $imagem = $res[0]['imagem'];
                    $data = $res[0]['data'];

                    $data_formatada = implode('/', array_reverse(explode('-', $data)));

                    $query2 = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_autor' and nivel = 'Administrador'");
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                    $nome_autor = $res2[0]['nome'];
                    $imagem_autor = $res2[0]['imagem'];
                }
                ?>

                <div class="blog__details__text">
                    <img src="img/blog/<?php echo $imagem ?>" alt="">
                    <p>
                        <?php echo $descricao_1 ?>

                    </p>
                    <h3><?php echo $titulo ?></h3>
                    <p><?php echo $descricao_2 ?></p>
                </div>
                <div class="blog__details__content">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="img/usuarios/<?php echo $imagem_autor ?>" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6>
                                        <?php echo $nome_autor ?>

                                    </h6>
                                    <span>Administrador</span>
                                    <!-- apenas administradores podem criar posts -->
                                </div>
                            </div>
                        </div>

                        <!--
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Categories:</span> Food</li>
                                    <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>

            -->

                    </div>
                </div>

                <?php
                if ($id_usuario == "" || $id_usuario == null) { //se o usuário não estiver logado
                    echo '<span>Deseja fazer um comentário? Clique <a href="sistema" title="Fazer Login ou Se Cadastrar" target="_blank">aqui </a> para fazer login ou se cadastrar!</span>';
                } else {
                    
                }

                ?>


            </div>
        </div>


    </div>

</section>
<!-- Blog Details Section End -->


<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Últimos Posts</h2>
                </div>
            </div>
        </div>
        <div class="row">

            <?php
            $query = $pdo->query("SELECT * FROM blog WHERE titulo_url != '$titulo_url_get' order by id desc LIMIT 3"); //where é para não mostrar o post da página
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
                $query2 = $pdo->query("SELECT * FROM comentarios_blog WHERE id_blog = $id");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $total_comentarios_post = @count($res2);

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
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</section>
<!-- Related Blog Section End -->

<?php
require_once('rodape.php');
?>