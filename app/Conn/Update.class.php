<?php

class Update extends Conn {
	
	private $tabela;
	private $dados;
	private $termos;
	private $places;
	private $result;
	
	/** @var PDOStatement*/
	private $update;
	
	/** @var PDO*/
	private $conn;
	
	public function ExeUpdate($tabela, array $dados, $termos, $parseString) {
		$this->tabela = (string) $tabela;
		$this->dados = $dados;
		$this->termos = (string) $termos;
		
		parse_str($parseString, $this->places);
		$this->getSyntax();
		$this->Execute();
	}
	
	public function getResult() {
		return $this->result;
	}
	
	public function getRowCount() {
		return $this->update->rowCount();
	}
		
	public function setPlaces($parseString) {
		parse_str($parseString, $this->places);
		$this->getSyntax();
		$this->Execute();
	}
	
	private function Connect() {
		$this->conn = parent::getConn();
		$this->update = $this->conn->prepare($this->update);
	}
	
	private function getSyntax() {
		foreach ($this->dados as $key => $value){
			$places[] = $key . ' = :' . $key;
		}
		
		$places = implode(', ', $places);
		$this->update = "UPDATE {$this->tabela} SET {$places} {$this->termos}";
	}
	
	//obter a conexao e executar
	private function Execute() {
		$this->Connect();
		
		try {
			$this->update->execute(array_merge($this->dados, $this->places));
			$this->result = true;
			
		} catch (PDOException $e) {
			echo "<b>Erro ao ler:</b> {$e->getMessage()}";
		}
	}
	
}