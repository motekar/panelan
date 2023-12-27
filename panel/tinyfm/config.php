<?php

$http_host = $_SERVER['HTTP_HOST'];

$is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
    || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

if (isset($_SERVER['HTTP_CF_VISITOR'])) {
    $cfVisitor = json_decode($_SERVER['HTTP_CF_VISITOR'], true);

    if ($cfVisitor && isset($cfVisitor['scheme']) && $cfVisitor['scheme'] === 'https') {
        // Request is using HTTPS through Cloudflare
        $is_https = true;
    }
}

define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . $_SERVER['PHP_SELF']);

$use_auth = false;

$default_timezone = 'Asia/Jakarta';

$datetime_format = 'Y-m-d H:i:s';
