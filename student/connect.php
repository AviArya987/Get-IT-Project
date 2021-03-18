<?php
class connect
{
	protected $username="root";
	protected $password="";
	protected $database="student";
	protected $server="localhost";
	protected $db_handle;
	public function connect()
	{
		$this->db_handle=mysqli_connect($this->server,$this->username,$this->password,$this->database);
	}
}
?>