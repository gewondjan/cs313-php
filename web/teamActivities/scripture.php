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
        margin: 40px;
      }
      form {
        display: flex;
        flex-direction: column;
      }
      form select {
        font-size: 18px;
        width: 300px;
        margin-bottom: 20px;
      }
      form input {
        width: 300px;
        margin-bottom: 20px;
        font-size: 20px;
        color: #C71585;
      }
      .main-text p a {
        text-decoration: none;
        color: #CD5C5C;
        font-size: 22px;
      }
    </style>
</head>

<body>
  <h1>Scipture References</h1>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <select name="scripture-input">
      <option value="John">John</option>
      <option value="Mosiah">Mosiah</option>
      <option value="D&C">Doctrine and Covenants</option>
      <option value="all">See the List</option>
    </select>
    <input type="submit" />
  </form>

  <?php
    if (isset($_POST["scripture-input"]) && $_POST["scripture-input"] != "all") {
      $stmt = $db->prepare('SELECT scripture_id, book, chapter, verse, content FROM scripture WHERE book=:book');
      $stmt->bindValue(':book', $_POST["scripture-input"], PDO::PARAM_STR);
      $stmt->execute();
    }
    else {
      $stmt = $db->query('SELECT scripture_id, book, chapter, verse, content FROM scripture');
    }
    $count = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<div class="main-text">';
      echo '<p><a href="./details.php?content=' . $row['scripture_id'] . '">';
      echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':';
      echo $row['verse'] . '</strong>';
      echo '</a></p>';
      echo '</div>';

    }
?>
</body>
</html>
