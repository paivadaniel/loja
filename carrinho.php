<?php

require_once('cabecalho.php');
require_once('cabecalho-busca.php');

?>
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad bg-light">
    <div class="container">
        <div class="row">

        <input type="hidden" id="txtquantidade"> <!-- esse input estava inserido em modal-carrinho.php, e como parte do código desta página foi copiado de modal-carrinho.php, se não copiar esse input dá problema falando que ele não está definido, porém, não lembro para que ele serve, já que em modal_carrinho.php para contar os produtos do carrinho foi dado um id="total_itens" em um span -->

            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Produtos</th>
                                <th>Características</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $res = $pdo->query("SELECT * from carrinho where id_usuario = '$id_usuario' and id_venda = 0 order by id asc"); //id_venda = 0 pois a venda ainda não ocorreu
                            $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                            $linhas = count($dados);

                            if ($linhas == 0) {
                                $linhas = 0;
                                $total = 0;
                            }

                            $total;

                            for ($i = 0; $i < count($dados); $i++) {
                                foreach ($dados[$i] as $key => $value) {
                                }

                                $id_produto = $dados[$i]['id_produto'];
                                $quantidade = $dados[$i]['quantidade'];
                                $id_carrinho = $dados[$i]['id'];
                                $combo = $dados[$i]['combo'];

                                if ($combo == 'Sim') { //para combos
                                    $res_p = $pdo->query("SELECT * from combos where id = '$id_produto' ");
                                    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto = $dados_p[0]['valor'];

                                    $pasta = 'combos';
                                } else { //para produtos
                                    $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
                                    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);

                                    $valor_produto = $dados_p[0]['valor'];
                                    $promocao_produto = @$dados_p[0]['promocao'];

                                    if ($promocao_produto == 'Sim') { //para produtos em promoção
                                        $res_p2 = $pdo->query("SELECT * from promocoes where id_produto = '$id_produto' ");
                                        $dados_p2 = $res_p2->fetchAll(PDO::FETCH_ASSOC);
                                        $valor_produto = $dados_p2[0]['valor'];
                                    }

                                    $pasta = 'produtos';
                                }

                                $nome_produto = $dados_p[0]['nome'];
                                $imagem_produto = $dados_p[0]['imagem'];

                                $total_item = $valor_produto * $quantidade;
                                @$total = @$total + $total_item;

                                $valor_produto = number_format($valor_produto, 2, ',', '.');
                                $total_item = number_format($total_item, 2, ',', '.');

                            ?>

                                <tr>

                                    <td class="shoping__cart__item">

                                        <img src="img/<?php echo $pasta ?>/<?php echo $imagem_produto ?>" alt="" width="60">
                                        <h5> <?php echo $nome_produto ?>
                                            <a href="#" title="Incluir/Editar Características" class="ml-1" onclick="addCarac('<?php echo $id_produto ?>' , '<?php echo $id_carrinho ?>')"><i class="fa fa-edit text-info"></i></a> <!-- id_produto e id_carrinho como são inteiros, poderiam ser passados sem aspas, que é apenas para string, porém, optei por passar com aspas -->
                                        </h5>
                                    </td>

                                    <td width="150" align="left" class="shoping__cart__item">

                                        <span class="mt-4 d-none d-sm-none d-md-block" align="center" id="listar-carac-itens2">


                                            <?php
                                            $query2 = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id_carrinho'");
                                            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                                            for ($i2 = 0; $i2 < count($res2); $i2++) {
                                                foreach ($res2[$i2] as $key => $value) {
                                                }

                                            ?>
                                                <span class="mr-2"><i class="fa fa-check text-info"></i> <?php echo $res2[$i2]['nome_carac'] ?>: <?php echo $res2[$i2]['nome_item'] ?></span>

                                            <?php

                                            }

                                            ?>
                                        </span>

                                    </td>




                                    <td class="shoping__cart__price">
                                        R$ <?php echo $total_item ?>
                                    </td>

                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">

                                                <input onchange="editarCarrinho('<?php echo $id_carrinho ?>')" type="text" data-zeros="true" value="<?php echo $quantidade ?>" min="1" max="1000" id="quantidade">

                                            </div>
                                        </div>
                                    </td>

                                    <td class="shoping__cart__item__close">
                                        <a onclick="deletarCarrinho('<?php echo $id_carrinho ?>')" id="btn-deletar" href="" class="ml-2" title="Remover Item do Carrinho">
                                            <span class="icon_close"></span>
                                        </a>
                                    </td>

                                </tr>

                            <?php
                            }

                            $total = number_format($total, 2, ',', '.');

                            ?>

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

                    <li>Total <span id="valor_total"></span></li>
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


<script type="text/javascript">
  var itens = "<?= $linhas ?>";
  var total = "<?= $total ?>";

  $("#total_itens").text(itens);
  $("#valor_total").text(total);
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