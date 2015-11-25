<?php

class Login{
	
	//autenticar, validar e checar usuários do sistema de login.
	
	private $level;
	private $login;
	private $senha;
	private $error;
	private $result;
	
	function __construct() {
		
	}
	
	public function ExeLogin(array $userData) {
		$this->login = (string) strip_tags(trim($userData['user']));
		$this->senha = (string) strip_tags(trim($userData['pass']));
		$this->setLogin();
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function getResult() {
		return $this->result;
	}
	
	
	//VERIFICA A SESSÃO
	public function CheckLogin() {
		if (empty($_SESSION['userlogin'])){
			unset($_SESSION['userlogin']);
			return false;
		}
		else{
			return true;
		}
	}
	
	
	private function setLogin() {
		if (!$this->login || !$this->senha){
			$this->error = ['Informe seu login e senha!' , RI_MSG_WARNING];
			$this->result = false;
		}
		else if (!$this->getUser()){
			$this->error = ['Dados inválidos!' , RI_MSG_DANGER];
			$this->result = false;
		}
		else {
			$this->Execute();
		}
	}
	
	private function getUser() {
		
		$this->senha = md5($this->senha);
		
		$read = new Read();
		$read->ExeRead('usuario', "WHERE login = :e AND senha = :p", "e={$this->login}&p={$this->senha}");
		if ($read->getResult()){
			$this->result = $read->getResult()[0];
			return true;
		}
		else{
			return false;
		}
	}
	
	private function Execute() {
		if (!session_id()){
			session_start();
		}
		
		$_SESSION['userlogin'] = $this->result;
		$this->error = ["Olá {$this->result['user_name']}, seja bem vindo(a). Aguarde redirecionamento!"];
		$this->result = true;
	}
	
	
	
}