<?php
	require_once('Table.php');

	class Participation extends Table{
		public $participation_id;
		public $event_id;
		public $user_id;
		public $last_update;
		public $participate;
		public $did_pay;
		public $confirm_pay;

		public function __construct($val = []){
			parent::__construct('Participation', $val);
		}

		public function insert($try=false){	// update or insert if not exist
			$this->user_id = $_SESSION['my_id'];
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
				$creator = new User((new Event($this->event_id))->getValue('creator'));
				if($creator->getValue('user_id') != $this->user_id){	// not me!
					$msgs = array(
						0=>(new User($this->user_id))->getValue('firstName').' will come to you event!',
						2=>'Mother fucker!!! '.(new User($this->user_id))->getValue('firstName').' won\'t come to you event!',
					);
					$msg = $msgs[$this->participate] ?? null;
					if($msg != null){
						$notif = new Notification(array($creator->getValue('firebase_id')), 'Your event!', $msg);
						$notif->send();
					}
				}
			}

			return $valueChanged;
		}
	}