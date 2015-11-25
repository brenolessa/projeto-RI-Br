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
			
		$file = $_FILES['extensao'];
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
					'coordenador' => $_POST['coordenador'],
					'unidadeExecutora' => $_POST['unidadeExecutora'],
					'area' => $_POST['area'],
					'dataInicio' => $_POST['dataInicio'],
					'dataTermino' => $_POST['dataTermino']
					
			];
			
			if($upload->getResult()){
				$cadastra = new Create();
				$cadastra->ExeCreate('extensao', $dados);
				
				if ($cadastra->getResult()){
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
        <h1 class="ls-title-intro ls-ico-plus">Cadastro de Projeto de Extensão</h1>
		
		<?php
		if ($resultado){
		
			MSG("Cadastrado com sucesso!", RI_MSG_SUCCESS);
		
		} else if ($texto != null) {
			MSG($texto, RI_MSG_DANGER);
		}
		?>
		
		<?php MSG('Todos os campos são obrigatórios!', RI_MSG_INFO) ?>
	
	<form action="" name="cadExtensao" method="post" enctype="multipart/form-data" class="ls-form ls-form-horizontal row">
		
		<label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Título:</b>
	      <input type="text" name="titulo" placeholder="Título do Projeto de Extensão" class="ls-field" required>
	    </label>

	    <label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Resumo:</b>
	      <textarea name="resumo" placeholder="Resumo" rows="10" class="ls-field" required></textarea>
	    </label>

	    <label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Autor(es):</b>
	      <input type="text" name="autores" placeholder="Autor(es)" class="ls-field" required>
	    </label>

	    <label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Coordenador:</b>
	      <input type="text" name="coordenador" placeholder="Coordenador" class="ls-field" required>
	    </label>

	    <label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Área:</b>
	      <input type="text" name="area" placeholder="Área" class="ls-field" required>
	    </label>

	    <label class="ls-label col-lg-4 col-xs-12">
	      <b class="ls-label-text">Ano:</b>
	      <input type="number" name="ano" placeholder="Ex: 2015" class="ls-field" required>
	    </label>

	    <label class="ls-label col-lg-4 col-xs-12">
	      <b class="ls-label-text">Data de Início:</b>
	      <input type="date" name="dataInicio" class="ls-field" required>
	    </label>

	    <label class="ls-label col-lg-4 col-xs-12">
	      <b class="ls-label-text">Data de Término</b>
	      <input type="date" name="dataTermino" class="ls-field" required>
	    </label>

	    <label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Unidade Executora:</b>
	      <input type="text" name="unidadeExecutora" placeholder="Unidade Executora" class="ls-field" required>
	    </label>
		
		<label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Arquivo:</b>
	      <input type="file" name="extensao" accept="application/pdf" class="ls-field" required>
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