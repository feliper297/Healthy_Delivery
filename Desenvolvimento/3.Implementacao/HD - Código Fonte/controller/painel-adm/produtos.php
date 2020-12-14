<?php 
$pagina = 'produtos';

$pagina_pag = intval(@$_GET['pagina']);
$itens_pag = intval(@$_GET['itens']);

?>
<div class="container ml-2 mr-2">
	<nav class="navbar navbar-expand navbar-white navbar-light">
		
		<a id="btn-novo" type="button" class="btn btn-primary" href="index.php?acao=<?php echo $pagina ?>&funcao=novo">Novo Produto</a>
		
		<form method="post" id="frm">
			<input type="hidden" name="pag" id="pag" value="<?php echo $pagina_pag ?>">
			<input type="hidden" name="itens_pag" id="itens_pag" value="<?php echo $itens_pag ?>">
		</form>
		

		<div class="direita">
			<!-- SEARCH FORM -->
			<form class="form-inline ml-3 float-right">
				<div class="input-group input-group-sm">

					<div class="form-group mr-2">
						
						<select class="form-control d-none d-md-block form-control-sm" id="cbbuscar" name="cbbuscar">
							<option value="">Categoria para Buscar</option>
							<?php 

								//TRAZER TODOS OS REGISTROS EXISTENTES
							$res = $pdo->query("SELECT * from categorias order by nome asc");
							$dados = $res->fetchAll(PDO::FETCH_ASSOC);

							for ($i=0; $i < count($dados); $i++) { 
								foreach ($dados[$i] as $key => $value) {
								}

								$id_categ = $dados[$i]['id'];	
								$nome_categ = $dados[$i]['nome'];


								echo '<option value="'.$id_categ.'">'.$nome_categ.'</option>';



							}
							?>
						</select>
					</div>

					<input class="form-control form-control-navbar" type="search" name="txtbuscar" id="txtbuscar" placeholder="Nome do Produto" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-navbar" type="submit" id="btn-buscar">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>
		</div>

	</nav>

	<div id="listar">
		
	</div>
</div>






<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<?php if(@$_GET['funcao']=='editar'){
					$titulo_modal = 'Editar Dados';
					$botao = 'Editar';


					//RECUPERAR OS DADOS COM BASE NO ID QUE RECEBO
					$id_reg = @$_GET['id'];
					$res = $pdo->query("SELECT * from produtos where id = '$id_reg'");
					$dados = $res->fetchAll(PDO::FETCH_ASSOC);
					$nome = $dados[0]['nome'];
					$descricao = $dados[0]['descricao'];
					$descricao_longa = $dados[0]['descricao_longa'];
					$valor = $dados[0]['valor'];
					$categoria = $dados[0]['categoria'];
					$combo = $dados[0]['combo'];
					$imagem = $dados[0]['imagem'];
					$form = 'form-editar';

					$dnone = 'd-none';
					

				}else{
					$titulo_modal = 'Inserir Novo';
					$botao = 'Salvar';
					$form = 'form-inserir';
				} ?>
				<h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?>
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">


			<form id="<?php echo $form ?>" method="post" enctype="multipart/form-data">



				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleFormControlInput1">Nome</label>
							<input type="text" class="form-control" id="nome" placeholder="Insira o Nome " name="nome" value="<?php echo @$nome ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">


							<label for="exampleFormControlInput1">Descrição</label>
							<input type="text" class="form-control" id="descricao" placeholder="Insira a Descrição " name="descricao" value="<?php echo @$descricao ?>" required>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">


							<label for="exampleFormControlInput1">Valor</label>
							<input type="text" class="form-control" id="valor" placeholder="Insira o Valor " name="valor" value="<?php echo @$valor ?>" required>
						</div>
					</div>

					<div class="col-md-3 <?php echo @$dnone ?>">
						<div class="form-group">
							<label for="exampleFormControlSelect1">Categoria</label>
							<select class="form-control" id="" name="categoria">



								<?php 
								//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER O NOME DO ITEM ASSOCIADA AO REGISTRO
								if(@$_GET['funcao'] == 'editar'){

									$res_dado = $pdo->query("SELECT * from categorias where id = '$categoria'");
									$dados_dado = $res_dado->fetchAll(PDO::FETCH_ASSOC);

									for ($i=0; $i < count($dados_dado); $i++) { 
										foreach ($dados_dado[$i] as $key => $value) {
										}

										$id_dado = $dados_dado[$i]['id'];	
										$nome_dado = $dados_dado[$i]['nome'];

									}


									echo '<option value="'.$id_dado.'">'.$nome_dado.'</option>';
								}
								


								//TRAZER TODOS OS REGISTROS EXISTENTES
								$res = $pdo->query("SELECT * from categorias order by nome asc");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								for ($i=0; $i < count($dados); $i++) { 
									foreach ($dados[$i] as $key => $value) {
									}

									$id_item = $dados[$i]['id'];	
									$nome_item = $dados[$i]['nome'];

									if($nome_dado != $nome_item){
										echo '<option value="'.$id_item.'">'.$nome_item.'</option>';
									}

									
								}
								?>
							</select>
						</div>
					</div>

				</div>





				<div class="form-group">


					<label for="exampleFormControlInput1">Descrição Longa</label>
					<textarea maxlength="600" class="form-control" id="descricao_longa" name="descricao_longa"><?php echo @$descricao_longa ?></textarea>
				</div>


				
				


			
						<div class="form-group">
							<label for="inputAddress">Foto</label>
							<div class="custom-file">

								<input type="file" name="foto" id="foto">


							</div>

						</div>
					
					

						<?php 

						if(@$combo == 'Sim'){
						$checked = 'checked';
							}
						 ?>
						<div class="form-group form-check">

							<input <?php echo @$checked ?> type="checkbox" class="form-check-input" id="exampleCheck1" name="combo" value="Sim">
							<label class="form-check-label" for="exampleCheck1">Combo</label>
						</div>
			
				

				<?php if(@$_GET['funcao']=='editar'){ ?>
					<img src="../images/produtos/<?php echo $imagem ?>" width="150">
				<?php } ?>


				<div align="center" id="mensagem" class="">

				</div>

			</div>
			<div class="modal-footer">

				<input type="hidden" id="id" name="id" value="<?php echo @$id_reg ?>">

				<input type="hidden" id="reg_antigo" name="reg_antigo" value="<?php echo @$nome ?>" required>

				<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

				<button type="submit" name="<?php echo $botao ?>" id="<?php echo $botao ?>" class="btn btn-primary"><?php echo $botao ?></button>

			</div>
		</form>
	</div>
</div>
</div>



<!--CHAMADA DA MODAL PARA NOVO REGISTRO OU EDIÇÃO -->
<?php 
if(@$_GET['funcao'] == 'novo' || @$_GET['funcao'] == 'editar'){ 
	
	?>
	<script>$('#modal').modal("show");</script>
<?php } ?>







<!--CHAMADA DA MODAL DELETAR -->
<?php 
if(@$_GET['funcao'] == 'excluir' && @$item_paginado == ''){ 
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Registro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<p>Deseja realmente Excluir este Registro?</p>

					<div align="center" id="mensagem_excluir" class="">

					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
					<form method="post">
						<input type="hidden" id="id"  name="id" value="<?php echo @$id ?>" required>

						<button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>

<script>$('#modal-deletar').modal("show");</script>



<!--AJAX PARA INSERÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
	$("#form-inserir").submit(function () {
		var pag = "<?=$pagina?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/inserir.php",
			type: 'POST',
			data: formData,

			success: function(mensagem){

				$('#mensagem').removeClass()

				if(mensagem == 'Cadastrado com Sucesso!!'){

					$('#btn-buscar').click();
					$('#btn-fechar').click();

				}else{

					$('#mensagem').addClass('text-danger')
				}

				$('#mensagem').text(mensagem)

			},


			cache: false,
			contentType: false,
			processData: false,
        xhr: function() {  // Custom XMLHttpRequest
        	var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
            	myXhr.upload.addEventListener('progress', function () {
            		/* faz alguma coisa durante o progresso do upload */
            	}, false);
            }
            return myXhr;
        }
    });
	});
</script>




<!--AJAX PARA BUSCAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-buscar').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar').html(result)
					
				},
				

			})

		})

		
	})
</script>








<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){
		
		var pag = "<?=$pagina?>";

		$.ajax({
			url: pag + "/listar.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function(result){
				$('#listar').html(result)

			},

			
		})
	})
</script>



<!--AJAX PARA BUSCAR OS DADOS PELA TXT -->
<script type="text/javascript">
	$('#txtbuscar').keyup(function(){
		$('#btn-buscar').click();
	})
</script>


<!--AJAX PARA BUSCAR OS DADOS PELO SELECT -->
<script type="text/javascript">
	$('#cbbuscar').change(function(){
		$('#btn-buscar').click();
	})
</script>


<!--AJAX PARA EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
	$("#form-editar").submit(function () {
		var pag = "<?=$pagina?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/editar.php",
			type: 'POST',
			data: formData,

			success: function(mensagem){

				$('#mensagem').removeClass()

				if(mensagem == 'Editado com Sucesso!!'){

					$('#btn-buscar').click();
					$('#btn-fechar').click();

				}else{

					$('#mensagem').addClass('text-danger')
				}

				$('#mensagem').text(mensagem)

			},


			cache: false,
			contentType: false,
			processData: false,
        xhr: function() {  // Custom XMLHttpRequest
        	var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
            	myXhr.upload.addEventListener('progress', function () {
            		/* faz alguma coisa durante o progresso do upload */
            	}, false);
            }
            return myXhr;
        }
    });
	});
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-deletar').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/excluir.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					$('#mensagem_excluir').removeClass()

					if(mensagem == 'Excluído com Sucesso!!'){

						$('#txtbuscar').val('')
						$('#btn-buscar').click();
						$('#btn-cancelar-excluir').click();

					}else{

						$('#mensagem_excluir').addClass('text-danger')
					}

					$('#mensagem_excluir').text(mensagem)

					

				},
				
			})
		})
	})
</script>