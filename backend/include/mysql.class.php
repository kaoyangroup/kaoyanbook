<?php



class mysql extends db{
	private static $ins = NULL;
	private $conn = NULL;
	private $conf = array();
	protected function __construct(){
		$this->conf = conf::getIns();
		
	}

}