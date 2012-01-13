doc:
	$(MAKE) -C ../pisg/docs
	cp -p ../pisg/docs/pisg-doc.html htdocs/docs/index.html
	cp -p ../pisg/docs/pisg-faq.html ../pisg/docs/pisg-formats.html htdocs/docs

rsync: doc
	rsync -Pav --exclude=CVS --exclude='*.swp' \
		htdocs/ df7cb,pisg@web.sourceforge.net:/home/groups/p/pi/pisg/htdocs/

clean:
	rm -f htdocs/docs/*.html
