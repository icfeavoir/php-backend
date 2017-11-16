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
			$statusChanged = false;
			$get = (new Participation(['event_id'=>$this->event_id, 'user_id'=>$this->user_id]))->get();
			if(!empty($get)){	// exists
				if($this->participate != $get[0]['participate']){	// not same value
					$this->changeValue('participation_id', $get[0]['participation_id']);
					$this->update();
					$statusChanged = true;
				}
				$valueChanged = $get[0]['participation_id'];
			}else{
				$valueChanged = parent::insert();
				$statusChanged = true;
			}

			if($statusChanged){		// get fb_id of creator
				$fb_id = (new User((new Event($this->event_id))->getValue('creator')))->getValue('firebase_id');
				$notif = new Notification(array($fb_id), 'New guy', 'Looks like someone will come to you event!!!');
				$notif->send();
			}

			return $valueChanged;
		}
	}