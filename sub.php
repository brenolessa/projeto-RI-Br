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
	
	$excluir = '';
	$excluirTipo = '';
	$aprovado = false;
	
	$read = new Read();
	$read->ExeRead('publicacao', 'WHERE aprovado = :aprovado', 'aprovado=N');
	
	//aprovar
	if (isset($_GET['id'])){
		
		$i = $_GET['id'];
		
		$dados = [
				'aprovado' => 'S'
		];
		
		$update = new Update();
		$update->ExeUpdate('publicacao', $dados, "WHERE id = :id", "id={$i}");
		
		if ($update->getResult()){
			$aprovado = true;
			
			$read->ExeRead('publicacao', 'WHERE aprovado = :aprovado', 'aprovado=N');
		}
		
	}
	
	//deletar
	if (isset($_GET['e'])){
	
		$e = $_GET['e'];
		$p = $_GET['p'];
	
	
		$delete = new Delete();
		$delete->ExeDelete('publicacao', 'WHERE id= :id', "id={$e}");
	
	
		if ($delete->getResult()){
				
			$excluir = 'Publicação rejeitada com sucesso!';
			$excluirTipo = RI_MSG_SUCCESS;
			
			//excluindo o pdf
			unlink("uploads/{$p}");
			
			$read->ExeRead('publicacao', 'WHERE aprovado = :aprovado', 'aprovado=N');
				
		}
	
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>Repositório Institucional - IFBA - VCA</title>

    <?php require_once('assets.php');?>

    <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    
    <script type="text/javascript">
		function confirmar(){
			var x = confirm("Deseja realmente rejeitar esta publicação?");
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
        <h1 class="ls-title-intro ls-ico-thumbs-up">Aprovar Submissões - Publicação</h1>
	
		<div class="col-lg-12 col-xs-12" style="margin-bottom: 40px; ">
			<?php 
			if ($excluirTipo != ''){
				
				MSG($excluir, $excluirTipo);
			
			} else if ($aprovado){
				MSG('Publicação aprovada com sucesso!', RI_MSG_SUCCESS);
			}
			?>
		</div>
	
		<?php
			if ($read->getResult()){
		echo'
		<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
			<thead>
				<th style="text-align:center;">Título</th>
				<th style="text-align:center;">Autor (es)</th>
				<th style="text-align:center;">Evento</th>
				<th style="text-align:center;">Operações</th>
				
			</thead>
			<tbody>';
					
					foreach ($read->getResult() as $pub){
						echo '<tr>';
							echo '<td style="text-align:justify;">'.$pub['titulo'].'</td>';
							echo '<td style="text-align:center;">'.$pub['autores'].'</td>';
							echo '<td style="text-align:center;">'.$pub['evento'].'</td>';
							echo '<td style="text-align:center;">
    								<a href="sub.php?id='.$pub['id'].'" class="ls-btn ls-ico-checkmark bt-aprovar" title="Aprovar"></a>
								   	
    								<a onclick="return confirmar();" href="sub.php?e='.$pub['id'].'&p='.$pub['arquivo'].'" class="ls-btn ls-ico-close bt-deletar-reprovar" title="Rejeitar"></a>
								 </td>';

						echo '</tr>';
					
					}
		echo'			
			</tbody>
		</table>';
	
			}
			else {
				MSG('Nenhuma submissão encontrada!', RI_MSG_WARNING);
			}
		?>
		
	</div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>