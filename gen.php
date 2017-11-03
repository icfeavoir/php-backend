<?php
	$tables = file_get_contents('db.sql');
	$tables = explode('CREATE TABLE IF NOT EXISTS `', $tables);
	unset($tables[0]);
	foreach ($tables as $table) {
		$classString = "<?php\n\trequire_once('Table.php');\n\n";
		$separate = explode('` (', $table);
		$tableName = $separate[0];
		$classString .= "\tclass $tableName extends Table{\n";

		$columns = explode(PHP_EOL, $separate[1]);
		$columnList = array();	// to avoid 2 columns with foreign keys
		foreach ($columns as $column) {
			$column = explode('`', $column)[1] ?? null;
			if($column != null && !in_array($column, $columnList)){
				array_push($columnList, $column);
				$classString .= "\t\tpublic $$column;\n";
			}
		}
		$val = '$val';
		$classString .= "\n\t\tpublic function __construct($val = []){\n\t\t\tparent::__construct('$tableName', $val);\n\t\t}\n\t}";
	
		file_put_contents('class/type/'.$tableName.'.php', $classString);
	}