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
	
	
	$read = new Read();
	
	$form= filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if($form && $form['submit']){
	
		if (isset($form['submit'])){
			
			
			
		
	
			if ((!$_POST['titulo']) && (!$_POST['autores']) && (!$_POST['evento'])){
				echo "Tudo vazio!";			
				
			} 
			else if (($_POST['titulo'])){
				echo "Título";
				
				
				$read->FullRead("SELECT * FROM publicacao WHERE titulo LIKE :like", "like={$_POST['titulo']}%");
				//$read->ExeRead('pesquisa', 'WHERE outorga = :outorga LIMIT :limit', "name=chrome&views=2&limit=2");
					
				//$read->setPlaces("name=firefox&views=2&limit=2");
					
				if ($read->getConn()){
					var_dump($read->getResult());
					echo "<hr>";

				}
					
				//outorga, titulo, autores
					
				var_dump($read);
				
			}
			else if (($_POST['autores'])){
				echo "Autores";
	
				//$read = new Read();
				$read->FullRead("SELECT * FROM publicacao WHERE autores LIKE :like", "like={$_POST['autores']}%");
				//$read->ExeRead('pesquisa', 'WHERE outorga = :outorga LIMIT :limit', "name=chrome&views=2&limit=2");
				
				//$read->setPlaces("name=firefox&views=2&limit=2");
				
				if ($read->getConn()){
					var_dump($read->getResult());
					echo "<hr>";

				}
				
				//outorga, titulo, autores
				
				var_dump($read);
			}
			else if (($_POST['evento'])){
				echo "Evento";
								
				//$read = new Read();
				$read->FullRead("SELECT * FROM publicacao WHERE evento LIKE :like", "like={$_POST['evento']}%");
				//$read->ExeRead('pesquisa', 'WHERE outorga = :outorga LIMIT :limit', "name=chrome&views=2&limit=2");
				
				//$read->setPlaces("name=firefox&views=2&limit=2");
				
				if ($read->getConn()){
					var_dump($read->getResult());
					echo "<hr>";
					
				}
				
				//outorga, titulo, autores
				
				var_dump($read);
			}
			
		}
		
		
		
		
	}
	
	if (isset($_GET['e'])){
	
		$e = $_GET['e'];
	
	
		$delete = new Delete();
		$delete->ExeDelete('publicacao', 'WHERE id= :id', "id={$e}");
	
	
		if ($delete->getResult()){
			echo "{$delete->getRowCount()} removidos com sucesso!";
		}
	
		var_dump($delete);
	
	}
	
	
	
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>Repositório IFBA - VCA</title>

    <?php require_once('assets.php');?>

    <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">
		function confirmar(){
			var x = confirm("Deseja realmente excluir?");
			if(x == true){
				return true;
			}
			else
				return false;
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#tb1').dataTable({
				// "bJQueryUI": true,
				// "sPaginationType": "full_numbers",
				// "sDom": '<"H"Tlfr>t<"F"ip>',
				"oLanguage": {
					"sLengthMenu": "Registros/Página _MENU_",
					"sZeroRecords": "Nenhum registro encontrado",
					"sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
					"sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
					"sInfoFiltered": "(filtrado de _MAX_ registros)",
					"sSearch": "Pesquisar: ",
					"oPaginate": {
						// "sFirst": " Primeiro ",
						"sPrevious": " Anterior ",
						"sNext": " Próximo ",
						// "sLast": " Último "
					}
				},
				"aaSorting": [[0, 'desc']],
				"aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
			});

		});
	</script>

  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-search">Pesquisar Publicação</h1>

	
	<form action="" name="cadPublicacao" method="post" enctype="multipart/form-data" class="ls-form ls-form-horizontal row">

		<label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Título:</b>
	      <input type="text" name="titulo" placeholder="Título da Publicação" class="ls-field">
	    </label>

	    <label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Autor(es):</b>
	      <input type="text" name="autores" placeholder="Autor(es)" class="ls-field">
	    </label>

	    <label class="ls-label col-lg-12 col-xs-12">
	      <b class="ls-label-text">Evento:</b>
	      <input type="text" name="evento" placeholder="Evento" class="ls-field">
	    </label>

		<!-- <div class="ls-actions-btn col-lg-12 col-xs-12 col-lg-push-4">
			<input type="submit" class="ls-btn-primary botao-pesq" name="submit" value="Pesquisar" />
		</div> -->

		<input type="submit" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4 botao-pesq" name="submit" value="Pesquisar" />

	</form>
	
	<hr>
	
	<?php
		if ($read->getResult()){
	echo'
	<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
		<thead>
			<th>Título</th>
			<th>Autor (es)</th>
			<th>Evento</th>
			<th>Editar</th>
			<th>Excluir</th>
		</thead>
		<tbody>';
				
				foreach ($read->getResult() as $pub){
					echo '<tr>';
						echo '<td>'.utf8_decode($pub['titulo']).'</td>';
						echo '<td>'.utf8_decode($pub['autores']).'</td>';
						echo '<td>'.utf8_decode($pub['evento']).'</td>';
						echo '<td><a href="editarPublicacao.php?id='.$pub['id'].'">Editar</a></td>';
						echo '<td><a onclick="return confirmar();" href="listaPublicacao.php?e='.$pub['id'].'">Excluir</a></td>';
					echo '</tr>';
				
				}
	echo'			
		</tbody>
	</table>';

		}
	?>

	<div class="contorno col-lg-12 col-xs-12">
		<br><br>
		<a href="cadastroPublicacao.php" class="ls-btn-primary col-lg-3 col-xs-12 botao-p ls-float-right">Cadastrar</a>
	</div>
	
	<?php 
	
	/*
	
		if ($read->getResult()){
			
			
			foreach ($read->getResult() as $pub){
				echo $pub['id'].'<br>';
				echo utf8_decode($pub['titulo']).'<br>';
				echo utf8_decode($pub['resumo']).'<br>';
				echo $pub['ano'].'<br>';
				echo utf8_decode($pub['autores']).'<br>';
				echo utf8_decode($pub['evento']).'<br>';
				echo utf8_decode($pub['area']).'<br>';
				echo '<hr><br>';

			}
			
		}
	*/
	?>
	
	
	</div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>