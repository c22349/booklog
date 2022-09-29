<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="stylesheets/css/app.css">

  <title><?php echo $title; ?></title>
</head>

<body>
  <header class="navbar shadow-sm p-3 mb-5 bg-white">
    <div class="h2">
      <a class="text-body text-decoration-none" href="index.php">HYUGA BASE 座席予約システム</a>
    </div>
  </header>
  <div class="container">
    <?php include $content; ?>
  </div>
</body>

</html>
