<?php
// API access key from Google API's Console
define('API_ACCESS_KEY', '');
$registrationIds = array('');
// prep the bundle
$msg = array
(
    'title'     => 'This is a title',
    'body'   => 'Hello notif!!!',
    
);

$fields = array
(
    'registration_ids'  => $registrationIds,
    'data'          => $msg
);
 
$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
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
echo $result;