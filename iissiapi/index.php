<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Prueba</title>
  </head>
  <body>
    <h1>Prueba la API</h1>
    <h2>Games</h2>
    <form action="getjuegos.php" method="post">
      <input type="text" name="sort" placeholder="Sort">
      <input type="number" name="limit" placeholder="Limit">
      <input type="number" name="offset" placeholder="Offset">
      <input type="submit" value="Obtener todos los juegos">
    </form>
    <br>
    <form action="getjuego.php" method="post">
      <input type="text" name="gid" maxlength="6" placeholder="GID" required>
      <input type="submit" value="Obtener un juego">
    </form>
    <br>
    <form action="postjuego.php" method="post">
      <input type="text" name="gid" maxlength="6" placeholder="GID" required>
      <input type="text" name="name" maxlength="50" placeholder="Name" required>
      <input type="date" name="releasedate" placeholder="Release date" required>
      <input type="submit" value="Crear un juego">
    </form>
    <br>
    <form action="putjuego.php" method="post">
      <input type="text" name="gid" maxlength="6" placeholder="GID" required>
      <input type="text" name="name" maxlength="50" placeholder="Name" required>
      <input type="date" name="releasedate" placeholder="Release date" required>
      <input type="submit" value="Actualizar un juego">
    </form>
    <br>
    <form action="deletejuego.php" method="post">
      <input type="text" name="gid" maxlength="6" placeholder="GID" required>
      <input type="submit" value="Eliminar un juego">
    </form>
    <h2>Gamelists</h2>
    <form action="getlistas.php" method="post">
      <input type="submit" value="Obtener todas las listas">
    </form>
    <br>
    <form action="getlista.php" method="post">
      <input type="number" name="lid" placeholder="LID" required>
      <input type="submit" value="Obtener una lista">
    </form>
    <br>
    <form action="postlista.php" method="post">
      <input type="number" name="lid" placeholder="LID" required>
      <input type="submit" value="Crear una lista">
    </form>
    <br>
    <form action="deletelista.php" method="post">
      <input type="number" name="lid" placeholder="LID" required>
      <input type="submit" value="Eliminar una lista">
    </form>
    <br>
    <form action="postjuegolista.php" method="post">
      <input type="number" name="lid" placeholder="LID" required>
      <input type="text" name="gid" maxlength="6" placeholder="GID" required>
      <input type="submit" value="Añadir un juego a una lista">
    </form>
    <br>
    <form action="deletejuegolista.php" method="post">
      <input type="number" name="lid" placeholder="LID" required>
      <input type="text" name="gid" maxlength="6" placeholder="GID" required>
      <input type="submit" value="Eliminar un juego de una lista">
    </form>
  </body>
</html>
