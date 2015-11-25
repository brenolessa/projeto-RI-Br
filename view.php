<?php 

require 'app/Config.inc.php';

if (isset($_GET['id'])){
	
	$id = $_GET['id'];
	$categoria = $_GET['categoria'];

	$read = new Read();
			
	$read->FullRead("SELECT * FROM {$categoria} WHERE id= :id", "id={$id}");
			
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
	        <li class="li-login"><a href="index.php" class="login" style="color:#FFFFFF;" title="Página Inicial"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		

	<h1 class="detalhes">Detalhes:</h1>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 view">


			<?php
				if ($read->getResult() && $categoria == 'publicacao'){	
					foreach ($read->getResult() as $b){

						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Título:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['titulo'].'</p></div>
							</div>
						</div>';
						
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Autor(es):</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['autores'].'</p></div>
							</div>
						</div>';
						
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Resumo:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['resumo'].'</p></div>
							</div>
						</div>';
						
						
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Evento:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['evento'].'</p></div>
							</div>
						</div>';
												
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Ano:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['ano'].'</p></div>
							</div>
						</div>';
						
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Área:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['area'].'</p></div>
							</div>
						</div>';
						
					}
				}
				else if ($read->getResult() && $categoria == 'pesquisa'){	
					foreach ($read->getResult() as $b){
						
					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Título:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['titulo'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Bolsista:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['autores'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Orientador:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['orientador'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Resumo:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['resumo'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Modalidade da Bolsa:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['modalidade'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Financiamento:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['financiamento'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Outorga:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['outorga'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Período:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['ano'].'</p></div>
						</div>
					</div>';

					echo '
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-2 col-md-2"><p class="title">Área:</p></div>
							<div class="col-lg-10 col-md-10"><p>'.$b['area'].'</p></div>
						</div>
					</div>';
												
					
					}
				}
				
				else if ($read->getResult() && $categoria == 'extensao'){
					foreach ($read->getResult() as $b){


						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Título:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['titulo'].'</p></div>
							</div>
						</div>';

						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Aluno(os):</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['autores'].'</p></div>
							</div>
						</div>';
				
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Coordenador:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['coordenador'].'</p></div>
							</div>
						</div>';
						
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Resumo:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['resumo'].'</p></div>
							</div>
						</div>';				
				
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Unidade Executora:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['unidadeExecutora'].'</p></div>
							</div>
						</div>';
						
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Ano:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['ano'].'</p></div>
							</div>
						</div>';
				
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Data Inicial:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['dataInicio'].'</p></div>
							</div>
						</div>';		
									
						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Data Final:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['dataTermino'].'</p></div>
							</div>
						</div>';

						echo '
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-2 col-md-2"><p class="title">Área:</p></div>
								<div class="col-lg-10 col-md-10"><p>'.$b['area'].'</p></div>
							</div>
						</div>';
							
					}
				}
			?>
	

	<hr>
	
	<iframe src="uploads/<?php echo $b['arquivo']; ?>" width="100%" height="300" style="border: none;" download="<?php echo 'RIIFBA-'.$b['ano'].'-'.$b['id'];?>"></iframe>
	
	<br>
	<hr>
	<div class="col-lg-12 col-md-12 download">
		<a href="uploads/<?php echo $b['arquivo']; ?>" class="btn btn-success btn-lg" target="__blank" download="<?php echo 'RIIFBA-'.$b['ano'].'-'.$b['id'];?>"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Download</a>
	</div>




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