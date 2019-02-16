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
  <h1>Scripture Topics</h1>
<?php
    $stmt = $db->prepare('INSERT INTO scripture (book, chapter, verse, content)
      VALUES (:book, :chapter, :verse, :content)');

    $stmt->bindValue(':book', $_POST['book'], PDO::PARAM_STR);
    $stmt->bindValue(':chapter', $_POST['chapter'], PDO::PARAM_INT);
    $stmt->bindValue(':verse', $_POST['verse'], PDO::PARAM_INT);
    $stmt->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
    $stmt->execute();

    $newID = $pdo->lastInsertId('scripture_id_seq');

    echo $newID;


    //header("Location: addScripture.php");

//     foreach ($_POST['topics'] as $topic) {
//       echo 'scripture_id: scripture_id, topic_id: topic_id';
//       $stmt = $db->prepare('INSERT INTO scripture_topic (scripture_id, topic_id)
//         VALUES (:scripture_id, :topic_id)');

//         $stmt->bindValue(':topic_id', $topic);
//         $stmt->bindValue(':scripture_id', $newID);
//         $stmt->execute();
//     }

//     $stmt = $db->query('SELECT id, book, chapter, verse from scripture');

//     while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//      echo "<p>" . $row['book'] . $row['chapter'] . ":" . $row['verse'] . "<br>" . $row['content'] . "<br></p>";

//     $nextStatement = $db->prepare('SELECT name FROM topic JOIN scripture_topic ON topic.topic_id = scripture_topic.topic_id WHERE scripture_topic.scripture_id = :scripture_id');

//     $nextStatement->bindValue(":scripture_id", $row['id'], PDO::PARAM_INT);
//     $nextStatement->execute();

//     while ($listOfTopics = $nextStatement->fetch(PDO::FETCH_ASSOC)) {
//       echo "<p>" . $listOfTopics['name'] . "</p> <br>";
//     }
// }
?>

</body>
</html>
