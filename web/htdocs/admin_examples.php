<?php

session_start();
if (!isset($_SESSION['authed']) || !$_SESSION['authed']) {
    $pw_salt='pisg+admin,';
    $pw_hash='a1764831e62d52191009207dadc0bc8e';
    $_SESSION['authed'] = ((isset($_REQUEST['password']) && md5($pw_salt.$_REQUEST['password']) == $pw_hash));
}

include('mysql.php');

if ($_SESSION['authed']) {
    if (isset($_GET['verify'])) {
        mysql_query('UPDATE examples SET shown=1 WHERE id='.$_GET['verify']) or die(mysql_error());
    } else if (isset($_GET['remove'])) {
        mysql_query("DELETE FROM examples WHERE id=".$_GET['remove']) or die(mysql_error());
    } else if (isset($_GET['deny'])) {
        mysql_query("UPDATE examples SET remove=0 WHERE id=".$_GET['deny']) or die(mysql_error());
    } else if (isset($_GET['edit'])) {
        mysql_query("UPDATE examples SET channel='".$_POST['channel']."', maintainer='".$_POST['maintainer']."', network='".$_POST['network']."', url='".$_POST['url']."' WHERE id=".$_GET['edit']) or die(mysql_error());
    }
}
if (isset($_SERVER['HTTP_ACCEPT'])) {
    if (strstr($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')) {
        header("Content-Type: application/xhtml+xml; charset=UTF-8");
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>pisg examples admin system</title>
<link rel="stylesheet" href="css/admin.css" type="text/css" />
<style type="text/css">
body {
    background-color: white;
}
</style>
</head>
<body>
<?
if (!$_SESSION['authed']) { ?>
    Please type in administrator password<br />
    <form method="post" action="">
    <input type="password" name="password" size="40" />
    <input type="hidden" name="add" value="<?=$add?>" />
    <input type="hidden" name="edit" value="<?=$edit?>" />
    <input type="hidden" name="delete" value="<?=$delete?>" />
    <input type="submit" value="Submit" />
    </form>
<? } else { ?>

<h3>Newly added pages, but not verified yet:</h3>
<ol>
<?
$query = mysql_query("SELECT * FROM examples WHERE shown=0 ORDER BY id ASC") or die(mysql_error());

while ($row = mysql_fetch_array($query))
{
    $row['url'] = htmlentities($row['url']);
    $row['channel'] = utf8_encode(htmlentities($row['channel']));
?>
 <li><?=$row['id']?> | <a href="admin_examples.php?verify=<?=$row['id']?>">verify</a> | <a href="admin_examples.php?remove=<?=$row['id']?>">remove</a> | <a href="admin_examples.php?doedit=<?=$row['id']?>">edit</a> | <?=$row['channel']?> | URL: <a href="<?=$row['url']?>"><?=$row['url']?></a></li>
<?
}
?>
</ol>
<br />
<h3>Pages for removal</h3>
<ol>
<?
$query = mysql_query("SELECT * FROM examples WHERE remove=1 ORDER BY id ASC") or die(mysql_error());

while ($row = mysql_fetch_array($query))
{
    $row['url'] = htmlentities($row['url']);
    $row['channel'] = utf8_encode($row['channel']);
    $row['reason'] = utf8_encode($row['reason']);
?>
 <li><?=$row['id']?> | <a href="admin_examples.php?remove=<?=$row['id']?>">remove</a> | <a href="admin_examples.php?deny=<?=$row['id']?>">deny</a> | <?=$row['channel']?> | URL: <a href="<?=$row['url']?>"><?=$row['url']?></a> | Reason: <?=$row['reason']?></li>
<?
}
?>
</ol>

<?php

if (isset($_GET['doedit'])) {
    $query = mysql_query("SELECT * FROM examples WHERE id=$_GET[doedit]") or die(mysql_error());
    $row = mysql_fetch_array($query);
?>
<h3>Editing statistics page <?=$_GET['doedit']?></h3>
<form action="admin_examples.php?edit=<?= $_GET['doedit']?>" method="post">
<input type="text" name="url" value="<?= $row['url'] ?>" />
<input type="text" name="channel" value="<?= $row['channel'] ?>" />
<input type="text" name="maintainer" value="<?= $row['maintainer'] ?>" />
<input type="text" name="network" value="<?= $row['network'] ?>" />
<input type="submit" />
</form>

<? } ?>

<? } ?>
</body>
</html>