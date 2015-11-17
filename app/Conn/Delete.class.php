<?php

class Delete extends Conn {
	
	private $tabela;
	private $termos;
	private $places;
	private $result;
	
	/** @var PDOStatement*/
	private $delete;
	
	/** @var PDO*/
	private $conn;
	
	public function ExeDelete($tabela, $termos, $parseString) {
		$this->tabela = (string) $tabela;
		$this->termos = (string) $termos;
		
		parse_str($parseString, $this->places);
		$this->getSyntax();
		$this->Execute();
	}
	
	public function getResult() {
		return $this->result;
	}
	
	public function getRowCount() {
		return $this->delete->rowCount();
	}
		
	public function setPlaces($parseString) {
		parse_str($parseString, $this->places);
		$this->getSyntax();
		$this->Execute();
	}
	
	private function Connect() {
		$this->conn = parent::getConn();
		$this->delete = $this->conn->prepare($this->delete);
	}
	
	private function getSyntax() {
		$this->delete = "DELETE FROM {$this->tabela} {$this->termos}";
	}
	
	//obter a conexao e executar
	private function Execute() {
		$this->Connect();
		
		try {
			
			$this->delete->execute($this->places);
			$this->result = true;
		
		} catch (PDOException $e) {
			$this->result = null;
			echo "<b>Erro ao deletar:</b> {$e->getMessage()}";
		}
	}
	
}