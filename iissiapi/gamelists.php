<?php
require_once("gestionBD.php");
require_once("gestionListas.php");
require_once("gestionJuegos.php");
$metodo = $_SERVER["REQUEST_METHOD"];
$uri = isset($_SERVER["PATH_INFO"])? explode("/", trim($_SERVER["PATH_INFO"], "/")) : null;
$list = json_decode(file_get_contents("php://input"), true);
$con = crearConexionBD();
// GET
if ($metodo == "GET") {
  if ($uri != null && count($uri) == 1) {
    if (existeLid($con, $uri[0])) {
      $res = getLista($con, $uri[0]);
      $lista = $res->fetch(PDO::FETCH_ASSOC);
      $juegos = getJuegosLista($con, $lista["LID"]);
      $lista["GAMES"] = $juegos->fetchAll(PDO::FETCH_ASSOC);
      header("Content-type: application/json");
      echo json_encode($lista);
    } else {
      header("HTTP/1.1 404 Not Found");
    }
  } else {
    $res = getListas($con);
    $listas = $res->fetchAll(PDO::FETCH_ASSOC);
    $return = array();
    foreach ($listas as $lista) {
      $juegos = getJuegosLista($con, $lista["LID"]);
      $lista["GAMES"] = $juegos->fetchAll(PDO::FETCH_ASSOC);
      array_push($return, $lista);
    }
    header("Content-type: application/json");
    echo json_encode($return);
  }
// POST
} else if ($metodo == "POST") {
  if ($uri != null && count($uri) == 2) {
    if (existeLid($con, $uri[0]) && existeGid($con, $uri[1])) {
      if (!contieneJuego($con, $uri[0], $uri[1])) {
        anadeJuegoLista($con, $uri[0], $uri[1]);
        $res = getLista($con, $uri[0]);
        $lista = $res->fetch(PDO::FETCH_ASSOC);
        $juegos = getJuegosLista($con, $lista["LID"]);
        $lista["GAMES"] = $juegos->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 201 Created");
        header("Content-type: application/json");
        echo json_encode($lista);
      } else {
        header("HTTP/1.1 400 Bad Request");
      }
    } else {
      header("HTTP/1.1 404 Not Found");
    }
  } else if (!existeLid($con, $list["LID"])) {
    anadeLista($con, $list);
    header("HTTP/1.1 201 Created");
    header("Content-type: application/json");
    $list["GAMES"] = array();
    echo json_encode($list);
  } else {
    header("HTTP/1.1 400 Bad Request");
  }
// DELETE
} else if ($metodo == "DELETE") {
  if ($uri != null && count($uri) == 2) {
    if (contieneJuego($con, $uri[0], $uri[1])) {
      eliminaJuegoLista($con, $uri[0], $uri[1]);
      header("HTTP/1.1 204 No Content");
    } else {
      header("HTTP/1.1 404 Not Found");
    }
  } else if ($uri != null && count($uri) == 1) {
    if (existeLid($con, $uri[0])) {
      eliminaLista($con, $uri[0]);
      header("HTTP/1.1 204 No Content");
    } else {
      header("HTTP/1.1 404 Not Found");
    }
  } else {
    header("HTTP/1.1 400 Bad Request");
  }
}
cerrarConexionBD($con);
?>
