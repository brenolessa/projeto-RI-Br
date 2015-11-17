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
    <title>Repositório IFBA - VCA</title>

    <?php require_once('assets.php');?>
     
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Página inicial</h1>

    <h1>Painel</h1>
	<hr><br>

	<h1>CRUD PESQUISA:</h1><br>
	<a href="listaPesquisa.php">Lista de Pesquisa</a>
	<br>
	<br>
	<a href="cadastroPesquisa.php">Cadastro de Pesquisa</a>
	<br>
	
	<h1>CRUD EXTENSÃO:</h1><br>
	<a href="listaExtensao.php">Lista de Extensão</a>
	<br>
	<a href="cadastroExtensao.php">Cadastro de Extensão</a>
	<br>
	
	<h1>CRUD PUBLICAÇÃO:</h1><br>
	<a href="listaPublicacao.php">Lista de Publicação</a>
	<br>
	<a href="cadastroPublicacao.php">Cadastro de Publicação</a>
	<br>


    </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>