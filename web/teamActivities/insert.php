<?php
  // start session for getting scriptures details
  session_start();
  // local DB variable configurations
  $dbHost = 'localhost';
  $dbPort = '5432';
  $dbName = 'scripturesdb';
  try
  {
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName");
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
    <style>
      body {
        display: flex;
        flex-direction: column;
      }
      form {
        display: flex;
        flex-direction: column;
        width: 40%;
        margin-left: 10%;
      }
      input {
        margin-bottom: 20px;
        height: 30px;
      }
    </style>
</head>
<body>
  <h1>Insert Scipture Topics</h1>

  <form method="post" action="display_scr.php">
      <input type="text" name="book" placeholder="Enter the Book Name"></input>
      <input type="text" name="chapter" placeholder="Enter the Chapter Number"></input>
      <input type="text" name="verse" placeholder="Enter the Verse Number"></input>
      <textarea row="4" name="content" cols="50" placeholder="Enter Content Here"></textarea>

      <?php
      $stmt = $db->query('SELECT topic_id, name FROM topic');

      while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<input type='checkbox' name='topics[]' value='" . "$row[topic_id]'> $row[name]";
      }
       ?>
    <input type="submit" />
  </form>

</body>
</html>
