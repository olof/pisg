# Makefile to create pisg stats in all available languages
# report.txt will contain a report about untranslated strings
#
# Copyright (C) 2005 Christoph Berg, GNU GPL v2 (or later)

DIR=../../pisg
LANGTXT=$(DIR)/lang.txt

all: lang-test.out report.txt

lang-test.conf: lang-test.pl $(LANGTXT)
	./lang-test.pl $(LANGTXT) > $@

lang-test.out: lang-test.conf
	$(DIR)/pisg -co $< | tee $@

report.txt: missing-translations.pl $(LANGTXT)
	./missing-translations.pl $(LANGTXT) | tee $@

clean:
	rm -f lang*.html lang*.txt lang-test.conf lang-test.out report.txt .htaccess* *~
