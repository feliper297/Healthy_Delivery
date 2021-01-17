<?php 

@session_start();
include_once("conexao.php");
$cpf_usuario = @$_SESSION['cpf_usuario'];


//includes para o mercado pago
include_once("mercadopago/lib/mercadopago.php");
include_once("mercadopago/PagamentoMP.php");

$pagar = new PagamentoMP;

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
<head>
  <title>Healthy Delivery</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta name="description" content="Lanches BH, Lanches em Venda Nova, Comprar Sanduíche Venda Nova ">
  <meta name="author" content="Hugo Vasconcelos">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">


  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="css/style.css">



  <link rel="icon" href="images/favicon-nova.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
  <link rel="stylesheet" href="css/checkout.css">



  <script src="checkout.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>


  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
  <![endif]-->
</head>
<body>


  <div class='checkout margem-topo'>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class='order'>
          <h2>Carrinho</h2>

          <ul class='order-list mt-4'>

            <?php 

            $res = $pdo->prepare("SELECT * from carrinho where cpf = '$cpf_usuario' and id_venda = 0 order by id asc");
            $dados = $res->fetchAll(PDO::FETCH_ASSOC);
            $linhas = count($dados);

            if($linhas == 0){
              $linhas = 0;
              $total = 0;
            }

            $total;
            for ($i=0; $i < count($dados); $i++) { 
              foreach ($dados[$i] as $key => $value) {
              }

              $id_produto = $dados[$i]['id_produto']; 
              $quantidade = $dados[$i]['quantidade'];
              $id_carrinho = $dados[$i]['id'];


              $res_p = $pdo->prepare("SELECT * from produtos where id = '$id_produto' ");
              $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
              $nome_produto = $dados_p[0]['nome'];  
              $valor = $dados_p[0]['valor'];
              $imagem = $dados_p[0]['imagem'];


              $total_item = $valor * $quantidade;
              @$total = @$total + $total_item;
              $valor_final = $total;

              $valor = number_format( $valor , 2, ',', '.');
                            //$total = number_format( $total , 2, ',', '.');
              $total_item = number_format( $total_item , 2, ',', '.');
              $valor_final = number_format( $valor_final , 2, ',', '.');
              ?>

              <li><img src='images/produtos/<?php echo $imagem ?>'><h4><?php echo $quantidade; echo ' '; echo $nome_produto; ?></h4><h5><?php echo $total_item ?></h5></li>


            <?php } ?>

          </ul>

          <h5 class='total mt-4'>Total</h5><h1>R$ <?php echo @$valor_final ?></h1>
        </div>
      </div>

      

      <div id='payment' class='payment col-md-6'>

        <h2>Pagamento e Entrega</h2>

        <form method="post">
          <div class="div-select">
            <select  id="tipo" name="tipo" required>
              <option value="" selected>Forma de Pagamento</option>
              <option value="Dinheiro">Dinheiro</option>
              <option value="Cartão de Débito">Cartão de Débito</option>
              <option value="Cartão de Crédito">Cartão de Crédito</option>
              <option value="Mercado Pago">Mercado Pago</option>
            </select>
          </div>

          <div id="troco" class="mt-2">

            <input type="text" class="form-control" id="troco" placeholder="Total em Dinheiro para calcularmos o Troco " name="troco" required> 
          </div>


        



          <?php 

          //TRAZER OS DADOS DO CLIENTE
  $cpf_cliente = @$_SESSION['cpf_usuario'];
  $res = $pdo->prepare("SELECT * from clientes where cpf = '$cpf_cliente'");
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);
  $rua = @$dados[0]['rua'];
  $numero = @$dados[0]['numero'];
  $bairro = @$dados[0]['bairro'];
  $cidade = @$dados[0]['cidade'];
  
  
           ?>

           <img src="images/dados.png" width="100%" class="mt-2">

           <div class="dados-usuario row">


            <div class="col-md-9">

           <div class="form-group">

            <label class="text-dark" for="exampleInputEmail1">Rua</label>
            <input type="text" class="form-control form-control-sm" id="rua" name="rua" placeholder="Rua" required value="<?php echo @$rua ?>">

          </div>

        </div>


          <div class="col-md-3">
           <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Número</label>
            <input type="text" class="form-control form-control-sm" id="numero" name="numero" placeholder="Número" required value="<?php echo @$numero ?>">

          </div>

        </div>

          <div class="col-md-6">
           <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Bairro</label>
            
            <select class="form-control form-control-sm" id="" name="bairro" required>



                <?php 
                //SE EXISTIR EDIÇÃO DOS DADOS, TRAZER O NOME DO ITEM ASSOCIADA AO REGISTRO
                if(@$bairro != ''){

                 
                  echo '<option value="'.@$bairro.'">'.@$bairro.'</option>';
                }else{
                   echo '<option value="">Selecione um Bairro</option>';
                }
                


                //TRAZER TODOS OS REGISTROS EXISTENTES
                $res = $pdo->prepare("SELECT * from locais order by nome asc");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id_item = $dados[$i]['id'];  
                  $nome_item = $dados[$i]['nome'];

                  if($nome_dado != $nome_item){
                    echo '<option value="'.$nome_item.'">'.$nome_item.'</option>';
                  }

                  
                }
                ?>
              </select>

          </div>

        </div>

         <div class="col-md-6">
           <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Cidade</label>
            <input type="text" class="form-control form-control-sm" id="cidade" name="cidade" placeholder="Cidade" required value="<?php echo @$cidade ?>">

          </div>

        </div>
           
           
          </div>

           <input type="hidden" id="total" name="total"  value="<?php echo @$total ?>">

          <button id="btn-finalizar" class='button-cta' title='Finalizar a Compra'><span>CONCLUIR</span></button>

        </form>

        <div id="mensagem">
        </div>
      </div>
      

    </div>
  </div>

</body>
</html>








<!--AJAX PARA CHAMAR O CARREGAMENTO DO INPUT SELECT A PARTIR DE OUTRO INPUT -->
<script type="text/javascript">
  $(function(){
    $('#troco').hide();
    $('#mp').hide();
    $('#tipo').change(function(){
      if( $(this).val() == 'Dinheiro' ) {
        $('#troco').show();

      } else {
        $('#troco').hide();
      }

     
    });
  });
</script>





<!--AJAX PARA INSERÇÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function(){
       
        $('#btn-finalizar').click(function(event){
            event.preventDefault();
            
            $.ajax({
                url: "carrinho/finalizar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Cadastrado com Sucesso!!'){
                        
                        $('#mensagem').addClass('text-success');
                        alert('Pedido Finalizado!');
                        window.location='painel-cliente';
                       
                        //$('#btn-fechar').click();
                        //location.reload();


                    }else if(mensagem == 'Mercado Pago!!'){
                      $("#modal-mp").modal("show");
                    }else{
                        
                        $('#mensagem').addClass('text-danger')
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
        })
    })
</script>







<?php 
//TRAZER OS DADOS DA VENDA
$res = $pdo->prepare("SELECT * from vendas where cliente = '$cpf_usuario' order by id desc limit 1");
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);
  @$total_venda = @$dados[0]['total'];
  @$id_venda = @$dados[0]['id'];
  $nome_do_produto = 'Compra no Delivery';
 ?>


<div class="modal fade" id="modal-mp" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pagar com Mercado Pago <?php echo $url_site ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   <span>Apenas pagamentos com liberação imediata como (Cartão de Crédito ou Débito e Saldo em Conta, clique na imagem abaixo para pagar!</span>

     <div class="mt-2">

            <?php 
                          //botao do mercado pago

            $btn = $pagar->PagarMP($id_venda, $nome_do_produto, (float)$total_venda, $url_site);
            echo $btn;
            ?>

           
          </div>


</div>

</div>
</div>
</div>

