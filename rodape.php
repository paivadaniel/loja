    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo-azul-pequena.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Endereço: <?php echo $endereco_loja ?></li>
                            <li>Telefone: <?php echo $tel_loja ?></li>
                            <li>Email: <?php echo $email_loja ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Links</h6>
                        <ul>
                            <li><a href="sobre.php">Sobre</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="categorias.php">Categorias</a></li>
                            <li><a href="lista-produtos.php">Produtos</a></li>
                            <li><a href="carrinho.php">Carrinho</a></li>
                            <li><a href="contatos.php">Contato</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Cadastre-se em Nossa Lista de Emails</h6>
                        <p>Fique informado sobre nossos últimos lançamentos e promoções!</p>
                        <form action="#">
                            <input type="email" placeholder="Digite seu email" required>
                            <button type="submit" class="site-btn">Cadastrar</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#" target="_blank" title="Acessar nosso Facebook"><i class="fa fa-facebook"></i></a>
                            <!-- <a href="#"><i class="fa fa-twitter"></i></a> -->
                            <a href="#" target="_blank" title="Acessar nosso Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_loja_link ?>" title="Fale Conosco no Whatsapp"><i class="fa fa-whatsapp"></i></a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> Todos os direitos reservados | Esse template foi feito com <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://rapidin.shop" target="_blank">Rapidin</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


    <!-- script mascara.js necessita do jquery para funcionar, e portanto, o jquery deve vir primeiro que o mascara.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="js/mascara.js"></script>


    </body>

    </html>