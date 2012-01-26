<h3>Add example</h3>
<?php

if ($_POST) {

    $channel=isset($_POST['channel'])?htmlspecialchars($_POST['channel']):'';
    $url=isset($_POST['url'])?htmlspecialchars($_POST['url']):'';
    $network=isset($_POST['network'])?htmlspecialchars($_POST['network']):'';
    $maintainer=isset($_POST['maintainer'])?htmlspecialchars($_POST['maintainer']):'';
    $email=isset($_POST['email'])?$db->quote($_POST['email']):'';

    $sql="INSERT INTO examples (channel, url, network, maintainer) VALUES (%s, %s, %s, %s)",$db->quote($channel),$db->quote($url),$db->quote($network),$db->quote($maintainer));
    $db->exec($sql);

    include'sendmail.php';
    $mail=new Sendmail();
    $to='pisg-commits@lists.sourceforge.net';
    $subject='Example addition';
    $message="Example to be added:\n
        Channel: $channel\n
        URL: $url\n
        Network: $network\n
        Maintainer: $maintainer";
    $mail->send($to, $subject, $message, $email);
?>

<p>Thank you for the submission. The URL and the data you submitted will be
reviewed within the next couple of days, and then your page will appear on
the 'examples' page.</p> 

<?php } else { ?>
<p>Here you can add a statistics page. The page will only be added to the
examples if you enter sane input.</p>

<form method="POST" action="">
<table width="100%" cellpadding="2" cellspacing="0" border="0">
 <tr>
  <td>Channel name:</td>
  <td><input type="text" name="channel" maxlength="50" /></td>
  <td>Eg. '#channel_name'</td>
 </tr>
 <tr>
  <td>IRC network:</td>
  <td><input type="text" name="network" maxlength="50" /></td>
  <td>Eg. 'Undernet'</td>
 </tr>
 <tr>
  <td>URL:</td>
  <td><input type="text" name="url" maxlength="255" value="http://" /></td>
  <td>Eg. 'http://www.example.org/stats/'</td>
 </tr>
 <tr>
  <td>Maintainer:</td>
  <td><input type="text" name="maintainer" maxlength="50" /></td>
  <td>Eg. 'John'</td>
 </tr>
 <tr>
  <td>Email address:</td>
  <td><input type="text" name="email" maxlength="255" /></td>
  <td>Eg. 'john@example.org'</td>
 </tr>
</table>
<input type="submit" />
</form>
<?php } //end if ?>