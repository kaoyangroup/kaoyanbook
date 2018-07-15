<?php

#defined('ACC') || exit('ACC Denied')
class Model{
	protected $table = NULL;
	protected $db = NULL; 
	protected $pk = '';
	protected $fields = array();
	protected $auto = array();
	protected $error = array();

	public function __construct(){
		$this-?db = mysql::getIns();
	}




}

