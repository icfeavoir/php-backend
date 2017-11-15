<?php
// API access key from Google API's Console
define('API_ACCESS_KEY', 'AAAA4L73uog:APA91bFCGqsX57wj73OmWTtHTowplwOnNJlLA-qFhdhtnf4hvmlOruTwykFoLGLtUXleXBTH7iWhIdlP5exrPiGpldNx1WqqLxAmlbO3OdaR3GXTW7SNDwXW4C1S2cTkJywi-o63eI96');
$registrationIds = array('cc_q9Y-8X5U:APA91bGtSJq3qB2nsfY9QYtQrTzlbwdsAz_A2QfVK03O-p6by2DrPC4RZ1YrxJ-XGdj_3po5wO2T9Vthse6HVtcnnojIKi8GDTESSMY75NRSCh_jpw4eextMY4OhysEpidufuNHxFzHu');
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