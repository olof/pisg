doc:
	$(MAKE) -C ../pisg/docs
	cp -p ../pisg/docs/pisg-doc.html htdocs/docs/index.html
	cp -p ../pisg/docs/pisg-faq.html ../pisg/docs/pisg-formats.html htdocs/docs
	cp -p ../pisg/docs/Changelog htdocs/docs/changelog

rsync: doc
	rsync -Pav --exclude=CVS --exclude='*.swp' \
		htdocs/ hm2k@web.sourceforge.net:/home/project-web/pisg/htdocs/

clean:
	rm -f htdocs/docs/*.html
