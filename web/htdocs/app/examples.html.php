<?php
    $query = $db->query('SELECT * FROM examples WHERE shown=1 ORDER by ID DESC');
?>
<h3>Example pages running pisg</h3>

<p>This is a list of example sites running pisg (Beware, probably many dead
links).</p>

<p>If you use pisg and have a permanent URL for it, then I encourage you to <a
href="examples_add">add your page</a> - just so I can see how
many uses it, and so the link can be added for presentation here!</p>

<p>If you find a dead link, or if you believe a page should be removed from
here, then click the 'remove' link which is aligned to the right.</p>

<table id="examples" cellspacing="0" cellpadding="2" border="0">
<?php
foreach ($query as $row)
{
    $class = ($row['id'] % 2 == 1)?'example_odd':'example_even';
    $url = htmlentities($row['url']);
    $channel = htmlentities($row['channel']);
    $network = htmlentities($row['network']);
    $maintainer = htmlentities($row['maintainer']);
    ?>
    <tr><td class="<?=$class?>" align="left">
    <b><a href="<?=$url?>"><?=$channel?></a></b> @ <?=$network?> by <?=$maintainer?></td>
    <td class="<?=$class?>" align="right"><a href="examples_remove?id=<?=$row['id']?>">Remove</a></td>
    </tr>
    <?php
}
?>
</table>