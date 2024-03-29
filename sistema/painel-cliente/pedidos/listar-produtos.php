<?php

require_once("../../../conexao.php");

$id_venda = $_POST['id_venda'];


echo ' 
<table class="table table-light">
  <thead>
    <tr>
      <th scope="col">Produto</th>
      <th scope="col">Características (Se produto) / Produtos (Se combo)</small></th>
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
  $id_carrinho = $res[$i]['id'];
  $combo = $res[$i]['combo'];

  if ($combo != 'Sim') {
    $tabela = 'produtos';
  } else {
    $tabela = 'combos';
  }

  $query2 = $pdo->query("SELECT * from $tabela where id = '$id_produto'");
  $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

  $nome_produto = $res2[0]['nome'];
  $valor_produto = $res2[0]['valor'];
  $tipo_envio = $res2[0]['tipo_envio'];
  $link = $res2[0]['link'];

  $valor_produto = number_format($valor_produto, 2, ',', '.');
  //$total_item = number_format($total_item, 2, ',', '.');

  $query_v = $pdo->query("SELECT * from vendas where id = '$id_venda'");
  $res_v = $query_v->fetchAll(PDO::FETCH_ASSOC);
  $pago = $res_v[0]['pago'];

  if ($tipo_envio == 4 and $link != "") { //tipo_envio = 4 é digital, link != "" é o link para acessar o produto digital, e pago = Sim se o pagamento da compra foi aprovado

    if ($pago == 'Sim') { //se estiver pago

      //para chamar a avaliar tentei passar o combo também, mas não consegui, fiz: (' . $id_produto   . '. '. $combo . ')"
      echo ' 
  <tr> 
  
  <td> 
  
  
<a href="" class="text-dark mr-2" onclick="avaliar(' . $id_produto . ')" title="Avaliar Produto">
  <i class="fa fa-star text-warning mr-1"></i>' .$nome_produto . '
</a>

<a href="' . $link . '" title="Acessar Produto Digital" target="_blank"> Acessar </a></td>';
    } else { //se produto digital com link não estiver pago

      echo '
      <tr> 
  
      <td>' . $nome_produto . '</td>';
    }
  } else { //para produto não digital, ou para produto digital sem link preenchido (o administrador pode enviar o link do curso para o cliente usando outra forma)

    if ($pago == 'Sim') {

      echo '
      <tr> 
 
      <td> <a href="" class="text-dark" onclick="avaliar(' . $id_produto . ')" title="Avaliar Produto">
      <i class="fa fa-star text-warning mr-1"></i>' . $nome_produto . '</a></td>';
    } else {
      echo ' 
      <tr> 
      
      <td>' . $nome_produto . '</td>';
    }
  }

  if ($combo != 'Sim') {

    $query_c = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto'");
    $res_c = $query_c->fetchAll(PDO::FETCH_ASSOC);
    $total_prod_carac = @count($res_c);

    if ($total_prod_carac > 0) { //isto é, se o produto tiver características a adicionar

      $query2 = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id_carrinho'");
      $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
      $total_carac = @count($res2);

      for ($i2 = 0; $i2 < count($res2); $i2++) {
        foreach ($res2[$i2] as $key => $value) {
        }


        echo '<td><span class="ml-4"> ' . $res2[$i2]['nome_carac'] . ': ' . $res2[$i2]['nome_item'] . '</span></td>';
      } //fechamento for

    } else { //se for produto e não tiver características a adicionar
      echo '<td></td>';
    }
  } else { //se for combo, mostra os produtos do combo

    $query2 = $pdo->query("SELECT * from prod_combos where id_combo = '$id_produto'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    echo '<td>';
    for ($i2 = 0; $i2 < count($res2); $i2++) {
      foreach ($res2[$i2] as $key => $value) {
      }

      $id_prod_combo = $res2[$i2]['id_produto'];

      $query3 = $pdo->query("SELECT * from produtos where id = '$id_prod_combo'");
      $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);

      echo '<span class="ml-2">' . $res3[0]['nome'] . '</span>';
    }

    echo '</td>';
  }
  echo '
    <td>R$ ' . $valor_produto . '</td>

    </tr>
    </tbody>
    ';
} //fechamento for

echo '   

</table>

';
