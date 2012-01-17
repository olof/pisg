<?php

session_start();
if (!isset($_SESSION['authed']) || !$_SESSION['authed']) {
    header('Location: admin');
    die();
}

if (isset($_GET['add'])) {

    $date = date("Y-m-d", time());
    $db->query("INSERT INTO news (title, date, text) VALUES
    ('$_POST[title]','$date','$_POST[text]')") or die(mysql_error());

} elseif (isset($_GET['edit'])) {

    $date = mktime(0,0,0,$_POST['mm'],$_POST['dd'], $_POST['yyyy']);
    $date = date("Y-m-d", $date);
    $db->query("UPDATE news SET title='$_POST[title]', date='$date', text='$_POST[text]' WHERE ID='$id'");

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

$query = $db->query("SELECT * FROM news ORDER BY date DESC LIMIT $start,$end");

while ($query as $row) {
    ?>
 <tr>
  <td class="text"><a href="admin.php?id=<?=$row['id']?>"><?=$row['title']?></a></td>
  <td class="text" align="left" style="color: gray"><?=$row['date']?></td>
 </tr>

<? } ?>
</table>
</td>
<td width="25">&nbsp;</td>
<td valign="top">

<table border="0" cellpadding="0" cellspacing="0" width="150" align="right">
<tr>
<?
$query = $db->query("SELECT * FROM news") or die(mysql_error());

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
    $query = mysql_query("SELECT * FROM news WHERE id='$id'");

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