<?php

class Check {
	
	private static $data;
	private static $format;
	
	public static function Name($name) {
		self::$format = array();
		self::$format['a'] = 'ÀÁÂÃÄÅÆÇçÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
		self::$format['b'] = 'aaaaaaacceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
	
		self::$data = strtr(utf8_decode($name), utf8_decode(self::$format['a']), self::$format['b']);
		self::$data = strip_tags(trim(self::$data));
		
		self::$data = str_replace(' ', '-', self::$data);
		self::$data = str_replace(array('-----','----','---','--'), '-', self::$data);
	
		return strtolower(utf8_encode(self::$data));
	}
	
	
}