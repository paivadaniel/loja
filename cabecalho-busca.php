<!--
    o cabeçalho foi dividido em dois pois ele é diferente na homepage e para as outras páginas
    na home, a hero section tem o banner principal e o mostrador das categorias está clicado, ou seja,
    as categorias estão à mostra, já nas outras páginas a hero section não tem o banner principal e
    para mostrar as categorias é necessário clicar em All Departaments
-->
      
   <!-- Hero Section Begin -->

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
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
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
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
