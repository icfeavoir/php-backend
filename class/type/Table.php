<?php
	abstract class Table{

		static private $db;
		static private $table;
		static private $id_name;

		public function __construct($table, $val){
			self::$table = $table;
			self::$id_name = strtolower($table).'_id';
			self::$db = $GLOBALS['db'];
			//get from DB
			if(gettype($val) == 'integer'){
				$req = self::$db->where(self::$id_name, $val)->getOne(self::$table);
				foreach (get_object_vars($this) as $key => $value) {
					$this->$key = $req[$key];
				}
			}else{	// new object in parameter
				foreach (get_object_vars($this) as $key => $value) {
					$this->$key = $val[$key] ?? null;
				}
			}
		}

		public function get(){
			return $this->values();
		}

		public function insert(){
			return self::$db->insert(self::$table, $this->values());
		}
		public function add(){
			return $this->insert();
		}

		public function update(){
			return self::$db->where(self::$id_name, $this->{self::$id_name})->update(self::$table, $this->values()) ? self::$db->count : false;
		}

		public function delete(){
			return self::$db->where(self::$id_name, $this->{self::$id_name})->delete(self::$table);
		}

		public function values(){
			return get_object_vars($this); 
		}
	}	