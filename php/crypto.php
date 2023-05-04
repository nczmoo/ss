<?php
require_once('functions.php');
$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
$result = $mysqli->query("select * from crypto");

$numOfOwnedRigs = howManyRigsDoTheyOwn();
$numOfRigsRunning = howManyRigsAreRunning();

$numOfRigsAvailable = $numOfOwnedRigs - $numOfRigsRunning;
echo "<tr><th>Name</th><th>Capitalization</th><th>Owned</th><th>Mining " 
	. $numOfRigsRunning . "/" . $numOfOwnedRigs . "</th></tr>";
while ($obj = $result->fetch_object()) {
	$howManyAreMining = howManyAreMining(fetchCryptoID($obj->name));
	echo "<tr><td>" . $obj->name . "</td><td>" . number_format($obj->capitalization) 
		. "</td><td>" . number_format(howMuchDoTheyHave($obj->name)) 
		. "</td><td>";
		
	$mining = "<input id='mine-" . $obj->id . "' class='mine' type='number' value='" . $howManyAreMining . "' min='0' max='" . $numOfRigsAvailable . "'>";
	if ($numOfRigsAvailable == 0 && $howManyAreMining == 0){
		$mining = $howManyAreMining;
	}
		
	echo $mining . "</td></tr>";
		
	//printf("%s (%s)\n", $obj->Name, $obj->CountryCode);
}
