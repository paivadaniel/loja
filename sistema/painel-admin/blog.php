<?php

require_once('../../conexao.php');
require_once('verificar.php'); /* precisa da verificação de nível, usuário mal-intencionado não consegue acessar digitando diretamente na barra de endereços:

http://localhost/dashboard/www/loja/sistema/painel-admin/index.php?pag=blog

mas consegue acessar (sem ter logado):

http://localhost/dashboard/www/loja/sistema/painel-admin/blog.php

*/

$pag = 'blog';

?>

<!-- botão nova categoria -->
<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Post</a>
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
                        <th>Imagem</th>
                        <th>Data</th>

                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM blog order by id desc");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $titulo = $res[$i]['titulo'];
                        $imagem = $res[$i]['imagem'];
                        $data = $res[$i]['data'];

                        $data_formatada = implode('/', array_reverse(explode('-', $data)));

                        $id = $res[$i]['id'];

                    ?>

                        <tr>
                            <td><?php echo $titulo ?></td>

                            <td><img src="../../img/blog/<?php echo $imagem ?>" width="50px"> </img></td>
                            <td><?php echo $data ?></td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Post'><i class='far fa-edit'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Post'><i class='far fa-trash-alt'></i></a>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo_modal = "Editar Post";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM blog where id = '$id2'");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $titulo2 = $res[0]['titulo'];
                    $imagem2 = $res[0]['imagem'];
                    $descricao_1_2 = $res[0]['descricao_1'];
                    $descricao_2_2 = $res[0]['descricao_2'];
                    $palavras = $res[0]['palavras'];

                } else {
                    $titulo_modal = "Criar Post";
                }
                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-inserir-editar-post" method="POST">
                <div class="modal-body">


                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Título <small>(Máx. 200 caracteres)</small> </label>
                                <input type="text" value="<?php echo @$titulo2 ?>" class="form-control" id="titulo_post" name="titulo_post" placeholder="Título do Post">
                            </div>

                            <div class="form-group">
                                <label>Descrição 1 <small>(Máx. 1000 caracteres)</small> </label>
                                <textarea class="form-control" id="descricao_1" name="descricao_1" placeholder="Descrição 1 do Post"><?php echo @$descricao_1_2 ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Descrição 2 <small>(Máx. 1000 caracteres)</small> </label>
                                <textarea class="form-control" id="descricao_2" name="descricao_2" placeholder="Descrição 2 do Post"><?php echo @$descricao_2_2 ?></textarea>
                            </div>


                            <div class="form-group">
                                <label>Palavras-chave <small>(Máx. 250 caracteres)</small> </label>
                                <input type="text" value="<?php echo @$palavras ?>" class="form-control" id="palavras_post" name="palavras_post" placeholder="Palavras-chave do Post">
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem_post" name="imagem_post" onChange="carregarImg()">
                                <!-- com o onChange, todas as vezes que eu alterar a imagem, ele irá chamar uma função que irá alterar a imagem chamando o id dela na div dela -->
                            </div>

                            <?php

                            if (@$imagem2 != '') { //editar
                            ?>
                                <img src="../../img/blog/<?php echo $imagem2 ?>" alt="" width="200px" id="target-imagem-post">

                            <?php
                            } else { //inserir (ou editar, se não tiver sido colocada outra imagem diferente de 'sem-foto.jgp' antes)
                            ?>

                                <img src="../../img/blog/sem-foto.jpg" alt="" width="200px" id="target-imagem-post">

                            <?php
                            }
                            ?>

                        </div>
                    </div>



                    <small>
                        <div id="mensagem-post" align="center">

                        </div>
                    </small>

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega categorias.php já tem txtid -->
                    <input value="<?php echo @$titulo2 ?>" type="hidden" name="antigoTitulo" id="antigoTitulo">
                    <!-- passa o antigoNome pois se houver alteração de nome, tem que ser feita a verificação se o nome da nova categoria já existe no banco de dados -->

                    <button type="button" id="btn-fechar-editar-inserir-post" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar-editar-inserir-post" class="btn btn-primary">Salvar</button>
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

        var target = document.getElementById('target-imagem-post');
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
    $("#form-inserir-editar-post").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem-post').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#mensagem-post').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem-post').text(mensagem)

                    //$('#btn-fechar-editar-inserir-categoria').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem-post').addClass('text-danger')
                }

                $('#mensagem-post').text(mensagem)

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

<?php

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-excluir').modal('show');</script>";
}

?>