<?php
$ch = curl_init("http://localhost/iissiapi/gamelists.php");
$post = [
  "LID" => $_REQUEST["lid"]
];
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
$res = curl_exec($ch);
$codigo = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $codigo;
echo "<br>";
echo $res;
?>
