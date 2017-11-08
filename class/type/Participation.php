<?php
	require_once('Table.php');

	class Participation extends Table{
		public $participation_id;
		public $event_id;
		public $user_id;
		public $last_update;
		public $participate;
		public $did_pay;

		public function __construct($val = []){
			parent::__construct('Participation', $val);
		}

		public function insert($try=false){	// update or insert if not exist
			$old = new Participation(array('event_id'=>$this->event_id, 'user_id'=>$this->user_id));
			$oldRow = $old->get();
			if(!empty($oldRow)){
				$old->update($this->values());
				return $oldRow[0]['participation_id'];
			}else{
				return parent::insert();
			}
		}
	}