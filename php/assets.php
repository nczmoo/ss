<?php

$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
$result = $mysqli->query("select * from assets");
echo "<tr><th>Name</th><th>Type</th><th>Quantity</th></tr>";
while ($obj = $result->fetch_object()) {
	//var_dump($obj);
	echo "<tr><td>" . $obj->name . "</td><td>" . $obj->category . "</td><td>" . number_format($obj->quantity) . "</td></tr>";
    //printf("%s (%s)\n", $obj->Name, $obj->CountryCode);
}