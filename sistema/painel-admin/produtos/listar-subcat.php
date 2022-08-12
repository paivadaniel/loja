<?php

require_once('../../../conexao.php');

$id_categoria_select = $_POST['txtCat']; //pega o id da categoria do SELECT em produtos.php
$id_subcategoria_select = $_POST['txtSub']; //pega o id da subcategoria do SELECT em produtos.php

//lista as subcategorias no select de acordo com a categoria
echo "<select class='sm-width form-control form-control-sm' name='subcategoria' id='subcategoria'>";

//if (@$_GET['funcao'] == 'editar') { //não pega o GET aqui
if (@$id_subcategoria_select > 0) { //para ser usado na edição, apesar de que na inserção também entra aqui pois quando se escolhe uma categoria, automaticamente se escolhe uma subcategoria daquela no select
    $query2 = $pdo->query("SELECT * from subcategorias where id = '$id_subcategoria_select'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    if (@count($res2)) { //tem que ter esse contador, se não mesmo na inserção vai entrar aqui, e daí vai mostrar um id vazio e um nome_subcategoria vazio
        $nome_subcategoria = $res2[0]['nome'];
        echo "<option value='" . $id_subcategoria_select . "' >" . $nome_subcategoria . "</option>";
    }
}

//mostra o restante da lista
$query = $pdo->query("SELECT * FROM subcategorias where id_categoria = '$id_categoria_select' order by nome asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    if ($id_subcategoria_select != $res[$i]['id']) {
        echo "<option value='" . $res[$i]['id'] . "'>" . $res[$i]['nome'] . "</option>";
    }
}

echo "</select>";
