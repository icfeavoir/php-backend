<?php
	require_once('MySQL/MysqliDb.php');
	//MySQL
	$GLOBALS['db'] = new MysqliDb (Array (
			                'host' => HOST,
			                'username' => DB_USER, 
			                'password' => DB_PASSWD,
			                'db'=> DATABASE,
			                'port' => DB_PORT,
			                'charset' => 'utf8',
			            ));