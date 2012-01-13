#!/usr/bin/perl -w
# Copyright (C) 2005 Christoph Berg, GNU GPL v2 (or later)

use Text::Iconv;

print <<EOT;
<set Charset="UTF-8">
<set LogCharset="latin1">
<set Format="irssi">
<set Maintainer="Myon">
<set Network="IRCnet">
<set PicLocation="../../pisg/gfx">
<set UserPics="3">
<set DailyActivity="5">
<set LangFile="$ARGV[0]">

EOT

open HT, ">.htaccess" or die ".htaccess: $!";
my %charset_seen;
print HT "AddCharset utf-8 .utf-8\n";

while(<>) {
	if(/<lang name="(.*?)"/) {
		my $lang = $1;
print <<EOT;
<channel="#lang_$lang">
        LogFile = "log"
        OutputFile = "lang_$lang.html"
        Lang = "$lang"
</channel>

EOT

		my $charset = "us-ascii";
		if(/charset="(.*)"/) {
			$charset = lc $1;
			$iconv = Text::Iconv->new($charset, "utf-8");
			open C, ">lang_$lang.utf-8.txt";
			unless($charset_seen{$charset}) {
				print HT "AddCharset $charset .$charset\n";
				$charset_seen{$charset} = 1;
			}
		} else {
			undef $iconv;
			warn "no charset for $lang";
		}
		open L, ">lang_$lang.$charset.txt";
		$l = 1;
	}
	print L if $l;
	print C $iconv->convert($_) if $l and $iconv;
	$l = 0 if /^<\/lang/;
}

close HT;
