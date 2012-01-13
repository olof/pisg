#!/usr/bin/perl -w
# Copyright (C) 2005 Christoph Berg, GNU GPL v2 (or later)

my %T;
my %translator;

while(<>) {
	if(/^# \((.*)\) (.*) - (.*)/) {
		$translator{$1} = $3;
		$language{$1} = $2;
		next;
	}
	last if /<lang/;
}

while(<>) {
	chomp;
	next if /^(#|$)/;
	last if /<\/lang/;
	warn "parse error: $_" unless /^(.*) = (.*)/;
	$T{$1} = $2;
}

print ((scalar keys %T). " strings in English\n");

my $lang;
while(<>) {
	chomp;
	if(/<lang name="(.*?)" (charset="(.*?)")?/) {
		$lang = $1;
		$charset = $3 || "";
		print "Language $lang ($language{$lang}, $charset, $translator{$lang})...\n";
		$lang_count++;
		next;
	}
	next unless $lang;
	next if /^(#|$)/;
	if(/<\/lang/) {
		foreach (keys %T) {
			unless($L{$_}) {
				print "missing: $_ = $T{$_}\n";
				$miss++;
				$miss{$lang}++;
			}
			$string++;
		}
		undef %L;
		undef $lang;
		next;
	}
	warn "parse error: $_" unless /^(.*) = (.*)/;
	print "duplicate translation of $1 in $lang: $2\n" if $L{$1};
	$L{$1} = $2;
}

print "$lang_count non-English translations, $string existing strings, $miss strings missing in ".(scalar keys %miss) ." languages.\n";
