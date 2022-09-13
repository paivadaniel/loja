<!-- Modal Carrinho -->

<div class="modal fade" id="modal-carrinho" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="overflow-y:initial !important">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Carrinho:<span id="total_itens" class="ml-1"></span> Produto(s)</h5>
                <input type="hidden" id="txtquantidade">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-carrinho" method="POST">
                <div class="modal-body" style="height:500px; overflow-y:auto;">
                    <!-- height e overflow-y:auto se colocar na modal-content, vai mudar a forma como a barra de rolagem é disposta -->
                    <?php
                    if (@$_SESSION['nivel_usuario'] != 'Cliente') {
                        echo "Faça login como cliente para adicionar produtos ao carrinho! Clique <a href='sistema' class='text-info'>aqui</a> para logar.";
                        //exit(); //faz sair da modal
                    } else {
                        echo "<div id='listar-carrinho'></div>";
                    }

                    ?>



                    <small>
                        <div align="center" id="mensagem_carrinho">

                        </div>
                    </small>


                </div>


                <div class="row p-3">
                    <div class="col-md-6">
                        <b>Total: </b>R$<span id="valor_total" class="ml-1"></span>
                    </div>

                    <div align="right" class="col-md-6 mb-4">
                        <button type="button" id="btn-comprar" class="primary-btn bg-secondary btn-sm" data-dismiss="modal">Comprar Mais</button>
                        <a href="" onclick="finalizarPedido()" name="btn-finalizar" id="btn-finalizar" class="primary-btn bg-info btn-sm">Finalizar</a> <!-- btn-sm deixa o botão small, não funcionou btn-small -->
                    </div>

                </div>


                <div class="modal-footer">



                </div>
            </form>
        </div>
    </div>
</div>


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


<!--AJAX PARA INSERÇÃO DOS DADOS VINDO DE UMA FUNÇÃO -->
<script>
    function carrinhoModal(id_produto, combo) {

        event.preventDefault();

        $.ajax({

            url: "carrinho/inserir-carrinho.php",
            method: "post",
            data: {
                id_produto,
                combo
            },
            dataType: "text",
            success: function(mensagem) {

                $('#mensagem_carrinho').removeClass()

                if (mensagem == 'Produto Inserido no Carrinho!') {
                    atualizarCarrinho();
                    $("#modal-carrinho").modal("show");
                    //$('#mensagem_carrinho').text(mensagem)

                } else {
                    $("#modal-carrinho").modal("show");
                    $('#mensagem_carrinho').text(mensagem)


                }


            },

        })
    }
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



<script type="text/javascript">
    function finalizarPedido() {

        event.preventDefault();

        $.ajax({

            url: "carrinho/verificar-carac.php",
            method: "post",
            data: {},
            dataType: "text",
            success: function(result) {

                if (result == 'Selecione as Características dos Produtos!') {

                    $('#mensagem_carrinho').addClass('text-danger')
                    $('#mensagem_carrinho').text(result);

                } else {
                    //$('#mensagem_carrinho').text(result);

                    window.location = 'checkout.php';
                }

                //$('#mensagem_caracteristicas').text(mensagem)

            },

        })


    }
</script>