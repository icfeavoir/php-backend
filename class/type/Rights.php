<?php
	require_once('Table.php');

	class Rights extends Table{
		public $rights;
		public $text;

		public function __construct($val = []){
			parent::__construct('Rights', $val);
		}
	}