<?php
$uri = "http://localhost/iissiapi/games.php";
if (!empty($_REQUEST["sort"]) || !empty($_REQUEST["limit"]) || !empty($_REQUEST["offset"])) {
  $uri .= "?";
  $param = array();
  if (!empty($_REQUEST["sort"])) {
    array_push($param, "sort=".$_REQUEST["sort"]);
  }
  if (!empty($_REQUEST["limit"])) {
    array_push($param, "limit=".$_REQUEST["limit"]);
  }
  if (!empty($_REQUEST["offset"])) {
    array_push($param, "offset=".$_REQUEST["offset"]);
  }
  if (count($param) == 1) {
    $uri .= $param[0];
  } else if (count($param) == 2) {
    $uri .= $param[0]."&".$param[1];
  } else if (count($param) == 3) {
    $uri .= $param[0]."&".$param[1]."&".$param[2];
  }
}
$ch = curl_init($uri);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
$codigo = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $codigo;
echo "<br>";
echo $res;
?>
