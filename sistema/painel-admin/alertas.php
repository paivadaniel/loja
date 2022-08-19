<?php

require_once('../../conexao.php');
require_once('verificar.php'); /* precisa da verificação de nível, usuário mal-intencionado não consegue acessar digitamente diretamente na barra de endereços:

http://localhost/dashboard/www/loja/sistema/painel-admin/index.php?pag=categorias

mas consegue acessar (sem ter logado):

http://localhost/dashboard/www/loja/sistema/painel-admin/categorias.php

*/

$pag = 'alertas';

$agora = date('Y-m-d');

?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Alerta</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-md-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Título Alerta</th>
                        <th>Título Mensagem</th>
                        <th>Imagem</th>
                        <th>Término da Exibição</th>

                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM alertas order by id desc");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $titulo_alerta = $res[$i]['titulo_alerta'];
                        $titulo_mensagem = $res[$i]['titulo_mensagem'];
                        $link = $res[$i]['link'];
                        $imagem = $res[$i]['imagem'];
                        $data_final = $res[$i]['data_final'];

                        $data_final = implode('/', array_reverse(explode('-', $data_final)));


                        $ativo = $res[$i]['ativo'];

                        $id = $res[$i]['id']; //id do alerta

                    ?>


                        <tr>
                            <td><a href="<?php echo $link ?>" title="Ir para Página do Alerta" target="_blank"><?php echo $titulo_alerta ?></td></a>
                            <td><?php echo $titulo_mensagem ?></a>

                            <td><img src="../../img/alertas/<?php echo $imagem ?>" width="100px" height="48px"> </img></td>
                            <td><?php echo $data_final ?></a>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Alerta'><i class='far fa-edit'></i></a>
                                <!-- id é o id da tabela alertas, ou seja, o id do alerta, nõo do produto, conforme recuperamos acima -->
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Alerta'><i class='far fa-trash-alt'></i></a>

                                <?php
                                if ($ativo == 'Sim') {
                                    echo "
                                        
                                        <a href='index.php?pag=$pag&funcao=desativar&id=$id' title='Desativar Alerta'>

                                        <i class='far fa-check-square text-success'></i></a>";
                                } else {
                                    echo "
                                        
                                        <a href='index.php?pag=$pag&funcao=ativar&id=$id' title='Ativar Alerta'>

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

                    $query = $pdo->query("SELECT * FROM alertas where id = '$id2'");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $titulo_alerta2 = $res[0]['titulo_alerta'];
                    $titulo_mensagem2 = $res[0]['titulo_mensagem'];
                    $mensagem = $res[0]['mensagem'];
                    $link2 = $res[0]['link'];
                    $imagem2 = $res[0]['imagem'];
                    $data_final2 = $res[0]['data_final'];
                } else {
                    $titulo_modal = "Inserir Registro";
                    $data_final2 = $agora;
                }
                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-inserir-editar-alerta" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="titulo_alerta">Título Alerta <small>(Máx. 35 caracteres)</small></label>
                                <input type="text" value="<?php echo @$titulo_alerta2 ?>" class="form-control" id="titulo_alerta" name="titulo_alerta" maxlength="35">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="titulo_mensagem">Título Mens. <small>(Máx. 100 caracteres)</small></label>
                                <input type="text" value="<?php echo @$titulo_mensagem2 ?>" class="form-control" id="titulo_mensagem" name="titulo_mensagem" maxlength="100">
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mensagem_alerta">Mensagem <small>(Máx. 1000 caracteres)</small></label>
                                <textarea class="form-control" id="mensagem_alerta" name="mensagem_alerta" maxlength="1000"><?php echo @$mensagem ?></textarea>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="link_alerta">Link</label>
                                <input type="text" value="<?php echo @$link2 ?>" class="form-control" id="link_alerta" name="link_alerta">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_final_alerta">Término da Exibição</label>
                                <input type="date" class="form-control" id="data_final_alerta" name="data_final_alerta" value="<?php echo $data_final2 ?>">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="imagem_alerta">Imagem</label>
                                <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem_alerta" name="imagem_alerta" onChange="carregarImg()">
                                <!-- com o onChange, todas as vezes que eu alterar a imagem, ele irá chamar uma função que irá alterar a imagem chamando o id dela na div dela -->
                            </div>

                            <?php

                            if (@$imagem2 != '') { //editar
                            ?>
                                <img src="../../img/alertas/<?php echo $imagem2 ?>" alt="" width="450px" height="213px" id="target-imagem-alerta">

                            <?php
                            } else { //inserir (ou editar, se não tiver sido colocada outra imagem diferente de 'sem-foto.jgp' antes)
                            ?>

                                <img src="../../img/alertas/sem-foto.jpg" alt="" width="200px" id="target-imagem-alerta">

                            <?php
                            }
                            ?>

                        </div>
                    </div>

                    <small>
                        <div id="mensagem-inserir-editar-alerta" align="center">

                        </div>
                    </small>



                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega alertas.php já tem txtid -->
                    <input value="<?php echo @$titulo_alerta2 ?>" type="hidden" name="antigoTitulo" id="antigoTitulo">
                    <!-- passa o antigoTitulo pois se houver alteração de título, tem que ser feita a verificação se o nome da nova alerta já existe no banco de dados -->

                    <button type="button" id="btn-fechar-editar-inserir-alerta" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar-editar-inserir-alerta" class="btn btn-primary">Salvar</button>
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
                <h5 class="modal-title">Excluir Alerta</h5>
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
                <h5 class="modal-title">Ativar Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Ativar este Alerta?</p>

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
                <h5 class="modal-title">Desativar Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Desativar este Alerta?</p>

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

        var target = document.getElementById('target-imagem-alerta');
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
    $("#form-inserir-editar-alerta").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem-inserir-editar-alerta').removeClass()

                if (mensagem.trim() == "Alerta Salvo com Sucesso!") {
                    $('#mensagem-inserir-editar-alerta').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem-inserir-editar-alerta').text(mensagem)

                    //$('#btn-fechar-editar-inserir-categoria').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem-inserir-editar-alerta').addClass('text-danger')
                    $('#mensagem-inserir-editar-alerta').text(mensagem)

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

<!--AJAX PARA ATIVAR ALERTA -->
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

                    if (mensagem.trim() === 'Alerta Ativado com Sucesso!') {

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

<!--AJAX PARA DESATIVAR ALERTA -->
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

                    if (mensagem.trim() === 'Alerta Desativado com Sucesso!') {

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