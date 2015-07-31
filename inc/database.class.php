<?php
	include "constants.inc.php";
	class Database
	{
		private static $_instance = null;
		public static function getInstance()
		{
			if (!self::$_instance)
			{
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		private function __clone(){}
		private $_connection = null;
		private function __construct()
		{
			$this->_connection = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
			if ($this->_connection)
			{
				mysql_select_db(DB_NAME);
			}
		}
		
		/* return a single record as an array (associative) */
		public function getRecord($sql)
		{
			$result = mysql_query($sql);
			if ($row = mysql_fetch_assoc($result))
			{
				return $row;
			}
			else
			{
				return false;
			}
		}
		
		/* insert a record */
		public function insertRecord($sql)
		{
			$result = mysql_query($sql);
			mysql_query($result);
		}
		
		/* update a record */
		public function updateRecord($sql)
		{
			$result = mysql_query($sql);
			mysql_query($result);
		}
		
		/* delete a record */
		public function deleteRecord($sql)
		{
			$result = mysql_query($sql);
			mysql_query($result);
		}
		
		// return an array of record objects
		function query($sql)
		{
			//@$result = mysql_query($sql) or common::error(mysql_error().$err_sql,__FILE__,__LINE__);
			$result = mysql_query($sql);
			return $result;
		}
	}
?>