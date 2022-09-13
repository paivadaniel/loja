<?php

require_once('conexao.php');

@session_start();

//atualiza o status da venda
//$id_venda não está nessa página, mas para chegar até aprovar_compra.php, obrigatoriamente tem que ser passado via GET o id_venda, e aprovar_compra.php abre como include em páginas que tem declarado $id_venda

$id_venda = '96'; //para TESTAR VENDA coloque o id_venda gerado em carrinho

$query = $pdo->query("SELECT * FROM vendas where id = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_usuario = $res[0]['id_usuario'];
$pago_ven = $res[0]['pago'];

if ($pago_ven != 'Sim') { //para se rodar aprovar_compra.php manualmente mais de uma vez, não incrementar venda e decrementar estoque do mesmo produto que já tinha sido pago

    $pdo->query("UPDATE vendas SET pago = 'Sim' where id = '$id_venda'");

    //incrementar o número de cartões fidelidade do cliente
    $query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $cpf_usuario = $res[0]['cpf'];
    $email_cliente = $res[0]['email'];

    $query2 = $pdo->query("SELECT * FROM clientes where cpf = '$cpf_usuario'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $cartoes = $res2[0]['cartoes'];

    $total_cartoes = $cartoes + 1;

    if ($total_cartoes >= $total_cartoes_troca_cupom) {
        $total_cartoes = 0;

        $data_cupom = date('Y-m-d', strtotime("+" . $dias_uso_cupom . " days")); //data limite para uso do cupom, e não a data de hoje
        $data_cupom_formatada = implode('/', array_reverse(explode('-', $data_cupom)));

        $pdo->query("INSERT INTO cupons (titulo, codigo, valor, data, id_usuario) VALUES ('Cupom por Cartões Fidelidade', '$cpf_usuario', '$valor_cupom_cartao', '$data_cupom', '$id_usuario')");

        //ENVIAR EMAIL PARA O CLIENTE INFORMANDO QUE ELE JUNTOU O NÚMERO DE CARTÕES FIDELIDADE NECESSÁRIO E TEM DIREITO A UTILIZAR UM CUPOM DE DESCONTO NO PRAZO DE X DIAS A PARTIR DA DATA DE RECEBIMENTO DO EMAIL
        $destinatario = $email_cliente;
        $assunto = 'Novo Cupom de Desconto - ' . $nome_loja;
        $remetente = $email_loja;
        $mensagem_email = utf8_decode('Parabéns, você ganhou um novo cupom de desconto no valor de ' . $valor_cupom_cartao . ' reais, poderá usar até o dia ' . $data_cupom_formatada . '. O seu código para uso do cupom é ' . $cpf_usuario);
        $mensagem_sem_codific = 'Parabéns, você ganhou um novo cupom de desconto no valor de ' . $valor_cupom_cartao . ' reais, poderá usar até o dia ' . $data_cupom_formatada . '. O seu código para uso do cupom é ' . $cpf_usuario; //sem utf8_decode
        $cabecalhos = 'From: ' . $remetente;
        @mail($destinatario, $assunto, $mensagem_email, $cabecalhos);

        //informar por mensagem (que ficará no painel-cliente) do cupom ganho da ultima compra
        $pdo->query("INSERT mensagens SET id_venda = '$id_venda', mensagem = '$mensagem_sem_codific', usuario = 'Admin', data = curDate(), hora = curTime()");
    }

    $pdo->query("UPDATE clientes SET cartoes = '$total_cartoes' where cpf = '$cpf_usuario'");

    //incrementa venda e decrementa estoque nos produtos

    $query = $pdo->query("SELECT * FROM carrinho where id_venda = '$id_venda'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < @count($res); $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $id_produto = $res[$i]['id_produto'];
        $combo = $res[$i]['combo']; //Sim (se é combo) ou Não (Se não é combo, ou seja, é produto)

        if ($combo != 'Sim') { //se for produto
            $query2 = $pdo->query("SELECT * FROM produtos where id = '$id_produto'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

            $vendas_produto = $res2[0]['vendas'];
            $estoque_produto = $res2[0]['estoque'];
            $tipo_envio = $res2[0]['tipo_envio'];

            $total_vendas = $vendas_produto + 1;

            if($tipo_envio == 4) { //não decrementa estoque de produto digital, tipo_envio = 4 é produto digital
                $total_estoque = $estoque_produto;
            } else {
                $total_estoque = $estoque_produto - 1; //optei por decrementar o estoque quando o pagamento for confirmado, e não apenas quando em painel-admin/vendas.php o status do produto for alterado para Enviado
            }

            //incrementa uma venda do produto e decrementa estoque na tabela produtos
            $pdo->query("UPDATE produtos SET vendas = '$total_vendas', estoque = '$total_estoque' where id = '$id_produto'");
        } else { //se for combo

            $query3 = $pdo->query("SELECT * FROM combos where id = '$id_produto'");
            $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);

            $vendas_combo = $res3[0]['vendas'];
            //combo não tem estoque

            $total_vendas_combo = $vendas_combo + 1; //está sendo incrementada apenas as vendas do combo, ou seja, não está sendo incrementada também as vendas da tabela de produtos (um combo tem produtos, o mais correto seria incrementar as vendas das duas, e saber que não pode se levar em consideração a tabela de combos para efeitos da contabilização das vendas das unidades de produtos)

            //incrementa uma venda do combo na tabela combos
            $pdo->query("UPDATE combos SET vendas = '$total_vendas_combo' where id = '$id_produto'");

            $query4 = $pdo->query("SELECT * FROM prod_combos where id_combo = '$id_produto'"); //id_produto na verdade é o id do combo
            $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < @count($res4); $i++) {
                foreach ($res4[$i] as $key => $value) {
                }

                $id_produto_combo = $res4[$i]['id_produto'];

                $query5 = $pdo->query("SELECT * FROM produtos where id = '$id_produto_combo'");
                $res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
                $estoque_prod_combo = $res5[0]['estoque'];
                $total_estoque = $estoque_prod_combo - 1;

                $pdo->query("UPDATE produtos SET estoque = '$total_estoque' where id = '$id_produto_combo'");

            }

        }
    }

    //ENVIAR EMAIL PARA O CLIENTE INFORMANDO DA COMPRA
    $destinatario = $email_cliente;
    $assunto = 'Compra Aprovada - ' . $nome_loja;
    $remetente = $email_loja;
    $mensagem_email = utf8_decode('Sua compra foi aprovada! Acesse o painel do cliente para acompanhar o andamento do pedido.');
    $cabecalhos = 'From: ' . $remetente;
    @mail($destinatario, $assunto, $mensagem_email, $cabecalhos);
} //fechamento do if do pago_ven
