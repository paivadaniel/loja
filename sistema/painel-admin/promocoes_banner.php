<?php

require_once('../../conexao.php');
require_once('verificar.php'); /* precisa da verificação de nível, usuário mal-intencionado não consegue acessar digitamente diretamente na barra de endereços:

http://localhost/dashboard/www/loja/sistema/painel-admin/index.php?pag=categorias

mas consegue acessar (sem ter logado):

http://localhost/dashboard/www/loja/sistema/painel-admin/categorias.php

*/

$pag = 'promocoes_banner';

?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Nova Promoção</a>
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

                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM promocoes_banner order by id desc");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $titulo = $res[$i]['titulo'];
                        $imagem = $res[$i]['imagem'];
                        $ativo = $res[$i]['ativo'];
                        $link = $res[$i]['link'];

                        $id = $res[$i]['id']; //id da promoção

                    ?>


                        <tr>
                            <td><a href="<?php echo $link ?>" title="Ir para Página da Promoção" target="_blank"><?php echo $titulo ?></td></a>
                            <td><img src="../../img/promocoes/<?php echo $imagem ?>" width="100px" height="48px"> </img></td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Promoção'><i class='far fa-edit'></i></a>
                                <!-- id é o id da tabela promocoes_banner, ou seja, o id da promoção, nõo do produto, conforme recuperamos acima -->
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Promoção'><i class='far fa-trash-alt'></i></a>

                                <?php
                                if ($ativo == 'Sim') {
                                    echo "
                                        
                                        <a href='index.php?pag=$pag&funcao=desativar&id=$id' title='Desativar Promoção'>

                                        <i class='far fa-check-square text-success'></i></a>";
                                } else {
                                    echo "
                                        
                                        <a href='index.php?pag=$pag&funcao=ativar&id=$id' title='Ativar Promoção'>

                                        <i class='far fa-square text-danger'></i></a>";
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

<!-- Modal Editar/Inserir -->

<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo_modal = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM promocoes_banner where id = '$id2'");

                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $titulo2 = $res[0]['titulo'];
                    $imagem2 = $res[0]['imagem'];
                    $link2 = $res[0]['link'];
                } else {
                    $titulo_modal = "Inserir Registro";
                }
                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-inserir-editar-promocao" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="titulo_promocao_banner">Título</label>
                        <input type="text" value="<?php echo @$titulo2 ?>" class="form-control" id="titulo_promocao_banner" name="titulo_promocao_banner">
                    </div>

                    <div class="form-group">
                        <label for="link_promocao_banner">Link</label>
                        <input type="text" value="<?php echo @$link2 ?>" class="form-control" id="link_promocao_banner" name="link_promocao_banner">
                    </div>

                    <div class="form-group">
                        <label for="imagem_promocao_banner">Imagem</label>
                        <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem_promocao_banner" name="imagem_promocao_banner" onChange="carregarImg()">
                        <!-- com o onChange, todas as vezes que eu alterar a imagem, ele irá chamar uma função que irá alterar a imagem chamando o id dela na div dela -->
                    </div>

                    <?php

                    if (@$imagem2 != '') { //editar
                    ?>
                        <img src="../../img/promocoes/<?php echo $imagem2 ?>" alt="" width="450px" height="213px" id="target-imagem-promocao">

                    <?php
                    } else { //inserir (ou editar, se não tiver sido colocada outra imagem diferente de 'sem-foto.jgp' antes)
                    ?>

                        <img src="../../img/promocoes/sem-foto.jpg" alt="" width="200px" id="target-imagem-promocao">

                    <?php
                    }
                    ?>

                    <small>
                        <div id="mensagem-inserir-editar-promocao" align="center">

                        </div>
                    </small>

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega promocoes_banner.php já tem txtid -->
                    <input value="<?php echo @$titulo2 ?>" type="hidden" name="antigoTitulo" id="antigoTitulo">
                    <!-- passa o antigoTitulo pois se houver alteração de título, tem que ser feita a verificação se o nome da nova promoção já existe no banco de dados -->

                    <button type="button" id="btn-fechar-editar-inserir-promocao" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar-editar-inserir-promocao" class="btn btn-primary">Salvar</button>
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
                <h5 class="modal-title">Excluir Promoção</h5>
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

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>">

                    <button type="button" id="btn-excluir" name="btn-excluir" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal ativar -->

<div class="modal" id="modal-ativar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ativar Promoção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Ativar esta Promoção?</p>

                <div align="center" id="mensagem_ativar" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-ativar">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>">

                    <button type="button" id="btn-ativar" name="btn-ativar" class="btn btn-danger">Ativar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal desativar -->

<div class="modal" id="modal-desativar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Promoção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Desativar esta Promoção?</p>

                <div align="center" id="mensagem_desativar" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-desativar">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>">

                    <button type="button" id="btn-desativar" name="btn-desativar" class="btn btn-danger">Desativar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
    function carregarImg() {

        var target = document.getElementById('target-imagem-promocao');
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
    $("#form-inserir-editar-promocao").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem-inserir-editar-promocao').removeClass()

                if (mensagem.trim() == "Promoção Salva com Sucesso!") {
                    $('#mensagem-inserir-editar-promocao').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem-inserir-editar-promocao').text(mensagem)

                    //$('#btn-fechar-editar-inserir-categoria').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem-inserir-editar-promocao').addClass('text-danger')
                    $('#mensagem-inserir-editar-promocao').text(mensagem)

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
                    } else {
                        $('#mensagem_excluir').addClass('text-danger')
                        $('#mensagem_excluir').text(mensagem)
                    }

                },

            })
        })
    })
</script>

<!--AJAX PARA ATIVAR PROMOÇÃO -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-ativar').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/ativar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Promoção Ativada com Sucesso!') {

                        $('#btn-cancelar-ativar').click();
                        window.location = "index.php?pag=" + pag;
                    } else {
                        $('#mensagem_ativar').addClass('text-danger')
                        $('#mensagem_ativar').text(mensagem)
                    }

                },

            })
        })
    })
</script>

<!--AJAX PARA DESATIVAR PROMOÇÃO -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-desativar').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/desativar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Promoção Desativada com Sucesso!') {

                        $('#btn-cancelar-desativar').click();
                        window.location = "index.php?pag=" + pag;
                    } else {
                        $('#mensagem_desativar').addClass('text-danger')
                        $('#mensagem_desativar').text(mensagem)
                    }

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

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "ativar") {
    echo "<script>$('#modal-ativar').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "desativar") {
    echo "<script>$('#modal-desativar').modal('show');</script>";
}

?>