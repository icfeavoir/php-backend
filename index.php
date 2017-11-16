<?php
	session_start();

	require_once('const.config.php');
	require_once(ROOTPATH.'/class/ext/import.php');
	foreach (glob('class/type/*.php') as $filename){
	    require_once(ROOTPATH.'/'.$filename);
	}

	parse_str(urldecode($_POST['data'] ?? ""), $data);
	$_POST['token'] = '';


	if(!isset($_POST['token']) || !isset($_POST['endpoint']) || !isset($_POST['my_id'])){
		include_once(ROOTPATH.'/error.php');
		exit();
	}

	$_SESSION['my_id'] = (int)$_POST['my_id'];

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