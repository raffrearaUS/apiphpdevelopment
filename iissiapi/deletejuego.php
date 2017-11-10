<?php
$ch = curl_init("http://localhost/iissiapi/games.php/".$_REQUEST["gid"]);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
$codigo = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $codigo;
echo "<br>";
echo $res;
?>
