<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?=$pagetitle?></title>
<link rel="stylesheet" type="text/css" href="css/<?=$style?$style:'pisg'?>.css" />
<link rel="shortcut icon" href="favicon.png" />
</head>
<body>
 <div class="top"><h1><a href="<?=$basepath?>"><img src="images/logo.png" alt="<?=$sitename?>"></a></h1></div>
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
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://sourceforge.net/apps/piwik/pisg/" : "http://sourceforge.net/apps/piwik/pisg/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://sourceforge.net/apps/piwik/pisg/piwik.php?idsite=1" style="border:0" alt=""/></p></noscript>
<!-- End Piwik Tag -->
</body>
</html>