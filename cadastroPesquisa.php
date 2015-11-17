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
	
	
	
	
	$form= filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if($form && $form['submit']){
			
		$file = $_FILES['pesquisa'];
		if ($file['name']){
			$upload = new Upload('uploads/');
			$upload->File($file);
	
			
			$dados=[
					'titulo' => utf8_encode($_POST['titulo']),
					'resumo' => utf8_encode($_POST['resumo']),
					'ano' => $_POST['ano'],
					'autores' => utf8_encode($_POST['autores']),
					'orientador' => utf8_encode($_POST['orientador']),
					'outorga' => $_POST['outorga'],
					'financiamento' => utf8_encode($_POST['financiamento']),
					'area' => utf8_encode($_POST['area'])
					
			];
			
			$cadastra = new Create();
			$cadastra->ExeCreate('pesquisa', $dados);
			
			if ($cadastra->getResult()){
				echo "Cadastro com sucesso!<hr>";
				echo 'ID:'.$cadastra->getResult();
			}

			var_dump($upload, $cadastra);
		}

			
			
			
	
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
        <h1 class="ls-title-intro ls-ico-plus">Cadastro de Projeto de Pesquisa</h1>
	
	<form action="" name="cadPesquisa" method="post" enctype="multipart/form-data" class="ls-form ls-form-horizontal row">
		

		<label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">T�tulo:</b>
		      <input type="text" name="titulo" placeholder="T�tulo do Projeto de Pesquisa" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Resumo:</b>
		      <textarea name="resumo" placeholder="Resumo" rows="10" class="ls-field" required></textarea>
		    </label>

		    <label class="ls-label col-lg-4 col-xs-12">
		      <b class="ls-label-text">Ano:</b>
		      <input type="number" name="ano" placeholder="Ex: 2015" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-4 col-xs-12">
		      <b class="ls-label-text">N�mero do Termo de Outorga:</b>
		      <input type="text" name="outorga" placeholder="N�mero do Processo ou Termo de Outorga" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-4 col-xs-12">
		      <b class="ls-label-text">Financiamento:</b>
		      <input type="text" name="financiamento" placeholder="Financiamento" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Autor(es):</b>
		      <input type="text" name="autores" placeholder="Autor(es)" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Orientador:</b>
		      <input type="text" name="orientador" placeholder="Orientador" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">�rea:</b>
		      <input type="text" name="area" placeholder="�rea" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Arquivo:</b>
		      <input type="file" name="pesquisa" accept="application/pdf" class="ls-field" required>
		    </label>			

			<!-- <div class="ls-actions-btn col-lg-12 col-xs-12 col-lg-push-4">
				<input type="submit" class="ls-btn-primary botao-p" name="submit" value="Cadastrar" />
			</div> -->

			<input type="submit" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4 botao-p" name="submit" value="Cadastrar" />

	</form>

	

	</div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>