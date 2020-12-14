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

          // definir o numero de itens por pagina
        $itens_por_pagina = $itens_por_pagina_produtos;

        // pegar a pagina atual
        $pagina = intval(@$_GET['pagina']);
        $limite = $pagina * $itens_por_pagina;

          $res = $pdo->query("SELECT * from produtos order by vendas desc LIMIT $limite, $itens_por_pagina");
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



             //BUSCAR TODOS OS PRODUTOS PARA SABER O TOTAL DE PRODUTOS PARA DIVIDIR EM PÁGINAS
          $res_p = $pdo->query("SELECT * from produtos");
          $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
          $num_total = count($dados_p);
        // definir numero de páginas
          $num_paginas = ceil($num_total/$itens_por_pagina);

            ?>


             <div class="col-sm-12 col-md-6 col-lg-3">
              <div class="oh-desktop">
                <!-- Product-->
                <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                  <div class="unit flex-row flex-lg-column">
                    <div class="unit-left">
                      <div class="product-figure"><img src="images/produtos/<?php echo $imagem ?>" alt="" width="270" height="280"/>
                        <div class="product-button"><a class="button button-md button-white button-ujarak" href="" onclick="carrinhoModal('<?php echo $id ?>')">Add ao Carrinho</a></div>
                      </div>
                    </div>
                    <div class="unit-body">
                      <h6 class="product-title"><a href="" onclick="setaDadosModal('<?php echo $descricao ?>','<?php echo $descricao_longa ?>')" data-toggle="modal" data-target="#modal-desc"><?php echo $nome ?></a></h6>
                      <div class="product-price-wrap">
                        <div class="product-price product-price-old">R$<?php echo $valor_sem_desconto ?></div>
                        <div class="product-price">R$<?php echo $valor ?></div>
                      </div><a class="button button-sm button-secondary button-ujarak" href="" onclick="carrinhoModal('<?php echo $id ?>')">Add ao Carrinho</a>
                    </div>
                  </div>
                </article>
              </div>
            </div>


           

         <?php } ?>


       </div>
     </div>
   </div>



   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

   <div class="row paginacao mt-4">
         <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="btn btn-outline-dark btn-sm" href="lista-produtos.php?pagina=0" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <?php 
            for($i=0;$i<$num_paginas;$i++){
            $estilo = "";
            if($pagina >= ($i - 2) and $pagina <= ($i + 2)){
            if($pagina == $i)
              $estilo = "active";
            ?>
             <li class="page-item"><a class="btn btn-outline-dark btn-sm  <?php echo $estilo; ?>" href="lista-produtos.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
          <?php } } ?>
            
            <li class="page-item">
              <a class="btn btn-outline-dark btn-sm " href="lista-produtos.php?pagina=<?php echo $num_paginas-2; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>

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


<?php include_once("modal-carrinho.php") ?>