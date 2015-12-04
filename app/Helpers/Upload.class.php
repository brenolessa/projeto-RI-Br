<?php
class Upload {
	
	private $file;
	private $name;
	private $send;
	
	//image upload
	private $width;
	private $image;
	
	//resultset
	private $result;
	private $error;
	//diretorios
	private $folder;
	private static $baseDir;
	
	
	function __construct($baseDir = null) {
		self::$baseDir = ( (string) $baseDir ? $baseDir: 'uploads/');
		if (!file_exists(self::$baseDir) && !is_dir(self::$baseDir)){
			mkdir(self::$baseDir, 0777);
		}
	}
		
	// o de file se tirar o 2º if ele aceita qualquer arquivo.
	// foi criado o de imagem separado pq ele está fazendo redimensionamento nas imagens.
	
	public function File(array $file, $name = null, $folder = null, $maxFileSize = null) {
		$this->file = $file;
		$this->name = ((string) $name ? $name : substr($file['name'], 0, strrpos($file['name'], '.')));
		$this->folder = ((string) $folder ? $folder : 'files');
		// 2 abaixo é o tamanho do arquivo. MB
		$maxFileSize = ((int) $maxFileSize ? $maxFileSize : 5);
		
		// aceitar pdf e docx
		$fileAccept = [
				'application/pdf'
		];
		
		if ($this->file['size'] > ($maxFileSize * (1024 * 1024))){
			$this->result = false;
			$this->error = "Arquivo muito grande, tamanho máximo permitido é de {$maxFileSize}mb.";
		}
		else if (!in_array($this->file['type'], $fileAccept)){
			$this->result = false;
			$this->error = 'Tipo de arquivo não aceito! Envie .PDF';
		}
		else {
			$this->CheckFolder($this->folder);
			$this->setFileName();
			$this->MoveFile();
		}
		
	}
		
	
	//PRIVATES
	private function CheckFolder($folder) {
		//list($y, $m) = explode('/', date('Y/m'));
		$this->CreateFolder("{$folder}");
		//$this->CreateFolder("{$folder}/{$y}");
		//$this->CreateFolder("{$folder}/{$y}/{$m}/");
		//$this->send = "{$folder}/{$y}/{$m}/";
		$this->send = "{$folder}/";
	}
	
	private function CreateFolder($folder) {
		if (!file_exists(self::$baseDir . $folder) && !is_dir(self::$baseDir . $folder)){
			mkdir(self::$baseDir . $folder, 0777);
		}	
	}
	
	public function getResult() {
		return $this->result;
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function getName() {
		return $this->name;
	}
	
	//VOLTAR AQUI DEPOIS
	
	private function setFileName() {
		//$fileName = Check::Name($this->name) . strrchr($this->file['name'], '.');

		$fileName = time() . strrchr($this->file['name'], '.');
		
		if (file_exists(self::$baseDir . $this->send . $fileName)){
			$fileName = Check::Name($this->name) . '-' . time() . strrchr($this->file['name'], '.');
		}
		$this->name = $fileName;
	}
		
	//Envia arquivos e mídias
	private function MoveFile() {
		if (move_uploaded_file($this->file['tmp_name'], self::$baseDir . $this->send . $this->name)){
			$this->result = $this->send . $this->name;
			$this->error = null;
		}
		else{
			$this->result = false;
			$this->error = 'Erro ao mover o arquivo. Favor tente mais tarde!';
		}
	}
		
	
	
	
	
	
}