<?php
class Extensao extends Projeto{
	
	private $coordenador;
	private $dataInicio;
	private $dataTermino;
	private $UnidadeExecutora;
	
	function __construct() {
		parent::__construct();
	}
	
	public function getCoordenador() {
		return $this->coordenador;
	}
	
	public function setCoordenador($coordenador) {
		$this->coordenador = $coordenador;
		return $this;
	}
	
	public function getDataInicio() {
		return $this->dataInicio;
	}
	
	public function setDataInicio($dataInicio) {
		$this->dataInicio = $dataInicio;
		return $this;
	}
	
	public function getDataTermino() {
		return $this->dataTermino;
	}
	
	public function setDataTermino($dataTermino) {
		$this->dataTermino = $dataTermino;
		return $this;
	}
	
	public function getUnidadeExecutora() {
		return $this->UnidadeExecutora;
	}
	
	public function setUnidadeExecutora($UnidadeExecutora) {
		$this->UnidadeExecutora = $UnidadeExecutora;
		return $this;
	}
	
}