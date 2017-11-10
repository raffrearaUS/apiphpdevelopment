<?php
require_once("gestionBD.php");
require_once("gestionJuegos.php");
$metodo = $_SERVER["REQUEST_METHOD"];
$uri = isset($_SERVER["PATH_INFO"])? explode("/", trim($_SERVER["PATH_INFO"], "/")) : null;
$orden = isset($_GET["sort"])? $_GET["sort"] : null;
$limit = isset($_GET["limit"])? $_GET["limit"] : null;
$offset = isset($_GET["offset"])? $_GET["offset"] : null;
$juego = json_decode(file_get_contents("php://input"), true);
$con = crearConexionBD();
// GET
if ($metodo == "GET") {
  if ($uri != null && count($uri) == 1) {
    if (existeGid($con, $uri[0])) {
      $res = getJuego($con, $uri[0]);
      header("Content-type: application/json");
      echo json_encode($res->fetch(PDO::FETCH_ASSOC));
    } else {
      header("HTTP/1.1 404 Not Found");
    }
  } else {
    $res = getJuegos($con, $orden, $limit, $offset);
    header("Content-type: application/json");
    echo json_encode($res->fetchAll(PDO::FETCH_ASSOC));
  }
// PUT
} else if ($metodo == "PUT") {
  if (existeGid($con, $juego["GID"])) {
    actualizaJuego($con, $juego);
    header("HTTP/1.1 204 No Content");
  } else {
    header("HTTP/1.1 404 Not Found");
  }
// POST
} else if ($metodo == "POST") {
  if (!existeGid($con, $juego["GID"])) {
    anadeJuego($con, $juego);
    header("HTTP/1.1 201 Created");
    header("Content-type: application/json");
    echo json_encode($juego);
  } else {
    header("HTTP/1.1 400 Bad Request");
  }
// DELETE
} else if ($metodo == "DELETE") {
  if ($uri != null && count($uri) == 1) {
    if (existeGid($con, $uri[0])) {
      eliminaJuego($con, $uri[0]);
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
