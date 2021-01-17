
<!--MODAL PARA CARRINHO -->
<div class="modal fade" id="modal-carrinho" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="cart-inline-title">Carrinho:<span id="total_itens" class="ml-1"> </span> Produtos</h5>
         <input type="hidden" id="txtquantidade">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   
   <?php if(@$_SESSION['cpf_usuario'] == ''){
    echo 'Você precisa está Logado, faça seu login clicando <a class="vermelho-link" href="login" target="_blank" title="Ir para o Login"> aqui </a>, caso não tenha login faça seu cadastro!';

   }else{ ?>
    <div id="listar-carrinho">
    
    </div>
  <?php } ?>
  </div>
  
</div>
</div>
</div>






<!--AJAX PARA INSERÇÃO DOS DADOS VINDO DE UMA FUNÇÃO -->
<script>
function carrinhoModal(idproduto) {
  
  
     event.preventDefault();
            
            $.ajax({

                url: "carrinho/inserir-carrinho.php",
                method: "post",
                data: {idproduto},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Cadastrado com Sucesso!!'){
                        atualizarCarrinho();
                       $("#modal-carrinho").modal("show");

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
}
</script>







<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
  $(document).ready(function(){
    
    

    $.ajax({
      url:  "carrinho/listar-carrinho.php",
      method: "post",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){
        $('#listar-carrinho').html(result)

      },

      
    })
  })
</script>




<script>
function atualizarCarrinho() {
    $.ajax({
      url:  "carrinho/listar-carrinho.php",
      method: "post",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){
        $('#listar-carrinho').html(result)

      },
     })
}
</script>



<script>
function deletarCarrinho(id) {

   event.preventDefault();
            
            $.ajax({

                url: "carrinho/excluir-carrinho.php",
                method: "post",
                data: {id},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Excluido com Sucesso!!'){
                        atualizarCarrinho();
                       //$("#modal-carrinho").modal("show");

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
   
}
</script>



<script type="text/javascript">
   function editarCarrinho(id) {
        
        var quantidade = document.getElementById('txtquantidade').value;
        event.preventDefault();
            
            $.ajax({

                url: "carrinho/editar-carrinho.php",
                method: "post",
                data: {id, quantidade},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Editado com Sucesso!!'){
                        atualizarCarrinho();
                       //$("#modal-carrinho").modal("show");

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })

        
      }
</script>