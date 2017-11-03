<?php
	require_once('MySQL/MysqliDb.php');
	//MySQL
	$GLOBALS['db'] = new MysqliDb(HOST, DB_USER, DB_PASSWD, DATABASE);