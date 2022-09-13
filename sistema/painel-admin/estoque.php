<?php

require_once('../../conexao.php');
require_once('verificar.php'); /* precisa da verificação de nível, usuário mal-intencionado não consegue acessar digitamente diretamente na barra de endereços:

http://localhost/dashboard/www/loja/sistema/painel-admin/index.php?pag=categorias

mas consegue acessar (sem ter logado):

http://localhost/dashboard/www/loja/sistema/painel-admin/categorias.php

*/

$pag = 'estoque';

?>


<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Estoque</th>

                        <th>Fazer Pedido</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM produtos where estoque <= '$estoque_baixo' order by estoque asc");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $nome = $res[$i]['nome'];
                        $estoque = $res[$i]['estoque'];

                        $id = $res[$i]['id'];

                    ?>

                        <tr>
                            <td><?php echo $nome ?></td>
                            <td><?php echo $estoque ?></td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Fazer Pedido'><i class='far fa-edit'></i></a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Fazer Pedido -->

<div class="modal fade" id="modalFazerPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <?php

                $id2 = $_GET['id'];

                $query = $pdo->query("SELECT * FROM produtos where id = '$id2'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                $nome2 = $res[0]['nome'];

                ?>

                <h5 class="modal-title" id="exampleModalLabel">Fazer Pedido - <?php echo $nome ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-fazer-pedido" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" class="form-control" id="quantidade_pedido" name="quantidade_pedido" placeholder="Insira a Quantidade para Fazer o Pedido">
                    </div>

                    <small>
                        <div id="mensagem_fazer_pedido" align="center">

                        </div>
                    </small>

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega carac.php já tem txtid -->

                    <button type="button" id="btn-fechar-fazer-pedido" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar-fazer-pedido id=" btn-salvar-fazer-pedido" class="btn btn-primary">Fazer Pedido</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form-fazer-pedido").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/entrada-estoque.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem_fazer_pedido').removeClass()

                if (mensagem.trim() == "Pedido Feito com Sucesso!") {
                    $('#mensagem_fazer_pedido').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem_fazer_pedido').text(mensagem)

                    //$('#btn-fechar-editar-inserir-categoria').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem_fazer_pedido').addClass('text-danger')
                    $('#mensagem_fazer_pedido').text(mensagem)

                }


            },

            //a partir daqui é apenas para imagem, não tinha para type="text"
            cache: false,
            contentType: false, //tem contentType ao invés de dataType
            processData: false,
            xhr: function() { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function() {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
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

<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalFazerPedido').modal('show');</script>";
}

?>


?>