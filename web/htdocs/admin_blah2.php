<? session_start(); ?>


<?
$_SESSION['authed'] = 0;
if (isset($_POST['password']) && $_POST['password'] == "hejskatter") {
    $_SESSION['authed'] = 1;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>pisg news admin system</title>
<link rel="stylesheet" href="mbpstyle.css" type="text/css">
<style type="text/css">

body {
    background-color: white;
}
</style>
</head>
<body>
<?
if (!isset($_SESSION['authed'])) { ?>
    Please type in administrator password<br />
    <form method="post" action="admin.php">
    <input type="password" name="password" size="40">
    <input type="hidden" name="add" value="<? print $add; ?>">
    <input type="hidden" name="edit" value="<? print $edit; ?>">
    <input type="hidden" name="delete" value="<? print $delete; ?>">
    <input type="submit" value="Submit">
    </form>
<? } else { ?>
<?
include("mysql.php");

if (isset($_GET['add'])) {

    $date = date("Y-m-d", time());
    mysql_query("INSERT INTO pisg_news (title, date, text) VALUES
    ('$_POST[title]','$date','$_POST[text]')") or die(mysql_error());

} elseif (isset($_GET['edit'])) {

    $date = mktime(0,0,0,$_POST['mm'],$_POST['dd'], $_POST['yyyy']);
    $date = date("Y-m-d", $date);
    mysql_query("UPDATE pisg_news SET title='$_POST[title]', date='$date', text='$_POST[text]' WHERE ID='$id'") or die(mysql_error());

}
?>

<table width="575" cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td class="text" colspan="3" align="center">
   <? if (!isset($_GET['new'])) { ?>
    <a style="color: green" href="admin.php?new=1">Post new</a><br />
   <? } ?>
    <br />
  </td>
 </tr>
 <tr>
  <td>

<table border="0" cellpadding="0" cellspacing="0" width="400">
<?
if (!isset($_GET['start'])) { $start = 0; }
if (!isset($_GET['end'])) { $end = 20; }

$query = mysql_query("SELECT * FROM pisg_news ORDER BY date DESC LIMIT $start,$end") or die(mysql_error());

while ($row = mysql_fetch_array($query)) {
    ?>
 <tr>
  <td class="text"><a href="admin.php?id=<? print $row[id] ?>"><? print $row[title]; ?></a></td>
  <td class="text" align="left" style="color: gray"><? print $row[date]; ?></td>
 </tr>

<? } ?>
</table>
</td>
<td width="25">&nbsp;</td>
<td valign="top">

<table border="0" cellpadding="0" cellspacing="0" width="150" align="right">
<tr>
<?
$query = mysql_query("SELECT * FROM pisg_news") or die(mysql_error());

$rows = mysql_num_rows($query);

if ($rows > $end) {
    $prevstart = $start - 20;
    print "<td class=\"text\"><a style=\"color: green\" href=\"admin.php?start=$prevstart&amp;end=$end\">Prev 20</a></td> ";
    $start += 20;
    print "<td class=\"text\"><a style=\"color: green\" href=\"admin.php?start=$start&amp;end=$end\">Next 20</a></td>";
}
?>
</tr>
</table>
</td>
</tr>
</table>


<br />

<? if ($id) {
    $query = mysql_query("SELECT * FROM pisg_news WHERE id='$id'");

    while ($row = mysql_fetch_array($query)) {
?>
<b>Edit</b><br />
<form method="post" action="admin.php?edit=1&id=<? print $row['id']; ?>">
Title: <input type="text" name="title" value="<? print $row['title']; ?>" size="30"><br />

<?
$dd = substr($row['date'], 8, 2);
?>

Day:

<select name="dd">
<? for($i=1;$i <= 31;$i++) { if(strlen($i) < 2) $i = "0".$i; ?>
<option value="<? print $i ?>" <? if($dd == "$i") { print "selected"; } ?>><? print $i ?></option>
<? } ?>
</select>


<?
$mm = substr($row[date], 5, 2);
?>

Month:
<select name="mm">
<? for($i=1;$i <= 12;$i++) { if(strlen($i) < 2) $i = "0".$i; ?>
<option value="<? print $i ?>" <? if($mm == "$i") { print "selected"; } ?>><? print $i ?></option>
<? } ?>
</select>

Year:
<input type="text" name="yyyy" size="4" maxlength="4" value="<? print
substr($row['date'], 0, 4); ?>"><br />
Text: <textarea name="text" rows="10" cols="80"><? echo $row['text']; ?></textarea><br />
<input type="submit" name="Edit" value="Edit">
</form>
<? } }  ?>
<br />
<? if (isset($_GET['new'])) { ?>
<b>Post new</b><br />
<form method="post" action="admin.php?add=1">
<input type="hidden" name="date">
Title: <input type="text" name="title" size="30"><br />
Text: <textarea name="text" rows="10" cols="80"></textarea><br />
<input type="submit" name="Add new" value="Add new">
</form>
<? } ?>

<? } ?>
</body>
</html>
