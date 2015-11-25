<?php 
	session_start();
	require 'app/Config.inc.php';
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
  	

	<?php
		$valida = false;
		
		$login = new Login();
		if ($login->CheckLogin()){
			header('Location: painel.php');
		}
		
		//filtros em forma de array
		
		$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if(!empty($dataLogin['AdminLogin'])){
			
			$login->ExeLogin($dataLogin);
			if (!$login->getResult()){
				//mensagens
				//echo $login->getError()[0];
				$valida = true;
			}
			else{
				header('Location: painel.php');
			}
			
		}
		
		
	?>




	<div class="container abcd">

		<div class="row text-center">
			<!-- <h1>RI<span class="ft">IFBA</span></h1> -->
						

			<div class="col-md-4 col-lg-4 col-xs-12 contor col-lg-offset-4 col-md-offset-4">
			<!-- <h2 class="hh">ÁREA DO ADMINISTRADOR</h2> -->
			<p><img src="assets/images/l.png"></p>
				<form action="" method="post" name="AdminLoginForm">

					<div class="form-group col-lg-12 col-md-12">
				    	<label class="sr-only" for="">Usuário</label>
						<input type="text" class="form-control i" name="user" placeholder="Usuário" required>
					</div>

					<div class="form-group col-lg-12 col-md-12">
				    	<label class="sr-only" for="">Senha</label>
						<input type="password" class="form-control i" name="pass" placeholder="Senha" required>
					</div>

					<div class="form-group col-lg-12 col-md-12">
						<input type="submit" class="btn btn-default i bt-entrar" name="AdminLogin" value="Entrar">
					</div>

				</form>
				
				<?php 
				if ($valida){
					MSG($login->getError()[0], $login->getError()[1]);
				}
				?>
				

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