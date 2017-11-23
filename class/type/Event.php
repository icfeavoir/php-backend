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

		public function insert(){
			$this->creator = $_SESSION['my_id'];
			$id = parent::insert();
			$creator = (new User($_SESSION['my_id']))->getValue('firstName');
			$notif = new Notification(Notification::ALL_EXCEPT_ME, 'New event', 'Hey, '.$creator.' just created a new event!');
			$notif->send();

			return $id;
		}
	}