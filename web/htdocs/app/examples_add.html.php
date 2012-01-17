<?php

if ($_POST) {

    $channel=isset($_POST['channel'])?$db->quote($_POST['channel']):'';
    $url=isset($_POST['url'])?$db->quote($_POST['url']):'';
    $network=isset($_POST['network'])?$db->quote($_POST['network']):'';
    $maintainer=isset($_POST['maintainer'])?$db->quote($_POST['maintainer']):'';

    $sql="INSERT INTO examples (channel, url, network, maintainer) VALUES ($channel, $url, $network, $maintainer)";
    $db->exec($sql);

    /*
    $host = gethostbyaddr($REMOTE_ADDR);
    mail("morten@mbrix.dk", "[pisg] Page addition", "Page to be added:\n\tChannel: $channel\n\tURL: $url\n\tNetwork: $network\n\tMaintainer: $maintainer\n\nUser agent: $HTTP_USER_AGENT\nHost: $host\n\nhttp://pisg.sourceforge.net/admin_examples.php");
    */

    header("location: examples_add?done=1");
}
?>

<h3>Add example pisg page</h3>

<?php if (isset($_GET['done'])) { ?>

Thank you for the submission. The URL and the data you submitted will be
reviewed within the next couple of days, and then your page will appear on
the 'examples' page.<br /> 

<?php } else { ?>
Here you can add a statistics page. The page will only be added to the
examples if you enter sane input.<br /> 
<br /> 

<form method="POST" action="">
<table width="100%" cellpadding="2" cellspacing="0" border="0">
 <tr>
  <td>Channel name:</td>
  <td><input type="text" name="channel" maxlength="30" /></td>
  <td>Eg. '#channel_name'</td>
 </tr>
 <tr>
  <td>IRC network:</td>
  <td><input type="text" name="network" maxlength="30" /></td>
  <td>Eg. 'Undernet'</td>
 </tr>
 <tr>
  <td>URL:</td>
  <td><input type="text" name="url" maxlength="100" value="http://" /></td>
  <td>Eg. 'http://www.foo.org/stats/'</td>
 </tr>
 <tr>
  <td>Maintainer:</td>
  <td><input type="text" name="maintainer" maxlength="30" /></td>
  <td>Eg. 'John'</td>
 </tr>
</table>
<input type="submit" />
</form>
<?php } //end if ?>