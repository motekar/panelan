<?php

session_name('PanelanSID'); session_start();

$config = include __DIR__ . '/config.php';

if (isset($_GET['logout'])) {
    session_destroy();

    setcookie(md5($_SERVER['DOCUMENT_ROOT']) . "_db", null, -1);

    header('Location: .');
    exit;
}

if (isset($_GET['fm']) && !empty($_GET['fm'])) {
    $path = filter_input(INPUT_GET, 'fm');

    if ( empty( $config['paths'][$path] ) ) die('No access');

    $_SESSION['path'] = $config['paths'][$path];

    header('Location: tinyfm/'); exit;
}

if (isset($_GET['db']) && !empty($_GET['db'])) {
    $dbname = filter_input(INPUT_GET, 'db');

    if ( empty( $config['databases'][$dbname] ) ) die('No access');

    $db_config = $config['databases'][$dbname];

    $data = array_merge( [
        'user' => 'root',
        'pass' => '',
        'host' => '127.0.0.1',
    ], $db_config );

    setcookie(md5($_SERVER['DOCUMENT_ROOT']) . "_db", base64_encode(json_encode($data)));

    // header('Location: pma/?db=' . $db_config['name']); exit;
    header('Location: adm/'); exit;
}

if (!empty($_POST)) {
    $user = filter_input(INPUT_POST, 'user');
    $pass = filter_input(INPUT_POST, 'pass');

    if (
        $user === $config['user'] &&
        password_verify($pass, $config['password_hash'])
    ) {
        $_SESSION['logged_in'] = 1;
        // first path in config
        $_SESSION['path'] = $config['paths'][array_keys($config['paths'])[0]];

        header('Location: ' . str_replace('access.php', '', $_SERVER['REQUEST_URI']));
        exit;
    }
}

// is logged in
if (!empty($_SESSION['logged_in'])) {
    header('Location: ' . str_replace('access.php', '', $_SERVER['REQUEST_URI']));
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

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
        <h3 class="text-2xl font-bold text-center">Login</h3>
        <form action="access.php" method="POST">
            <div class="mt-4">
                <div>
                    <label class="block" for="user">User<label>
                    <input name="user" type="text" placeholder="user"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block">Password<label>
                    <input name="pass" type="password" placeholder="Password"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-baseline justify-between">
                    <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
