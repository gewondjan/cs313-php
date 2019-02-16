<?php

$url = parse_url(getenv('DATABASE_URL'));

$dbname = ltrim($url['path'], '/');
$dbHost = $url['host']; 
$dbPort = $url['port'];

try
{
  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbname", $url['user'], $url['pass']);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Scriptures DB</title>
</head>
<body>
  <h1>Scriptures in System</h1>
  <?php
    $scripturesInDb = $db->query('SELECT * FROM scripture');
    $foreach($scripturesInDb as $scripture) {
      echo "<p>" . $scripture['book'] . "</p></b>";

    }

  ?>


  <h1>Add Scriptures</h1>

  <form method="post" action="insert.php">
      <input type="text" name="book" placeholder="Enter the Book Name"><br>
      <input type="text" name="chapter" placeholder="Enter the Chapter Number"><br>
      <input type="text" name="verse" placeholder="Enter the Verse Number"><br>
      <textarea row="4" name="content" cols="50" placeholder="Enter Content Here"></textarea><br>

      <?php
      $stmt = $db->query('SELECT topic_id, name FROM topic');

      while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<input type='checkbox' name='topics[]' value='" . "$row[topic_id]'> $row[name] <br>";
      }
       ?>
    <input type="submit" />
  </form>

</body>
</html>
