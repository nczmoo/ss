<?php
function howMuchDoTheyHave($assetName){
	$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
	$userID = 1;
	$stmt = $mysqli->prepare("select * from assets where user_id=? and name=? limit 1");
	$stmt->bind_param('is', $userID, $assetName);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows < 1){	 
		return 0;	
	  
	}
	$obj = $result->fetch_object();
	return $obj->quantity;
	$stmt->close();
	
}

function fetchCryptoID($name){
	$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
	$stmt = $mysqli->prepare("select id from crypto where name=?");
	$stmt->bind_param('s', $name);
	$stmt->execute();
	return intval($stmt->get_result()->fetch_all()[0][0]);
	
}
function howManyAreMining($crypto_id){
	$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
	$stmt = $mysqli->prepare("select quantity from mining where user_id=1 and crypto_id=? limit 1");
	$stmt->bind_param('i', $crypto_id);
	$stmt->execute();
	$result = $stmt->get_result();
		if ($result->num_rows < 1){	 
		return 0;	
	  
	}
	return intval($result->fetch_all()[0][0]);
}

function howManyRigsDoTheyOwn(){
	$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
	$result = $mysqli->query("select quantity from assets where user_id=1 and name='Mining Rigs' limit 1");
	//$stmt->bind_param('is', $userID, $assetName);
	//$stmt->execute();
	//$result = $stmt->get_result();
	if ($result->num_rows < 1){	 
		return 0;	
	  
	}
	$obj = $result->fetch_object();
	return intval($obj->quantity);
	$stmt->close();
}

function howManyRigsAreRunning(){
	$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
	$result = $mysqli->query("select sum(quantity) from mining where user_id=1 limit 1");
	if ($result->num_rows < 1){	 
		return 0;	
	  
	}
	return intval($result->fetch_all()[0][0]);
	//return $obj->quantity;
	//$stmt->close();
}