<?php

class Create extends Conn {
	
	private $tabela;
	private $dados;
	private $result;
	
	/** @var PDOStatement*/
	private $create;
	
	/** @var PDO*/
	private $conn;
	
	public function ExeCreate($tabela, array $dados) {
		$this->tabela = (string) $tabela;
		$this->dados = $dados;	
		$this->getSyntax();
		$this->Execute();
	}
	
	public function getResult() {
		return $this->result;
	}
	
	private function Connect() {
		// obteve a conexão
		$this->conn = parent::getConn();
		//cria a query
		$this->create = $this->conn->prepare($this->create);
	}
	
	private function getSyntax() {
		//prepared statements
		$fileds = implode(', ', array_keys($this->dados));
		$places = ':'.implode(', :', array_keys($this->dados));
		$this->create = "INSERT INTO {$this->tabela} ({$fileds}) VALUES ({$places})";
	}
	
	//obter a conexao e executar
	private function Execute() {
		$this->Connect();
		try {
			$this->create->execute($this->dados);
			$this->result = $this->conn->lastInsertId();
			
			
		} catch (PDOException $e) {
			$this->result = null;
			echo "<b>Erro ao cadastrar:</b> {$e->getMessage()}";
		}
	}
	
}