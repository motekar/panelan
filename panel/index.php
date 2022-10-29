<?php

// prevent baseurl issue, redirect to path with trailing slash
if (!preg_match('#(\.php|\/)$#', $_SERVER['REQUEST_URI']) ) {
  header('Location: ' . $_SERVER['REQUEST_URI'] . '/');
  die;
}

$config = include __DIR__ . '/config.php';

session_name('PanelanSID'); session_start();

if (empty($_SESSION['logged_in'])) {
  header('Location: access.php');
  exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panelan</title>

      <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<main class="flex bg-gray-50 h-screen">
  <div class="w-[150px] bg-white">
    <div class="bg-gray-800 p-2">
      <h1 class="font-bold text-white">Panelan</h1>
    </div>
    <div class="flow-root">
      <nav aria-label="Main Nav" class="flex flex-col space-y-2">

        <div>
          <strong class="block text-xs font-medium uppercase p-2 text-gray-500 bg-gray-200"> File Manager </strong>

          <ul class="space-y-1">
            <?php foreach( $config['paths'] as $dir => $path): ?>
            <li>
              <a href="access.php?fm=<?php echo $dir; ?>" target="content-frame" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"><?php echo $dir; ?></a>
            </li>
            <?php endforeach; ?>
          </ul>

          <strong class="block text-xs font-medium uppercase p-2 text-gray-500 bg-gray-200"> DB Manager </strong>
          <ul class="space-y-1">
            <?php foreach( $config['databases'] as $name => $dbconfig ): ?>
            <li>
              <a href="access.php?db=<?php echo $name; ?>" target="content-frame" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"><?php echo $name; ?></a>
            </li>
            <?php endforeach; ?>
          </ul>

          <strong class="block text-xs font-medium uppercase p-2 text-gray-500 bg-gray-200">Access</strong>
          <ul class="space-y-1">
            <li>
              <a href="access.php?logout=1" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="h-screen w-full">
    <iframe name="content-frame" class="bg-green-100 w-[100%] h-full"
      onLoad="console.log(this.contentWindow.location.href);"
    src="tinyfm/"></iframe>
  </div>
</main>

</body>
</html>
