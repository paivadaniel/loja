<!-- Modal Pagamento -->

<div class="modal fade" id="modal-pgto" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                /*
                //não deu para usar o código abaixo para recuperar o valor da última venda, pois quando abre essa modal a última venda ainda não está criada na tabela, então ele recupera o total da penúltima venda

                $query = $pdo->query("SELECT * FROM vendas where id_usuario = '$id_usuario' order by id desc limit 1"); //identifica qual foi a última venda para aquele usuário, não há como ele estar fazendo o checkout de uma penúltima ou antepenúltima compra
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $vlr_total = $res[0]['total']; //pega o total da venda

              */

                $query = $pdo->query("SELECT * FROM vendas where id = '$id_venda'");
                //estava dando um order by nome desc acima, e como na tabela vendas não tem o campo nome, a modal não estava abrindo, e não era mostrado onde estava o problema, perdi bastante tempo tentando encontrar
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $vlr_venda = $res[0]['total'];
                $vlr_venda = number_format($vlr_venda, 2, ',', '.');

                ?>

                <h5 class="modal-title"><small>Compra de Produtos - Total: R$ <?php echo $vlr_venda ?></small></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-1">

                        <a title="Pagar com PagSeguro" target="_blank" href="pagamentos/pagseguro/checkout.php?codigo=<?php echo $id_venda ?>"><img src="img/pagamentos/pagseguro.png" width="200"></a>
                        <span class="text-muted"><i><small><br>Cartão de Crédito/Débito <br>
                                    Boleto pode demorar até 24 Horas.</small></i></span>

                    </div>


                    <div class="col-md-4 col-sm-12 mb-1">
                        <a title="Paypal - Acesso Imediato ao Curso" href="pagamentos/paypal/checkout.php?id_venda=<?php echo $id_venda ?>" target="_blank"><img src="img/pagamentos/paypal.png" width="200"></a>
                        <span class="text-muted"><i><small><br>Cartão de Crédito <br>
                                    Pagamentos no Estrangeiro.</small></i></span>
                    </div>



                    <!-- testes do mercado pago só funcionarão com o projeto hospedado
                       
                    -->
                    <div class="col-md-4 col-sm-12 mb-1">

                        <?php
                        //botao do mercado pago
                        //ERRO_ALGORITMO: só está abrindo a modal pagamento se não comentar o código do mercadopago quando a compra não tem que digitar o CEP para cálculo do frete, ou seja, quando o frete é fixo abre, isso deve ser por conta do problema para mostrar o valor do frete

                        $nome_produto = $nome_loja;
                        $btn = $pagar->PagarMP($id_venda, $nome_produto, (float)$vlr_venda, $url_loja);
                        echo $btn;
                        ?>

                        <span class="text-muted"><i><small><br>Cartão de Crédito ou Boleto <br>
                                    Boleto pode demorar até 24 Horas.</small></i></span>
                    </div>


                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <p align="center">Depósitos ou Transferências </p>
                        <span class="text-muted"><small> Precisamos que nos envie o comprovante para a liberação do curso, se for transferência será liberado de Imediato, caso seja depósito ou Doc precisa aguardar o pagamento ser compensado, geralmente de 12 a 24 horas, pode nos mandar o comprovante no WhatsApp <a class="text-muted" href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_loja_link ?>" alt="<?php echo $whatsapp_loja ?>" target="_blank"><i class="fa fa-whatsapp mr-1 text-success"></i><?php echo $whatsapp_loja ?></a> ou no email <?php echo $email_loja ?></span></small>

                        <a href="img/pagamentos/contas-grande.png" title="Clique para Ampliar" target="_blank">
                            <img src="img/pagamentos/contas.png" width="100%" class="mt-3">
                            <p align="center" class="text-danger"><i><small>Clique para Ampliar</small></i></p>
                        </a>

                        <small> Se já efetuou o pagamento <a title="Ir para o Painel" href="painel-cliente/index.php?pag=pedidos" class="text-success" target="_blank">Clique aqui</a> </small>

                    </div>
                </div>


            </div>

        </div>
    </div>
</div>

<?php

if (@$_GET["id_venda"] != null) {
    echo "<script>$('#modal-pgto').modal('show');</script>";
}

?>