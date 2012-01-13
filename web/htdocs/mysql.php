<?php

//set config from ini
$config=parse_ini_file('../config.ini',1);

//extract config settings
extract($config['database']);

//connect database
$connect = mysql_connect($config['database']['host'], $config['database']['user'], $config['database']['pass']);
mysql_select_db($config['database']['name']);

//unset database password
unset($config['database']['pass']);

//eof