<? include("mysql.php"); ?>
<h3>Example pages running pisg</h3>
This is a list of example sites running pisg (Beware, probably many dead
links).
<br />
<br />
If you use pisg and have a permanent URL for it, then I encourage you to <a
href="<?=$_SERVER['PHP_SELF']?>?page=examples_add">add your page</a> - just so I can see how
many uses it, and so the link can be added for presentation here!<br />
<br />
If you find a dead link, or if you believe a page should be removed from
here, then click the 'remove' link which is aligned to the right.<br />
<br />

<table cellspacing="0" cellpadding="2" border="0"
style="border-top: 1px solid black; margin-left: auto; margin-right: auto">
<? 
$query = mysql_query("SELECT * FROM examples WHERE shown=1 ORDER by ID DESC") or
die(mysql_error());

$i = 1;
while ($row = mysql_fetch_array($query))
{
    if ($i % 2 == 1) {
        $bgcolor = "#EFF7FE";
    } else {
        $bgcolor = "#FFFFFF";
    }
    $row['url'] = htmlentities($row['url']);
    $row['channel'] = htmlentities($row['channel']);
    $row['maintainer'] = htmlentities($row['maintainer']);
    print "<tr>\n";
    print "<td style=\"border-bottom: 1px solid black; background-color: $bgcolor\" align=\"left\"><b><a href=\"$row[url]\">$row[channel]</a></b> @ $row[network] by $row[maintainer]</td>\n";
    print "<td style=\"border-bottom: 1px solid black; font-size: 10px; background-color: $bgcolor\" align=\"right\"><a href=\"index.php?page=examples_remove&amp;id=$row[id]\">Remove</a></td>\n";
    print "</tr>\n";
    $i++;
}
?>
   </table>
