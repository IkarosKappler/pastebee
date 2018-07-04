<?php

require('env.inc.php');
mkenv('../.env');

defined("DBDRIVER")or define('DBDRIVER',_env('DBDRIVER','mysql'));
defined("DBHOST")or define('DBHOST',_env('DBHOST','localhost'));
defined("DBNAME")or define('DBNAME',_env('DBNAME','pastebee'));
defined("DBUSER")or define('DBUSER',_env('DBUSER','pastebee'));
defined("DBPASS")or define('DBPASS',_env('DBPASS','yourpass'));

