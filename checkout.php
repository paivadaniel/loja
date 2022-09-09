<?php

require_once('cabecalho.php');
require_once('cabecalho-busca.php');
require_once('conexao.php');

//includes para o mercado pago
include_once("pagamentos/mercadopago/lib/mercadopago.php");
include_once("pagamentos/mercadopago/PagamentoMP.php");
$pagar = new PagamentoMP; //instância (inicialização) da classe do Mercado Pago, já que essas APIs trabalham com orientação à objetos

@session_start();

$id_usuario = @$_SESSION['id_usuario'];

if ($id_usuario == null) { //se não tiver logado, envia para a página de login. optei por não utilizar $_SESSION['nivel_usuario'] != 'Cliente' para essa verificação, ou seja, mesmo admin pode acessar o checkout.php, não apenas clientes
    echo "<script>window.location='sistema'</script>";
    exit();
}

$total = 0;
$total_peso = 0;

$id_venda = @$_GET['id_venda'];
$nome_usuario = @$_SESSION['nome_usuario'];
$email_usuario = @$_SESSION['email_usuario'];

//é necessário buscar o cpf no banco de dados, não na variável de sessão, pois se ele alterar o cpf no checkout, a variável de sessão do cpf não altera, por isso comentamos a linha abaixo e pegamos o cpf do banco de dados
//$cpf_usuario = @$_SESSION['cpf_usuario'];

$query = $pdo->query("SELECT * from usuarios where id = '$id_usuario'"); //id_venda = 0 pois a venda ainda não ocorreu
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cpf_usuario = $res[0]['cpf'];

$query = $pdo->query("SELECT * from clientes where cpf = '$cpf_usuario'"); //id_venda = 0 pois a venda ainda não ocorreu
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$telefone = $res[0]['telefone'];
$logradouro = $res[0]['logradouro'];
$numero = $res[0]['numero'];
$bairro = $res[0]['bairro'];
$complemento = $res[0]['complemento'];
$cep = $res[0]['cep'];
$cidade = $res[0]['cidade'];
$estado = $res[0]['estado'];

?>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form bg-light pl-4 pt-4">
            <h4>Detalhes de Pagamento</h4>
            <form method="post" id="form-principal">
                <!-- temos 2 forms dentro do form-principal, são eles: form-cupom e form-correios --->
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nome<span>*</span></p>
                                    <input type="text" name="nome" id="nome" value="<?php echo @$nome_usuario ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>CPF<span>*</span></p>
                                    <input type="text" name="cpf" id="cpf" value="<?php echo @$cpf_usuario ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="email" id="email" value="<?php echo @$email_usuario ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Telefone<span>*</span></p>
                                    <input type="text" name="telefone" id="telefone" value="<?php echo @$telefone ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Logradouro<span>*</span></p>
                                    <input type="text" name="logradouro" id="logradouro" value="<?php echo @$logradouro ?>">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="checkout__input">
                                    <p>Número<span>*</span></p>
                                    <input type="text" name="numero" id="numero" value="<?php echo @$numero ?>">
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Bairro<span>*</span></p>
                                    <input type="text" name="bairro" id="bairro" value="<?php echo @$bairro ?>">
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-lg-3">
                                <div class="checkout__input">
                                    <p>Complemento<span>*</span></p>
                                    <input type="text" name="complemento" id="complemento" value="<?php echo @$complemento ?>">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Cidade<span>*</span></p>
                                    <input type="text" name="cidade" id="cidade" value="<?php echo @$cidade ?>">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="checkout__input">
                                    <p>Estado<span>*</span></p>
                                    <select name="estado" id="estado">

                                        <option value="AC" <?php if (@$estado == 'AC') { ?> selected <?php } ?>>AC</option>
                                        <option value="AL" <?php if (@$estado == 'AL') { ?> selected <?php } ?>>AL</option>
                                        <option value="AP" <?php if (@$estado == 'AP') { ?> selected <?php } ?>>AP</option>
                                        <option value="AM" <?php if (@$estado == 'AM') { ?> selected <?php } ?>>AM</option>
                                        <option value="BA" <?php if (@$estado == 'BA') { ?> selected <?php } ?>>BA</option>
                                        <option value="CE" <?php if (@$estado == 'CE') { ?> selected <?php } ?>>CE</option>
                                        <option value="DF" <?php if (@$estado == 'DF') { ?> selected <?php } ?>>DF</option>
                                        <option value="ES" <?php if (@$estado == 'ES') { ?> selected <?php } ?>>ES</option>
                                        <option value="GO" <?php if (@$estado == 'GO') { ?> selected <?php } ?>>GO</option>
                                        <option value="MA" <?php if (@$estado == 'MA') { ?> selected <?php } ?>>MA</option>
                                        <option value="MT" <?php if (@$estado == 'MT') { ?> selected <?php } ?>>MT</option>
                                        <option value="MS" <?php if (@$estado == 'MS') { ?> selected <?php } ?>>MS</option>
                                        <option value="MG" <?php if (@$estado == 'MG') { ?> selected <?php } ?>>MG</option>
                                        <option value="PA" <?php if (@$estado == 'PA') { ?> selected <?php } ?>>PA</option>
                                        <option value="PB" <?php if (@$estado == 'PB') { ?> selected <?php } ?>>PB</option>
                                        <option value="PR" <?php if (@$estado == 'PR') { ?> selected <?php } ?>>PR</option>
                                        <option value="PE" <?php if (@$estado == 'PE') { ?> selected <?php } ?>>PE</option>
                                        <option value="PI" <?php if (@$estado == 'PI') { ?> selected <?php } ?>>PI</option>
                                        <option value="RJ" <?php if (@$estado == 'RJ') { ?> selected <?php } ?>>RJ</option>
                                        <option value="RN" <?php if (@$estado == 'RN') { ?> selected <?php } ?>>RN</option>
                                        <option value="RS" <?php if (@$estado == 'RS') { ?> selected <?php } ?>>RS</option>
                                        <option value="RO" <?php if (@$estado == 'RO') { ?> selected <?php } ?>>RO</option>
                                        <option value="RR" <?php if (@$estado == 'RR') { ?> selected <?php } ?>>RR</option>
                                        <option value="SC" <?php if (@$estado == 'SC') { ?> selected <?php } ?>>SC</option>
                                        <option value="SP" <?php if (@$estado == 'SP') { ?> selected <?php } ?>>SP</option>
                                        <option value="SE" <?php if (@$estado == 'SE') { ?> selected <?php } ?>>SE</option>
                                        <option value="TO" <?php if (@$estado == 'TO') { ?> selected <?php } ?>>TO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="checkout__input">
                                    <p>CEP<span>*</span></p>
                                    <input type="text" name="cep" id="cep" value="<?php echo @$cep ?>">
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="checkout__input">
                                    <label for="comentario">Notas da Compra<span>*</span></label>

                                    <input type="text" style="height:100px" class="form-control" maxlength="1000" id="comentario" name="comentario" placeholder="Notas sobre sua compra, por exemplo, caso não tiver ninguém em casa deixar com o vizinho do apartamento 12.">

                                </div>
                            </div>
                        </div>

                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Cupom de Desconto</h5>
                                <form method="post" id="form-cupom">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="checkout__input">

                                                <input type="text" placeholder="Entre com o código do seu cupom" name="codigo_cupom" id="codigo_cupom">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout__input">

                                                <button type="submit" class="site-btn bg-info" id="btn-cupom">APLICAR CUPOM</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>

                                <div id="mensagem-cupom"></div>
                            </div>
                        </div>

                    </div>




                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Sua Compra</h4>
                            <div class="checkout__order__products">Produtos <span>Total</span></div>
                            <ul>

                                <?php

                                $query = $pdo->query("SELECT * from carrinho where id_usuario = '$id_usuario' and id_venda = 0 order by id asc"); //id_venda = 0 pois a venda ainda não ocorreu
                                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                                for ($i = 0; $i < count($res); $i++) {
                                    foreach ($res[$i] as $key => $value) {
                                    }

                                    $combo = $res[$i]['combo'];
                                    $quantidade = $dados[$i]['quantidade'];

                                    $id_produto = $res[$i]['id_produto'];

                                    if ($combo == 'Não') {
                                        $tabela = 'produtos';
                                    } else if ($combo == 'Sim') {
                                        $tabela = 'combos';
                                    }

                                    $query2 = $pdo->query("SELECT * from $tabela where id = '$id_produto'");
                                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                                    $nome_produto = $res2[0]['nome'];

                                    $valor_produto = $res2[0]['valor'];
                                    $tipo_envio = $res2[0]['tipo_envio'];

                                    $valor_frete = $res2[0]['valor_frete']; //apenas para frete fixo

                                    $query_e = $pdo->query("SELECT * from tipo_envios where id = '$tipo_envio'");
                                    $res_e = $query_e->fetchAll(PDO::FETCH_ASSOC);
                                    $envio = $res_e[0]['tipo'];

                                    if ($envio == 'correios') { //se qualquer um dos produtos do carrinho tiver tipo_envio = Correios
                                        $frete_correios = 'Sim';
                                        $peso_produto = $res2[0]['peso'];

                                        $total_peso += $peso_produto;
                                        $existe_frete = 'Sim'; //se existe_frete for Sim e valor_frete (input com id definido ao longo do código, não a variável acima, que é para frete fixo) for zero, há algo errado
                                    }

                                    if ($combo == 'Não') {

                                        $promocao_produto = $res2[0]['promocao'];

                                        if ($promocao_produto == 'Sim') { //para produtos em promoção
                                            $query_p = $pdo->query("SELECT * from promocoes where id_produto = '$id_produto' ");
                                            $res_p = $query_p->fetchAll(PDO::FETCH_ASSOC);
                                            $valor_produto = $res_p[0]['valor'];
                                        }
                                    }

                                    $total_item = $valor_produto * $quantidade;
                                    @$total = @$total + $total_item;

                                    if ($tipo_envio == '2') { //verificação igual é if envio == 'fixo', pois valor_frete é maior que 0 apenas para frete fixo, ou também if ($valor_frete > 0)
                                        $total += $valor_frete;
                                    }

                                    $valor_produto = number_format($valor_produto, 2, ',', '.');
                                    $total_item = number_format($total_item, 2, ',', '.');

                                ?>

                                    <li><?php echo $nome_produto ?> <span>R$ <?php echo $total_item ?></span></li>

                                    <?php if ($tipo_envio == '2') { //apenas para frete fixo 
                                    ?>

                                        <p align="right" class="text-danger"><small>Frete fixo: <?php echo $valor_frete ?></small></p>

                                    <?php } ?>

                                <?php
                                }

                                $total = number_format($total, 2, ',', '.');

                                ?>

                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>R$ <?php echo $total ?></span></div>

                            <?php

                            if (@$frete_correios == 'Sim') {
                            ?>

                                <div class="checkout__order__total">Frete <br>

                                    <form method="post" id="form-correios">
                                        <input type="hidden" id="total_peso" name="total_peso" value="<?php echo $total_peso ?>">
                                        <input type="hidden" id="nome_produto" name="nome_produto" value="<?php echo $nome_produto ?>">


                                        <div class="row mb-4">

                                            <div class="col-md-7">
                                                <div class="checkout__input">

                                                    <input type="text" name="cep2" id="cep2" placeholder="Digite o CEP">
                                                </div>

                                            </div>
                                            <div class="col-md-5">
                                                <div class="checkout__input">
                                                    <select name="codigo_servico_correios" id="codigo_servico_correios">
                                                        <option value="0">Envio</option>
                                                        <option value="40010">Sedex</option>
                                                        <option value="41106">PAC</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div id="listar-frete"></div>
                                        </div>
                                    </form>

                                </div>

                            <?php
                            }
                            ?>

                            <div class="checkout__order__total">Total <span id="total_final"></span></div>

                            <!-- o input a seguir é para armazenar o valor do frete e substituir por um anterior caso houver, pois da forma implementada, toda vez que inserimos um CEP e escolhemos um frete, ele soma o valor do frete ao total, ou seja, adiciona vários fretes na compra caso pesquisemos o valor do frete para mais de um CEP
                            começa com valor 0
                            -->
                            <input type="hidden" id="valor_frete" name="valor_frete" value="0">
                            <!-- valor_frete tem que ser maior que 0 caso exista o frete -->
                            <input type="hidden" id="existe_frete" name="existe_frete" value="<?php echo $existe_frete ?>">
                            <input type="hidden" id="total_compra" name="total_compra" value="<?php echo $total ?>">
                            <input type="hidden" id="antigoCpf" name="antigoCpf" value="<?php echo $cpf_usuario ?>">


                            <button type="submit" class="site-btn bg-success" id="btn-finalizar-compra">FINALIZAR COMPRA</button>

                            <div style="margin-top:15px" id="mensagem-finalizar-compra" align="center"></div>
                            </ </div>

                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php

require_once('rodape.php');

?>

<script type="text/javascript">
    $(document).ready(function() { //executa assim que a página carregar
        var total = "<?= $total ?>";
        var id_venda = "<?= $id_venda ?>";

        if (total == "0,00" && id_venda == "") {
            window.location = "produtos.php"
        }

        total = "R$ " + total;


        $('#total_final').text(total);
        $('#total_pgto').text(total) //total_pgto está na modal-pagamento, se não usar cupom nem fizer cálculo de frete, o total_pgto ainda assim tem que ser preenchido



    })
</script>

<script type="text/javascript">
    $('#btn-cupom').click(function(event) {
        event.preventDefault();

        var total = "<?= $total ?>"

        $.ajax({
            url: 'cupom/usar-cupom.php',
            method: 'post',
            data: $('form-cupom').serialize(),
            dataType: "text",
            success: function(msg) {

                if (msg.trim() === "Insira um valor para o cupom!" || msg.trim() === "Código de cupom inválido!") {

                    $('#mensagem-cupom').removeClass();
                    $('#mensagem-cupom').addClass('text-danger');
                    $('#mensagem-cupom').text(msg);

                    //limpar o campo do cupom
                    $('#codigo_cupom').val('');

                } else {

                    var novoTotal = total - msg; //msg é o desconto do cupom, que já vem com ponto ao invés de vírgula, não precisa de replace

                    //o cupom tem que ser subtraído do total_final (ou seja, com frete, não apenas do total dos produtos), por isso desconsideramos a variável total, que fazia a soma apenas dos produtos, e comentamos as linhas a seguir e utilizamos total_final
                    //substitui vírgula por ponto
                    //total = total.replace(",", ".")
                    //novoTotal = parseFloat(total) - parseFloat(msg);

                    totaL_final = $('#total_final').text()

                    totaL_final = totaL_final.replace(",", ".")
                    totaL_final = totaL_final.replace("R$", "") //tem que remover o cifrão para o resultado da subtração não dar NaN

                    //converte ambos para float para poder efetuar a subtração
                    novoTotal = parseFloat(total_final) - parseFloat(msg);

                    //toFixed(2) serve para exibir 2 casas decimais (ou seja, após a vírgula), porém, o meu mesmo sem toFixed(2) está mostrando as 2 casas decimais, portanto, não fez diferença
                    novoTotal = novoTotal.toFixed(2)

                    //substitui ponto por vírgula, tem que ser feito obrigatoriamente após o toFixed

                    $('#total_compra').val(novoTotal); //se usou cupom, total_compra recebe o total com o valor do cupom subtraído, tem que ser atribuído o valor antes de adicionar o cifrão (linha a seguir)

                    novoTotal = "R$ " + novoTotal.replace(".", ",")

                    $('#total_final').text(novoTotal);
                    $('#total_pgto').text(novoTotal) //total_pgto está na modal-pagamento

                    //substitui ponto por vírgula
                    msg = msg.replace(".", ",")

                    $('#mensagem-cupom').removeClass();
                    $('#mensagem-cupom').addClass('text-success');
                    $('#mensagem-cupom').text("Cupom utilizado no valor de R$ " + msg);

                }
            }
        })

    })
</script>


<script type="text/javascript">
    $('#codigo_servico_correios').change(function(event) {
        event.preventDefault();

        $.ajax({
            url: "correios/pegarDadosFrete.php",
            method: "post",
            data: $('#form-correios').serialize(),
            dataType: "html",
            success: function(result) {

                //pega o valor do frete e coloca na posição 1 de um array
                var array = result.split(" ")
                var total_frete = array[1]

                //se digitar vários CEPs, calcula vários fretes, para não somar os valores desses fretes ao total dos produtos, e somar apenas o último frete, tem que substrair a seguir o valor_frete_antigo
                valor_frete_antigo = $('#valor_frete').val()

                //substitui vírgula pelo ponto para somar com o total do frete com o total dos produtos
                total_frete = total_frete.replace(",", ".")
                totaL_final = $('#total_final').text()

                totaL_final = totaL_final.replace(",", ".")
                totaL_final = totaL_final.replace("R$", "")

                /*ERRO_ALGORITMO
                totaL_final = $('#total_final').text() está mostrando mensagem com span,
                para confirmar basta fazer
                console.log(total_final)
                por isso a soma abaixo de total_final com total_frete não está dando certo

                aqui o que estamos tentando fazer é somar frete com total de produtos e exibir no span com id=total_final
                */
                tot = parseFloat(total_final) + parseFloat(total_frete) - parseFloat(valor_frete_antigo)
                tot = tot.toFixed(2)

                $('#total_compra').val(tot); //pega dados do frete e atualiza o total_compra, tem que ser feito antes de colocar o cifrão (linha abaixo)

                tot = "R$ " + tot.replace(".", ",")
                console.log(tot)
                $('#total_final').text(tot)
                $('#total_pgto').text(tot) //total_pgto está na modal-pagamento

                $('#listar-frete').html(result)

                $('#valor_frete').val(total_frete)

                $('#mensagem-finalizar-compra').text("");


            },
        })


    })
</script>

<script type="text/javascript">
    $('#btn-finalizar-compra').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: "finalizar-compra.php",
            method: "post",
            data: $('#form-principal').serialize(),
            dataType: "html",
            /*
            success: function(msg) {

                //$('#modal-pgto').modal('show');

                if (msg.trim() === 'Editado com Sucesso!') {
                    $('#listar-frete').html('');
                    $('#mensagem-finalizar-compra').removeClass();
                    $('#mensagem-finalizar-compra').addClass('text-success');
                    $('#mensagem-finalizar-compra').text(msg);

                    window.location = "checkout.php?id_venda=" + msg;
                    //$('#modal-pgto').modal('show');


                } else { //Selecione um CEP válido, Preencha o Campo Nome, Preencha o Campo Logradouro etc.
                    $('#mensagem-finalizar-compra').removeClass();
                    $('#mensagem-finalizar-compra').addClass('text-danger');
                    $('#mensagem-finalizar-compra').text(msg);

                }
            }
            */

            success: function(msg) {
                console.log(msg);
                if (msg.trim() === 'Selecione um CEP válido!') {
                    $('#listar-frete').html('');
                    $('#mensagem-finalizar-compra').addClass('text-danger')
                    $('#mensagem-finalizar-compra').text(msg);
                } else if (msg.trim() === 'Preencha o Campo Logradouro!') {
                    $('#mensagem-finalizar-compra').addClass('text-danger')
                    $('#mensagem-finalizar-compra').text(msg);
                } else {
                    window.location = "checkout.php?id_venda=" + msg;

                }

            }

        })

    })
</script>

<?php

require_once('modal-pagamento.php');

?>