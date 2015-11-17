<?php
class Conn {
	private static $host = HOST;
	private static $user = USER;
	private static $pass = PASS;
	private static $dbsa = DBSA;
	private static $connect = null;
	
	// Conecta com o bd com o pattern singleton, retorna
	// um objeto PDO;
	private static function Conectar() {
		try {
			if (self::$connect == null) {
				
				$dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbsa;
				$options = [ 
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' 
				];
				self::$connect = new PDO ( $dsn, self::$user, self::$pass, $options );
			}
		} catch ( PDOException $e ) {
			die ( "Erro {$e->getMessage()}" );
		}
		
		self::$connect->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return self::$connect;
	}
	
	// retorna um objeto PDO Singleton pattern.
	public static function getConn() {
		return self::Conectar ();
	}
}