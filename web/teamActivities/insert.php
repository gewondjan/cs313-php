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
<?php
    $stmt = $db->prepare('INSERT INTO scripture (book, chapter, verse, content)
      VALUES (:book, :chapter, :verse, :content)');

    $stmt->bindValue(':book', $_POST['book'], PDO::PARAM_STR);
    $stmt->bindValue(':chapter', $_POST['chapter'], PDO::PARAM_INT);
    $stmt->bindValue(':verse', $_POST['verse'], PDO::PARAM_INT);
    $stmt->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
    $stmt->execute();

    $newID = $db->lastInsertId('scripture_scripture_id_seq');


    foreach ($_POST['topics'] as $topic) {
      $stmt = $db->prepare('INSERT INTO scripture_topic (scripture_id, topic_id)
        VALUES (:scripture_id, :topic_id)');

        $stmt->bindValue(':topic_id', $topic, PDO::PARAM_INT);
        $stmt->bindValue(':scripture_id', $newID, PDO::PARAM_INT);
        $stmt->execute();
    }

    
    header("Location: addScripture.php");
    die();

?>

</body>
</html>
