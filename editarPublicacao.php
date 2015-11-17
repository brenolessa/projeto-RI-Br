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
	
	
	if (isset($_GET['id'])){
		
		$i = $_GET['id'];
		
		$busca = new Read();
		$busca->ExeRead("publicacao", "WHERE id = :id", "id={$i}");
		
	}
	
		
if (isset($_POST['titulo'])){	
	//$form= filter_input_array(INPUT_POST, FILTER_DEFAULT);
	//if($form && $form['submit']){
	
	
		//$file = $_FILES['pesquisa'];
		//if ($file['name']){
			//$upload = new Upload('uploads/');
			//$upload->File($file);
	
			
			$dados = [ 
				'titulo' => utf8_encode ( $_POST ['titulo'] ),
				'resumo' => utf8_encode ( $_POST ['resumo'] ),
				'ano' => $_POST ['ano'],
				'autores' => utf8_encode ( $_POST ['autores'] ),
				'evento' => utf8_encode ( $_POST ['evento'] ),
				'area' => utf8_encode ( $_POST ['area'] ) 
			];
			
			$update = new Update();
			$update->ExeUpdate('publicacao', $dados, "WHERE id = :id", "id={$i}");
			
			if ($update->getResult()){
				echo "{$update->getRowCount()} dados atualizados com sucesso! <hr>";
				//header("Location:editarPesquisa.php?id=$i");
				$busca->ExeRead("publicacao", "WHERE id = :id", "id={$i}");
				
			}
	
		}
		
		
	//}
	
	
	/*
	 * ANTIGO
	 * 
	 if (isset($_POST['titulo'])){	
	//$form= filter_input_array(INPUT_POST, FILTER_DEFAULT);
	//if($form && $form['submit']){
	
	
		//$file = $_FILES['pesquisa'];
		//if ($file['name']){
			//$upload = new Upload('uploads/');
			//$upload->File($file);
	
			
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
			
			$update = new Update();
			$update->ExeUpdate('pesquisa', $dados, "WHERE id = :id", "id={$i}");
			
			if ($update->getResult()){
				echo "{$update->getRowCount()} dados atualizados com sucesso! <hr>";
				var_dump($update);
			}
	
		}
		
		
	//}
	  */
	
	
	
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
        <h1 class="ls-title-intro ls-ico-pencil2">Editar Publicação</h1>

        <form action="editarPublicacao.php?id=<?= $i ?>" name="" method="post"
			enctype="multipart/form-data" class="ls-form ls-form-horizontal row">

			<label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Título:</b>
		      <input type="text" name="titulo" placeholder="Título da Publicação" value="<?php echo utf8_decode($busca->getResult()[0]['titulo']); ?>" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Resumo:</b>
		      <textarea name="resumo" placeholder="Resumo" rows="10" class="ls-field" required><?php echo utf8_decode($busca->getResult()[0]['resumo']); ?></textarea>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Ano:</b>
		      <input type="number" name="ano" placeholder="Ex: 2015" value="<?php echo $busca->getResult()[0]['ano']; ?>" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Autor(es):</b>
		      <input type="text" name="autores" placeholder="Autor(es)" value="<?php echo utf8_decode($busca->getResult()[0]['autores']); ?>" class="ls-field" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Evento:</b>
		      <input type="text" name="evento" placeholder="Evento" class="ls-field" value="<?php echo utf8_decode($busca->getResult()[0]['evento']); ?>" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Área</b>
		      <input type="text" name="area" placeholder="Área" class="ls-field" value="<?php echo utf8_decode($busca->getResult()[0]['area']); ?>" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Arquivo:</b>
		      <input type="file" name="publicacao" accept="application/pdf" class="ls-field" required>
		    </label>			

			<!-- <div class="ls-actions-btn col-lg-12 col-xs-12">
				<input type="submit" class="ls-btn" name="submit" value="Atualizar" />
			</div> -->

			<input type="submit" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4 botao-p" name="submit" value="Atualizar" />

		</form>
	
	</div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>