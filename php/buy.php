<?php
require_once('functions.php');
$market_id = $_POST['market_id'];



$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
$stmt = $mysqli->prepare("select * from market where id=? limit 1");
$stmt->bind_param('i', $market_id);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows < 1){
  echo "e!";
  return;
}

$obj = $result->fetch_object();

if (howMuchDoTheyHave('ELONS') < $obj->ask){
	echo 'e!';
}


if (howMuchDoTheyHave($obj->name) == 0){
	$stmt = $mysqli->prepare("insert into assets (name, category, quantity) values (?, ?, 1)");
	$stmt->bind_param("ss", $obj->name, $obj->category);
	$stmt->execute();
	$stmt->close();
} else {
	$stmt = $mysqli->prepare("update assets set quantity = quantity + 1 where name=? and user_id=1");
	$stmt->bind_param("s", $obj->name);
	$stmt->execute();
	$stmt->close();
}

$stmt = $mysqli->prepare("update assets set quantity = quantity-? where user_id=1 and name='ELONS'");
$stmt->bind_param('i', $obj->ask);
$stmt->execute();
$stmt->close();

if ($obj->quantity == 1){
	$stmt = $mysqli->prepare("delete from market where id=?");
	$stmt->bind_param('s', $market_id);
	$stmt->execute();
	$stmt->close();
	return;
} 
	
$stmt = $mysqli->prepare("update market set quantity = quantity -1 where id=?");
$stmt->bind_param('s', $market_id);
$stmt->execute();
$stmt->close();

