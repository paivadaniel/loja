<?php

require_once('cabecalho.php');
require_once('cabecalho-busca.php');

?>
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Produtos</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="img/cart/cart-1.jpg" alt="">
                                    <h5>Vegetable’s Package</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    $55.00
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $110.00
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="img/cart/cart-2.jpg" alt="">
                                    <h5>Fresh Garden Vegetable</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    $39.00
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $39.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="img/cart/cart-3.jpg" alt="">
                                    <h5>Organic Bananas</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    $69.00
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $69.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">ATUALIZAR COMPRA</a>
                    <a href="lista-produtos.php" class="primary-btn cart-btn cart-btn-right bg-primary text-light">
                    CONTINUE COMPRANDO</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Cupom de Desconto</h5>
                        <form action="#">
                            <input type="text" placeholder="Digite o código do cupom">
                            <button type="submit" class="site-btn">APLICAR CUPOM</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Totais</h5>
                    <ul>
                        <li>Subtotal <span>R$454.98</span></li>
                        <li>Total <span>R$454.98</span></li>
                    </ul>
                    <a href="checkout.php" class="primary-btn">CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<?php

require_once('rodape.php');

?>