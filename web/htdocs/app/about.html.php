<h3>What exactly is pisg?</h3>

<p>pisg is called a "logfile analyzer" - it takes an IRC logfile,
analyzes it, and generates some statistics from it.</p>
</p>A lot of people find these stats amusing. That's really the main reason
of making the stats.</p>

<p>What you need to do exactly to generate these stats, is to:</p>
<ul>
    <li>Use a IRC client or bot to generate a logfile</li>
    <li>Make pisg run through your logfile</li>
    <li>Upload the HTML file to a website so everyone can see it (see <a
        href="examples">examples here</a>)</li>
</ul>

<p>It's that simple :)</p>

<p>Of course, you can also automate all these things with a scheduling
program like crontab, so you don't have to manually update the stats.</p>

<h3>Who is developing pisg?</h3>
<p>pisg was created by <b>Morten Brix Pedersen (mbp)</b> as a small project which
helped a bit on the motivation to learn Perl.</p>
<p>Since then, a lot of people has contributed with their ideas and code, see the CREDITS file in the source for the list of people
who has contributed.</p>
<p>Patches are highly appreciated, mail your ideas to the pisg <a href="list">mailing list</a>!</p>


<h3>Adding support for new logfile formats</h3>
<p>If you have a fair amount of Perl knowledge, it is not very hard to add
support for a new logfile format (clients, bots, loggers).</p>
<p>If you don't have any Perl knowledge, you can try sending a sample logfile
to the <a href="list">mailing list</a> and see if anyone is kind enough to write one for you.</p>

<h3>Translations</h3>
<p>Pisg is translated into about every language that you can think of,
including:</p>
<p>English, German, Norweigan, Portugese, Danish, French, Spanish, Polish,
Dutch, Swedish, Finnish, Slovenian, Hungarian, Estonian, Italian,
Catalan, Turkish, Romanian, Czech, Icelandic, Russian, Hebrew,
Bulgarian, Greek, Flemish, Albanian, Serbian and Slovak.</p>
<p>You're very welcome to translate pisg into your own language, it's not very hard.</p>

<h3>Other IRC statistics generators</h3>
<ul>
    <li>gruftistats: - Open source, havn't been updated for a year though</li>
    <li>IRCStats: - Used to be closed source, now open source, written in C, for Linux and other *nix'es</li>
    <li>mIRCStats: - Graphical client for Windows</li>
    <li>irssistats: - Dedicated parser for the irssi logformat, written in C.</li>
</ul>