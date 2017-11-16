<?php

	require_once('const.config.php');

	class Notification{
		public $id_list;
		public $title;
		public $body;

		public function __construct($id_list = array(), $title = '', $body = ''){
			$this->id_list = $id_list;
			$this->title = $title;
			$this->body = $body;
		}

		public function send(){
			$msg = array(
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
			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			$result = curl_exec($ch );
			curl_close( $ch );
			return $result;
		}
	}