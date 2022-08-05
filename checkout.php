<?php

require_once('cabecalho.php');
require_once('cabecalho-busca.php');

?>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Detalhes de Pagamento</h4>
            <form action="#">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nome<span>*</span></p>
                                    <input type="text" name="nome" id="nome">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>CPF<span>*</span></p>
                                    <input type="text" name="cpf" id="cpf">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Telefone<span>*</span></p>
                                    <input type="text" name="telefone" id="telefone">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Logradouro<span>*</span></p>
                                    <input type="text" name="logradouro" id="logradouro">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="checkout__input">
                                    <p>Número<span>*</span></p>
                                    <input type="text" name="numero" id="numero">
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Bairro<span>*</span></p>
                                    <input type="text" name="bairro" id="bairro">
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Complemento<span>*</span></p>
                                    <input type="text" name="complemento" id="complemento">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Cidade<span>*</span></p>
                                    <input type="text" name="cidade" id="cidade">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="checkout__input">
                                    <p>Estado<span>*</span></p>
                                    <input type="text" name="estado" id="estado">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="checkout__input">
                                    <p>CEP<span>*</span></p>
                                    <input type="text" name="cep" id="cep">
                                </div>
                            </div>


                        </div>

                        <div class="checkout__input">
                            <p>Notas da Compra<span>*</span></p>
                            <input type="text" placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Sua Compra</h4>
                            <div class="checkout__order__products">Produtos <span>Total</span></div>
                            <ul>
                                <li>Vegetable’s Package <span>$75.99</span></li>
                                <li>Fresh Vegetable <span>$151.99</span></li>
                                <li>Organic Bananas <span>$53.99</span></li>
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
                            <div class="checkout__order__total">Total <span>$750.99</span></div>


                            <button type="submit" class="site-btn" data-toggle="modal" data-target="#modalPagamento">FINALIZAR COMPRA</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<!-- Modal Pagamento -->
<div class="modal fade" id="modalPagamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pagamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php

require_once('rodape.php');

?>