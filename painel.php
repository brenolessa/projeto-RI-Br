<?php 	
	session_start();
	require 'app/Config.inc.php';
	$login = new Login();
	
	if (!$login->CheckLogin()){
		unset($_SESSION['userlogin']);
		header('Location: index.php?exe=restrito');
	
	}
	else{
		$userLogin = $_SESSION['userlogin'];
	}
		
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>Reposit�rio IFBA - VCA</title>

    <?php require_once('assets.php');?>
     
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">P�gina inicial</h1>

    <h1>Painel</h1>
	<hr><br>

	<h1>CRUD PESQUISA:</h1><br>
	<a href="listaPesquisa.php">Lista de Pesquisa</a>
	<br>
	<br>
	<a href="cadastroPesquisa.php">Cadastro de Pesquisa</a>
	<br>
	
	<h1>CRUD EXTENS�O:</h1><br>
	<a href="listaExtensao.php">Lista de Extens�o</a>
	<br>
	<a href="cadastroExtensao.php">Cadastro de Extens�o</a>
	<br>
	
	<h1>CRUD PUBLICA��O:</h1><br>
	<a href="listaPublicacao.php">Lista de Publica��o</a>
	<br>
	<a href="cadastroPublicacao.php">Cadastro de Publica��o</a>
	<br>


    </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>