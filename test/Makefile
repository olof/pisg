# pisg test suite

CFG=$(wildcard *.cfg)
HTML=$(subst .cfg,.html,$(CFG))

PISG=../pisg/pisg
#PISG=pisg

all: $(HTML)

%.html: %.cfg
	$(PISG) -s -co $<

clean:
	rm -f $(HTML) *.html.old 04.log ??.cache/*
	test ! -d 03.cache || rmdir 03.cache
	test ! -d 04.cache || rmdir 04.cache

cachetest: all
	for i in *.html ; do mv $$i $$i.old ; done
	$(MAKE) all

# special rules

03.html: 03.cache
04.log: 03_*.log
	cat $^ > $@
04.html: 04.log 04.cache
%.cache:
	mkdir $@

# vim:noexpandtab:
