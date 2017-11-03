<?php
	require_once('const.config.php');
	require_once(ROOTPATH.'/class/ext/import.php');
	foreach (glob('class/type/*.php') as $filename){
	    require_once(ROOTPATH.'/'.$filename);
	}

// test -> this is what we receive from the app
	$_POST['token'] = '';
	$_POST['endpoint'] = '/event/add/';
	$_POST['data'] = '{"creator":1, "title":"Event2", "start":"2017-11-03 19:00:00", "end":"2017-11-04 02:00:00", "description":"With date!"}';
// end test

	if(!isset($_POST['token'])){
		include_once(ROOTPATH.'/error.php');
		exit();
	}
	if(!isset($_POST['endpoint']))
		exit('No endpoint');

	//remove first and last '/'
	$endpoint = explode('/', trim($_POST['endpoint'], "\t\n\r\0\x0B/"));
	
	if(sizeof($endpoint) != 2)
		exit('Wrong call');
	// first elem -> class Name
	// second -> function
	$class = ucwords($endpoint[0]);		// Capitalize first letter (for class)
	$func = $endpoint[1];
	$data = json_decode($_POST['data'] ?? "[]", true);
	try{
		$req = new $class($data);
		echo json_encode($req->$func());
	}catch(Exception $e){
		exit('Internal Error<br/>'.$e);
	}