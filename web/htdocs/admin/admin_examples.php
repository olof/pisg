<? session_start(); ?>
<?
if (isset($_POST['password']) && $_POST['password'] == "hejskatter") {
    $_SESSION['authed'] = 1;
}

?>
<?
include("mysql.php");

if (isset($_SESSION['authed'])) {
    if (isset($verifypage)) {
        mysql_query("UPDATE pisg_examples SET shown=1 WHERE id=$verifypage") or die(mysql_error());
    } else if (isset($removepage)) {
        mysql_query("DELETE FROM pisg_examples WHERE id=$removepage") or die(mysql_error());
    } else if (isset($denypage)) {
        mysql_query("UPDATE pisg_examples SET remove=0 WHERE id=$denypage") or die(mysql_error());
    } else if (isset($editpage)) {
        mysql_query("UPDATE pisg_examples SET channel='$channel', maintainer='$maintainer', network='$network', url='$url' WHERE id=$editpage") or die(mysql_error());
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>pisg examples admin system</title>
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
    <form method="post" action="admin_examples.php">
    <input type="password" name="password" size="40">
    <input type="hidden" name="add" value="<? print $add; ?>">
    <input type="hidden" name="edit" value="<? print $edit; ?>">
    <input type="hidden" name="delete" value="<? print $delete; ?>">
    <input type="submit" value="Submit">
    </form>
<? } else { ?>

<span style="font-weight: bold">Newly added pages, but not verified yet:</span><br /> 
<?
$query = mysql_query("SELECT * FROM pisg_examples WHERE shown=0") or die(mysql_error());

while ($row = mysql_fetch_array($query))
{
    print "id: $row[id] | URL: <a href=\"$row[url]\">$row[url]</a> | Channel: $row[channel] | <a href=\"admin_examples.php?verifypage=$row[id]\">verify page</a> | <a href=\"admin_examples.php?removepage=$row[id]\">removepage</a> | <a href=\"admin_examples.php?doedit=$row[id]\">edit</a><br />";
}

?>
<br />
<br />
<span style="font-weight: bold">Pages for removal:</span><br />
<br />
<?
$query = mysql_query("SELECT * FROM pisg_examples WHERE remove=1") or die(mysql_error());

while ($row = mysql_fetch_array($query))
{
    print "id: $row[id] | URL: <a href=\"$row[url]\">$row[url]</a> | Channel: $row[channel] | Reason: $row[reason] | <a href=\"admin_examples.php?removepage=$row[id]\">remove page</a> | <a href=\"admin_examples.php?denypage=$row[id]\">denypage</a> | <a href=\"admin_examples.php?doedit=$row[id]\">edit</a> <br />";
}

?>

<? if (isset($doedit)) { ?>

<?
$query = mysql_query("SELECT * FROM pisg_examples WHERE id=$doedit") or die(mysql_error());

$row = mysql_fetch_array($query);

?>
<br />
<br />

<form action="admin_examples.php?editpage=<?= $doedit?>" method="post">
<input type="text" name="url" value="<?= $row[url] ?>">
<input type="text" name="channel" value="<?= $row[channel] ?>">
<input type="text" name="maintainer" value="<?= $row[maintainer] ?>">
<input type="text" name="network" value="<?= $row[network] ?>">
<input type="submit">
</form>

<? } ?>

<? } ?>



</body>
</html>
