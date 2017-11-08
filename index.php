<?php
	require_once('const.config.php');
	require_once(ROOTPATH.'/class/ext/import.php');
	foreach (glob('class/type/*.php') as $filename){
	    require_once(ROOTPATH.'/'.$filename);
	}

	// $_POST['data'] = 'event_id%3D1%26user_id%3D1%26participate%3D1';
	parse_str(urldecode($_POST['data'] ?? ""), $data);

// test -> this is what we receive from the app
	$_POST['token'] = '';
	// $_POST['endpoint'] = 'participation/insert';
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
	try{
		$req = new $class($data);
		$return = $req->$func();
		if(!is_array($return))
			$return = array($return);
		echo json_encode($return);
	}catch(Exception $e){
		exit('Internal Error<br/>'.$e);
	}