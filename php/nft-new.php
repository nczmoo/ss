<?php
$NFTName = $_POST['NFTName'];
$resell = intval($_POST['resell']);

if ($resell > 99 || $resell < 0 || $NFTName == '' || strlen($NFTName) > 16 ) {
	echo 'e!';
}
$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
$stmt = $mysqli->prepare("select * from nfts where name=? ");
$stmt->bind_param('s', $NFTName);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0){
  echo "e!";
  return;
}
$stmt->close();


$assetName = 'ELONS';
$userID = 1;
$cost = 10000;

$stmt = $mysqli->prepare("select * from assets where user_id=? and name=? and quantity > ?");
$stmt->bind_param('isi', $userID, $assetName, $cost);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0){
  echo "e!";
  return;
}
$stmt->close();


$stmt = $mysqli->prepare("insert into nfts (name, resell) values (?, ?)");
$stmt->bind_param("si", $NFTName, $resell);
$stmt->execute();
$stmt->close();


$assetCategory = 'NFT';
$assetQuantity = 1;
$stmt = $mysqli->prepare("insert into assets (name, category, quantity) values (?, ?, ?)");
$stmt->bind_param("ssi", $NFTName, $assetCategory , $assetQuantity);
$stmt->execute();
$stmt->close();


$stmt = $mysqli->prepare("update assets set quantity = quantity-? where user_id=? and name=?");
$stmt->bind_param('iis', $cost, $userID, $assetName);
$stmt->execute();
