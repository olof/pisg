<?
if (ereg("Mozilla\/(4)\.(7.)", $HTTP_USER_AGENT) && !ereg("Opera", $HTTP_USER_AGENT) && !ereg("MSIE", $HTTP_USER_AGENT)) {
?>
<br />
<table width="75%" cellpadding="0" cellspacing="0" align="center">
 <tr>
  <td><font color="black" size="3">
  <i><? print $HTTP_USER_AGENT; ?></i><br />
<b>WARNING</b>:
It seems that you are using Netscape 4. This browser is old, buggy and
doesn't support common web standards very well, therefor making it very time
consuming to develop webpages for.<br />
I recommend you to upgrade your browser.<br />
If you're on a Windows platform, then Microsoft Internet Explorer might be
the best for you.<br />
If you're on a platform where Internet Explorer is not available, then
Mozilla (aka Netscape 6's engine) has become very stable, and much more
useable than Netscape 4.x, it's available from <a
b
href="http://www.mozilla.org" style="color: #70ba57">Mozilla.org</a>.<br />
This message was brought here not to bug you, but to make the web a better
place. <br />
 - Thanks. <a href="mailto:morten@wtf.dk" style="color: #70ba57">morten@wtf.dk</a></font>
  </td>
 </tr>
</table>
<? 
}
?>
