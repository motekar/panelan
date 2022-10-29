<?php

session_name('PanelanSID'); session_start();
if (empty($_SESSION['logged_in'])) die('401');

$use_auth = false;

$default_timezone = 'Asia/Jakarta';

$datetime_format = 'Y-m-d H:i:s';
