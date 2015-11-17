<?php
class Projeto {
	protected $id;
	protected $titulo;
	protected $resumo;
	protected $ano;
	protected $autores;
	
	function __construct() {
		
	}
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
		return $this;
	}
	
	public function getResumo() {
		return $this->resumo;
	}
	
	public function setResumo($resumo) {
		$this->resumo = $resumo;
		return $this;
	}
	
	public function getAno() {
		return $this->ano;
	}
	
	public function setAno($ano) {
		$this->ano = $ano;
		return $this;
	}
	
	public function getAutores() {
		return $this->autores;
	}
	
	public function setAutores($autores) {
		$this->autores = $autores;
		return $this;
	}
	
}