<?php
require_once('functions.php');
$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
$result = $mysqli->query("select * from market where crypto_id=1");
echo "<tr><th>Name</th><th>Type</th><th>Quantity</th><th>Bid</th><th>Ask</th></tr>";
while ($obj = $result->fetch_object()) {
	echo "<tr><td>" . $obj->name . "</td><td>" . $obj->category . "</td><td>" . $obj->quantity 
		. " </td>";
	$bid = '-';
	if ($obj->bid != null){
		$bid = number_format($obj->bid);
	}
	$ask = '-';
	if ($obj->ask != null){
		$ask = number_format($obj->ask);
		if (howMuchDoTheyHave('ELONS') >= $obj->ask){
			$ask = "<button id='buy-" . $obj->id . "' class='buy btn btn-link'>" 
				. number_format($obj->ask) . "</button>";
		}
	}
	echo "<td>" . $bid . "</td><td>" . $ask . "</td></tr>";
}
echo "<tr><td><select><option></option><option>Mining Rigs</option></select></td><td></td><td><input type='number' value='1' min='1'></td><td><input type='text'></td><td><input type='text'></td></tr>";