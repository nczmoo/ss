<?php
$mysqli = new mysqli('localhost', "admin", "menia387", "ss");
$result = $mysqli->query("select * from nfts");
echo "<tr><th>Name</th><th>Creator</th><th>Owner</th><th>Bid</th><th>Ask</th><th>Resell %</th></tr>";
while ($obj = $result->fetch_object()) {
	echo "<tr><td>" . $obj->name . "</td><td>olnog</td><td>olnog</td><td>-</td>-<td></td><td> ". $obj->resell . "</td></tr>";
}
echo "<tr><td><input id='NFTName' type='text' style='width:140px;' maxlength='16' placeholder='10k ELONS'></td><td></td>" .  
	"<td></td><td></td><td> -</td><td><input id='NFTResell' type='number' value='0' min='0' max='99' style='width:50px;' maxlength='2'></td></tr>";