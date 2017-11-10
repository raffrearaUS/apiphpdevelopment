<?php
function getListas($con) {
  try {
    $stmt = $con->prepare("SELECT * FROM GAMELISTS");
    $stmt->execute();
    return $stmt;
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function getLista($con, $lid) {
  try {
    $stmt = $con->prepare("SELECT * FROM GAMELISTS WHERE LID = :lid");
    $stmt->bindParam(":lid", $lid);
    $stmt->execute();
    return $stmt;
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function getJuegosLista($con, $lid) {
  try {
    $stmt = $con->prepare("SELECT GID, GNAME, RELEASEDATE FROM GAMELISTS NATURAL JOIN CONTAINS NATURAL JOIN GAMES WHERE LID = :lid");
    $stmt->bindParam(":lid", $lid);
    $stmt->execute();
    return $stmt;
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function contieneJuego($con, $lid, $gid) {
  try {
    $stmt = $con->prepare("SELECT COUNT(*) FROM CONTAINS WHERE LID = :lid AND GID = :gid");
    $stmt->bindParam(":lid", $lid);
    $stmt->bindParam(":gid", $gid);
    $stmt->execute();
    return $stmt->fetchColumn();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function anadeLista($con, $lista) {
  try {
    $stmt = $con->prepare("INSERT INTO GAMELISTS VALUES (:lid)");
    $stmt->bindParam(":lid", $lista["LID"]);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function eliminaLista($con, $lid) {
  try {
    $stmt1 = $con->prepare("DELETE FROM CONTAINS WHERE LID = :lid");
    $stmt1->bindParam(":lid", $lid);
    $stmt1->execute();
    $stmt2 = $con->prepare("DELETE FROM GAMELISTS WHERE LID = :lid");
    $stmt2->bindParam(":lid", $lid);
    $stmt2->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function anadeJuegoLista($con, $lid, $gid) {
  try {
    $stmt = $con->prepare("INSERT INTO CONTAINS VALUES (SEQ_CONTAINS.NEXTVAL, :lid, :gid)");
    $stmt->bindParam(":lid", $lid);
    $stmt->bindParam(":gid", $gid);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function eliminaJuegoLista($con, $lid, $gid) {
  try {
    $stmt = $con->prepare("DELETE FROM CONTAINS WHERE LID = :lid AND GID = :gid");
    $stmt->bindParam(":lid", $lid);
    $stmt->bindParam(":gid", $gid);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function existeLid($con, $lid) {
  try {
    $stmt = $con->prepare("SELECT COUNT(*) FROM GAMELISTS WHERE LID = :lid");
    $stmt->bindParam(":lid", $lid);
    $stmt->execute();
    return $stmt->fetchColumn();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}
?>
