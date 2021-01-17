<?php 
$pagina = 'balconistas';

$pagina_pag = intval(@$_GET['pagina']);
$itens_pag = intval(@$_GET['itens']);

?>
<div class="container ml-2 mr-2">
	<nav class="navbar navbar-expand navbar-white navbar-light">
		
		<a id="btn-novo" type="button" class="btn btn-primary" href="index.php?acao=<?php echo $pagina ?>&funcao=novo">Novo Balconista</a>
		
		<form method="post" id="frm">
			<input type="hidden" name="pag" id="pag" value="<?php echo $pagina_pag ?>">
			<input type="hidden" name="itens_pag" id="itens_pag" value="<?php echo $itens_pag ?>">
		</form>
		

		<div class="direita">
			<!-- SEARCH FORM -->
			<form class="form-inline ml-3 float-right">
				<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" name="txtbuscar" id="txtbuscar" placeholder="Nome ou CPF" aria-label="Search">
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
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<?php if(@$_GET['funcao']=='editar'){
					$titulo_modal = 'Editar Dados';
					$botao = 'Editar';

					//RECUPERAR OS DADOS COM BASE NO ID QUE RECEBO
					$id = @$_GET['id'];
					$res = $pdo->prepare("SELECT * from usuarios where id = '$id'");
					$dados = $res->fetchAll(PDO::FETCH_ASSOC);
					$nome = $dados[0]['nome'];
					$cpf = $dados[0]['cpf'];
					$telefone = $dados[0]['telefone'];
					$usuario = $dados[0]['usuario'];
					$senha = $dados[0]['senha'];
					$nivel = $dados[0]['nivel'];
					
					$form = 'form-editar';

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


				<form id="<?php echo $form ?>" method="post">


					<div class="form-group">


						<label for="exampleFormControlInput1">CPF</label>
						<input type="text" class="form-control" id="cpf" placeholder="Insira o CPF " name="cpf" value="<?php echo @$cpf ?>" required>
					</div>

					<div class="form-group">


						<label for="exampleFormControlInput1">Nome</label>
						<input type="text" class="form-control" id="nome" placeholder="Insira o Nome " name="nome" value="<?php echo @$nome ?>" required>
					</div>


					


					<div class="form-group">


						<label for="exampleFormControlInput1">Telefone</label>
						<input type="text" class="form-control" id="telefone" placeholder="Insira o Telefone " name="telefone" value="<?php echo @$telefone ?>" required>
					</div>


					<div class="form-group">


						<label for="exampleFormControlInput1">Usuário</label>
						<input type="email" class="form-control" id="usuario" placeholder="Insira o Email " name="usuario" value="<?php echo @$usuario ?>" required>
					</div>




						<div align="center" id="mensagem" class="">

						</div>

					</div>
					<div class="modal-footer">

						<input type="hidden" id="id" name="id" value="<?php echo @$id ?>">

						<input type="hidden" id="reg_antigo" name="reg_antigo" value="<?php echo @$cpf ?>" required>

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



<!--AJAX PARA INSERÇÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function(){
        var pag = "<?=$pagina?>";
        $('#Salvar').click(function(event){
            event.preventDefault();
            
            $.ajax({
                url: pag + "/inserir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Cadastrado com Sucesso!!'){
                        
                        $('#mensagem').addClass('text-success')

                       
                        $('#nome').val('')
                      
                        $('#btn-buscar').click();
                        //$('#btn-fechar').click();
                        //location.reload();


                    }else{
                        
                        $('#mensagem').addClass('text-danger')
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
        })
    })
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





<!--AJAX PARA EDIÇÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function(){
        var pag = "<?=$pagina?>";
        $('#Editar').click(function(event){
            event.preventDefault();
            
            $.ajax({
                url: pag + "/editar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Editado com Sucesso!!'){
                        
                        $('#mensagem').addClass('text-success')

                       
                        $('#nome').val('')
                      
                        $('#btn-buscar').click();
                        //$('#btn-fechar').click();
                        //location.reload();


                    }else{
                        
                        $('#mensagem').addClass('text-danger')
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
        })
    })
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="../js/mascaras.js"></script>
