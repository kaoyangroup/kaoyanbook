<?php


class conf{
	protected static $ins = NULL;
	protected $data = array();

	final protected function __constract(){
		include(ROOT.'include/config.inc.php');
		$this->data = $__CFG;
	}

	public static function getIns(){
		if(self::$ins instanceof self){
			return self::$ins;
		} else{
			self::ins = new self();
			return self::$ins;
		}
	}

	public function __get($key){
		if(array_key_exists($key,$this->data)){
			return $this->data[$key];
		} else{
			return null;
		}
	}

	public function __set($key, $value){
		$this->data[$key] = $value;
	}
}

$conf = conf::getIns();