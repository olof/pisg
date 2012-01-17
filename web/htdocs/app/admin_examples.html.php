<?php

session_start();
if (!isset($_SESSION['authed']) || !$_SESSION['authed']) {
    header('Location: admin');
    die();
}

if (isset($_GET['verify'])) {
    $db->query('UPDATE examples SET shown=1 WHERE id='.$_GET['verify']);
} else if (isset($_GET['remove'])) {
    $db->query('DELETE FROM examples WHERE id='.$_GET['remove']);
} else if (isset($_GET['deny'])) {
    $db->query('UPDATE examples SET remove=0 WHERE id='.$_GET['deny']);
} else if (isset($_GET['edit'])) {
    $db->query("UPDATE examples SET channel='".$_POST['channel']."', maintainer='".$_POST['maintainer']."', network='".$_POST['network']."', url='".$_POST['url']."' WHERE id=".$_GET['edit']);
}
?>

<h3>Newly added pages, but not verified yet:</h3>
<ol>
<?php
$query = $db->query('SELECT * FROM examples WHERE shown=0 ORDER BY id ASC') or die($db->error());
foreach ($query as $row)
{
    $row['url'] = htmlentities($row['url']);
    $row['channel'] = utf8_encode(htmlentities($row['channel']));
?>
 <li><?=$row['id']?> | <a href="admin_examples.php?verify=<?=$row['id']?>">verify</a> | <a href="admin_examples?remove=<?=$row['id']?>">remove</a> | <a href="admin_examples?doedit=<?=$row['id']?>">edit</a> | <?=$row['channel']?> | URL: <a href="<?=$row['url']?>"><?=$row['url']?></a></li>
<? } // end while ?>
</ol>
<br />
<h3>Pages for removal</h3>
<ol>
<?
$query = $db->query("SELECT * FROM examples WHERE remove=1 ORDER BY id ASC") or die($db->error());

foreach ($query as $row)
{
    $row['url'] = htmlentities($row['url']);
    $row['channel'] = utf8_encode($row['channel']);
    $row['reason'] = utf8_encode($row['reason']);
?>
 <li><?=$row['id']?> | <a href="admin_examples?remove=<?=$row['id']?>">remove</a> | <a href="admin_examples?deny=<?=$row['id']?>">deny</a> | <?=$row['channel']?> | URL: <a href="<?=$row['url']?>"><?=$row['url']?></a> | Reason: <?=$row['reason']?></li>
<?php } //end while ?>
</ol>

<?php
if (isset($_GET['doedit'])) {
    $query = $db->query('SELECT * FROM examples WHERE id='.$_GET['doedit']);
    $row = $db->fetch($query);
?>
<h3>Editing statistics page <?=$_GET['doedit']?></h3>
<form action="admin_examples.php?edit=<?= $_GET['doedit']?>" method="post">
<input type="text" name="url" value="<?= $row['url'] ?>" />
<input type="text" name="channel" value="<?= $row['channel'] ?>" />
<input type="text" name="maintainer" value="<?= $row['maintainer'] ?>" />
<input type="text" name="network" value="<?= $row['network'] ?>" />
<input type="submit" />
</form>

<?php } //end doedit ?>