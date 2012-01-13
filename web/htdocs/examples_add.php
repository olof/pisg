<h3>Add example pisg page</h3>

<? if (isset($_GET['done'])) { ?>

Thank you for the submission. The URL and the data you submitted will be
reviewed within the next couple of days, and then your page will appear on
the 'examples' page.<br /> 

<? } else { ?>
Here you can add a statistics page. The page will only be added to the
examples if you enter sane input.<br /> 
<br /> 

<form method="POST" action="examples_add_submit.php">

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

<? } ?>
