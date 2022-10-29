<?php return [
	'user' => 'admin',
	// password_hash('password', PASSWORD_DEFAULT);
	'password_hash' => '$2y$10$mSWp0ktmKycf8sIXUTrNeuMAt2YxJhWw7z.CUE2zqCbJN9TKHQFSm',

	'paths' => [
		'www' => realpath(__DIR__ . '/../'),
		'sites' => realpath(__DIR__ . '/../../'),
	],
	'databases' => [
		'mysql' => [
			'name' => 'mysql',
			'host' => '127.0.0.1',
			'user' => 'root',
			'pass' => '',
		],
	],

	'default_timezone' => 'Asia/Jakarta',
];
