<?php 
include_once("cabecalho.php");
include_once("conexao.php");

 ?>

      

<!-- Trending products-->
<section class="section section-md bg-default margem-cima">
  <div class="container">
    <div class="row row-40 justify-content-center">
     
      <div class="col-md-12 col-lg-12">
        <div class="row row-30">

          <?php 
          $res = $pdo->query("SELECT * from categorias order by produtos desc");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $id = $dados[$i]['id']; 
            $nome = $dados[$i]['nome'];

            $descricao = $dados[$i]['descricao'];
           
            $imagem = $dados[$i]['imagem'];
            $produtos = $dados[$i]['produtos'];
            $nome_url = $dados[$i]['nome_url'];
           

            ?>


            <div class="col-sm-12 col-md-6 col-lg-3">
              <div class="oh-desktop">
                <!-- Product-->
                <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                  <div class="unit flex-row flex-lg-column">
                    <div class="unit-left">
                      <div class="product-figure"><img src="images/categorias/<?php echo $imagem ?>" alt="" width="270" height="280"/>
                        <div class="product-button"><a class="button button-md button-white button-ujarak" href="produtos-da-categoria-de-<?php echo $nome_url ?>">Ver Produtos</a></div>
                      </div>
                    </div>
                    <div class="unit-body">
                      <h6 class="product-title"><a title="<?php echo $descricao ?>" href="#" ><?php echo $nome ?></a></h6>
                      <div class="product-price-wrap">
                        <div class="product-price"><?php echo $produtos ?> Produtos </div>
                       
                      </div><a class="button button-sm button-secondary button-ujarak" href="#">Ver Produtos</a>
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