<?
include("mysql.php");

mysql_query("INSERT INTO examples (channel, url, network, maintainer)
VALUES ('$channel', '$url', '$network', '$maintainer')") or
die(mysql_error());

/*
$host = gethostbyaddr($REMOTE_ADDR);
mail("morten@mbrix.dk", "[pisg] Page addition", "Page to be added:\n\tChannel: $channel\n\tURL: $url\n\tNetwork: $network\n\tMaintainer: $maintainer\n\nUser agent: $HTTP_USER_AGENT\nHost: $host\n\nhttp://pisg.sourceforge.net/admin_examples.php");
*/

header("location: index.php?page=examples_add&done=1");


?>
