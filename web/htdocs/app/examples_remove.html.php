<h3>Remove example</h3>

<?php

$id=isset($_REQUEST['id'])?htmlspecialchars($_REQUEST['id']):'';
    
if (isset($_POST['remove_description'])) {

    $remove_description=$db->quote($_POST['remove_description']);
    $email=isset($_POST['email'])?$db->quote($_POST['email']):'';

    $row = $db->query("SELECT channel, url, network, maintainer FROM examples WHERE id='$id'")->fetch();

    //$db->exec("UPDATE examples SET remove=1, reason=$remove_description WHERE ID=$id");

    include'sendmail.php';
    $mail=new Sendmail($config['smtp']['user'],$config['smtp']['pass'],$config['smtp']['host'],$config['smtp']['port']);
    $to='pisg-commits@lists.sourceforge.net';
    $subject='Example removal';
    $message="Example to be removed:\n
        ID: $id\n
        Channel: ".$row['channel']."\n
        URL: ".$row['url']."\n
        Reason: $remove_description";
    $mail->send($to, $subject, $message, $email);

?>

<p>Thank you for the notice of removal, your submission will be reviewed, and
the link will be removed if the reason is found appropriate.</p>

<?php } else { ?>

<form method="POST" action="examples_remove">
    <p>Please state briefly why the page should be removed.</p>
    <input type="text" name="remove_description" size="50" />
    <p>Please enter your email address:</p>
    <input type="text" name="email" size="50" />
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="submit" />
</form>

<?php } ?>