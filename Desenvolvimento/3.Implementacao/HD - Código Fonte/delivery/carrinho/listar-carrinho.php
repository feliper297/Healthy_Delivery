
<?php 

require_once("../conexao.php");
$pagina = 'produtos';
@session_start();
$cpf_usuario = @$_SESSION['cpf_usuario'];

echo '

 
                    
                        <div class="cart-inline-header">
                          
                          
                           <h6 class="cart-inline-title">Valor Total: R$<span id="valor_total" class="ml-1"> </span></h6>
                         </div>
                         <div class="cart-inline-body">';


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


                            $valor = number_format( $valor , 2, ',', '.');
                            //$total = number_format( $total , 2, ',', '.');
                            $total_item = number_format( $total_item , 2, ',', '.');

                        echo '  <div class="cart-inline-item">
                            <div class="unit align-items-center">
                              <div class="unit-left"><a class="" href="#"><img src="images/produtos/'.$imagem.'" alt="" width="108" height="100"/></a></div>
                              <div class="unit-body">
                                <h6 class="cart-inline-name"><a>'.$nome_produto.'</a>
                                <a onclick="deletarCarrinho('.$id_carrinho.')" id="btn-deletar" href="" class="ml-2" title="Remover Item do Carrinho">
                                 <img src="images/delete-icon.png" width="20">
                                </a>
                                </h6>

                                <div>
                                  <div class="group-xs group-inline-middle">
                                    <div class="table-cart-stepper">
                                     <div class="quantity">
                                      <input onchange="editarCarrinho('.$id_carrinho.')" class="form-control" type="number" data-zeros="true" value="'.$quantidade.'" min="1" max="1000" id="quantidade">
                                      </div>
                                    </div>
                                    <h6 class="cart-inline-title">R$ '.$total_item.'</h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>';
                         
                        
                      }

                     echo '   </div>
                        <div class="cart-inline-footer">
                          <div class="group-sm"><a class="button button-md button-default-outline-2 button-wapasha" href="produtos">+ Produtos</a><a class="button button-md button-primary button-pipaluk" href="finalizar-compra" target="_blank">Finalizar</a></div>
                        </div>
                   
';


?>



<!--SCRIPT PARA ALTERAR O INPUT NUMBER -->
<script type="text/javascript">
      jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><big>+</big></div><div class="quantity-button quantity-down"><big>-</big></div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
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
	 var itens = "<?=$linhas?>";
	 var total = "<?=$total?>";

	 $("#total_itens").text(itens);
	 $("#valor_total").text(total);
</script>



