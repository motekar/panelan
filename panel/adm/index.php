<?php

$cookie_dbkey = md5($_SERVER['DOCUMENT_ROOT']) . '_db';
if ( empty( $_COOKIE[$cookie_dbkey] ) ) die( 'No access' );

$config = json_decode( base64_decode( $_COOKIE[$cookie_dbkey] ) );

if (empty($_GET)) {
    $_POST['auth'] = [
        'driver'    => 'server',
        'server'    => $config->host,
        'username'  => $config->user,
        'password'  => $config->pass,
        'db'        => $config->name,
        'permanent' => 1,
    ];
}

header("X-Frame-Options: allow");

function adminer_object() {
  class AdminerSoftware extends Adminer {
        // allow password-less database
        function login($login, $password) {
			return true;
		}

        function headers() {
            header_remove("X-Frame-Options");
        }
	}
	return new AdminerSoftware;
}

// include original Adminer
include "adminer.php";
