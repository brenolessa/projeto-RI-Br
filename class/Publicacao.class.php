<?php
class Publicacao extends Projeto{
	
	private $evento;
	private $area;
	
	function __construct() {
		parent::__construct();
	}
	
	public function getEvento() {
		return $this->evento;
	}
	
	public function setEvento($evento) {
		$this->evento = $evento;
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