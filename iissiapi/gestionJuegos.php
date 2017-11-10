<?php
function getJuegos($con, $orden, $limit, $offset) {
  $consulta = "SELECT * FROM GAMES";
  if ($orden != null && $orden != "") {
    switch ($orden) {
      case "id":
      $consulta.=" ORDER BY GID";
      break;
      case "name":
      $consulta.=" ORDER BY GNAME";
      break;
      case "releasedate":
      $consulta.=" ORDER BY RELEASEDATE";
      break;
    }
  }
  if ($offset != null && $offset != "" && ($limit == null || $limit == "")) {
    $consulta = "SELECT GID, GNAME, RELEASEDATE FROM (SELECT ROWNUM RNUM, A.* FROM (".$consulta.") A) WHERE RNUM > ".$offset;
  } else if ($limit != null && $limit != "" && ($offset == null || $offset == "")) {
    $consulta = "SELECT A.* FROM (".$consulta.") A WHERE ROWNUM <= ".$limit;
  } else if ($offset != null && $offset != "" && $limit != null && $limit != "") {
    $dif = $offset + $limit;
    $consulta = "SELECT GID, GNAME, RELEASEDATE FROM (SELECT ROWNUM RNUM, A.* FROM (".$consulta.") A WHERE ROWNUM <= ".$dif.") WHERE RNUM > ".$offset;
  }
  try {
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    return $stmt;
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function getJuego($con, $gid) {
  try {
    $stmt = $con->prepare("SELECT * FROM GAMES WHERE GID = :gid");
    $stmt->bindParam(":gid", $gid);
    $stmt->execute();
    return $stmt;
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function actualizaJuego($con, $juego) {
  try {
    $stmt = $con->prepare("UPDATE GAMES SET GNAME = :name, RELEASEDATE = :releasedate WHERE GID = :gid");
    $stmt->bindParam(":gid", $juego["GID"]);
    $stmt->bindParam(":name", $juego["GNAME"]);
    $stmt->bindParam(":releasedate", $juego["RELEASEDATE"]);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function anadeJuego($con, $juego) {
  try {
    $stmt = $con->prepare("INSERT INTO GAMES VALUES (:gid, :name, :releasedate)");
    $stmt->bindParam(":gid", $juego["GID"]);
    $stmt->bindParam(":name", $juego["GNAME"]);
    $stmt->bindParam(":releasedate", $juego["RELEASEDATE"]);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function eliminaJuego($con, $gid) {
  try {
    $stmt1 = $con->prepare("DELETE FROM CONTAINS WHERE GID = :gid");
    $stmt1->bindParam(":gid", $gid);
    $stmt1->execute();
    $stmt2 = $con->prepare("DELETE FROM GAMES WHERE GID = :gid");
    $stmt2->bindParam(":gid", $gid);
    $stmt2->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function existeGid($con, $gid) {
  try {
    $stmt = $con->prepare("SELECT COUNT(*) FROM GAMES WHERE GID = :gid");
    $stmt->bindParam(":gid", $gid);
    $stmt->execute();
    return $stmt->fetchColumn();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}
?>
