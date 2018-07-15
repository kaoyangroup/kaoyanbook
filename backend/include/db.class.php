<?php


abstract class db{
	#h: host u: user p: pwd
	public abstract function connect($h,$u,$p,$db);

	#send query
	public abstract function query($sql);

	# multi query
	public abstract function getAll($sql);

	# single line query
	public abstract function getRow($sql);

	#single data query
	public abstract function getOne($sql);

	public abstract function autoExecute($table, $data, $act='insert', $where='');
}





