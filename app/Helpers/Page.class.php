<?php

class Page{
	
	// Define o PAGER
	private $page;
	private $limit;
	private $offset;
	
	//Realiza a leitura
	private $tabela;
	private $termos;
	private $places;
	
	// Define o paginator
	private $rows;
	private $link;
	private $maxLinks;
	private $first;
	private $last;
	
	// Renderiz o paginar
	private $paginator;
	
	
	function __construct($link, $first = null, $last = null, $maxLinks = null) {
		$this->link = (string) $link;
		$this->first = ((string) $first ? $first : 'Primeira Página');
		$this->last = ((string) $last ? $last : 'Última Página');
		$this->maxLinks = ((int) $maxLinks ? $maxLinks : 5);
	}
	
	public function ExePager($page, $limit) {
		$this->page = ((int) $page ? $page : 1);
		$this->limit = (int) $limit;
		$this->offset = ($this->page * $this->limit) - $this->limit;
	}
	
	public function ReturnPage() {
		if ($this->page > 1){
			$nPage = $this->page - 1;
			header("Location: {$this->link}{$nPage}");
		}
	}
	
	public function getPage() {
		return $this->page;
	}
	
	public function getLimit() {
		return $this->limit;
	}
	
	public function getOffset() {
		return $this->offset;
	}
	
	public function ExePaginator($tabela, $termos = null, $parseString = null) {
		$this->tabela = (string) $tabela;
		$this->termos = (string) $termos;
		$this->places = (string) $parseString;
		
		$this->getSyntax();
	}
	
	public function getPaginator() {
		return $this->paginator;
	}
	
	private function getSyntax() {
		$read = new Read();
		$read->ExeRead($this->tabela, $this->termos, $this->places);
		$this->rows = $read->getRowCount();
	
		if($this->rows > $this->limit){
			$paginas = ceil($this->rows / $this->limit);
			$maxLinks = $this->maxLinks;
				
			$this->paginator = "<ul class=\"paginator\">";
			$this->paginator .= "<li><a title=\"{$this->first}\" href=\"{$this->link}1\">{$this->first}</a></li>";
			
			for ($iPag = $this->page - $maxLinks; $iPag <= $this->page - 1; $iPag ++){
				if($iPag >= 1){
					$this->paginator .= "<li><a title=\"Página {$iPag}\" href=\"{$this->link}{$iPag}\">{$iPag}</a></li>";
				}
			}
			
			$this->paginator .="<li><span=\"active\">{$this->page}</li>";
			
			for ($dPag = $this->page + 1; $dPag <= $this->page + $maxLinks; $dPag ++){
				if($dPag <= $paginas){
					$this->paginator .= "<li><a title=\"Página {$dPag}\" href=\"{$this->link}{$dPag}\">{$dPag}</a></li>";
				}
			}
			
			$this->paginator .= "<li><a title=\"{$this->last}\" href=\"{$this->link}{$paginas}\">{$this->last}</a></li>";
			$this->paginator .="</ul>";
		}
	}
	
	
	
	
	
	
	
}