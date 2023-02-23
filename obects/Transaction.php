


<?php
// <!-- 
// |account: class Students 
// |auther: colls_codes
// |date: sunday january 16 2022
// |objective: handle all the student request extending class Transactions Tran
// -->
// ini_set('session.use_only_cookies', true);
//  id | ref_no   | loan_date_id | borrower_id | purpose                       | amount  | plan_id | status | date_released       | date_created  
class Transaction
{
	private $id;
	private $account;
	private $phone;
	private $amount;	
	private $table;
	private $status;
	private $connection;
	private $link;	
	public  function __construct($connection)
	{
		$this->id = "";
		$this->connection = $connection;
		$this->account = "";
		$this->status = "";
		$this->phone = "";
		$this->amount = "";		
		$this->link = "";
		$this->table = "transaction";
	}
	public function create($account, $phone, $amount,   $link)
	{
		//filte/sanitze Transaction data 
		$this->account = filter_var($account, FILTER_SANITIZE_STRING);
		$this->phone = filter_var($phone, FILTER_SANITIZE_STRING);
		$this->amount  = filter_var($amount , FILTER_SANITIZE_STRING);
		$this->link = filter_var($link , FILTER_SANITIZE_STRING);
        $this->status = "pending...";
        $this->date = 
		
		//sql statement 
		$sql = "INSERT INTO  `$this->table` SET 
		`$this->table`.account = :account, 
		`$this->table`.amount = :amount,
		`$this->table`.phone = :phone, 
		`$this->table`.status = :status,
		`$this->table`.link = :link,
		`$this->table`.date = :date;";		
		//prepare the sql statement  
		$psql = $this->connection->prepare($sql);
		//bind parameters
		$psql->bindParam(":account", $this->account);
		$psql->bindParam(":amount", $this->amount);
		$psql->bindParam(":phone", $this->phone);
		$psql->bindParam(":status", $this->status);
		$psql->bindParam(":link", $this->link);
		$psql->bindParam(":date", $this->date);		
		try 
		{
			$psql->execute();
			if(!$psql->errorinfo()[2])
			{
				return array("error"=>0, 'info'=>"account created successful ...");
			}else 
			{
				return array("error"=>1, 'info'=>"unable to create the student  ...");				
			}
		}catch(PDOException $ex)
		{
			return $ex;
		}
	}
	public function read($id)
	{
		// E_STRING);
        $this->id = $id;
		$sql = "SELECT *  FROM `$this->table`WHERE `$this->table`.link = :id ";;
		
		$stmt = $this->connection->prepare($sql);
		try
		{
			if (!empty($this->id)) {$stmt->bindParam(':id', $this->id);}			
			


			try{
				$stmt->execute();
				if(!$stmt->errorinfo()[2]){
					if ($stmt->rowCount() >= 1)
					{
						$data = array();
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							array_push($data, $row);
						}
						return array('error' => false,  'data' => $data);
					} else{
						return array('error' => false, 'data' => "no match found");
					}
				} else{
					return array('error' => true, ' two' => $stmt->errorinfo()[2]);
				}
			} catch(PDOException $e)
			{
				return array('error' => true, 'three' => $e->getMessage());
			}
		} catch (PDOException $e)
		{
			return array('error' => true, 'meslocation' => $e->getMessage());
		}
	}
	public function delete($id)
	{
		$this->id = filter_var($id, FILTER_SANITIZE_STRING);
		$sql = "DELETE FROM `$this->table` WHERE `$this->table`.id = :id;";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		try
		{
			$stmt->execute();
			if(!$stmt->errorinfo()[2])
			{
				return array('error'=> 0, 'info'=>"delete was successful..");
			}

		}catch(PDOException $error)
		{
			return array('error'=>1, 'info'=>$error);
		}
	}
	public function update($filter = array('id'=>"",  'phone'=> "", 'amount'=> "", 'status'=> "",  'date'=>""))
	{
		$this->phone = filter_var($filter['phone'], FILTER_SANITIZE_STRING);
		$this->amount = filter_var($filter['amount'], FILTER_SANITIZE_STRING);
		$this->date = filter_var($filter['date'], FILTER_SANITIZE_STRING);
		$this->id = filter_var($filter['id'], FILTER_SANITIZE_STRING);
		$this->status = filter_var($filter['status'], FILTER_SANITIZE_STRING);		

		//prepare the sql query
		$sql = "UPDATE   `$this->table` SET"; 		 

		//update based on the data given
		
	
		// serch using phone number .....
		if(!empty($filter['phone']))
		{
			if(stripos($sql, "AND"))
			{
				$sql .= " AND  `$this->table`.phone = :phone ";
			}else 
			{
				$sql .= " `$this->table`.phone = :phone ";
			}

		}

		 //search using amount  		
		if(!empty($filter['amount']))
		{
			if(stripos($sql, "AND"))
			{
				$sql .= "AND  `$this->table`.amount = :amount ";
			}else 
			{
				$sql .= " `$this->table`.amount = :amount ";
			}

		} 
		// SEARCH USING THE status
		if(!empty($filter['status']))
		{
			if(stripos($sql, "AND"))
			{
				$sql .= "AND  `$this->table`.status = :status ";
				
			}else 
			{
				$sql .= " `$this->table`.status = :status ";

			}

		} 



		
		//the Transaction date never changes thus is  most suitable to be used as the finall serch key	
		
		// $sql .= " `$this->table`.date = :date ";s
		$sql .=  " WHERE `$this->table`.id = :id;";

		

		

		//prepare the sql statement    dfjdf
		$psql = $this->connection->prepare($sql);
		// bind the parameters 
		if (!empty($this->id)){$psql->bindParam(":id", $this->id);}
		if (!empty($this->amount)){$psql->bindParam(":amount", $this->amount);}
		if (!empty($this->phone)){$psql->bindParam(":phone", $this->phone);}
		if (!empty($this->status)){$psql->bindParam(":status", $this->status);}
		if (!empty($this->date)){$psql->bindParam(":date", $this->date);}
		try
		{
			$psql->execute();
			if(!$psql->errorinfo()[2])
			{
				return array('error'=>0, 'info'=>"Transaction updated succesfully");

			}else
			{
				print $psql->errorinfo()[2];
			}
		}catch(PDOException $error)
		{
			print "sorry unable to update the data" . $error->getmessage();
		}

	}
	public function login($idNumber, $link)
	{
		//clean the daata 
		$this->idNumber = filter_var($idNumber, FILTER_SANITIZE_STRING);
		$this->link = filter_var($link, FILTER_SANITIZE_STRING);
		// make an sql statement 
		$sql = "SELECT  
		`$this->table`.id,
		`$this->table`.account ,
		`$this->table`.amount,
		`$this->table`.phone,
		`$this->table`.status,
		`$this->table`.link,		
		`$this->table`.idNumber,				
		`$this->table`.date FROM `$this->table` WHERE `$this->table`.idNumber = :idNumber;";
		//prepare the sql statemnt 
		$stmt = $this->connection->prepare($sql);
		// bind the parameter 
		$stmt->bindParam(":idNumber", $this->idNumber);
		// execute the sql query
		
		try
		{
			$stmt->execute();
			if(!$stmt->errorinfo()[2])
			{

				$rows = $stmt->rowCount();
				if($rows == 1)
				{
					// fetch the data  as an associative arry
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
					// extract the link from the db
					$linkFromDb = $data['link'];
					//veryfy the link 

					if(link_verify($this->link, $linkFromDb))
					{
						// save the data in a session
						$Transaction_agent = $_SERVER['HTTP_Transaction_AGENT'];						
						$_SESSION['TransactionId'] = $data['id'];
						$_SESSION['date'] = $data['date'];						
						$_SESSION['Transactionaccount'] = $data['account'];						
						$_SESSION['idNumber'] = $data['idNumber'];						
						$_SESSION['loginString'] = hash("sha512", $linkFromDb.$Transaction_agent);
						return array('error'=>0, 'info'=>"login sucess ... ");


					}else
					{
						return array('error'=>1, 'info'=>"incorrect Transactionaccount of link please try again ... ");					
						
					}


				}
				else 
				{
					return array('error'=>1, 'info'=>"account not found ");					
				}
			}else 
			{
				return array('error'=>1, 'info'=>$stmt->errorinfo()[2]);
			}
		} 
		catch (PDOException $e)
		{
			return array('error'=>1, 'info'=>$e);
			
		}

	}
	public function StartSession()
	{
		// session account 
		$account = "sagg";
		// ensure the session secure is false
		$secure = false;
		// ensure the session uses only the http only
		$http  = true;
		//ensure that our session uses only the cookie
		if(ini_set('session_use_only_cookie', 1) === false)
		{
			$_SESSION['sessionError'] = "session_not secure";
		}
		// get  the initial cookie parameters and store them in a variable 
		$cookie_param = session_get_cookie_params();
		//seee what these cookie parma look like 
		// print_r($cookie_param)=>Array ( [lifetime] => 0 [path] => / [domain] => [secure] => [httponly] => [samesite] => )
		// set the cookie paaramete
		session_set_cookie_params($cookie_param['lifetime'], $cookie_param['path'], $cookie_param['domain'], $secure, $http);
		// set the session account 
		session_account($account);
		// session start
		session_start();
		// regenerate the id
		session_regenerate_id();
	}
	public function stopSessionLogout()
	{

		if(!empty($_SESSION))
		{
			// [TransactionId] => 2 [date] => 2 [Transactionaccount] => colls [idNumber] => 2056467 [loginString]
			unset($_SESSION['TransactionId']);
			unset($_SESSION['date']);	
			unset($_SESSION['Transactionaccount']);						
			unset($_SESSION['idNumber']);
			unset($_SESSION['loginString']);
			session_destroy();						
			return array('error'=>0, 'info'=>"session stoped succesfully");
			

		}else 
		{
			return array('error'=>1, 'info'=>"trying to stop a non existence session ");
		}
	}
	public function loginCheck()
	{
		// just checks that the uer using our systen belongs to us 
		// strt by making sure the required details are all set b4 we continue
		if(isset($_SESSION['TransactionId'], $_SESSION['idNumber'], $_SESSION['loginString']))
		{
			// check if  the logged in Transaction is identified by our sustem
			//make a query to extract  the pswd from the db
			$sql = "SELECT  `$this->table`.link FROM  `$this->table` WHERE `$this->table`.idNumber = :idNumber;";
			// prepare the sql statement 
			$stmt = $this->connection->prepare($sql);
			// bind the parameter
			$stmt->bindParam(":idNumber", $_SESSION['idNumber']);
			// try and execute the sql querry 
			try
			{
				$stmt->execute();
				if(!$stmt->errorinfo()[2])
				{
					$rows = $stmt->rowCount();
					if($rows == 1)
					{
						// fetch the data 
						$data = $stmt->fetch(PDO::FETCH_ASSOC);
						// EXTRACT THE pswd
						$linkFromDb = $data['link'];
						// extract the Transaction agent 
						$Transaction_agent = $_SERVER['HTTP_Transaction_AGENT'];
						// hash the tha Transactionagent and the link from the db
						$login_check = hash("sha512", $linkFromDb.$Transaction_agent);
						//check if the login string and the hashed Transaction agent are the same
						if(hash_equals( $_SESSION['loginString'], $login_check))
						{
							return array('error'=>0, 'info'=>"Transaction veryfied"); 
							
						}else 
						{
							return array('error'=>1, 'info'=>"unable to veryfy the Transaction ..."); 						

						}
						

					}else //when the Transaction does not belong to us
					{
						return array('error'=>1, 'info'=>"the use does not belong  to us"); 

					}

				}else 
				{
					return array('error'=>1, 'info'=>$stmt->errorinfo()[2]); 

				}

			}catch(PDOException $E)
			{
				return array('error'=>1, 'info'=>$E);				
			}
			
			return array('error'=>1, 'info'=>"some  one is logged inn");
		}
		else 
		{
			
			return array('error'=>1, 'info'=>"no Transaction currently logged in");
		}
	}
	public function readstatus($id)
	{
		$this->table = "status";
		$this->id = filter_var($id, FILTER_SANITIZE_STRING);
		$sql = "SELECT 	`$this->table`.id, 	`$this->table`.account FROM `$this->table`  WHERE `$this->table`.id = :id ;";
		$sql .= "  ;";
		$stmt = $this->connection->prepare($sql);
		try
		{
			if (!empty($this->id)) {$stmt->bindParam(':id', $this->id);}			
			
			try{
				$stmt->execute();
				if(!$stmt->errorinfo()[2]){
					if ($stmt->rowCount() >= 1)
					{
						$data = array();
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							array_push($data, $row);
						}
						return array('error' => false,  'data' => $data);
					} else{
						return array('error' => false, 'data' => "no match found");
					}
				} else{
					return array('error' => true, ' two' => $stmt->errorinfo()[2]);
				}
			} catch(PDOException $e)
			{
				return array('error' => true, 'three' => $e->getMessage());
			}
		} catch (PDOException $e)
		{
			return array('error' => true, 'meslocation' => $e->getMessage());
		}
	}
}

?>
