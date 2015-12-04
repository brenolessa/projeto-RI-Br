<?php 

require 'app/Config.inc.php';

$read = new Read();
$resultado = true;

$form= filter_input_array(INPUT_POST, FILTER_DEFAULT);
if($form && $form['submit']){

	if (isset($form['submit'])){

		if (!$_POST['busca']){

			MSG("Digite um termo para busca", RI_MSG_WARNING);
			
		}
		else if ($_POST['busca']){
			
			$busca = $_POST['busca'];
			$categoria = $_POST['categoria'];
			$tipo = $_POST['tipo'];

			$read = new Read();
			
			if ($categoria == 'publicacao'){
				$read->FullRead("SELECT * FROM {$categoria} WHERE {$tipo} LIKE \"%{$busca}%\" AND aprovado = 'S'");
			}
			else {
				$read->FullRead("SELECT * FROM {$categoria} WHERE {$tipo} LIKE \"%{$busca}%\"");
			}
			
			if(!$read->getResult()){
				$resultado = false;
			}
										
		}
	}


}


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Repositório Institucional - IFBA - VCA</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/repositorio.css" rel="stylesheet">

    <script src="assets/js/jquery-2.1.4.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
    
		$(document).ready(function() {

			$('#tb1').dataTable({
				
				// "bJQueryUI": true,
				// "sPaginationType": "full_numbers",
				// "sDom": '<"H"Tlfr>t<"F"ip>',
				"oLanguage": {
					"sLengthMenu": "Registros/Página _MENU_",
					"sZeroRecords": "Nenhum registro encontrado",
					"sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
					"sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
					"sInfoFiltered": "(filtrado de _MAX_ registros)",
					"sSearch": "Pesquisar: ",
					"oPaginate": {
						// "sFirst": " Primeiro ",
						"sPrevious": " Anterior ",
						"sNext": " Próximo ",
						// "sLast": " Último "
					}
				},
				"aaSorting": [[0, 'desc']],
				"aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
			});

		});
	</script>

  </head>
  <body>

	  <nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="index.php">
		      	<img alt="Repositório Institucional IFBA Campus Vitória da Conquista" class="img-responsive img" src="assets/images/ifba.png">
		      </a>
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		      	<li class="li-login"><a href="submeter.php" class="submeter" title="Submeter Publicação"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Submeter</a></li>
		        <li class="li-login"><a href="admin.php" class="login" title="Área do Administrador"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Login</a></li>
		        <!-- <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ADMIN <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		          </ul>
		        </li> -->
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

		<div class="container abc">
		
		<?php 
		$get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
		if (!empty($get)){
			if ($get == 'restrito'){
				MSG('Acesso negado: Por favor efetue login para acessar o Painel!', RI_MSG_DANGER);
			}
			else if($get == 'logoff') {
				MSG('Sucesso ao deslogar: Sua sessão foi finalizada. Volte sempre!', RI_MSG_SUCCESS);
			}
		}
		?>
		
			<div class="row text-center">
				<h1>RI<span class="ft">IFBA</span></h1>
				<h2>Repositório Institucional do IFBA <i>Campus</i> Vitória da Conquista</h2>
		
				<div class="col-md-12 col-lg-12 c">
					<form action="index.php" method="post" enctype="multipart/form-data" style="background-color:;">
		
						<div class="form-group col-lg-5 col-md-5">
					    	<label class="sr-only" for="">Digite um termo para busca</label>
							<input type="search" class="form-control inp" name="busca" id="" placeholder="Digite um termo para pesquisar..." required>
						</div>
		
						<div class="form-group col-lg-3 col-md-3">
					    	<select class="form-control inp" name="categoria">
								<option value="publicacao" selected>Publicação</option>
								<option value="pesquisa">Projeto de Pesquisa</option>
								<option value="extensao">Projeto de Extensão</option>
							</select>
						</div>
		
						<div class="form-group col-lg-2 col-md-2">
							<select class="form-control inp" name="tipo">
								<option value="area">Área</option>
								<option value="titulo" selected>Título</option>
								<option value="autores">Autor</option>
								<option value="ano">Ano</option>
							</select>
						</div>
		
						<div class="form-group col-lg-2 col-md-2">
							<input type="submit" class="btn btn-default inp bt-lg" name="submit" value="Pesquisar">
						</div>
		
					</form>
		
				</div>
			</div>
		
			<?php
			if (!$resultado){
			
				MSG("Nenhum resultado encontrado!", RI_MSG_DANGER);
			
			}
			else if ($read->getResult()){
			
				echo '
				<hr>
				<div class="col-lg-12 col-md-12 contorno-table">
					<table class="ls-table a ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
						<thead>
							<th>Ano</th>
							<th>Título</th>
							<th>Autor (es)</th>
							<th>Detalhes</th>
						</thead>
						<tbody>';
								
									foreach ($read->getResult() as $r){
										echo '<tr>';
											echo '<td>'.$r['ano'].'</td>';
											echo '<td><a href="view.php?id='.$r['id'].'&categoria='.$categoria.'">'.$r['titulo'].'</a></td>';
											echo '<td>'.$r['autores'].'</td>';
											echo '<td style="text-align:center;"><a href="view.php?id='.$r['id'].'&categoria='.$categoria.'" class="btn bt-visualizar" title="Visualizar"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>';
										echo '</tr>';
									
									}
					echo '			
						</tbody>
					</table>
				</div>';	
				
			}
			?>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="pre-cop"></div>
				<div class="cop">
					<p>2015-<?= date('Y');?> RIIFBA. Desenvolvido por <a href="http://lattes.cnpq.br/5590242674758693" target="__blank" class="lattes" title="Lattes">Breno Lessa</a> e <a href="http://lattes.cnpq.br/7272567597428470" target="__blank" class="lattes" title="Lattes">Moara Brito</a></p>
				</div>
			</div>
		</div>
	
    	<script src="assets/js/bootstrap.min.js"></script>

	</body>
</html>