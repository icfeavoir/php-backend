<?php
	require_once('Table.php');

	class Event extends Table{
		public $event_id;
		public $creator;
		public $title;
		public $start;
		public $end;
		public $description;
		public $price;

		public function __construct($val = []){
			parent::__construct('Event', $val);
		}
	}