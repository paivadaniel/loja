<?php

require_once("../../../conexao.php");

$id_venda = $_POST['id_venda'];


echo ' 
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Produto</th>
      <th scope="col">Valor</th>
    </tr>
  </thead>
  <tbody>
';

$query = $pdo->query("SELECT * from carrinho where id_venda = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
  foreach ($res[$i] as $key => $value) {
  }

  $id_produto = $res[$i]['id_produto'];

  $query2 = $pdo->query("SELECT * from produtos where id = '$id_produto'");
  $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
  
  $nome_produto = $res2[$i]['nome'];
  $valor_produto = $res2[$i]['valor'];


  $valor_produto = number_format($valor_produto, 2, ',', '.');
  //$total_item = number_format($total_item, 2, ',', '.');

  echo ' 
    <tr> 
    
    <td>'.$nome_produto.'</td>
    <td>R$ '.$valor_produto.'</td>

    </tr>
    </tbody>
    ';
    
} //fechamento for

echo '   

</table>

';

?>
