<?php

require_once("../conexao.php");
$pagina = 'produtos';
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

//cabeçalho do carrinho
echo '
                    
                        <div class="cart-inline-header">
                    
                         <!-- corpo do carrinho -->
                     
                         <div class="shoping__cart__table">
                         <table>';

$res = $pdo->query("SELECT * from carrinho where id_usuario = '$id_usuario' and id_venda = 0 order by id asc"); //id_venda = 0 pois a venda ainda não ocorreu
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

if ($linhas == 0) {
  $linhas = 0;
  $total = 0;
}

$total;

for ($i = 0; $i < count($dados); $i++) {
  foreach ($dados[$i] as $key => $value) {
  }

  $id_produto = $dados[$i]['id_produto'];
  $quantidade = $dados[$i]['quantidade'];
  $id_carrinho = $dados[$i]['id'];
  $combo = $dados[$i]['combo'];

  if ($combo == 'Sim') { //para combos
    $res_p = $pdo->query("SELECT * from combos where id = '$id_produto' ");
    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);

    $valor_produto = $dados_p[0]['valor'];

    $pasta = 'combos';
  } else { //para produtos
    $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);

    $valor_produto = $dados_p[0]['valor'];
    $promocao_produto = @$dados_p[0]['promocao'];

    if ($promocao_produto == 'Sim') { //para produtos em promoção
      $res_p2 = $pdo->query("SELECT * from promocoes where id_produto = '$id_produto' ");
      $dados_p2 = $res_p2->fetchAll(PDO::FETCH_ASSOC);
      $valor_produto = $dados_p2[0]['valor'];
    }

    $pasta = 'produtos';
  }

  $nome_produto = $dados_p[0]['nome'];
  $imagem_produto = $dados_p[0]['imagem'];

  $total_item = $valor_produto * $quantidade;
  @$total = @$total + $total_item;

  $valor_produto = number_format($valor_produto, 2, ',', '.');
  $total_item = number_format($total_item, 2, ',', '.');

  echo ' 
    <tr> 
    <td class="shoping__cart__item">
                            
    <img src="img/' . $pasta . '/' . $imagem_produto . '" alt="" width="60">
    <h5>' . $nome_produto  . '
    <a href="#" title="Incluir/Editar Características" class="ml-1" onclick="addCarac(' . $id_produto . ', ' . $id_carrinho . ')"><i class="fa fa-edit text-info"></i></a>
   </h5>
   </td>

<td width="150" align="left" class="shoping__cart__item">

<span class="mt-4 d-none d-sm-none d-md-block" align="center" id="listar-carac-itens2">';
   
$query2 = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id_carrinho'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_carac = @count($res2);

if($total_carac == 0 and $combo != 'Sim') { //se não tiver característica adicionada ao produto (o autor exibiu a frase "Selecionar Característica", porém, e se o produto não exigir que uma categoria seja selecinada? Por exemplo, um boné com cor padrão preta, por isso escolhi exibir "Nenhuma Característica Selecionada", e optei por não colocar nessa frase link com onclick levando para a modal de seleção de característica)
//não será permitido selecionar características para combos, portanto, não exibe a mensagem "Nenhuma Característica Selecionada" 
  echo '<span class="mr-2">Nenhuma Característica Selecionada</span>';
} else { //se tiver característica selecionada do produto, lista cada uma delas

for ($i2 = 0; $i2 < count($res2); $i2++) {
    foreach ($res2[$i2] as $key => $value) {
    }

/*
não foi necessário fazer:

$res2 = $res2[$i2]['id_carac']
$query3 = $pdo->query(SELECT * from carac WHERE id = '$id_carac')
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);

$res3 = $res3[0]['nome']

pois coloquei nome_carac na tabela carac_itens_carrinho

*/

    echo '<span class="mr-2"><i class="fa fa-check text-info"></i> ' . $res2[$i2]['nome_carac'] . ': ' . $res2[$i2]['nome_item'] .'</span>';

  } //fechamento if
} //fechamento for


echo '</span>

</td>

   <td class="shoping__cart__price">
   R$ ' . $total_item . '
</td>

<td class="shoping__cart__quantity">
<div class="quantity">
  <div class="pro-qty">

    <input onchange="editarCarrinho(' . $id_carrinho . ')" type="text" data-zeros="true" value="' . $quantidade . '" min="1" max="1000" id="quantidade">

</div>
</div>
</td>
   
<td class="shoping__cart__item__close">
<a onclick="deletarCarrinho(' . $id_carrinho . ')" id="btn-deletar" href="" class="ml-2" title="Remover Item do Carrinho">
<span class="icon_close"></span>
</a>
</td>

</tr>';
}

//rodapé do carrinho
echo '   

</table>
                          </div>
                          
</div>


';

$total = number_format($total, 2, ',', '.');

?>

<!--SCRIPT PARA ALTERAR O INPUT NUMBER -->
<script type="text/javascript">
  jQuery('<span class="dec qtybtn">-</span>').insertBefore('.pro-qty input');
  jQuery('<span class="inc qtybtn">+</span>').insertAfter('.pro-qty input');
  jQuery('.pro-qty').each(function() {
    var spinner = jQuery(this),
      input = spinner.find('input[type="text"]'),
      btnUp = spinner.find('.inc'),
      btnDown = spinner.find('.dec'),
      min = input.attr('min'),
      max = input.attr('max');

    btnUp.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      document.getElementById('txtquantidade').value = newVal;
      spinner.find("input").trigger("change");


    });

    btnDown.click(function() {

      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      document.getElementById('txtquantidade').value = newVal;
      spinner.find("input").trigger("change");



    });




  });
</script>


<script type="text/javascript">
  var itens = "<?= $linhas ?>";
  var total = "<?= $total ?>";

  $("#total_itens").text(itens);
  $("#valor_total").text(total);
</script>

