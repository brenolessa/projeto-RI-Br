<?php 

require 'app/Config.inc.php';

if (isset($_GET['id'])){
	
	$id = $_GET['id'];
	$categoria = $_GET['categoria'];

	$read = new Read();
	
	echo "Pesquisa...";
			
	$read->FullRead("SELECT * FROM {$categoria} WHERE id= :id", "id={$id}");
		
	if ($read->getConn()){
		//var_dump($read->getResult());
		echo "<hr>";
	
	}
		
	//var_dump($read);
	
	
	
	
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title></title>
</head>
<body>
	<a href="admin.php">PAINEL ADMIN</a>
	
	<hr>
	
	<br><br><br><br>
	<h1>Detalhes:</h1>

	
	<table>
		
		<tbody>
			<?php
				if ($read->getResult() && $categoria == 'publicacao'){	
					foreach ($read->getResult() as $b){
						
						echo '<tr>';
							echo '<td>Título</td>';
							echo '<td>'.utf8_decode($b['titulo']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Autor (es)</td>';
							echo '<td>'.utf8_decode($b['autores']).'</td>';
						echo '</tr>';
						
						
						echo '<tr>';
							echo '<td>Resumo</td>';
							echo '<td>'.utf8_decode($b['resumo']).'</td>';
						echo '</tr>';
												
						echo '<tr>';
							echo '<td>Evento</td>';
							echo '<td>'.utf8_decode($b['evento']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Ano</td>';
							echo '<td>'.$b['ano'].'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Área</td>';
							echo '<td>'.utf8_decode($b['area']).'</td>';
						echo '</tr>';
												
					
					}
				}
				else if ($read->getResult() && $categoria == 'pesquisa'){	
					foreach ($read->getResult() as $b){
						
						echo '<tr>';
							echo '<td>Título</td>';
							echo '<td>'.utf8_decode($b['titulo']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Bolsista</td>';
							echo '<td>'.utf8_decode($b['autores']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Orientador</td>';
							echo '<td>'.utf8_decode($b['orientador']).'</td>';
						echo '</tr>';						
						
						echo '<tr>';
							echo '<td>Resumo</td>';
							echo '<td>'.utf8_decode($b['autores']).'</td>';
						echo '</tr>';
											
						echo '<tr>';
							echo '<td>Financiamento</td>';
							echo '<td>'.utf8_decode($b['financiamento']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Outorga</td>';
							echo '<td>'.utf8_decode($b['outorga']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Ano</td>';
							echo '<td>'.$b['ano'].'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Área</td>';
							echo '<td>'.utf8_decode($b['area']).'</td>';
						echo '</tr>';
												
					
					}
				}
				
				else if ($read->getResult() && $categoria == 'extensao'){
					foreach ($read->getResult() as $b){
				
						echo '<tr>';
							echo '<td>Título:</td>';
							echo '<td>'.utf8_decode($b['titulo']).'</td>';
						echo '</tr>';
				
						echo '<tr>';
							echo '<td>Aluno (os):</td>';
							echo '<td>'.utf8_decode($b['autores']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Coordenador:</td>';
							echo '<td>'.utf8_decode($b['coordenador']).'</td>';
						echo '</tr>';				
				
						echo '<tr>';
							echo '<td>Resumo:</td>';
							echo '<td>'.utf8_decode($b['autores']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Unidade Executora:</td>';
							echo '<td>'.utf8_decode($b['unidadeExecutora']).'</td>';
						echo '</tr>';
				
						echo '<tr>';
							echo '<td>Ano:</td>';
							echo '<td>'.$b['ano'].'</td>';
						echo '</tr>';		
									
						echo '<tr>';
							echo '<td>Data Inicial:</td>';
							echo '<td>'.utf8_decode($b['dataInicio']).'</td>';
						echo '</tr>';
						
						echo '<tr>';
							echo '<td>Data Final:</td>';
							echo '<td>'.utf8_decode($b['dataTermino']).'</td>';
						echo '</tr>';
				
				/*
						echo '<tr>';
						echo '<td>Área</td>';
						echo '<td>'.utf8_decode($b['area']).'</td>';
						echo '</tr>';
				*/
							
					}
				}
			?>
						
		</tbody>
	</table>
	
	<hr>
	<br>
	
	<hr>
	
	<iframe src="uploads/files/2015/11/ednaldo-tradu-o.pdf" width="50%" height="200" style="border: none;" download="newfilename"></iframe>
	<br>
	<a href="uploads/files/2015/11/ednaldo-tradu-o.pdf" target="__blank" download="<?php echo $b['ano'];?>">Visualizar</a>
	
</body>
</html>