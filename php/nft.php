<?php


$NFTName = $_POST['NFTName'];
$resell = intval($_POST['resell']);
var_dump($NFTName, $resell);

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

$assetName = 'ELONS';
$userID = 1;
$cost = 10000;

$stmt = $mysqli->prepare("select * from assets where user_id=? and name=? and quantity > ?");
$stmt->bind_param('isi', $userID, $assetName, $cost);
$stmt->execute();
if ($result->num_rows > 0){
  echo "e!";
  return;
}
$stmt->close();
mysqli_report(MYSQLI_REPORT_ALL);


$stmt = $mysqli->prepare("insert into nfts (name, resell) values (?, ?)");
$stmt->bind_param("si", $NFTName, $resell);
$stmt->execute();
$stmt->close();


$stmt = $mysqli->prepare("update assets set quantity=quantity-? where user_id=? and name=?");
$stmt->bind_param('isi', $cost, $userID, $assetName);
$stmt->execute();
