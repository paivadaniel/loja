<?php

require_once('cabecalho.php');
require_once('conexao.php');

?>

<!-- não chamou cabecalho_busca.php, pois a home tem um banner a mais no cabecalho_busca.php, portanto, ele
foi adicionado no final do código do Hero Section, onde consta banner homepage -->

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Categorias</span>
                    </div>
                    <ul>

                        <?php
                        $query = $pdo->query("SELECT * FROM categorias order by nome asc");
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
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <!--
                                    <div class="hero__search__categories">
                                Produtos
                                    <span class="arrow_carrot-right"></span>
                                </div>
                                -->
                            <input type="text" placeholder="O que você precisa?">
                            <button type="submit" class="site-btn">BUSCAR</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <!-- <i class="fa fa-phone"></i> -->
                            <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_loja_link ?>" title="<?php echo $whatsapp_loja ?>" target="_blank"><i class="fa fa-whatsapp"></i></a>

                        </div>
                        <div class="hero__search__phone__text">
                            <h5><?php echo $whatsapp_loja ?></h5>
                            <span>Contate-nos!</span>
                        </div>
                    </div>
                </div>
                <!-- banner da homepage -->
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="hero__text">
                        <span><?php echo strtoupper($nome_loja) ?></span>
                        <h2>Produtos de <br />Primeira Linha</h2>
                        <p>Aqui você encontra os melhors preços!</p>
                        <a href="produtos.php" class="primary-btn">COMPRAR AGORA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">

                <?php
                $query = $pdo->query("SELECT * FROM categorias order by nome asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome_url_categoria = $res[$i]['nome_url'];
                    $nome_categoria = $res[$i]['nome'];
                    $imagem_categoria = $res[$i]['imagem'];

                ?>

                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categorias/<?php echo $imagem_categoria ?>">
                            <h5><a href="categoria-<?php echo $nome_url_categoria ?>"><?php echo $nome_categoria ?></a></h5>
                        </div>
                    </div>

                <?php
                }
                ?>


            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <a href="produtos.php" class="text-dark">
                        <span>
                            <small>Ver + Produtos</small>
                        </span>
                    </a>
                    <h2>Produtos de Destaque</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <!--
                        <li class="active" data-filter="*">Todas</li>
                        <li data-filter=".sapatos">Sapatos</li>
                        
                        //filtra por items que tem a classe sapatos 
                    -->

                        <?php
                        $query = $pdo->query("SELECT * FROM subcategorias order by nome asc limit 3");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i = 0; $i < count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $nome_url_subcategoria = $res[$i]['nome_url'];
                            $nome_subcategoria = $res[$i]['nome'];

                        ?>

                            <li><a href="subcategoria-<?php echo $nome_url_subcategoria ?>" class="text-dark"><?php echo $nome_subcategoria ?></a></li>

                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">

            <?php
            $query = $pdo->query("SELECT * FROM produtos order by vendas desc limit 5");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($res); $i++) {
                foreach ($res[$i] as $key => $value) {
                }
                $nome_url_produto = $res[$i]['nome_url'];
                $nome_produto = $res[$i]['nome'];
                $valor_produto = $res[$i]['valor'];
                $imagem_produto = $res[$i]['imagem'];

                $valor_produto = number_format($valor_produto, 2, ',', '.');

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
                                <h5>R$ <?php echo $valor_produto ?></h5>
                            </a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>


        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">

            <?php
            $query = $pdo->query("SELECT * FROM promocoes_banner WHERE ativo = 'Sim' order by id desc LIMIT 2"); //o LIMIT é desnecessário pois já programos antes para não poder deixar ativo ao mesmo tempo mais de 2 banners, porém, deixei o LIMIT
            $res = $query->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($res); $i++) {
                foreach ($res[$i] as $key => $value) {
                }

                $titulo_banner = $res[$i]['titulo'];
                $link_banner = $res[$i]['link'];
                $imagem_banner = $res[$i]['imagem'];

            ?>

                <!--
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="bg-light">

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <img src="img/produtos/calca.jpg" alt="">
                        </div>

                        <div class="col-md-6 col-sm-12 mt-4">
                            <div class="hero__text">
                                <h3 class="mt-3">Promoção Camisas</h3>
                                <p class="mt-3">Descrição da promoção <br>que virá do BD!</p>
                                <a href="produtos.php" class="primary-btn">VER PROMOÇÃO!</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        -->


                <div class="col-lg-6 col-md-6 col-sm-6 my-2">
                    <div class="">
                        <a href="produto-<?php echo $link_banner ?>" title="<?php echo $titulo_banner ?>" alt="<?php echo $titulo_banner ?>">
                            <img src="img/promocoes/<?php echo $imagem_banner ?>" alt="">
                        </a>
                    </div>
                </div>

            <?php

            }
            ?>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Últimos Produtos</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by id desc limit 3");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_produto_ultimos = $res[$i]['nome_url'];
                                $nome_produto_ultimos = $res[$i]['nome'];
                                $valor_produto_ultimos = $res[$i]['valor'];
                                $imagem_produto_ultimos = $res[$i]['imagem'];
                                $promocao_produto_ultimos = $res[$i]['promocao'];
                                $id_produto_ultimos = $res[$i]['id'];

                                if ($promocao_produto_ultimos == 'Sim') {
                                    $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto_ultimos'");
                                    $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto_ultimos = $resP[0]['valor'];
                                    $valor_produto_ultimos = number_format($valor_produto_ultimos, 2, ',', '.');
                                } else {
                                    $valor_produto_ultimos = number_format($valor_produto_ultimos, 2, ',', '.');
                                }


                            ?>

                                <a href="produto-<?php echo $nome_url_produto_ultimos ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem_produto_ultimos ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_produto_ultimos ?></h6>

                                        <span>R$ <?php echo $valor_produto_ultimos ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by id desc limit 3, 3"); //limite de 3, a partir do 3
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_produto_ultimos = $res[$i]['nome_url'];
                                $nome_produto_ultimos = $res[$i]['nome'];
                                $valor_produto_ultimos = $res[$i]['valor'];
                                $imagem_produto_ultimos = $res[$i]['imagem'];

                                $promocao_produto_ultimos = $res[$i]['promocao'];
                                $id_produto_ultimos = $res[$i]['id'];

                                if ($promocao_produto_ultimos == 'Sim') {
                                    $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto_ultimos'");
                                    $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto_ultimos = $resP[0]['valor'];
                                    $valor_produto_ultimos = number_format($valor_produto_ultimos, 2, ',', '.');
                                } else {
                                    $valor_produto_ultimos = number_format($valor_produto_ultimos, 2, ',', '.');
                                }

                            ?>

                                <a href="produto-<?php echo $nome_url_produto_ultimos ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem_produto_ultimos ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_produto_ultimos ?></h6>
                                        <span>R$ <?php echo $valor_produto_ultimos ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by id desc limit 6, 3"); //limite de 3, a partir do 6
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_produto_ultimos = $res[$i]['nome_url'];
                                $nome_produto_ultimos = $res[$i]['nome'];
                                $valor_produto_ultimos = $res[$i]['valor'];
                                $imagem_produto_ultimos = $res[$i]['imagem'];

                                $promocao_produto_ultimos = $res[$i]['promocao'];
                                $id_produto_ultimos = $res[$i]['id'];

                                if ($promocao_produto_ultimos == 'Sim') {
                                    $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto_ultimos'");
                                    $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto_ultimos = $resP[0]['valor'];
                                    $valor_produto_ultimos = number_format($valor_produto_ultimos, 2, ',', '.');
                                } else {
                                    $valor_produto_ultimos = number_format($valor_produto_ultimos, 2, ',', '.');
                                }
                            ?>

                                <a href="produto-<?php echo $nome_url_produto_ultimos ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem_produto_ultimos ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_produto_ultimos ?></h6>
                                        <span>R$ <?php echo $valor_produto_ultimos ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Mais Vendidos</h4>

                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by vendas desc limit 3");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_produto_mais_vendidos = $res[$i]['nome_url'];
                                $nome_produto_mais_vendidos = $res[$i]['nome'];
                                $valor_produto_mais_vendidos = $res[$i]['valor'];
                                $imagem_produto_mais_vendidos = $res[$i]['imagem'];

                                $promocao_produto_mais_vendidos = $res[$i]['promocao'];
                                $id_produto_mais_vendidos = $res[$i]['id'];

                                if ($promocao_produto_mais_vendidos == 'Sim') {
                                    $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto_mais_vendidos'");
                                    $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto_mais_vendidos = $resP[0]['valor'];
                                    $valor_produto_mais_vendidos = number_format($valor_produto_mais_vendidos, 2, ',', '.');
                                } else {
                                    $valor_produto_mais_vendidos = number_format($valor_produto_mais_vendidos, 2, ',', '.');
                                }


                            ?>

                                <a href="produto-<?php echo $nome_url_produto_mais_vendidos ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem_produto_mais_vendidos ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_produto_mais_vendidos ?></h6>
                                        <span>R$ <?php echo $valor_produto_mais_vendidos ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by vendas desc limit 3, 3"); //limite de 3, a partir do 3
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_produto_mais_vendidos = $res[$i]['nome_url'];
                                $nome_produto_mais_vendidos = $res[$i]['nome'];
                                $valor_produto_mais_vendidos = $res[$i]['valor'];
                                $imagem_produto_mais_vendidos = $res[$i]['imagem'];

                                $promocao_produto_mais_vendidos = $res[$i]['promocao'];
                                $id_produto_mais_vendidos = $res[$i]['id'];

                                if ($promocao_produto_mais_vendidos == 'Sim') {
                                    $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto_mais_vendidos'");
                                    $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto_mais_vendidos = $resP[0]['valor'];
                                    $valor_produto_mais_vendidos = number_format($valor_produto_mais_vendidos, 2, ',', '.');
                                } else {
                                    $valor_produto_mais_vendidos = number_format($valor_produto_mais_vendidos, 2, ',', '.');
                                }

                            ?>

                                <a href="produto-<?php echo $nome_url_produto_mais_vendidos ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem_produto_mais_vendidos ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_produto_mais_vendidos ?></h6>
                                        <span>R$ <?php echo $valor_produto_mais_vendidos ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM produtos WHERE ativo = 'Sim' order by vendas desc limit 6, 3"); //limite de 3, a partir do 6
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_produto_mais_vendidos = $res[$i]['nome_url'];
                                $nome_produto_mais_vendidos = $res[$i]['nome'];
                                $valor_produto_mais_vendidos = $res[$i]['valor'];
                                $imagem_produto_mais_vendidos = $res[$i]['imagem'];

                                $promocao_produto_mais_vendidos = $res[$i]['promocao'];
                                $id_produto_mais_vendidos = $res[$i]['id'];

                                if ($promocao_produto_mais_vendidos == 'Sim') {
                                    $queryP = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto_mais_vendidos'");
                                    $resP = $queryP->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto_mais_vendidos = $resP[0]['valor'];
                                    $valor_produto_mais_vendidos = number_format($valor_produto_mais_vendidos, 2, ',', '.');
                                } else {
                                    $valor_produto_mais_vendidos = number_format($valor_produto_mais_vendidos, 2, ',', '.');
                                }

                            ?>

                                <a href="produto-<?php echo $nome_url_produto_mais_vendidos ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem_produto_mais_vendidos ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_produto_mais_vendidos ?></h6>
                                        <span>R$ <?php echo $valor_produto_mais_vendidos ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Combos Promocionais</h4>

                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM combos WHERE ativo = 'Sim' order by id desc limit 3");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_combo = $res[$i]['nome_url'];
                                $nome_combo = $res[$i]['nome'];
                                $valor_combo = $res[$i]['valor'];
                                $imagem_combo = $res[$i]['imagem'];

                                $valor_combo = number_format($valor_combo, 2, ',', '.');

                            ?>

                                <a href="produto-<?php echo $nome_url_combo ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/combos/<?php echo $imagem_combo ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_combo ?></h6>
                                        <span>R$ <?php echo $valor_combo ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM combos WHERE ativo = 'Sim' order by id desc limit 3, 3"); //limite de 3, a partir do 3
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_combo = $res[$i]['nome_url'];
                                $nome_combo = $res[$i]['nome'];
                                $valor_combo = $res[$i]['valor'];
                                $imagem_combo = $res[$i]['imagem'];

                                $valor_combo = number_format($valor_combo, 2, ',', '.');

                            ?>

                                <a href="produto-<?php echo $nome_url_combo ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/combos/<?php echo $imagem_combo ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_url_combo ?></h6>
                                        <span>R$ <?php echo $valor_combo ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT * FROM combos WHERE ativo = 'Sim' order by id desc limit 6, 3"); //limite de 3, a partir do 6
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $nome_url_combo = $res[$i]['nome_url'];
                                $nome_combo = $res[$i]['nome'];
                                $valor_combo = $res[$i]['valor'];
                                $imagem_combo = $res[$i]['imagem'];

                                $valor_combo = number_format($valor_combo, 2, ',', '.');

                            ?>

                                <a href="produto-<?php echo $nome_url_combo ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/combos/<?php echo $imagem_combo ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome_combo ?></h6>
                                        <span>R$ <?php echo $valor_combo ?></span>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="img/blog/blog-1.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="img/blog/blog-2.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="img/blog/blog-3.jpg" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Visit the clean farm in the US</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
Blog Section End -->

<?php

require_once('rodape.php');

?>