
<?php 
/*
|name: class Databse
|auther: colls_codes
|date: sunday january 16 2022
|objective: manages the connection to the database
*/
class Database
{
	private $host;
	private $user;
	private $password;
	private $database;
	private $connection;	
	public function __construct()
	{
		$this->host="127.0.0.1";
		$this->username="aggy";s
		$this->password="1234";
		$this->database="stanpay";
		try 
		{
			$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database;",$this->username,$this->password);

		}
		catch(PDOException $exception)
		{
			print_r($exception);
		}
	}

	public function getConnection()
	{
		return $this->connection;
        print("connected");
	}

}



?>