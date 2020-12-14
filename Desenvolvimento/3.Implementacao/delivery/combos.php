<?php 
include_once("cabecalho.php");
include_once("conexao.php");

 ?>

      

<!-- Trending products-->
<section class="section section-md bg-default margem-cima">
  <div class="container">
    <div class="row row-40 mb-3">
     
     <!--PRODUTOS MAIS VENDIDOS -->
      <div class="col-md-12 col-lg-12">
         
        <div class="row row-30">



         <?php 
          $res = $pdo->query("SELECT * from produtos where combo = 'Sim' order by vendas desc");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $id = $dados[$i]['id']; 
            $nome = $dados[$i]['nome'];

            $descricao = $dados[$i]['descricao'];
            $valor = $dados[$i]['valor'];
            $categoria = $dados[$i]['categoria'];
            $imagem = $dados[$i]['imagem'];
            $descricao_longa = $dados[$i]['descricao_longa'];

            $valor_sem_desconto = $valor + ($valor * 0.10);

            $valor_sem_desconto = number_format( $valor_sem_desconto , 2, ',', '.');
            $valor = number_format( $valor , 2, ',', '.');

            ?>


             <div class="col-sm-12 col-md-6 col-lg-3">
              <div class="oh-desktop">
                <!-- Product-->
                <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                  <div class="unit flex-row flex-lg-column">
                    <div class="unit-left">
                      <div class="product-figure"><img src="images/produtos/<?php echo $imagem ?>" alt="" width="270" height="280"/>
                        <div class="product-button"><a class="button button-md button-white button-ujarak" href="#">Add ao Carrinho</a></div>
                      </div>
                    </div>
                    <div class="unit-body">
                      <h6 class="product-title"><a href="" onclick="setaDadosModal('<?php echo $descricao ?>','<?php echo $descricao_longa ?>')" data-toggle="modal" data-target="#modal-desc"><?php echo $nome ?></a></h6>
                      <div class="product-price-wrap">
                        <div class="product-price product-price-old">R$<?php echo $valor_sem_desconto ?></div>
                        <div class="product-price">R$<?php echo $valor ?></div>
                      </div><a class="button button-sm button-secondary button-ujarak" href="#">Add ao Carrinho</a>
                    </div>
                  </div>
                </article>
              </div>
            </div>


           

         <?php } ?>


       </div>
     </div>
   </div>




 </div>
</section>




     


<?php include_once("rodape.php") ?>


    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>






 <!--MODAL PARA MOSTRAR A DESCRIÇÃO DO PRODUTO -->

            <div class="modal fade" id="modal-desc" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 id="texto-descricao" class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                 
                    <span id="texto-descricao-longa"></span>

                  </div>
                  
               </div>
             </div>
           </div>


<script>
function setaDadosModal(descricao, descricaoLonga) {
    $("#texto-descricao").text(descricao);
    $("#texto-descricao-longa").text(descricaoLonga);
}
</script>