<?php

require_once('cabecalho.php');
require_once('cabecalho-busca.php');

?>

<!-- ERRO ALGORITMO
não está funcionando atualização automática do preço e nem a atualização do valor_total, que vem de listar-carrinho.php
-->
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad bg-light">
    <div class="container">
        <div class="row">

            <input type="hidden" id="txtquantidade"> <!-- esse input estava inserido em modal-carrinho.php, e como parte do código desta página foi copiado de modal-carrinho.php, se não copiar esse input dá problema falando que ele não está definido, porém, não lembro para que ele serve, já que em modal_carrinho.php para contar os produtos do carrinho foi dado um id="total_itens" em um span -->

            <div class="col-lg-12">
                <div id='listar-carrinho'>

                </div>
            </div>
        </div>

        <div class="row p-3">
                    <div class="col-md-6">
                        <b>Total: </b>R$<span id="valor_total" class="ml-1"></span>
                    </div>

                    <div align="right" class="col-md-6 mb-4">
                        <button type="button" id="btn-comprar" class="primary-btn bg-secondary btn-sm" data-dismiss="modal">Comprar Mais</button>
                        <button type="submit" name="btn-finalizar" id="btn-finalizar" class="primary-btn bg-info btn-sm">Finalizar</button> <!-- btn-sm deixa o botão small, não funcionou btn-small -->
                    </div>

                </div>
      
    </div>
</section>
<!-- Shoping Cart Section End -->



<?php

require_once('rodape.php');

?>

<!-- Modal Característica Carrinho -->

<div class="modal fade" id="modal-carac-carrinho" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Características do Produto</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-carrinho" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">

                            <div id='listar-caracteristicas'></div>
                        </div>
                        <div class="col-md-6">
                            <div id='listar-carac-itens'></div>
                        </div>
                    </div>








                </div>



                <div class="modal-footer">



                </div>
            </form>
        </div>
    </div>
</div>

<!--SCRIPT PARA ALTERAR O INPUT NUMBER -->
<script type="text/javascript">
    jQuery('<span class="dec qtybtn">-</span>').insertBefore('.pro-qty input');
    jQuery('<span class="inc qtybtn">+</span>').insertAfter('.pro-qty input');
    jQuery('.pro-qty').each(function() {
        var spinner = jQuery(this),
            input = spinner.find('input[type="text"]'),
            btnUp = spinner.find('.inc'),
            btnDown = spinner.find('.dec'),
            min = input.attr('min'),
            max = input.attr('max');

        btnUp.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            document.getElementById('txtquantidade').value = newVal;
            spinner.find("input").trigger("change");


        });

        btnDown.click(function() {

            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            document.getElementById('txtquantidade').value = newVal;
            spinner.find("input").trigger("change");



        });




    });
</script>



<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
    $(document).ready(function() { //executa assim que a página carregar

        atualizarCarrinho()
    })
</script>

<script>
    //atualizarCarrinho faz o mesmo que listar-carrinho.php, porém, listar-carrinho é exclusiva quando a página é carregada pela primeira vez
    //atualizar carrinho devolve a quantidade total de itens e o preço total deles
    function atualizarCarrinho() {
        $.ajax({
            url: "carrinho/listar-carrinho.php",
            method: "post",
            data: $('#frm').serialize(),
            dataType: "html",
            success: function(result) {
                $('#listar-carrinho').html(result)

            },
        })
    }
</script>

<script>
    function deletarCarrinho(id) {

        event.preventDefault();

        $.ajax({

            url: "carrinho/excluir-carrinho.php",
            method: "post",
            data: {
                id
            },
            dataType: "text",
            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem == 'Excluído com Sucesso!') {
                    atualizarCarrinho();
                    //$("#modal-carrinho").modal("show");

                } else {


                }

                $('#mensagem').text(mensagem)

            },

        })

    }
</script>

<script type="text/javascript">
    function editarCarrinho(id_carrinho) {

        var quantidade = document.getElementById('txtquantidade').value;
        event.preventDefault();

        $.ajax({

            url: "carrinho/editar-carrinho.php",
            method: "post",
            data: {
                id_carrinho,
                quantidade
            },
            dataType: "text",
            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem == 'Editado com Sucesso!') {
                    atualizarCarrinho();
                    //$("#modal-carrinho").modal("show");

                } else {


                }

                $('#mensagem').text(mensagem)

            },

        })


    }
</script>

<script type="text/javascript">
    function addCarac(id_produto, id_carrinho) {

        event.preventDefault();

        $.ajax({

            url: "carrinho/carac-produtos.php",
            method: "post",
            data: {
                id_produto,
                id_carrinho
            },
            dataType: "text",
            success: function(result) {

                $('#mensagem_caracteristicas').removeClass()
                $("#modal-carac-carrinho").modal("show");
                $('#listar-caracteristicas').html(result)
                if (result == 'Listado com Sucesso!') {
                    //atualizarCarrinho();

                    $("#modal-carac-carrinho").modal("show");

                } else {


                }

                //$('#mensagem_caracteristicas').text(mensagem)

            },

        })


    }
</script>

