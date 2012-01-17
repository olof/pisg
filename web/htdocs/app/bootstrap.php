<?php

//set config from ini
$config=parse_ini_file('../config.ini',1);

//extract config settings
extract($config['settings']);

//setup
date_default_timezone_set($timezone);

//database
require 'db.php';
$db=new db($dbfile);
if (filesize($dbfile)==0) { $db->setup('data/db.sql'); }

//route
require 'route.php';
$route=new route('home');
$basepath=$route->basepath;
$path=$route->path;

//do we need to redirect?
$newpath=$route->checkpath($path);
if ($path != $newpath) { $route->redirect($basepath.$newpath); }
//backwards compat
if (isset($_GET['page'])) { $route->redirect($basepath.htmlspecialchars($_GET['page'])); }

//set title
$pagetitle=isset($config['title'][$path])?$config['title'][$path]:ucwords(str_replace('-',' ',$path));

//view
require 'view.php';
$view=new view();
$view->viewpath=DIR_APP.DIRSEP;

/*data*/
//define empty data array
$data=array();
//settings
$view->data+=$config['data'];
//add the logic data
$file=DIR_APP.DIRSEP.$path;
if (file_exists($file.'.php')) { include $file.'.php'; }
$data['path']=$path;
$data['content']='';
$data['db']=&$db;
//add data to view
$view->data+=$data;
unset($data);

//no contents?
$content=$view->getcontents($path);
if (!$content) {
  $path='notfound';
  $pagetitle=isset($config['title'][$path])?$config['title'][$path]:ucwords(str_replace('-',' ',$path));
  $content=$view->getcontents($path);
}
$pagetitle=$sitename.' :: '.$pagetitle;
$view->set('pagetitle',$pagetitle);

//include the layout
include 'layout.html.php';
//eof