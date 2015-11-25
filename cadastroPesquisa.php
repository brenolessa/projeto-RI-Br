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
	
	
	$resultado = false;
	$texto = null;
	
	$form= filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if($form && $form['submit']){
			
		$file = $_FILES['pesquisa'];
		if ($file['name']){
			$upload = new Upload('uploads/');
			$upload->File($file);
	
			if ($upload->getError()){
				$texto = $upload->getError();
			}
			
			$dados=[
					'titulo' => $_POST['titulo'],
					'resumo' => $_POST['resumo'],
					'ano' => $_POST['ano'],
					'autores' => $_POST['autores'],
					'orientador' => $_POST['orientador'],
					'outorga' => $_POST['outorga'],
					'modalidade' => $_POST['modalidade'],
					'financiamento' => $_POST['financiamento'],
					'area' => $_POST['area']
					
			];
			
			if($upload->getResult()){
				$cadastra = new Create();
				$cadastra->ExeCreate('pesquisa', $dados);
				
				if($cadastra->getResult()){
					$resultado = true;
				}
			}
			
		}

			
			
			
	
	}
	
	
	
	
	
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>Repositório Institucional - IFBA - VCA</title>

    <?php require_once('assets.php');?>
     
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-plus">Cadastro de Projeto de Pesquisa</h1>
		
		<?php
		if ($resultado){
		
			MSG("Cadastrado com sucesso!", RI_MSG_SUCCESS);
		
		} else if ($texto != null) {
			MSG($texto, RI_MSG_DANGER);
		}
		?>
		
		<?php MSG('Todos os campos são obrigatórios!', RI_MSG_INFO) ?>
	
	<form action="" name="cadPesquisa" method="post" enctype="multipart/form-data" class="ls-form ls-form-horizontal row">
		

		<label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Título:</b>
		      <input type="text" name="titulo" placeholder="Título do Projeto de Pesquisa" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Resumo:</b>
		      <textarea name="resumo" placeholder="Resumo" rows="10" class="ls-field" required></textarea>
		    </label>

		    <label class="ls-label col-lg-6 col-xs-12">
		      <b class="ls-label-text">Período:</b>
		      <input type="text" name="ano" placeholder="Ex: 2015 - 2016" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-6 col-xs-12">
		      <b class="ls-label-text">Número do Termo de Outorga:</b>
		      <input type="text" name="outorga" placeholder="Número do Processo ou Termo de Outorga" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-6 col-xs-12">
		      <b class="ls-label-text">Modalidade da Bolsa:</b>
		      <input type="text" name="modalidade" placeholder="Modalidade da Bolsa" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-6 col-xs-12">
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
		      <b class="ls-label-text">Área:</b>
		      <input type="text" name="area" placeholder="Área" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Arquivo:</b>
		      <input type="file" name="pesquisa" accept="application/pdf" class="ls-field" required>
		    </label>			

			<input type="submit" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4 botao-p" name="submit" value="Cadastrar" />

	</form>

	

	</div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>