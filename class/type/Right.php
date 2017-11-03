<?php
	require_once('Table.php');

	class Right extends Table{
		public $right;
		public $text;

		public function __construct($val = []){
			parent::__construct('Right', $val);
		}
	}