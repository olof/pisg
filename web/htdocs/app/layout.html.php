<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?=$pagetitle?></title>
<link rel="stylesheet" type="text/css" href="css/<?=$style?$style:'pisg'?>.css" />
</head>
<body>
 <div class="top"><h1><a href="home"><?=$sitename?></a></h1></div>
 <ul id="nav" class="box">
  <li><a href="about">About</a></li>
  <li><a href="examples">Examples</a></li>
  <li><a href="download">Download</a></li>
  <li><a href="documentation">Documentation</a></li>
  <li><a href="faq">FAQ</a></li>
  <li><a href="list">Mailing list</a></li>
  <li><a href="bugs">Bugs</a></li>
 </ul>
 <div id="content">
 <?=$content?>
 </div><!--/content-->
 <div id="footer">Copyright &copy; <a href="http://sourceforge.net/projects/pisg/">pisg project</a> <?=date('Y')?>. All Rights Reserved.</div>
</body>
</html>