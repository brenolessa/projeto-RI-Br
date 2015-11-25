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
	
	if (isset($_GET['id'])){
		
		$i = $_GET['id'];
		
		$busca = new Read();
		$busca->ExeRead("pesquisa", "WHERE id = :id", "id={$i}");
		
	}
	
		
if (isset($_POST['titulo'])){	
			
		$file = $_FILES['pesquisa'];
		if ($file['name']){
				
			//$pdf = substr($busca->getResult()[0]['arquivo'], 0, strrpos($busca->getResult()[0]['arquivo'], '.'));
		
			//unlink("uploads/{$pdf}");
								
			$upload = new Upload('uploads/');
			$upload->File($file);
			
			//se deu errado
			if ($upload->getError()){
				$texto = $upload->getError();
			}
			//se deu certo
			else {
				unlink("uploads/{$busca->getResult()[0]['arquivo']}");
				
				$dados=[
						'titulo' => $_POST['titulo'],
						'resumo' => $_POST['resumo'],
						'ano' => $_POST['ano'],
						'autores' => $_POST['autores'],
						'orientador' => $_POST['orientador'],
						'outorga' => $_POST['outorga'],
						'modalidade' => $_POST['modalidade'],
						'financiamento' => $_POST['financiamento'],
						'area' => $_POST['area'],
						'arquivo' => $upload->getResult()
				
				];
										
				$update = new Update();
				$update->ExeUpdate('pesquisa', $dados, "WHERE id = :id", "id={$i}");
					
				if ($update->getResult()){
					
					$resultado = true;
					//echo "{$update->getRowCount()} dados atualizados com sucesso! <hr>";
					//header("Location:editarPesquisa.php?id=$i");
					$busca->ExeRead("pesquisa", "WHERE id = :id", "id={$i}");
				
				}
			}
		
				
		} else {
			
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
						
			$update = new Update();
			$update->ExeUpdate('pesquisa', $dados, "WHERE id = :id", "id={$i}");
			
			if ($update->getResult()){
				
				$resultado = true;
				//echo "{$update->getRowCount()} dados atualizados com sucesso! <hr>";
				//header("Location:editarPesquisa.php?id=$i");
				$busca->ExeRead("pesquisa", "WHERE id = :id", "id={$i}");
				
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
        <h1 class="ls-title-intro ls-ico-pencil2">Editar Projeto de Pesquisa</h1>
        
        <?php
		if ($resultado){
		
			MSG("Atualizado com sucesso!", RI_MSG_SUCCESS);
		
		} else if ($texto != null) {
			MSG($texto, RI_MSG_DANGER);
		}
		?>

        <form action="editarPesquisa.php?id=<?= $i ?>" name="edPesquisa" method="post" enctype="multipart/form-data" class="ls-form ls-form-horizontal row">
		

			<label class="ls-label col-lg-12 col-xs-12">
			      <b class="ls-label-text">Título:</b>
			      <input type="text" name="titulo" placeholder="Título do Projeto de Pesquisa" value="<?php echo $busca->getResult()[0]['titulo']; ?>" class="ls-field" required>
			    </label>

			    <label class="ls-label col-lg-12 col-xs-12">
			      <b class="ls-label-text">Resumo:</b>
			      <textarea name="resumo" placeholder="Resumo" rows="10" class="ls-field" required><?php echo $busca->getResult()[0]['resumo']; ?></textarea>
			    </label>

			    <label class="ls-label col-lg-6 col-xs-12">
			      <b class="ls-label-text">Período:</b>
			      <input type="text" name="ano" placeholder="Ex: 2015 - 2016" class="ls-field" value="<?php echo $busca->getResult()[0]['ano']; ?>" required>
			    </label>

			    <label class="ls-label col-lg-6 col-xs-12">
			      <b class="ls-label-text">Número do Termo de Outorga:</b>
			      <input type="text" name="outorga" placeholder="Número do Processo ou Termo de Outorga" class="ls-field" value="<?php echo $busca->getResult()[0]['outorga']; ?>" required>
			    </label>

			    <label class="ls-label col-lg-6 col-xs-12">
			      <b class="ls-label-text">Modalidade da Bolsa:</b>
			      <input type="text" name="modalidade" placeholder="Modalidade da Bolsa" class="ls-field" value="<?php echo $busca->getResult()[0]['modalidade']; ?>" required>
			    </label>

			    <label class="ls-label col-lg-6 col-xs-12">
			      <b class="ls-label-text">Financiamento:</b>
			      <input type="text" name="financiamento" placeholder="Financiamento" class="ls-field" value="<?php echo $busca->getResult()[0]['financiamento']; ?>" required>
			    </label>

			    <label class="ls-label col-lg-12 col-xs-12">
			      <b class="ls-label-text">Autor(es):</b>
			      <input type="text" name="autores" placeholder="Autor(es)" class="ls-field" value="<?php echo $busca->getResult()[0]['autores']; ?>" required>
			    </label>

			    <label class="ls-label col-lg-12 col-xs-12">
			      <b class="ls-label-text">Orientador:</b>
			      <input type="text" name="orientador" placeholder="Orientador" class="ls-field" value="<?php echo $busca->getResult()[0]['orientador']; ?>" required>
			    </label>

			    <label class="ls-label col-lg-12 col-xs-12">
			      <b class="ls-label-text">Área:</b>
			      <input type="text" name="area" placeholder="Área" class="ls-field" value="<?php echo $busca->getResult()[0]['area']; ?>" required>
			    </label>

			    <label class="ls-label col-lg-12 col-xs-12">
			      <b class="ls-label-text">Arquivo:</b>
			      <input type="file" name="pesquisa" accept="application/pdf" class="ls-field">
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