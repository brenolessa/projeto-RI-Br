<?php 
	session_start();
	require 'app/Config.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title></title>
</head>
<body>
	<?php
			
		$login = new Login();
		if ($login->CheckLogin()){
			header('Location: painel.php');
		}
		
		//filtros em forma de array
		
		$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if(!empty($dataLogin['AdminLogin'])){
			
			$login->ExeLogin($dataLogin);
			if (!$login->getResult()){
				//mensagens
				echo $login->getError()[0];
			}
			else{
				header('Location: painel.php');
			}
			
			$get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
			if (!empty($get)){
				if ($get == 'restrito'){
					echo 'Acesso negado: Por favor efetue login para acessar o painel!';
				}
			}
			else if($get == 'logoff') {
				echo 'Sucesso ao deslogar: Sua sessão foi finalizada. Volte sempre!';
			}
		}
		
		
	?>
	<h1>Administrar Site:</h1>
	<form action="" name="AdminLoginForm" method="post">
		<label>
			<span>E-mail:</span>
			<input type="text" name="user" />
		</label>
		
		<label>
			<span>Senha:</span>
			<input type="password" name="pass" />
		</label>
		
		<input type="submit" name="AdminLogin" value="Logar" />
		
	</form>
</body>
</html>