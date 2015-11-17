<?php
class Pesquisa extends Projeto {
	
	private $orientador;
	private $outorga;
	private $financiamento;
	private $area;
	
	function __construct() {
		parent::__construct();
	}
	
	public function getOrientador() {
		return $this->orientador;
	}
	
	public function setOrientador($orientador) {
		$this->orientador = $orientador;
		return $this;
	}
	
	public function getOutorga() {
		return $this->outorga;
	}
	
	public function setOutorga($outorga) {
		$this->outorga = $outorga;
		return $this;
	}
	
	public function getFinanciamento() {
		return $this->financiamento;
	}
	
	public function setFinanciamento($financiamento) {
		$this->financiamento = $financiamento;
		return $this;
	}
	
	public function getArea() {
		return $this->area;
	}
	
	public function setArea($area) {
		$this->area = $area;
		return $this;
	}
	
}