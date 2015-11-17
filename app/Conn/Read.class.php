<?php

class Read extends Conn {
	
	private $select;
	private $places;
	private $result;
	
	/** @var PDOStatement*/
	private $read;
	
	/** @var PDO*/
	private $conn;
	
	public function ExeRead($tabela, $termos = null, $parseString = null) {
		if (!empty($parseString)){
			$this->places = $parseString;
			parse_str($parseString, $this->places);
		}
		
		$this->select = "SELECT * FROM {$tabela} {$termos}";
		$this->Execute();
	}
	
	public function getResult() {
		return $this->result;
	}
	
	public function getRowCount() {
		return $this->read->rowCount();
	}
	
	public function FullRead($query, $parseString = null) {
		$this->select = (string) $query;
		
		if (!empty($parseString)){
			parse_str($parseString, $this->places);
		}
		
		$this->Execute();
	}
	
	public function setPlaces($parseString) {
		parse_str($parseString, $this->places);
		$this->Execute();
	}
	
	private function Connect() {
		$this->conn = parent::getConn();
		$this->read = $this->conn->prepare($this->select);
		$this->read->setFetchMode(PDO::FETCH_ASSOC);
	}
	
	private function getSyntax() {
		if ($this->places){
			foreach ($this->places as $vinculo => $valor){
				if($vinculo == 'limit' || $vinculo == 'offset'){
					$valor = (int) $valor;
				}
				
				$this->read->bindValue(":{$vinculo}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
			}
		}
	}
	
	//obter a conexao e executar
	private function Execute() {
		$this->Connect();
		
		try {
			$this->getSyntax();
			$this->read->execute();
			$this->result = $this->read->fetchAll();
			
		} catch (PDOException $e) {
			echo "<b>Erro ao ler:</b> {$e->getMessage()}";
		}
	}
	
}