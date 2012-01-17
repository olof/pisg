<?php

session_start();
if (!isset($_SESSION['authed']) || !$_SESSION['authed']) {
    $pw_salt='pisg+admin,';
    $pw_hash='a1764831e62d52191009207dadc0bc8e';
    $_SESSION['authed'] = ((isset($_REQUEST['password']) && md5($pw_salt.$_REQUEST['password']) == $pw_hash));
}

if (!$_SESSION['authed']) { ?>
    <p>Please type in administrator password...</p>
    <form method="post" action="">
        <input type="password" name="password" size="40" />
        <input type="submit" value="Submit" />
    </form>
<?php } else { ?>
    <ul>
        <li><a href="admin_examples">Admin Examples</a></li>
        <li><a href="admin_news">Admin News</a></li>
    </ul>
<?php } ?>