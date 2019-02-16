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

  $scripturesStatement = $db->query('SELECT * FROM scripture');
  $scripturesInDb = $scripturesStatement->fetchAll(PDO::FETCH_ASSOC);
  foreach($scripturesInDb as $scripture) {
    echo "<p>" . $scripture['book'] . " " . $scripture['chapter'] . ":" . $scripture['verse'] . "</p></b>";
    $topicisCorresponding = $db->prepare('SELECT * FROM scripture JOIN scripture_topic ON scripture_topic.scripture_id = scripture.scripture_id JOIN topic ON topic.topic_id = scripture_topic.topic_id WHERE scripture.scripture_id = :id');
    $topicisCorresponding->bindValue(':id', $scripture['scripture_id'], PDO::PARAM_INT);
    $topicisCorresponding->execute();
    $topicsForScripture = $topicisCorresponding->fetchALl(PDO::FETCH_ASSOC);
    echo "<ul>";
    foreach($topicsForScripture as $topic) { 
      echo "<li>" . $topic['name'] . "</li>";
    }
    echo "</ul>";

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
        echo "<input type='checkbox' name='topics[]' value='" . $row[topic_id] . "'> $row[name] <br>";
      }
       ?>
    <input type="submit" />
  </form>

</body>
</html>
