<?php
$ch = curl_init("http://localhost/iissiapi/games.php");
$put = [
  "GID" => $_REQUEST["gid"],
  "GNAME" => $_REQUEST["name"],
  "RELEASEDATE" => date_create($_REQUEST["releasedate"])->format("d/m/y")
];
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($put));
$res = curl_exec($ch);
$codigo = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $codigo;
echo "<br>";
echo $res;
?>
