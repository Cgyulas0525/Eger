<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 6000);

define('PATH_MODEL', dirname(__DIR__, 2) . '/api/model');
define('PATH_INC', dirname(__DIR__, 2) . '/api/inc');
define('PATH_FILES', dirname(__DIR__, 2) . '/api/files');
define('PATH_OUTPUT', dirname(__DIR__, 2) . '/output/');

define('MYSQL_HOST', 'localhost');
define('MYSQL_PORT', '3306');
define('MYSQL_DATABASE', 'eger');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', 'password');
define('MYSQL_CHARSET', 'utf8');


define('VALIDFROM', date('Y-m-d H:i:s', strtotime('midnight')));
define('DATE_NOW', date('Y-m-d H:i:s', strtotime('now')));

/* ide kell vmi */
