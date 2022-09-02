<!-- 
    
o form abaixo é percorrido por um for, portanto,
não havia como passar $id_carac nele,
já que a cada iteração do for, era jogado um $id_carac diferente

<input name='id_carac_carrinho' type='hidden' value='" . $id_carac . "'>

já aqui pode:

<input name='id_carrinho_carrinho' type='hidden' value='" . $id_carrinho . "'> 

pois id_carrinho não muda para um item de uma mesma compra

-->
<?php

require_once('../conexao.php');
@session_start();

$id_produto = $_POST['id_produto'];
$id_carrinho = $_POST['id_carrinho'];

$id_cliente = @$_SESSION['id_usuario'];


$query2 = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto' order by id desc");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($res2); $i++) {
    foreach ($res2[$i] as $key => $value) {
    }

    $id_carac = $res2[$i]['id_carac'];
    $id_carac_prod = $res2[$i]['id'];

    $query3 = $pdo->query("SELECT * from carac WHERE id = '$id_carac'");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    $nome_carac = $res3[0]['nome'];

    if ($nome_carac == 'Cor') {
        @$tem_cor = 'Sim';
    }



    echo "

<form id='form' method='post'>

<input name='id_carrinho_carrinho' type='hidden' value='" . $id_carrinho . "'> 
<div class='p-2'>
        <select class='form-control form-control-sm' name='" . $i . "' id='" . $i . "'>"; //name e id vai ficar cor, numeração, tamanho, ou seja, as características cadastradas na tabela carac do banco de dados


    echo "<option value='0' > Selecionar " . $nome_carac . "</option>"; //value é zero pois não seleciona nenhum valor, apenas Selecionar Tamanho, Selecionar Numeração, Selecionar Cor, ou seja, Selecionar + Nome da Características
    //mudou de 0 para vazio, pois 0 pode assumir valor no option abaixo, se $res4[$i2]['nome_item'] for 0

    $query4 = $pdo->query("SELECT * from carac_itens WHERE id_carac_prod = '$id_carac_prod'");
    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
    for ($i2 = 0; $i2 < count($res4); $i2++) {
        foreach ($res4[$i2] as $key => $value) {
        }



        echo "<option value='" . $res4[$i2]['id'] . "' >" . $res4[$i2]['nome_item'] . "</option>";
    }

    echo "</select>
    </div>
    </form>

";
}



if (@$tem_cor == 'Sim') {

    

    $query2 = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto' order by id desc");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($res2); $i++) {
        foreach ($res2[$i] as $key => $value) {
        }

        $id_carac = $res2[$i]['id_carac'];
        $id_carac_prod = $res2[$i]['id'];

        $query3 = $pdo->query("SELECT * from carac WHERE id = '$id_carac'");
        $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
        $nome_carac = $res3[0]['nome'];

        if ($nome_carac == 'Cor') {
            $query4 = $pdo->query("SELECT * from carac_itens WHERE id_carac_prod = '$id_carac_prod'");
            $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
            for ($i2 = 0; $i2 < count($res4); $i2++) {
                foreach ($res4[$i2] as $key => $value) {
                }

                $valor_item = $res4[$i2]['valor_item'];

                echo "<span class='p-2'> <i class='fa fa-circle ml-1 mr-1' style='color:" . $valor_item . "'></i>" . $res4[$i2]['nome_item'] . "</span> <br>";
            }
        }
    }

   
}

?>



<script type="text/javascript">
    $("#0").change(function() {

        event.preventDefault();

        $.ajax({
            url: 'carrinho/add-carac-carrinho.php', //tem que colocar a pasta carrinho mesmo add-carac-carrinho.php e carac-produtos.php estando na mesmo página, pois carac-produtos.php é chamada em modal-carrinho.php, que está na raíz
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                atualizarCaracCarrinho()
                atualizarCarrinho()
                if (msg.trim() === 'Característica Inserida com Sucesso!') {


                } else {
                    $('#mensagem_caracteristicas').removeClass();
                    $('#mensagem_caracteristicas').addClass('text-danger');
                    $('#mensagem_caracteristicas').text(msg);

                }
            }
        })


    })
</script>

<script type="text/javascript">
    $("#1").change(function() {

        event.preventDefault();

        $.ajax({
            url: 'carrinho/add-carac-carrinho.php', //tem que colocar a pasta carrinho mesmo add-carac-carrinho.php e carac-produtos.php estando na mesmo página, pois carac-produtos.php é chamada em modal-carrinho.php, que está na raíz
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                atualizarCaracCarrinho()
                atualizarCarrinho()
                if (msg.trim() === 'Característica Inserida com Sucesso!') {


                } else {
                    $('#mensagem_caracteristicas').removeClass();
                    $('#mensagem_caracteristicas').addClass('text-danger');
                    $('#mensagem_caracteristicas').text(msg);

                }
            }
        })


    })
</script>

<script type="text/javascript">
    $("#2").change(function() {

        event.preventDefault();

        $.ajax({
            url: 'carrinho/add-carac-carrinho.php', //tem que colocar a pasta carrinho mesmo add-carac-carrinho.php e carac-produtos.php estando na mesmo página, pois carac-produtos.php é chamada em modal-carrinho.php, que está na raíz
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                atualizarCaracCarrinho()
                atualizarCarrinho()
                if (msg.trim() === 'Característica Inserida com Sucesso!') {

                } else {
                    $('#mensagem_caracteristicas').removeClass();
                    $('#mensagem_caracteristicas').addClass('text-danger');
                    $('#mensagem_caracteristicas').text(msg);

                }
            }
        })


    })
</script>

<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
    $(document).ready(function() { //executa assim que a página carregar

        atualizarCaracCarrinho()
    })
</script>

<script>
    function atualizarCaracCarrinho() {

        //id_carrinho vem de listar-carrinho.php, da função addCarac, que por sua vez está em modal-carrinho.php
        //caso migrasse atualizarCaracCarrinho para modal-carrinho.php, não teria como recuperar id_carrinho como foi feito na linha a seguir, já que $id_carrinho está definida nessa página, e não em modal-carrinho.php
        var id_carrinho = <?= $id_carrinho ?>

        $.ajax({
            url: "carrinho/listar-carac-carrinho.php",
            method: "post",
            data: {
                id_carrinho
            },
            dataType: "html",
            success: function(result) {
                $('#listar-carac-itens').html(result)

            },
        })
    }
</script>

<script>
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