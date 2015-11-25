<?php

// CONFIGURAÇÕES
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DBSA", "repositorio");



// AUTO LOAD DE CLASSES
function __autoload($Class) {
	$cDir = ['Conn', 'Helpers', 'Models'];
	$iDir = null;
	
	foreach ($cDir as $dirName){
		
		
		
		if ((!$iDir) && (file_exists(__DIR__ . "\\{$dirName}\\{$Class}.class.php")) && (!is_dir(__DIR__ . "\\{$dirName}\\{$Class}.class.php"))){
			include_once(__DIR__ . "\\{$dirName}\\{$Class}.class.php");
			$iDir = true;
		}
	}
	
	if (!$iDir){
		echo "Não foi possível incluir {$dirName}.class.php";
		die;
	}
	
}


//variáveis
define('RI_MSG_SUCCESS', 'success');
define('RI_MSG_INFO', 'info');
define('RI_MSG_WARNING', 'warning');
define('RI_MSG_DANGER', 'danger');

// Mensagens do sistema
function MSG($msg, $tipo) {
	
	echo 	
		'<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="alert alert-'.$tipo.' alert-dismissible" role="alert">
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  					'.$msg.'
				</div>
  			</div>
  		</div>';
	
}











