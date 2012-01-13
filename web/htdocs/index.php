<?

if (isset($_SERVER['HTTP_ACCEPT'])) {
    if (strstr($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')) {
        header("Content-Type: application/xhtml+xml; charset=UTF-8");
    }
}
global $DEFINES;

$DEFINES = array(
        "CURRENT_RELEASE" => "0.72",
        "DATE" => "February 13th 2008"
        );

?>
<? echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>pisg - Perl IRC Statistics Generator <? if (isset($_GET['page'])) { echo ":: $_GET[page]"; } ?></title>
<link rel="stylesheet" type="text/css" href="css/pisg.css" /> 
</head>

<body>

<a href="/"><div class="top">pisg - Perl IRC Statistics Generator</div></a>
 <div class="box">
  <a href="<?=$_SERVER['PHP_SELF']?>?page=about">About</a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?=$_SERVER['PHP_SELF']?>?page=examples">Examples</a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?=$_SERVER['PHP_SELF']?>?page=download">Download</a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="docs/">Documentation</a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="docs/pisg-faq.html">FAQ</a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?=$_SERVER['PHP_SELF']?>?page=list">Mailing list</a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="<?=$_SERVER['PHP_SELF']?>?page=bugs">Bugs</a>
 </div>

 <div style="padding-left: 10px; padding-right: 10px">

 <?
 if (!isset($_GET['page'])) {
    $page = 'frontpage';
 } else {
     $page = $_GET['page'];
 }

 if (file_exists("$page.php") && $page != "index") {
     include_once("$page.php");
 } else {
     print "The page could not be found.\n";
 }
 ?>

 </div>

</body>
</html>
