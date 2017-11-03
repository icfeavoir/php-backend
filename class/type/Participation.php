<?php
	require_once('Table.php');

	class Participation extends Table{
		public $participation_id;
		public $event_id;
		public $user_id;
		public $last_update;
		public $participe;

		public function __construct($val = []){
			parent::__construct('Participation', $val);
		}
	}