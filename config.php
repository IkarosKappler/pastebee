<?php

require('env.inc.php');
mkenv('../.env');

defined("MAX_PASTES_PER_HOUR")or define('MAX_PASTES_PER_HOUR',_env('MAX_PASTES_PER_HOUR',30));

defined("DBDRIVER")or define('DBDRIVER',_env('DBDRIVER','mysql'));
defined("DBHOST")or define('DBHOST',_env('DBHOST','localhost'));
defined("DBNAME")or define('DBNAME',_env('DBNAME','pastebee'));
defined("DBUSER")or define('DBUSER',_env('DBUSER','pastebee'));
defined("DBPASS")or define('DBPASS',_env('DBPASS','yourpass'));


defined("THEME")or define('THEME',_env('THEME','default'));

defined("NOTIFICATION_EMAIL")or define('NOTIFICATION_EMAIL',_env('NOTIFICATION_EMAIL','default'));

defined("BASE_URL")or define('BASE_URL',_env('BASE_URL',$_SERVER['HTTP_HOST']));
