<?php
require_once('cabecalho.php');
require_once('cabecalho-busca.php');

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
                    <div class="sidebar__item">
                        <h4>Preço</h4>
                        <!-- price-range está em js/main.js -->
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <form action="lista-produtos.php" method="post">

                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                        <a type="submit" class="text-dark">
                                            <i class="fa fa-search ml-2"></i>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Cores</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Tamanhos Mais Vendidos</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>

-->
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Lançamentos</h4>

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
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Promoções</h2> <a href="promocoes.php"> <span class="text-muted ml-3">Ver todas</span> </a>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/bota.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="#">Bota Masculina</a></h5>
                                        <div class="product__item__price">R$30,00 <span>R$36,00</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/bota.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="#">Bota Masculina</a></h5>
                                        <div class="product__item__price">R$30,00 <span>R$36,00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/bota.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="#">Bota Masculina</a></h5>
                                        <div class="product__item__price">R$30,00 <span>R$36,00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/bota.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="#">Bota Masculina</a></h5>
                                        <div class="product__item__price">R$30,00 <span>R$36,00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/bota.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="#">Bota Masculina</a></h5>
                                        <div class="product__item__price">R$30,00 <span>R$36,00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/bota.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="#">Bota Masculina</a></h5>
                                        <div class="product__item__price">R$30,00 <span>R$36,00</span></div>
                                    </div>
                                </div>
                            </div>

                            >
                        </div>
                    </div>
                </div>

                <div class="section-title product__discount__title">
                    <h2>Mais Vendidos</h2>
                    <a href="lista-produtos.php"> <span class="text-muted ml-3">Ver todos</span> </a>
                </div>


                <!--
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>16</span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>

-->
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>






                <div class="section-title product__discount__title">
                    <h2>Combos Mais Vendidos</h2>
                    <a href="combos.php"> <span class="text-muted ml-3">Ver todos</span> </a>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/produtos/tenis-masculino.jpg">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <a href="produto.php">
                                    <h6>Tênis masculino</h6>
                                    <h5>R$130,0</h5>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>



                <!--
                <div class="product__pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>

                -->
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php
require_once('rodape.php')
?>