<!--
    o cabeçalho foi dividido em dois pois ele é diferente na homepage e para as outras páginas
    na home, a hero section tem o banner principal e o mostrador das categorias está clicado, ou seja,
    as categorias estão à mostra, já nas outras páginas a hero section não tem o banner principal e
    para mostrar as categorias é necessário clicar em All Departaments
-->

<!-- Hero Section Begin -->

<?php

require_once('conexao.php');

?>

<section class="hero hero-normal">
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

                            <li><a href="categoria-<?php echo $nome_url_categoria ?>"><?php echo $nome_categoria ?></a></li>

                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="lista-produtos.php" method="GET">

                            <!-- diferente do form em lista-produtos.php, 
                            aqui tem um action que leva para lista-produtos.php -->
                            <!--
                                    <div class="hero__search__categories">
                                Produtos
                                    <span class="arrow_carrot-right"></span>
                                </div>
                                -->
                            <input type="text" name="txtBuscar" placeholder="O que você precisa?">
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
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->