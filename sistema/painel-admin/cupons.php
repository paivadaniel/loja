<?php

require_once('../../conexao.php');
require_once('verificar.php'); /* precisa da verificação de nível, usuário mal-intencionado não consegue acessar digitamente diretamente na barra de endereços:

http://localhost/dashboard/www/loja/sistema/painel-admin/index.php?pag=categorias

mas consegue acessar (sem ter logado):

http://localhost/dashboard/www/loja/sistema/painel-admin/categorias.php

*/

$pag = 'cupons';

$hoje = date('Y-m-d');

//VERIFICAR SE HÁ CUPONS VENCIDOS E EXCLUI-LOS
//IDEAL SERIA CRIAR UM BOTÃO PARA DELETAR CUPONS ANTIGOS
$query = $pdo->query("SELECT * FROM cupons WHERE data < curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $id_cupom_vencido = $res[$i]['id'];

    $pdo->query("DELETE FROM cupons WHERE id = '$id_cupom_vencido'");
}

?>

<!-- botão nova categoria -->
<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Cupom</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-md-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Código</th>
                        <th>Valor</th>
                        <th>Válido Até</th>

                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM cupons order by id desc");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $id = $res[$i]['id'];
                        $titulo = $res[$i]['titulo'];
                        $valor = $res[$i]['valor'];
                        $codigo = $res[$i]['codigo'];
                        $data = $res[$i]['data'];

                        $valor = number_format($valor, 2, ',', '.');

                        $data = implode('/', array_reverse(explode('-', $data)));


                    ?>

                        <tr>
                            <td><?php echo $titulo ?></td>
                            <td><?php echo $codigo ?></td>
                            <td>R$ <?php echo $valor ?></td>
                            <td><?php echo $data ?></td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Editar/Inserir -->

<div class="modal fade" id="modalCupons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo_modal = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM cupons where id = '$id2'");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $titulo2 = $res[0]['titulo'];
                    $valor2 = $res[0]['valor'];
                    $codigo2 = $res[0]['codigo'];
                    $data2 = $res[0]['data'];

                    $valor2 = number_format($valor2, 2, ',', '.');
                } else {
                    $titulo_modal = "Inserir Registro";
                    $data2 = $hoje;
                }
                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-inserir-editar-cupom" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" value="<?php echo @$titulo2 ?>" class="form-control" id="titulo_cupom" name="titulo_cupom">
                    </div>


                    <div class="form-group">
                        <label>Código</label>
                        <input type="text" value="<?php echo @$codigo2 ?>" class="form-control" id="codigo_cupom" name="codigo_cupom">
                    </div>

                    <div class="form-group">
                        <label>Valor (R$)</label>
                        <input type="text" value="<?php echo @$valor2 ?>" class="form-control" id="valor_cupom" name="valor_cupom">
                    </div>

                    <div class="form-group">
                        <label>Data de Validade</label>
                        <input type="date" value="<?php echo @$data2 ?>" class="form-control" id="data_cupom" name="data_cupom">
                    </div>
                    <small>
                        <div id="mensagem-cupom" align="center">

                        </div>
                    </small>

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega categorias.php já tem txtid -->
                    <input value="<?php echo @$codigo2 ?>" type="hidden" name="antigoCodigo" id="antigoCodigo">
                    <!-- passa o antigoCodigo pois se houver alteração do código, tem que ser feita a verificação se o código do novo cupom já existe no banco de dados -->

                    <button type="button" id="btn-fechar-cupom" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar-cupom" class="btn btn-primary">Salvar</button>
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

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-excluir" name="btn-excluir" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<!-- usou ajax com imagem, mas não precisava pois não tem imagem, mas ainda assim deu certo -->
<script type="text/javascript">
    $("#form-inserir-editar-cupom").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem-cupom').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#mensagem-cupom').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem-cupom').text(mensagem)

                    //$('#btn-fechar-editar-inserir-categoria').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem-cupom').addClass('text-danger')
                }

                $('#mensagem-cupom').text(mensagem)

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


<!-- script para não permitir ordenamento por Data Tables, assim podemos ordenar na instrução SQL, com, por exemplo, order by nome asc -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>

<!-- chamadas das modais -->

<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
    echo "<script>$('#modalCupons').modal('show');</script>";
}

?>

<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalCupons').modal('show');</script>";
}

?>


<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-excluir').modal('show');</script>";
}

?>