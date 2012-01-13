<h3>Remove example pisg page</h3>

<? if (isset($_POST['remove_description'])) { ?>

<?
include("mysql.php");
$query = mysql_query("SELECT channel, url, network, maintainer FROM
examples WHERE id='$id'") or die(mysql_error());

mysql_query("UPDATE examples SET remove=1, reason='$remove_description' WHERE ID='$id'") or die(mysql_error());

$row = mysql_fetch_array($query);
/*
$host = gethostbyaddr($REMOTE_ADDR);
mail("morten@mbrix.dk", "[pisg] Page removal", "Page to be removed:\n\tID: $id\n\tURL: $row[url]\n\tChannel: $row[channel]\n\n\tPage removal reason: $remove_description\n\nUser agent: $HTTP_USER_AGENT\nHost: $host\n");
*/
?>

Thank you for the notice of removal, your submission will be reviewed, and
the page will be removed if the reason is found appropriate.

<? } else { ?>
Please state briefly why the page should be removed, and then enter
'submit'.

<form method="POST" action="index.php?page=examples_remove">

<input type="text" name="remove_description" size="50"/>
<input type="hidden" name="id" value="<?=$id?>" /><br /> 
<input type="submit" />
</form>

<? } ?>
