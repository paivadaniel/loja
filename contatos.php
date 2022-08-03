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
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad bg-light">
    <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span><i class="fa fa-phone"></i></span>
                        <h4>Telefone</h4>
                        <p><?php echo $tel_loja ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_whatsapp">
                            <a target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_link ?>" title="<?php echo $whatsapp ?>"><i class="fa fa-whatsapp text-info"></i></a>
                        </span>
                        <h4>Whatsapp</h4>
                        <p><?php echo $whatsapp_loja ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span><i class="fa fa-history"></i></span>
                        <h4>Horário Atendimento</h4>
                        <p>09:00 ás 19:00 </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span><i class="fa fa-envelope"></i></span>
                        <h4>Email</h4>
                        <p><?php echo $email_loja ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin 
    mod01 aula25 02:50
    
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>New York</h4>
                <ul>
                    <li>Phone: +12-345-6789</li>
                    <li>Add: 16 Creek Ave. Farmingdale, NY</li>
                </ul>
            </div>
        </div>
    </div>
    Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Fale Conosco</h2>
                    </div>
                </div>
            </div>
            <form id="form-contato">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <input type="text" name="nome" id="nome" placeholder="Nome" required>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <input type="text" name="telefone" id="telefone" placeholder="Telefone" required>
                    </div>

                    <div class="col-lg-12 text-center">
                        <textarea name="mensagem" id="mensagem" placeholder="Mensagem"></textarea>
                        <button type="submit" name="btn-contato" id="btn-contato" class="site-btn">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

    <?php

require_once('rodape.php');

?>
