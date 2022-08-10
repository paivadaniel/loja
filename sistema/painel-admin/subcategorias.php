<?php

require_once('../../conexao.php');
require_once('verificar.php'); /* precisa da verificação de nível, usuário mal-intencionado não consegue acessar digitamente diretamente na barra de endereços:

http://localhost/dashboard/www/loja/sistema/painel-admin/index.php?pag=categorias

mas consegue acessar (sem ter logado):

http://localhost/dashboard/www/loja/sistema/painel-admin/categorias.php

*/

$pag = 'subcategorias';

?>

<!-- botão nova categoria -->
<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Nova Subcategoria</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-md-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Imagem</th>
                        <th>Produtos</th>
                        <th>Categoria</th>

                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM subcategorias order by nome asc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $nome = $res[$i]['nome'];
                        $imagem = $res[$i]['imagem'];
                        $produtos = $res[$i]['produtos'];
                        $id_categoria = $res[$i]['id_categoria'];
                        $id = $res[$i]['id'];

                        //busca nome da categoria a partir do id dela
                        $query2 = $pdo->query("SELECT * FROM categorias where id = '$id_categoria'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $nome_categoria = $res2[0]['nome'];

                    ?>


                        <tr>
                            <td><?php echo $nome ?></td>
                            <td><img src="../../img/subcategorias/<?php echo $imagem ?>" width="50px"> </img></td>
                            <td><?php echo $produtos ?></td>
                            <td><?php echo $nome_categoria ?></td>



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

<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM subcategorias where id = '$id2'");

                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $nome2 = $res[0]['nome'];
                    $imagem2 = $res[0]['imagem'];
                    $id_categoria2 = $res[0]['id_categoria'];
                } else {
                    $titulo = "Inserir Registro";
                }
                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-inserir-editar-subcategoria" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" value="<?php echo @$nome2 ?>" class="form-control form-control-sm" id="nome-subcategoria" name="nome-subcategoria" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control form-control-sm" name="categoria" id="categoria">
                            <?php

                            if (@$_GET['funcao'] == 'editar') {

                                $query2 = $pdo->query("SELECT * FROM categorias where id = '$id_categoria2'");
                                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                $nome_categoria2 = $res2[0]['nome'];

                                echo "<option value='" . $id_categoria2 . "'>" . $nome_categoria2 . "</option>";
                            }

                            //mesmo que já tenha categoria (ou seja, se for edição), é possível trocá-la, para isso é necessário listar todas

                            $query3 = $pdo->query("SELECT * FROM categorias order by nome asc");
                            $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($res3); $i++) {
                                foreach ($res3[$i] as $key => $value) {
                                }

                                if (@$nome_categoria2 != $res3[$i]['nome']) { //arrobar pois nome_categoria2 não existe na inserção
                                    echo "<option value='" . $res3[$i]['id'] . "'>" . $res3[$i]['nome'] . "</option>";
                                }
                            }
                            ?>

                        </select>

                    </div>

                    <div class="form-group">
                        <label>Imagem</label>
                        <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem-subcategoria" name="imagem-subcategoria" onChange="carregarImg()">
                        <!-- com o onChange, todas as vezes que eu alterar a imagem, ele irá chamar uma função que irá alterar a imagem chamando o id dela na div dela -->
                    </div>

                    <?php

                    if (@$imagem2 != '') { //editar
                    ?>
                        <img src="../../img/subcategorias/<?php echo $imagem2 ?>" alt="" width="200px" id="target-imagem-subcategoria">

                    <?php
                    } else { //inserir (ou editar, se não tiver sido colocada outra imagem diferente de 'sem-foto.jgp' antes)
                    ?>

                        <img src="../../img/subcategorias/sem-foto.jpg" alt="" width="200px" id="target-imagem-subcategoria">

                    <?php
                    }
                    ?>

                    <small>
                        <div id="mensagem-inserir-editar-subcategoria" align="center">

                        </div>
                    </small>

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega subcategorias.php já tem txtid -->
                    <input value="<?php echo @$nome2 ?>" type="hidden" name="antigoNomeCategoria" id="antigoNomeSubcategoria">
                    <!-- passa o antigoNome pois se houver alteração de nome, tem que ser feita a verificação se o nome da nova categoria já existe no banco de dados -->

                    <button type="button" id="btn-fechar-editar-inserir-subcategoria" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar-editar-inserir-subcategoria" class="btn btn-primary">Salvar</button>
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

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
    function carregarImg() {

        var target = document.getElementById('target-imagem-subcategoria');
        var file = document.querySelector("input[type=file]").files[0]; //pega um input qualquer do tipo file
        var reader = new FileReader();

        reader.onloadend = function() {
            target.src = reader.result; //caminho do campo de imagem recebe o valor que está no input
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }
</script>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form-inserir-editar-subcategoria").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem-inserir-editar-subcategoria').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#mensagem-inserir-editar-subcategoria').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem-inserir-editar-subcategoria').text(mensagem)

                    //$('#btn-fechar-editar-inserir-categoria').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem-inserir-editar-subcategoria').addClass('text-danger')
                }

                $('#mensagem-inserir-editar-subcategoria').text(mensagem)

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
    echo "<script>$('#modalDados').modal('show');</script>";
}

?>

<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

?>


<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-excluir').modal('show');</script>";
}

?>