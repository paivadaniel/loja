<?php

require_once('../../conexao.php');
require_once('verificar.php'); //já tem session_start() aqui
require_once("../../pagamentos/pagseguro/PagSeguro.class.php");
$PagSeguro = new PagSeguro();

$id_usuario = $_SESSION['id_usuario'];

$pag = 'vendas'; //é a página pedidos.php do painel-cliente, e a pasta vendas é a pasta pedidos do painel-cliente

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Total</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Pago</th>
                        <th>Status</th>
                        <th>Produtos</th>

                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query_ped = $pdo->query("SELECT * FROM vendas order by id desc");
                    $res_ped = $query_ped->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < @count($res_ped); $i++) {
                        foreach ($res_ped[$i] as $key => $value) {
                        }

                        $total = $res_ped[$i]['total'];
                        $data = $res_ped[$i]['data'];
                        $pago = $res_ped[$i]['pago'];
                        $status = $res_ped[$i]['status'];
                        $rastreio = @$res_ped[$i]['rastreio'];
                        $id_cliente = $res_ped[$i]['id_usuario'];

                        $id_venda = $res_ped[$i]['id'];

                        //VERIFICAR SE O PAGAMENTO NO PAGSEGURO ESTÁ APROVADO
                        //COMENTE ESSE TRECHO DE CÓDIGO CASO QUEIRA UM GANHO GRANDE EM VELOCIDADE DE CARREGAMENTO
                        //variável P recebe a referência do pagamento
                        $P = $PagSeguro->getStatusByReference($id_venda);
                        if ($P == 3 || $P == 4) { //p=3 aprovado e p=4 disponível
                            include_once('../../aprovar_compra.php'); //aprova a compra
                        }


                        $query3 = $pdo->query("SELECT * FROM usuarios where id = '$id_cliente'");
                        $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                        $email_cliente = $res3[0]['email'];

                        $total = number_format($total, 2, ',', '.');
                        $data = implode('/', array_reverse(explode('-', $data)));

                        $query2 = $pdo->query("SELECT * FROM carrinho where id_venda = '$id_venda'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $total_produtos = @count($res2);

                        if ($pago == 'Sim') {
                            $classe_pago = 'text-success';
                        } else {
                            $classe_pago = 'text-danger';
                        }

                    ?>

                        <tr>
                            <td><i class="fa fa-square mr-2 <?php echo $classe_pago ?>"></i> R$ <?php echo $total ?></td>
                            <td><?php echo $email_cliente ?></td>

                            <td><?php echo $data ?></td>
                            <td><?php echo $pago ?></td>
                            <td>
                                <?php
                                if ($status == "Enviado") {
                                    echo "<img src='../../img/correios.png' width='25'><a href='http://www.correios.com.br' class='text-primary' title='Código de Postagem' target='_blank'><small>" . $rastreio . "</small></a>";
                                } else {
                                    echo $status;
                                }
                                ?>
                            </td>
                            <td>
                                <a href="" onclick="verProdutos('<?php echo $id_venda ?>')" title="Ver Produtos">
                                    <i class="fa fa-eye text-primary"></i>
                                    <?php echo $total_produtos ?> Produto(s)
                            </td>
                            </a>
                            <td>

                                <?php

                                $query3 = $pdo->query("SELECT * FROM mensagens where id_venda = '$id_venda' order by id desc limit 1");
                                $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                                $usuario_ultimo = @$res3[0]['usuario'];

                                if ($usuario_ultimo == 'Cliente') {

                                ?>
                                    <!-- caso última resposta seja do admin -->
                                    <a href="index.php?pag=<?php echo $pag ?>&funcao=mensagem&id_venda=<?php echo $id_venda ?>" class='text-primary mr-1' title='Enviar Mensagem'><span class="badge badge-warning"><?php echo @count($res3) ?></span></a>

                                <?php

                                } else {
                                ?>
                                    <!-- caso última resposta seja do cliente, não há contador de resposta, o contador é 1 quando a última mensagem for do admin, nunca passa de 1 pois colocamos um limit de 1 no SELECT -->
                                    <a href="index.php?pag=<?php echo $pag ?>&funcao=mensagem&id_venda=<?php echo $id_venda ?>" class='text-primary mr-1' title='Enviar Mensagem'><span class="badge badge-success">0</span></a>

                                <?php

                                }

                                ?>

                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id_venda=<?php echo $id_venda ?>" class='text-primary mr-1' title='Editar Status'><i class='far fa-edit'></i></a>

                                <?php
                                if ($pago != "Sim") {
                                ?>
                                    <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id_venda=<?php echo $id_venda ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>


                                    <a href="index.php?pag=<?php echo $pag ?>&funcao=aprovar&id_venda=<?php echo $id_venda ?>" class='text-success mr-1' title='Aprovar Pagamento'><i class='far fa-check-circle'></i></a>


                                <?php

                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Produtos -->

<div class="modal fade" id="modal-produtos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="overflow-y:initial !important">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Produtos da Venda</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:auto;">
                <!-- height e overflow-y:auto se colocar na modal-content, vai mudar a forma como a barra de rolagem é disposta -->

                <div id="listar-produtos"></div>

                <small>
                    <div align="center" id="mensagem_produtos">

                    </div>
                </small>

            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Status -->

<div class="modal fade" id="modal-editar-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <?php

                $id_ven3 = $_GET['id_venda'];

                $query = $pdo->query("SELECT * FROM vendas where id = '$id_ven3'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $rastreio = @$res[0]['rastreio'];
                $status = @$res[0]['status'];

                ?>
                <h5 class="modal-title" id="exampleModalLabel">Editar Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control form-control-sm" name="status_rastreio" id="status_rastreio">
                                    <option value="Não Enviado" <?php if (@$status == 'Não Enviado') { ?> selected <?php } ?>>Não Enviado</option>
                                    <option value="Enviado" <?php if (@$status == 'Enviado') { ?> selected <?php } ?>>Enviado</option>
                                    <option value="Entregue" <?php if (@$status == 'Entregue') { ?> selected <?php } ?>>Entregue</option>
                                    <option value="Disponivel" <?php if (@$status == 'Disponivel') { ?> selected <?php } ?>>Disponivel</option>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="editar-rastreio">Código de postagem</label>

                                <input type="text" name="codigo_rastreio" id="codigo_rastreio" class="form-control form-control-sm" value="<?php echo @$rastreio ?>">
                            </div>

                        </div>

                    </div>
                    <small>
                        <div id="mensagem-editar-status" align="center">

                        </div>
                    </small>

                </div>

                <div class="modal-footer">

                    <input value="<?php echo $id_ven3 ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega categorias.php já tem txtid -->

                    <button type="button" id="btn-fechar-editar-status" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar-editar-status" id="btn-salvar-editar-status" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal Excluir -->

<div class="modal" id="modal-excluir" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Registro?</p>

                <div align="center" id="mensagem_excluir" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id_venda" name="id_venda" value="<?php echo @$_GET['id_venda'] ?>">

                    <button type="button" id="btn-excluir" name="btn-excluir" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal Aprovar Pgto -->

<div class="modal" id="modal-aprovar-pgto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aprovar Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja Aprovar o Pagamento desta Venda?</p>

                <div align="center" id="mensagem_aprovar_pgto" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-aprovar-pgto">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id_venda" name="id_venda" value="<?php echo @$_GET['id_venda'] ?>">
                            <!-- não usaremos ajax, então tem que ser type submit -->
                    <button type="submit" id="btn-aprovar-pgto" name="btn-aprovar-pgto" class="btn btn-success">Aprovar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal Pergunta -->

<div class="modal" id="modal-pergunta" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perguntas acerca do pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6 mb-2">

                        <form method="post">

                            <div class="form-group">
                                <label for="pedidos_mensagem">Faça uma nova pergunta</label>
                                <textarea class="form-control form-control-sm" id="mensagem_pergunta" name="mensagem_pergunta" maxlength="1000"></textarea>
                            </div>

                            <button type="submit" id="btn-mensagem-pergunta" name="btn-mensagem-pergunta" class="btn btn-info">Enviar</button> <!-- precisa ter type="submit" pois a transferência não será por AJAX, terá refresh na página -->
                        </form>

                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="mb-2">Perguntas</label><br>

                        <?php

                        $id_ven = $_GET['id_venda'];

                        $query = $pdo->query("SELECT * FROM mensagens where id_venda = '$id_ven' order by id desc"); //não dá para usar apenas id_venda = $id_venda, pois ele vai pegar o último registro armazenado na variável id_venda, que será o mesmo para todos os produtos, e será o id da última venda
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }

                            $usuario = $res[$i]['usuario'];
                            $mensagem = $res[$i]['mensagem'];
                            $data = $res[$i]['data'];
                            $hora = $res[$i]['hora'];

                            $data = implode('/', array_reverse(explode('-', $data)));

                            if ($usuario == 'Admin') { //deixa em negrito as mensagens do admin
                                echo '<b>' . $i + 1 . ') <u> Administrador</u> </b> - '  . $data . ' às ' . ' ' . $hora . '<br>' . $mensagem . '<hr>';
                            } else {
                                echo $i + 1 . ') <u>Cliente</u> </b> - '  . $data . ' às ' . ' ' . $hora . '<br>' .  $mensagem . '<hr>';
                            }
                        }
                        ?>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!--AJAX PARA INSERÇÃO DOS DADOS VINDO DE UMA FUNÇÃO -->
<script>
    function verProdutos(id_venda) {

        var pag = "<?= $pag ?>"

        event.preventDefault(); //sem o event e usando a href com onclick, fica abrindo e fechando a modal

        $.ajax({
            url: pag + "/listar-produtos.php",
            method: "post",
            data: {
                id_venda
            },
            dataType: "html",
            success: function(result) {
                $('#modal-produtos').modal('show')

                $('#listar-produtos').html(result)

            },
        })

    }
</script>

<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-excluir').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!') {

                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_excluir').text(mensagem)
                },

            })
        })
    })
</script>

<?php
if (isset($_POST['btn-aprovar-pgto'])) { //o que guarda btn-mensagem-pergunta após ser apertado?

$id_venda = $_GET['id_venda'];

require('../../aprovar_compra.php');

echo "<script> window.location='index.php?pag=vendas'</script>";
}
?>


<!--AJAX PARA EDITAR STATUS -->
<script type="text/javascript">
    var pag = "<?= $pag ?>";
    $('#btn-salvar-editar-status').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: pag + "/editar-status.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem) {

                if (mensagem.trim() === 'Editado com Sucesso!') {

                    $('#btn-fechar-editar-status').click();
                    window.location = "index.php?pag=" + pag;
                }

                $('#mensagem-editar-status').addClass('text-danger');
                $('#mensagem-editar-status').text(mensagem)
            },

        })
    })
</script>


<!-- script para não permitir ordenamento por Data Tables, assim podemos ordenar na instrução SQL, com, por exemplo, order by nome asc -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>

<!-- chamadas das modais -->

<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "mensagem") {
    echo "<script>$('#modal-pergunta').modal('show');</script>";
}

?>

<?php

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modal-editar-status').modal('show');</script>";
}

?>


<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-excluir').modal('show');</script>";
}

?>

<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "aprovar") {
    echo "<script>$('#modal-aprovar-pgto').modal('show');</script>";
}

?>



<?php

if (isset($_POST['btn-mensagem-pergunta'])) { //o que guarda btn-mensagem-pergunta após ser apertado?

    $id_ven2 = $_GET['id_venda'];
    $mensagem_pergunta = $_POST['mensagem_pergunta'];

    $res = $pdo->prepare("INSERT mensagens SET id_venda = :id_venda, mensagem = :mensagem, usuario = 'Admin', data = curDate(), hora = curTime()");
    $res->bindValue(":id_venda", $id_ven2);
    $res->bindValue(":mensagem", $mensagem_pergunta);
    $res->execute();

    echo "<script> window.location='index.php?pag=vendas&funcao=mensagem&id_venda=$id_ven2'</script>";
}
?>

<!--
    não dá para dar require/include da modal-pagamento.php por que muda as pastas de imagens, por exemplo /img/pagamentos/exemplo.png, viraria ../../img/pagamentos/exemplo.png
-->