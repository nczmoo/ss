<?php
require_once('functions.php');
$mysqli = new mysqli('localhost', "admin", "menia387", "ss");

$crypto_id = intval($_POST['crypto_id']);
$quantity = intval($_POST['quantity']);

$ownedRigs = howManyRigsDoTheyOwn();
$runningRigs = howManyRigsAreRunning();
$availableRigs = $ownedRigs - $runningRigs;
$howManyMining = howManyAreMining($crypto_id);
var_dump($quantity, $howManyMining, $crypto_id);
if ($quantity > $ownedRigs || ($quantity > $howManyMining && $quantity - $howManyMining  > $availableRigs)){
	echo "e!";
	return;
}



if ($howManyMining == 0){
	$stmt = $mysqli->prepare("insert into mining (crypto_id, quantity) values (?, ?)");
	$stmt->bind_param("ii", $crypto_id, $quantity);
	$stmt->execute();
	$stmt->close();
	return;
} else if ($howManyMining == 1 && $quantity == 0){
	$stmt = $mysqli->prepare("delete from mining where crypto_id=? and user_id=1");
	$stmt->bind_param("i", $crypto_id);
	$stmt->execute();
	$stmt->close();
	return;
}


$stmt = $mysqli->prepare("update mining set quantity=? where crypto_id=? and user_id=1");
$stmt->bind_param("ii", $quantity, $crypto_id);
$stmt->execute();
$stmt->close();
