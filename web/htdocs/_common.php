<?php

/**
 * Enable Error Reporting
 */
error_reporting(E_ALL);
ini_set('display_errors','On');

/**
 * Defines the root path.
 */
defined('ROOT_PATH')
    || define('ROOT_PATH', realpath(dirname(__FILE__)));

/**
 * Defines the library directory.
 */
define('DIR_LIB','lib');

/**
 * Defines the application directory.
 */
define('DIR_APP','app');

/**
 * Defines the data directory.
 */
define('DIR_DATA','data');

/**
 * Includes the library directory.
 */
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(ROOT_PATH . DIRECTORY_SEPARATOR . DIR_LIB),
    get_include_path(),
)));

/**
 * Includes the application directory.
 */
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(ROOT_PATH . DIRECTORY_SEPARATOR . DIR_APP),
    get_include_path(),
)));

/**
 * Short definition of DIRECTORY_SEPARATOR.
 */
define('DIRSEP',DIRECTORY_SEPARATOR);

/**
 * Defines the extention used for php files.
 */
define('PHP_EXT','.'.pathinfo(__FILE__,PATHINFO_EXTENSION));

/**
 * Defines the default index name.
 */
define('PHP_INDEX','index'.PHP_EXT);

/**
 * Defines the common directory.
 */
define('DIR_COMMON','common');

/**
 * Include common functions.
 */
$dir=DIR_LIB.DIRSEP.DIR_COMMON.DIRSEP.'*'.PHP_EXT;
$files=glob($dir);
rsort($files);
if ($files) {
	foreach ($files as $file) {
		if (basename($file) != PHP_INDEX) { include($file); }
	}
}
