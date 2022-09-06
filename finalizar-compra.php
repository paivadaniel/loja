<?php

require_once('conexao.php');

@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$total_compra = $_POST['total_compra'];
$valor_frete = $_POST['valor_frete']; //valor do frete, não é valor do frete fixo, tem que mudar o nome da variável $valor_frete no checkout.php para não dar confusão
$existe_frete = $_POST['existe_frete'];

$antigoCpf = $_POST['antigoCpf']; //se o usuário trocar de cpf na página de checkout, compara-se o cpf antigo com o nome digitado, se forem diferentes, ele trocou o cpf, e então verifica se o novo cpf digitado já não se encontra no banco de dados

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$complemento = $_POST['complemento'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$comentario = $_POST['comentario'];
$cep = $_POST['cep'];

//ERRO_ALGORITMO
//está dando problema para fazer essa subtração por causa de ser string, em checkout.php eu converti para float com parseFloat, autor não teve o mesmo problema, o problema é no total_compra, pois o frete está sendo passado com ponto para o banco de dados
//$subtotal = $total_compra - $valor_frete;
$subtotal = 0;

if ($existe_frete == 'Sim') {
    if ($valor_frete == '0' || $valor_frete == "") {
        echo "Selecione um CEP válido!";
        exit();
    }
}

if ($nome == "") {
    echo 'Preencha o Campo Nome!';
    exit();
}

if ($logradouro == "") {
    echo 'Preencha o Campo Logradouro!';
    exit();
}

if ($numero == "") {
    echo 'Preencha o Campo Número!';
    exit();
}

if ($bairro == "") {
    echo 'Preencha o Campo Bairro!';
    exit();
}

$res = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email where id = '$id_usuario'");

$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":cpf", $cpf);

$res->execute();

//não usou id_usuario no where da tabela clientes, pois o id na tabela clientes é diferente do da id do usuário na tabela usuários, o único campo comum entre eles é o cpf, por isso se chama chave estrangeira, que é o campo comum à duas tabelas
//antigoCpf carrega o cpf atual, ou se ele mudar, antigoCpf carrega o antigo
$res = $pdo->prepare("UPDATE clientes SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, logradouro = :logradouro, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep where cpf = '$antigoCpf' ");
$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":logradouro", $logradouro);
$res->bindValue(":numero", $numero);
$res->bindValue(":complemento", $complemento);
$res->bindValue(":bairro", $bairro);
$res->bindValue(":cidade", $cidade);
$res->bindValue(":estado", $estado);
$res->bindValue(":cep", $cep);

$res->execute();

$res = $pdo->prepare("INSERT vendas SET total = :total, frete = :frete, subtotal = :subtotal, id_usuario = '$id_usuario', pago = 'Não', data = curDate()");
$res->bindValue(":total", $total_compra);
$res->bindValue(":frete", $valor_frete);
$res->bindValue(":subtotal", $subtotal);

$res->execute();

//tem que vir exatamente aqui (e não acima), após a tabela de vendas, para recuperar o último id inserido
$id_venda = $pdo->lastInsertId();

//MUDAR ID DA VENDA NA TABELA CARRINHOS, DE 0 (VENDA EM ANDAMENTO) PARA ID_VENDA
//depois de executar a query a seguir, se atualizar o carrinho, sumiram os itens colocados no carrinho, pois em carrinho/listar-carrinho.php temos uma query que seleciona apenas itens com id_venda = 0
$pdo->query("UPDATE carrinho SET id_venda = '$id_venda' where id_usuario = '$id_usuario' and id_venda = '0'");


if ($comentario != "") {
    $res = $pdo->prepare("INSERT mensagens SET id_venda = :id_venda, mensagem = :mensagem, lida = :lida");
    $res->bindValue(":id_venda", $id_venda);
    $res->bindValue(":mensagem", $comentario);
    $res->bindValue(":lida", 'Não');
    $res->execute();
}

echo "Editado com Sucesso!";
