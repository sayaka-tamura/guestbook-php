<?php

  $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
  $db['dbname'] = ltrim($db['path'], '/');
  $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
  $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
  );

  try {
      $db = new PDO($dsn, $db['user'], $db['pass'], $options);

      $sql = 'SELECT * FROM message';
      $prepare = $db->prepare($sql);
      $prepare->execute();

      echo '<pre>';
      $prepare->execute();
      $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
      print_r(h($result));
      echo "\n";
      echo '</pre>';
  } catch (PDOException $e) {
      echo 'Error: ' . h($e->getMessage());
  }

  function h($var)
  {
      if (is_array($var)) {
          return array_map('h', $var);
      } else {
          return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
      }
  }
?>

</head>

<body class="d-flex h-100 text-center text-white bg-dark">
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

    <header>
      <div>
        <h3 class="float-md-start mb-0"><a href="index.php">Guest Book</a></h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
          <a class="nav-link" href="#">Feature</a>
          <a class="nav-link" href="#">Contact</a>
        </nav>
      </div>
    </header>

    <main class="px-3">
      <form method="post" action="confirm.php">
        <div class="form-group">
        <table class=" mx-auto mx-auto my-4 col-6">
          <tr>
            <td class="my-1">Name</td>
            <td><input type="text" class="form-control" name="m_name"></td>
          </tr>
          <tr>
            <td class="my-1">Email Address</td>
            <td><input type="text" class="form-control" name="m_mail"></td>
          </tr>
          <tr>
            <td class="my-1">Message</td>
            <td>
              <textarea name="m_message" class="form-control" rows="5"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" class="form-control mt-3 btn btn-info" name="sub1" value="Confirm">
            </td>
          </tr>
        </table>
        </div>
      </form>


    </main>
    <footer class="my-5 text-white-50">
      <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
    </footer>

  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>