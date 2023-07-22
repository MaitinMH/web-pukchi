<?php 
function select($sql,$array = array(),$db,$fetchMode = PDO::FETCH_ASSOC){
	$sth = $db -> prepare($sql);
	foreach($array as $key => $value){
		$sth->bindValue("$key",$value);
		}
		
	$sth->execute();
	$result = $sth->fetchAll($fetchMode);
  	return $result;
}

function insert($table,$data,$db){
	//global $db;
	ksort($data);
	
	$fieldaNames = implode('`, `',array_keys($data));
	$fieldValue  = ':' . implode(', :', array_keys($data));
	
	$sth = $db->prepare("INSERT INTO $table (`$fieldaNames`) VALUES ($fieldValue)");
	
	foreach($data as $key => $value){
		$sth->bindValue(":$key",$value);
		}
	
	return $sth->execute();
}

function update($table, $data, $where,$db){
	//global $db;
	ksort($data);
	
	$fieldDetails = NULL;
	foreach($data as $key => $values){
		$fieldDetails .= "$key=:$key,";			
		}
	
	$fieldDetails = rtrim($fieldDetails, ',');
	
	$sth = $db->prepare("UPDATE $table SET $fieldDetails WHERE $where");
	
	foreach($data as $key=>$value){
		$sth->bindValue(":$key",$value);
		}
	
	return $sth->execute();
}

function delete($table,$where,$db,$limit = 1){
	//global $db;
	return $db->exec("DELETE FROM $table WHERE LIMIT = $limit");		
}

function selectAndCountRows($sql,$array = array(),$db,$fetchMode = PDO::FETCH_ASSOC){
	//global $db;
	$sth = $db -> prepare($sql);
	foreach($array as $key => $value){
		$sth->bindValue("$key",$value);
		}
		
	$sth->execute();
	$data['fectchall'] = $sth->fetchAll($fetchMode);
	$data['countrows'] = $sth->rowCount();
	return $data;
}

function insert_AndLastId($table,$data,$db){
	//global $db;
	ksort($data);
	
	$fieldaNames = implode('`, `',array_keys($data));
	$fieldValue  = ':' . implode(', :', array_keys($data));
	
	$sth = $db->prepare("INSERT INTO $table (`$fieldaNames`) VALUES ($fieldValue)");
	
	foreach($data as $key => $value){
		$sth->bindValue(":$key",$value);
		}
	
	$res['exec'] = $sth->execute();
	//$res['countrows'] = $sth->rowCount();

	$res['lastinsert'] = $db->lastInsertId();

	//return $sth->execute();
	return $res;
}
function lastinsert($db){	 
	//global $db;
	return $db->lastInsertId();
}
	?>