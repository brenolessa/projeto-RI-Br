<?php 

require 'app/Config.inc.php';

$resultado = false;
$texto = null;

$form = filter_input_array ( INPUT_POST, FILTER_DEFAULT );
if ($form && $form ['submit']) {

	$file = $_FILES ['publicacao'];
	if ($file ['name']) {
		$upload = new Upload ( 'uploads/' );
		$upload->File ( $file );

		if ($upload->getError()){
			$texto = $upload->getError();
		}

		$dados = [
				'titulo' => $_POST ['titulo'],
				'resumo' => $_POST ['resumo'],
				'ano' => $_POST ['ano'],
				'autores' => $_POST ['autores'],
				'evento' => $_POST ['evento'],
				'arquivo' => $upload->getResult(),
				'aprovado' => 'N',
				'area' => $_POST ['area']
		];

		if($upload->getResult()){
			$cadastra = new Create ();
			$cadastra->ExeCreate ( 'publicacao', $dados );
				
			if ($cadastra->getResult ()) {
				$resultado = true;
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

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
			if ($resultado){
			
				MSG("Cadastrado com sucesso!", RI_MSG_SUCCESS);
			
			} else if ($texto != null) {
				MSG($texto, RI_MSG_DANGER);
			}
			?>

			<div class="alert alert-info">
				<p>Obs.: Para disponibilizar sua produção científica no Repositório deve-se submeter a produção através deste formulário. Onde o mesmo deverá ser aprovado pelo administrador do sistema.</p>
				<hr>
				<p>Requisito para submissão:</p>
				<p>I - O formato do arquivo deve ser .PDF</p>
				<p>II - O arquivo não deve exceder o tamanho máximo de 5mb</p>
				<p>III - Todos os campos são obrigatórios</p>
			</div>
			
			<div class="row">
				<div class="text-center">
					<h1 class="h1e">RI<span class="ft">IFBA</span></h1>
					<h2>Submeter Publicação</h2>
				</div>
		
				<div class="col-md-12 col-lg-12 border-form">
					<form action="" method="post" enctype="multipart/form-data">
		
						<div class="form-group col-lg-12 col-md-12">
					    	<label class="" for="">Título <span class="requisito">*</span>:</label>
							<input type="text" class="form-control inp br" name="titulo" placeholder="Título da Publicação" required>
						</div>
		
						<div class="form-group col-lg-12 col-md-12">
					    	<label class="" for="">Resumo <span class="requisito">*</span>:</label>
					    	<textarea name="resumo" placeholder="Resumo" rows="10" class="form-control ta br" required></textarea>
						</div>
		
						<div class="form-group col-lg-12 col-md-12">
					    	<label class="" for="">Autor(es) <span class="requisito">*</span>:</label>
							<input type="text" class="form-control inp br" name="autores" placeholder="Autor(es)" required>
						</div>
						
						<div class="form-group col-lg-12 col-md-12">
					    	<label class="" for="">Evento <span class="requisito">*</span>:</label>
							<input type="text" class="form-control inp br" name="evento" placeholder="Evento" required>
						</div>
						
						<div class="form-group col-lg-6 col-md-6">
					    	<label class="" for="">Ano <span class="requisito">*</span>:</label>
							<input type="number" class="form-control inp br" name="ano" placeholder="Ex: 2015" required>
						</div>
						
						<div class="form-group col-lg-6 col-md-6">
					    	<label class="" for="">Área <span class="requisito">*</span>:</label>
							<input type="text" class="form-control inp br" name="area" placeholder="Área" required>
						</div>
						
						<div class="form-group col-lg-12 col-md-12">
					    	<label class="" for="">Arquivo <span class="requisito">*</span>:</label>
							<input type="file" class="form-control inp br" name="publicacao" accept="application/pdf" required>
						</div>
								
						<div class="form-group col-lg-4 col-md-4 col-lg-push-4 col-md-push-4">
							<input type="submit" class="btn btn-default inp bt-lg br" name="submit" value="Submeter">
						</div>
		
					</form>
		
				</div>
			</div>
		
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