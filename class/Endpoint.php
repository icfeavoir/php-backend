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
			$resp['creator'] = new User((int)$resp['event']->get('creator'));
			$resp['participate'] = (new Participation(['event_id'=>$event_id]))->get();
			return $resp;
		}
	}