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
			$req = self::$db;
			foreach ($this->values() as $key => $value) {
				$req = self::$db->where($key, $value);
			}
			return $req->get(self::$table);
		}
		public function select(){
			return $this->get();
		}

		public function insert(){
			return self::$db->insert(self::$table, $this->values());
		}

		public function update($val){
			$req = self::$db;
			foreach ($this->values() as $key => $value) {
				$req = self::$db->where($key, $value);
			}
			return $req->update(self::$table, $val) ? self::$db->count : false;
		}

		public function delete(){
			$req = self::$db;
			foreach ($this->values() as $key => $value) {
				$req = self::$db->where($key, $value);
			}
			return $req->delete(self::$table);
		}

		public function values(){
			$data = array();
			foreach (get_object_vars($this) as $key => $value) {
				if($value != null)
					$data[$key] = $value;
			}
			return $data; 
		}
	}	