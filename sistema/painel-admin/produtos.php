<?php

require_once('../../conexao.php');
require_once('verificar.php'); /* precisa da verificação de nível, usuário mal-intencionado não consegue acessar digitamente diretamente na barra de endereços:

http://localhost/dashboard/www/loja/sistema/painel-admin/index.php?pag=categorias

mas consegue acessar (sem ter logado):

http://localhost/dashboard/www/loja/sistema/painel-admin/categorias.php

*/

$pag = 'produtos';

$agora = date('Y-m-d');

?>

<!-- botão nova categoria -->
<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Produto</a>
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
                        <th>Valor</th>
                        <th>Estoque</th>
                        <th>Subcategoria</th>

                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM produtos order by id desc");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $id = $res[$i]['id'];
                        $nome = $res[$i]['nome'];
                        $imagem = $res[$i]['imagem'];
                        $valor = $res[$i]['valor'];
                        $estoque = $res[$i]['estoque'];
                        $id_subcategoria = $res[$i]['id_subcategoria'];
                        $ativo = $res[$i]['ativo'];
                        $promocao = $res[$i]['promocao'];

                        $valor = number_format($valor, 2, ',', '.');
                        //$valor = str_replace('.', ',', $valor);
                        /* achava que str_replace era exclusiva para passar para o banco de dados, mas não tem nada a ver
                        pelo que entendi, a única diferença dela é que ela não tem o argumento para limitar o número de casas decimais, que utilizamos acima como 2 
                        */

                        $classe = '';

                        if ($ativo == 'Sim') {
                            $classe = 'text-success';
                        } else {
                            $classe = 'text-secondary';
                        }

                        $classe2 = '';

                        if ($promocao == 'Sim') {
                            $classe2 = 'text-success';
                        } else {
                            $classe2 = 'text-danger';
                        }

                        //busca nome da subcategoria a partir do id dela
                        $query2 = $pdo->query("SELECT * FROM subcategorias where id = '$id_subcategoria'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $nome_subcategoria = $res2[0]['nome'];

                    ?>


                        <tr>
                            <td><i class='fas fa-square <?php echo $classe ?>'></i>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=carac&id=<?php echo $id ?>" class="text-secondary" title="Adicionar Características">
                                    <?php echo $nome ?>
                                </a>
                            </td>
                            <td><img src="../../img/produtos/<?php echo $imagem ?>" width="50px"> </img></td>
                            <td>R$ <?php echo $valor ?></td>
                            <td><?php echo $estoque ?></td>
                            <td><?php echo $nome_subcategoria ?></td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=imagens&id=<?php echo $id ?>" class='text-info mr-1' title='Inserir Imagens'><i class='fas fa-images'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=promocao&id=<?php echo $id ?>" class='text-success mr-1' title='Inserir Promoção'>

                                    <?php
                                    if ($promocao == 'Sim') {
                                        echo "<i class='fas fa-dollar-sign " . $classe2 . "'></i></a>";
                                    } else {
                                        echo "<i class='fas fa-dollar-sign " . $classe2 . "'></i></a>";
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM produtos where id = '$id2'");

                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $nome2 = $res[0]['nome'];
                    $imagem2 = $res[0]['imagem'];
                    $id_categoria2 = $res[0]['id_categoria'];
                    $id_subcategoria2 = $res[0]['id_subcategoria'];
                    $valor2 = $res[0]['valor'];
                    $estoque2 = $res[0]['estoque'];
                    $descricao2 = $res[0]['descricao'];
                    $descricao_longa2 = $res[0]['descricao_longa'];
                    $tipo_envio2 = $res[0]['tipo_envio'];
                    $palavras2 = $res[0]['palavras'];
                    $ativo2 = $res[0]['ativo'];
                    $peso2 = $res[0]['peso'];
                    $largura2 = $res[0]['largura'];
                    $altura2 = $res[0]['altura'];
                    $comprimento2 = $res[0]['comprimento'];
                    $modelo2 = $res[0]['modelo'];
                    $valor_frete2 = $res[0]['valor_frete'];
                    $link2 = $res[0]['link'];
                } else {
                    $titulo = "Inserir Registro";
                }
                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-inserir-editar-produto" method="POST">


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" value="<?php echo @$nome2 ?>" class="form-control form-control-sm" id="nome" name="nome" placeholder="Nome">
                            </div>

                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control form-control-sm" name="categoria" id="categoria">
                                    <?php
                                    if (@$_GET['funcao'] == 'editar') {
                                        $query = $pdo->query("SELECT * from categorias where id = '$id_categoria2' ");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $nome_categoria = $res[0]['nome'];
                                        echo "<option value='" . $id_categoria2 . "' >" . $nome_categoria . "</option>";
                                    }

                                    $query2 = $pdo->query("SELECT * from categorias order by nome asc ");
                                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($res2); $i++) {
                                        foreach ($res2[$i] as $key => $value) {
                                        }

                                        if (@$nome_categoria != $res2[$i]['nome']) {
                                            echo "<option value='" . $res2[$i]['id'] . "' >" . $res2[$i]['nome'] . "</option>";
                                        }
                                    }


                                    ?>
                                </select>
                                <input type="hidden" id="txtCat" name="txtCat">
                                <input value="<?php echo $id_subcategoria2 ?>" type="hidden" id="txtSub" name="txtSub"> <!-- passa a subcategoria atual para o listar-subcat.php -->
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Categoria</label>
                                <span id="listar-subcat"></span>

                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição Curta <small>(500 caracteres) </small> </label>
                                <textarea class="form-control form-control-sm" id="descricao" name="descricao" maxlength="500"><?php echo @$descricao2 ?></textarea>
                            </div>


                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição Longa </label>
                                <textarea class="form-control form-control-sm" id="descricao_longa" name="descricao_longa"><?php echo @$descricao_longa2 ?></textarea>
                                <!-- sem limite de caracteres -->
                            </div>


                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Valor </label>
                                <input type="text" value="<?php echo @$valor2 ?>" class="form-control form-control-sm" id="valor" name="valor" placeholder="valor">
                            </div>

                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Estoque </label>
                                <input type="number" value="<?php echo @$estoque2 ?>" class="form-control form-control-sm" id="estoque" name="estoque">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo Envio </label>
                                <select class="form-control form-control-sm" name="tipo_envio" id="tipo_envio">

                                    <?php

                                    if (@$_GET['funcao'] == 'editar') {

                                        $query3 = $pdo->query("SELECT * FROM tipo_envios where id = '$tipo_envio2'");
                                        $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                                        $nome_tipo_envio = $res3[0]['tipo'];

                                        echo "<option value='" . $tipo_envio2 . "'>" . $nome_tipo_envio . "</option>";
                                    }

                                    //mesmo que já tenha categoria (ou seja, se for edição), é possível trocá-la, para isso é necessário listar todas

                                    $query4 = $pdo->query("SELECT * FROM tipo_envios order by tipo asc");
                                    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

                                    for ($i = 0; $i < count($res4); $i++) {
                                        foreach ($res4[$i] as $key => $value) {
                                        }

                                        if (@$tipo_envio2 != $res4[$i]['tipo']) { //arroba pois tipo_envio não existe na inserção
                                            echo "<option value='" . $res4[$i]['id'] . "'>" . $res4[$i]['tipo'] . "</option>";
                                        }
                                    }
                                    ?>

                                </select>


                            </div>


                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ativo </label>

                                <select class="form-control form-control-sm" name="ativo" id="ativo">

                                    <?php

                                    if (@$_GET['funcao'] == 'editar') {

                                        echo "<option value='" . $ativo2 . "'>" . $ativo2 . "</option>";
                                    }

                                    if (@$ativo2 != 'Sim') {
                                        echo "<option value='Sim'> Sim </option>";
                                    }

                                    if (@$ativo2 != 'Não') {
                                        echo "<option value='Não'> Não </option>";
                                    }


                                    ?>
                                </select>

                            </div>


                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Palavras Chave </label>
                                <input type="text" value="<?php echo @$palavras2 ?>" class="form-control form-control-sm" id="palavras" name="palavras">
                            </div>


                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Link </label>
                                <input type="text" value="<?php echo @$link2 ?>" class="form-control form-control-sm" id="link" name="link">
                            </div>


                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Peso (kg) <small> - Ex.: para 20g, preencha 0.02 </small> </label>
                                <input type="text" value="<?php echo @$peso2 ?>" class="form-control form-control-sm" id="peso" name="peso">
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Largura (cm) <small> - Ex.: para 1,5m, preencha 150 </small> </label>
                                <input type="text" value="<?php echo @$largura2 ?>" class="form-control form-control-sm" id="largura" name="largura">
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Altura (cm) </label>
                                <input type="text" value="<?php echo @$altura2 ?>" class="form-control form-control-sm" id="altura" name="altura">
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Comprimento (cm) </label>
                                <input type="text" value="<?php echo @$comprimento2 ?>" class="form-control form-control-sm" id="comprimento" name="comprimento">
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Modelo </label>
                                <input type="text" value="<?php echo @$modelo2 ?>" class="form-control form-control-sm" id="modelo" name="modelo">
                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Valor Frete </label>
                                <input type="text" value="<?php echo @$valor_frete2 ?>" class="form-control form-control-sm" id="valor_frete" name="valor_frete">
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg()">
                                <!-- com o onChange, todas as vezes que eu alterar a imagem, ele irá chamar uma função que irá alterar a imagem chamando o id dela na div dela -->
                            </div>

                            <?php

                            if (@$imagem2 != '') { //editar
                            ?>
                                <img src="../../img/produtos/<?php echo $imagem2 ?>" alt="" width="100px" id="target-imagem">

                            <?php
                            } else { //inserir (ou editar, se não tiver sido colocada outra imagem diferente de 'sem-foto.jgp' antes)
                            ?>

                                <img src="../../img/produtos/sem-foto.jpg" alt="" width="100px" id="target-imagem">

                            <?php
                            }
                            ?>


                        </div>
                    </div>

                    <small>
                        <div id="mensagem-inserir-editar-produto" align="center" style="margin-top:10px">

                        </div>
                    </small>

            </div>

            <div class="modal-footer">

                <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2"> <!-- chamei de txtid2, pois index.php que carrega subcategorias.php já tem txtid -->
                <input value="<?php echo @$nome2 ?>" type="hidden" name="antigoNomeProduto" id="antigoNomeProduto">
                <!-- passa o antigoNome pois se houver alteração de nome, tem que ser feita a verificação se o nome da nova categoria já existe no banco de dados -->

                <button type="button" id="btn-fechar-produto" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" name="btn-salvar-produto" id="btn-salvar-produto" class="btn btn-primary">Salvar</button>
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

<!-- modal imagens -->

<div class="modal" id="modal-imagens" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Imagem do Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-fotos" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12 form-group">
                                <label>Imagens do Produto</label>
                                <input type="file" class="form-control-file" id="img-produto" name="img-produto" onchange="carregarImgs();">

                            </div>

                            <div class="col-md-12 mb-2">
                                <img src="../../img/produtos/detalhes/sem-foto.jpg" alt="Carregue sua Imagem" id="target-imagens" width="100">
                            </div>

                        </div>

                        <div class="col-md-7" id="listar-imagens">

                        </div>




                    </div>

                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-fotos">Cancelar</button>

                        <input type="hidden" id="id_produto" name="id_produto" value="<?php echo @$_GET['id'] ?>"> <!-- passa id do produto no form -->

                        <button type="submit" id="btn-fotos" name="btn-fotos" class="btn btn-info">Salvar</button>

                    </div>


                    <small>
                        <div align="center" id="mensagem_fotos" class="">

                        </div>
                    </small>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- modal deletar imagens -->

<div class="modal" id="modalDeletarImg" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir esta Imagem?</p>

                <div align="center" id="mensagem_excluir_img" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-img">Cancelar</button>
                <form method="post">
                    <input type="hidden" name="id_foto" id="id_foto">
                    <button type="button" id="btn-deletar-img" name="btn-deletar-img" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal carac -->

<div class="modal" id="modal-carac" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Característica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form" method="post">
                    <!-- abertura do form -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Característica</label>
                                <select class="form-control form-control-sm" name="id_carac" id="id_carac">
                                    <?php

                                    $query3 = $pdo->query("SELECT * FROM carac order by nome asc");
                                    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);

                                    for ($i = 0; $i < count($res3); $i++) {
                                        foreach ($res3[$i] as $key => $value) {
                                        }

                                        echo "<option value='" . $res3[$i]['id'] . "'>" . $res3[$i]['nome'] . "</option>";
                                    }
                                    ?>

                                </select>

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div id="listar-carac">

                            </div>

                        </div>
                    </div>


                    <div align="center" id="mensagem-carac">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-carac">Cancelar</button>

                <input type="hidden" id="id_prod_carac" name="id_prod_carac" value="<?php echo @$_GET['id'] ?>"> <!-- id do produto -->

                <button type="button" id="btn-add-carac" name="btn-add-carac" class="btn btn-success">Adicionar</button>
                </form> <!-- fechamento do form -->

            </div>

        </div>
    </div>
</div>


<!-- modal deletar carac -->
<!-- tem que vir depois da modal-carac, pois ela abre "dentro dela", e se vier primeiro, vai abrir atrás dela, e não na frente -->

<div class="modal" id="modalDeletarCarac" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Característica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir esta Característica?</p>

                <div align="center" id="mensagem_excluir_carac" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir-carac">Cancelar</button>
                <form method="post">
                    <input type="text" name="id_carac_deletar" id="id_carac_deletar">
                    <button type="button" id="btn-deletar-carac" name="btn-deletar-carac" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal add item à carac -->

<div class="modal" id="modalAddItem" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form id="form" method="post">

                    <input type="hidden" name="id_carac_item_2" id="id_carac_item_2">

                    <a id="btn-item-listar" name="btn-item-listar"></a>


                </form>

                <form id="form" method="post">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descrição do Item</label>
                                <input type="text" value="<?php echo @$nome_item ?>" class="form-control" id="nome_item" name="nome_item">
                            </div>
                            <div class="form-group">
                                <label>Valor do Item<small>(Exemplo: código hexadecimal da cor do item)</small></label>
                                <input type="text" value="<?php echo @$valor_item ?>" class="form-control" id="valor_item" name="valor_item">
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div id="listar-itens">

                            </div>
                        </div>



                    </div>

                    <div align="center" id="mensagem_add_item" class="">

                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_carac_item_1" id="id_carac_item_1">


                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-add-item">Cancelar</button>
                <button type="button" id="btn-add-item" name="btn-add-item" class="btn btn-info">Adicionar</button>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- modal deletar item -->
<!-- tem que ser colocada embaixo da modalAddItem, pois abre dentro dela, e se vier primeiro no código, vai ficar atrás -->

<div class="modal" id="modalDeletarItem" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Item?</p>

                <div align="center" id="mensagem_excluir_item" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir-item">Cancelar</button>
                <form method="post">
                    <input type="hidden" name="id_item_carac_deletar" id="id_item_carac_deletar">
                    <button type="button" id="btn-deletar-item" name="btn-deletar-item" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal add promoção -->

<div class="modal" id="modalAddPromocao" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Promoção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <form id="form-promocao" method="post">

                <div class="modal-body">


                    <?php
                    $id_produto = @$_GET['id'];

                    $query = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_produto'");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    if (@count($res) > 0) { //se for edição
                        $ativo_promocao2 = @$res[0]['ativo'];
                        $data_inicio = $res[0]['data_inicio'];
                        $data_final = $res[0]['data_final'];
                        $desconto_promocao = $res[0]['desconto'];
                        $valor_promocao = $res[0]['valor'];
                    } else { //se for inserção
                        $data_inicio = $agora;
                        $data_final = $agora;
                        $ativo_promocao2 = @$res[0]['ativo'];
                    }


                    ?>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="valor_promocao">% do Desconto <small>(Ex.: 20, 30)</small></label>
                                <input type="number" class="form-control" id="desconto_promocao" name="desconto_promocao" value="<?php echo @$desconto_promocao ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="ativo_promocao">Ativa </label>

                                <select class="form-control form-control-sm" name="ativo_promocao" id="ativo_promocao">

                                    <?php

                                    if (@count($res) > 0) {

                                        echo "<option value='" . $ativo_promocao2 . "'>" . $ativo_promocao2 . "</option>";
                                    }

                                    if (@$ativo_promocao2 != 'Sim') {
                                        echo "<option value='Sim'> Sim </option>";
                                    }

                                    if (@$ativo_promocao2 != 'Não') {
                                        echo "<option value='Não'> Não </option>";
                                    }


                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_inicio_promocao">Data Início</label>
                                <input type="date" class="form-control" id="data_inicio_promocao" name="data_inicio_promocao" value="<?php echo $data_inicio ?>">
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="data_final_promocao">Data Final</label>
                                <input type="date" class="form-control" id="data_final_promocao" name="data_final_promocao" value="<?php echo $data_final ?>">
                            </div>

                        </div>
                    </div>

                    <?php

                    if (@$desconto_promocao > 0) {

                    ?>
                        <p class="text-muted">Valor promocional = R$ <?php echo @$valor_promocao ?></p>

                    <?php

                    }

                    ?>

                    <div align="center" id="mensagem_add_promocao" class="">

                    </div>


                </div>



                <div class="modal-footer">
                    <input type="hidden" name="id_produto_promocao" id="id_produto_promocao" value="<?php echo @$_GET['id'] ?>">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-promocao">Cancelar</button>
                    <button type="button" id="btn-add-promocao" class="btn btn-info">Salvar</button>
                    <!-- deixei texto do botão como Salvar ao invés de Adicionar/Inserir, pois pode ser edição de uma promoção -->
                </div>

            </form>

        </div>

    </div>

</div>

<!--SCRIPT EXECUTADO AO CARREGAR A PÁGINA -->
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('txtCat').value = document.getElementById('categoria').value; //campo que recebe o valor do input do select da categoria na modal de Edição / Inserção
        listarSubCat();
        listarImagens();
        listarCarac();
    })
</script>

<script type="text/javascript">
    function listarSubCat() {

        var pag = "<?= $pag ?>"

        $.ajax({
            url: pag + "/listar-subcat.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function(result) {

                $('#listar-subcat').html(result);
            }
        })
    }
</script>


<!-- Script para buscar pelo select -->
<script type="text/javascript">
    $('#categoria').change(function() { //quando mudar a categoria escolhida no select
        document.getElementById('txtCat').value = $(this).val();
        document.getElementById('txtSub').value = ""; //limpa o input de subcategoria para na edição quando trocar a categoria, carregar as novas subcategorias dela, antes durante a aula do autor na edição do produto ele trocava de categoria e as subcategorias dela não apareciam, permaneciam as antigas, porém, no meu estava dando certo não sei porquê 
        listarSubCat();
    })
</script>

<!--SCRIPT PARA CARREGAR IMAGEM PRINCIPAL DO PRODUTO -->
<script type="text/javascript">
    function carregarImg() {

        var target = document.getElementById('target-imagem');
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

<!--SCRIPT PARA CARREGAR IMAGENS SECUNDÁRIAS DO PRODUTO -->
<script type="text/javascript">
    function carregarImgs() {

        var target = document.getElementById('target-imagens');
        var file = document.querySelector("input[id=img-produto]").files[0]; //pega um input qualquer do tipo file
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
    $("#form-inserir-editar-produto").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem-inserir-editar-produto').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#mensagem-inserir-editar-produto').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem-inserir-editar-produto').text(mensagem)

                    //$('#btn-fechar-editar-inserir-categoria').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem-inserir-editar-produto').addClass('text-danger')
                    $('#mensagem-inserir-editar-produto').text(mensagem)

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

<!--AJAX PARA INSERÇÃO E EDIÇÃO DAS IMAGENS SECUNDÁRIAS DO PRODUTO -->
<script type="text/javascript">
    $("#form-fotos").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this); //não tem quando se trabalha apenas com type="text"

        $.ajax({
            url: pag + "/inserir-imagens.php",
            type: 'POST', //pode ser method ao invés de type?
            data: formData,

            success: function(mensagem) {

                $('#mensagem_fotos').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#mensagem_fotos').addClass('text-success')
                    //$('#nome').val('');
                    //$('#cpf').val('');

                    $('#mensagem_fotos').text(mensagem)
                    listarImagens();
                    //$('#btn-fechar-editar-inserir-categoria').click();
                    //window.location = "index.php?pag=" + pag; //refresh na página

                } else {

                    $('#mensagem_fotos').addClass('text-danger')
                    $('#mensagem_fotos').text(mensagem)

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

<!-- AJAX PARA LISTAR IMAGENS SECUNDÁRIAS -->

<script type="text/javascript">
    function listarImagens() {

        var pag = "<?= $pag ?>"

        $.ajax({
            url: pag + "/listar-imagens.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function(result) {

                $('#listar-imagens').html(result);
            }
        })
    }
</script>

<!-- AJAX PARA LISTAR CARACTERÍSTICAS -->

<script type="text/javascript">
    function listarCarac() {

        var pag = "<?= $pag ?>"

        $.ajax({
            url: pag + "/listar-carac.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function(result) {

                $('#listar-carac').html(result);
            }
        })
    }
</script>

<!-- AJAX PARA LISTAR ITENS DAS CARACTERÍSTICAS -->

<script type="text/javascript">
    $('#btn-item-listar').click(function(event) {
        event.preventDefault();
        var pag = "<?= $pag ?>"

        $.ajax({
            url: pag + "/listar-itens.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function(result) {

                $('#listar-itens').html(result);
            }
        })
    })
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

<!--FUNCAO PARA CHAMAR MODAL DE DELETAR IMAGEM DAS FOTOS -->
<script type="text/javascript">
    function deletarImg(img) {
        document.getElementById('id_foto').value = img;
        $('#modalDeletarImg').modal('show');
    }
</script>

<!--FUNCAO PARA CHAMAR MODAL DE DELETAR CARAC DOS PRODUTOS -->
<script type="text/javascript">
    function deletarCarac(id) {

        document.getElementById('id_carac_deletar').value = id;
        $('#modalDeletarCarac').modal('show');

    }
</script>

<!--FUNCAO PARA CHAMAR MODAL DE DELETAR ITEM DAS CARAC DOS PRODUTOS -->
<script type="text/javascript">
    function deletarItem(id) {

        document.getElementById('id_item_carac_deletar').value = id;
        $('#modalDeletarItem').modal('show');

    }
</script>

<!--FUNCAO PARA CHAMAR MODAL DE ADD ITEM A CARAC -->
<script type="text/javascript">
    function addItem(id) {

        document.getElementById('id_carac_item_1').value = id;
        document.getElementById('id_carac_item_2').value = id;

        $('#btn-item-listar').click(); //execução do botão
        //executando o botão ele tem que enviar um post com o campo id_carac_item_2

        $('#modalAddItem').modal('show');

    }
</script>

<!--AJAX PARA EXCLUSÃO DAS IMAGENS SECUNDÁRIAS -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-deletar-img').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir-imagens.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!') {

                        $('#mensagem_fotos').addClass('text-success')
                        $('#mensagem_fotos').text(mensagem)

                        $('#btn-cancelar-img').click();
                        //window.location = "index.php?pag=" + pag;
                        listarImagens();
                    } else {
                        $('#mensagem_fotos').addClass('text-danger')
                        $('#mensagem_fotos').text(mensagem)

                    }

                },

            })
        })
    })
</script>

<!--AJAX PARA EXCLUSÃO DAS CARACTERÍSTICAS -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-deletar-carac').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir-carac.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!') {

                        //$('#btn-cancelar-excluir-carac').click();
                        //window.location = "index.php?pag=" + pag;
                        listarCarac();
                        $('#btn-cancelar-excluir-carac').click()
                    } else {
                        $('#mensagem_excluir_carac').addClass('text-danger')
                        $('#mensagem_excluir_carac').text(mensagem)

                    }

                },

            })
        })
    })
</script>


<!--AJAX PARA EXCLUSÃO DOS ITENS DAS CARACTERÍSTICAS -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-deletar-item').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: pag + "/excluir-item.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!') {

                        $('#btn-item-listar').click(); //execução do botão
                        $('#btn-cancelar-excluir-item').click(); //fechar modal de excluir item

                    } else {

                        $('#mensagem_excluir_item').addClass('text-danger')
                        $('#mensagem_excluir_item').text(mensagem)

                    }

                },

            })
        })
    })
</script>

<!-- ajax para caracteristicas -->

<script type="text/javascript">
    var pag = "<?= $pag ?>";

    $('#btn-add-carac').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: pag + '/add-carac.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Característica Adicionada com Sucesso!') {

                    $('#mensagem-carac').removeClass();
                    $('#mensagem-carac').addClass('text-success')

                    $('#mensagem-carac').text(msg);
                    listarCarac()

                } else {
                    $('#mensagem-carac').removeClass();
                    $('#mensagem-carac').addClass('text-danger')

                    $('#mensagem-carac').text(msg);

                }
            }
        })

    })
</script>

<!-- ajax para add item às características -->

<script type="text/javascript">
    $('#btn-add-item').click(function(event) {
        event.preventDefault();
        var pag = "<?= $pag ?>";

        $.ajax({
            url: pag + '/add-item.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Item Adicionado com Sucesso!') {

                    $('#mensagem_add_item').removeClass();
                    $('#mensagem_add_item').addClass('text-success')

                    $('#mensagem_add_item').text(msg);
                    $('#btn-item-listar').click(); //execução do botão
                    $('#nome_item').val(''); //limpa descrição do nome item
                    $('#nome_item').focus(); //coloca cursor do mouse nesse input
                    $('#valor_item').val(''); //limpa valor do item

                } else {
                    $('#mensagem_add_item').removeClass();
                    $('#mensagem_add_item').addClass('text-danger')

                    $('#mensagem_add_item').text(msg);

                }
            }
        })

    })
</script>

<!-- ajax para add promoção -->

<script type="text/javascript">
    $('#btn-add-promocao').click(function(event) {
        event.preventDefault();
        var pag = "<?= $pag ?>";

        $.ajax({
            url: pag + '/add-promocao.php',
            method: 'post',
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Promoção Inserida com Sucesso!') {

                    $('#btn-cancelar-promocao').click();
                    window.location = "index.php?pag=" + pag; //refresh na página

                } else {
                    $('#mensagem_add_promocao').removeClass();
                    $('#mensagem_add_promocao').addClass('text-danger')

                    $('#mensagem_add_promocao').text(msg);

                }
            }
        })

    })
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

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "imagens") {
    echo "<script>$('#modal-imagens').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "carac") {
    echo "<script>$('#modal-carac').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "promocao") {
    echo "<script>$('#modalAddPromocao').modal('show');</script>";
}

?>