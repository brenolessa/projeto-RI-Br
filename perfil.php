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
  
  $busca = new Read();
  $busca->ExeRead("usuario", "WHERE codUsuario = :codUsuario", "codUsuario={$userLogin['codUsuario']}");
  
  $resultado = false;
  
  $form = filter_input_array ( INPUT_POST, FILTER_DEFAULT );
  if ($form && $form ['submit']) {
     	if (isset($_POST['login'])){
     		
     		$dados = [
     				'nome' => $_POST ['nome'],
     				'login' => $_POST ['login'],
     				'senha' => md5($_POST ['senha'])
     		];
     		
     		
     		$update = new Update();
     		$update->ExeUpdate('usuario', $dados, "WHERE codUsuario = :codUsuario", "codUsuario={$userLogin['codUsuario']}");
     			
     		if ($update->getResult()){
     				
     			$resultado = true;
     			$busca->ExeRead("usuario", "WHERE codUsuario = :codUsuario", "codUsuario={$userLogin['codUsuario']}");
     			
     			$_SESSION['userlogin']['nome'] = $_POST ['nome'];
     			
     			header("Refresh:0");
     			
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

    <?php 
    	require_once('aside.php');
    ?>
    <main class="ls-main">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-cog">Perfil</h1>
        
        <?php
		if ($resultado){
		
			MSG("Salvo com sucesso!", RI_MSG_SUCCESS);
		
		}
		?>
        
        <form action="" method="post" enctype="multipart/form-data" class="ls-form ls-form-horizontal row">

			<label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Nome:</b>
		      <input type="text" name="nome" placeholder="Nome" class="ls-field" value="<?= $busca->getResult()[0]['nome']; ?>" required>
		    </label>
		    
		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Usuário:</b>
		      <input type="text" name="login" placeholder="Usuário" class="ls-field" value="<?= $busca->getResult()[0]['login']; ?>" required>
		    </label>

		    <label class="ls-label col-lg-12 col-xs-12">
		      <b class="ls-label-text">Senha:</b>
		      <input type="text" name="senha" placeholder="Senha" class="ls-field" required>
		    </label>

			<input type="submit" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4 botao-p" name="submit" value="Salvar" />
			
		</form>
                     
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>