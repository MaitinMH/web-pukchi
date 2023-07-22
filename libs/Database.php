<?php 
class Database extends PDO{
	
	public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS){
		parent:: __construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
		
		}
	
	public function select($sql,$array = array(),$fetchMode = PDO::FETCH_ASSOC){
		$sth = $this -> prepare($sql);
		foreach($array as $key => $value){
			$sth->bindValue("$key",$value);
			}
			
		$sth->execute();
		return $sth->fetchAll($fetchMode);
		}
	
	public function insert($table,$data){
		ksort($data);
		
		$fieldaNames = implode('`, `',array_keys($data));
		$fieldValue  = ':' . implode(', :', array_keys($data));
		
		$sth = $this->prepare("INSERT INTO $table (`$fieldaNames`) VALUES ($fieldValue)");
		
		foreach($data as $key => $value){
			$sth->bindValue(":$key",$value);
			}
		
		return $sth->execute();
		}
	
	public function update($table, $data, $where){
		ksort($data);
		
		$fieldDetails = NULL;
		foreach($data as $key => $values){
			$fieldDetails .= "$key=:$key,";			
			}
		
		$fieldDetails = rtrim($fieldDetails, ',');
		
		$sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		
		foreach($data as $key=>$value){
			$sth->bindValue(":$key",$value);
			}
		
		return $sth->execute();
		}
	
	public function delete($table,$where,$limit = 1){
		return $this->exec("DELETE FROM $table WHERE LIMIT = $limit");		
		}
	public function precedure($data){
		/*ksort($data);
		
		$fieldaNames = implode('`, `',array_keys($data));
		$fieldValue  = ':' . implode(', :', array_keys($data));
		
		$sth = $this->prepare("INSERT INTO $table (`$fieldaNames`) VALUES ($fieldValue)");*/
		
		$sth = $this->prepare($data);
		
		/*foreach($data as $key => $value){
			$sth->bindValue(":$key",$value);
			}*/
		
		return $sth->execute();
		}
	public function selectAndCountRows($sql,$array = array(),$fetchMode = PDO::FETCH_ASSOC){
		$sth = $this -> prepare($sql);
		foreach($array as $key => $value){
			$sth->bindValue("$key",$value);
			}
			
		$sth->execute();
		$data['fectchall'] = $sth->fetchAll($fetchMode);
		$data['countrows'] = $sth->rowCount();
		return $data;
		}
		
	public function insert_AndLastId($table,$data){
		ksort($data);
		
		$fieldaNames = implode('`, `',array_keys($data));
		$fieldValue  = ':' . implode(', :', array_keys($data));
		
		$sth = $this->prepare("INSERT INTO $table (`$fieldaNames`) VALUES ($fieldValue)");
		
		foreach($data as $key => $value){
			$sth->bindValue(":$key",$value);
			}
		
		$res['exec'] = $sth->execute();
		$res['lastinsert'] = $this->lastInsertId();
		//$res['error'] = $sth->errorInfo();
		//return $sth->execute();
		return $res;
		}
	 public function lastinsert(){	 
		return $this->lastInsertId();
   		}

   	public function probarquery($table, $data, $where){
		ksort($data);
		
		$fieldDetails = NULL;
		foreach($data as $key => $values){
			$fieldDetails .= "$key=:$key,";			
			}
		
		$fieldDetails = rtrim($fieldDetails, ',');
		
		$sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		
		foreach($data as $key=>$value){
			$sth->bindValue(":$key",$value);
			}
		
		//return $sth->execute();
		
		$res['exec'] = $sth->execute();
		$res['error'] = $sth->errorInfo();
		
		return $res;
		
	}
		
	}

	

?>