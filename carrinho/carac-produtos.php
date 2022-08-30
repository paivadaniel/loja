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

echo "<div class='row p-3'>";

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

    echo "<div class='mr-3 mt-3'>

<form id='form' method='post'>

<input name='id_carrinho_carrinho' type='hidden' value='" . $id_carrinho . "'> 
        <select class='form-control form-control-sm' name='" . $i . "' id='" . $i . "'>"; //name e id vai ficar cor, numeração, tamanho, ou seja, as características cadastradas na tabela carac do banco de dados


    echo "<option value='' > Selecionar " . $nome_carac . "</option>"; //value é zero pois não seleciona nenhum valor, apenas Selecionar Tamanho, Selecionar Numeração, Selecionar Cor, ou seja, Selecionar + Nome da Características
    //mudou de 0 para vazio, pois 0 pode assumir valor no option abaixo, se $res4[$i2]['nome_item'] for 0

    $query4 = $pdo->query("SELECT * from carac_itens WHERE id_carac_prod = '$id_carac_prod'");
    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
    for ($i2 = 0; $i2 < count($res4); $i2++) {
        foreach ($res4[$i2] as $key => $value) {
        }



        echo "<option value='" . $res4[$i2]['id'] . "' >" . $res4[$i2]['nome_item'] . "</option>";
    }

    echo "</select>
    </form>

    </div>
";

}

echo "<div class='mt-4' align='center' id='listar-carac-itens'>

</div>


</div>";

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

    var id_carrinho = <?=$id_carrinho?>

        $.ajax({
            url: "carrinho/listar-carac-carrinho.php",
            method: "post",
            data: {id_carrinho},
            dataType: "html",
            success: function(result) {
                $('#listar-carac-itens').html(result)

            },
        })
    }
</script>