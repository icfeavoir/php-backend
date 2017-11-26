<?php
	class Endpoint{

		private $data;

		public function __construct($data){
			$this->data = $data;
		}

		public function eventUnique(){
			if(!isset($this->data['event_id']))
				return ['error'=>'No event_id'];
			$event_id = $this->data['event_id'];
			$resp = array();
			// get event
			$resp['event'] = new Event($event_id);
			$resp['creator'] = (new User((int)$resp['event']->creator))->firstName;
			$resp['participate'] = array();
			$participateList = (new Participation(['event_id'=>$event_id]))->get();
			foreach ($participateList as $participate) {
				$userP = new User((int)$participate['user_id']);
				$resp['participate'][] = array(
											'user_id'=>$userP->user_id,
											'firstName'=>$userP->firstName,
											'participate'=>$participate['participate']
										);
			}
			return [$resp];
		}
	}