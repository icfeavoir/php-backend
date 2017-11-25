<?php
	require_once('const.config.php');

	class Notification{

		const ALL = 1;
		const ALL_EXCEPT_ME = 1<<1;

		public $id_list;
		public $title;
		public $body;

		public function __construct($id_list = array(), $title = '', $body = ''){
			$this->id_list = $id_list;
			$this->title = $title;
			$this->body = $body;
		}

		public function send(){
			if(!is_array($this->id_list) && is_int($this->id_list)){	// const
				$list = array();
				switch ($this->id_list) {
					case self::ALL:
						foreach ((new User())->get() as $key => $user) {
							$list[$user['user_id']] = $user['firebase_id'];
						}
						break;

					case self::ALL_EXCEPT_ME:
						foreach ((new User())->get() as $key => $user) {
							$list[$user['user_id']] = $user['firebase_id'];
						}
						unset($list[$_SESSION['my_id']]);
						break;
					
					default:
						$list = array();
						break;
				}
				$this->id_list = array_values($list);
			}

			$msg = array(	// TODO : add an activity & an id
			    'title'		=> $this->title,
			    'body'		=> $this->body,
			);
			$fields = array(
			    'registration_ids'  => $this->id_list,
			    'data'          	=> $msg,
			);
			$headers = array(
			    'Authorization: key='.API_PUSH,
			    'Content-Type: application/json'
			);

			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch,CURLOPT_POST, true);
			curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
		}
	}