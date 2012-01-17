<?php
    /*
    $html='docs/index.html';
    $tag='body';
    $dom = new domdocument;
    $dom->loadHTMLFile($html);
    $dom->preserveWhiteSpace = false;
    $content = $dom->getElementsByTagname($tag);
    foreach ($content as $item) {
        echo $item->nodeValue . "\n";
    }
    
    // Warning: DOMDocument::loadHTMLFile(): Unexpected end tag : p in docs/index.html, line: 666
    */

    $content = file_get_contents('docs/index.html');
    //$content = preg_replace("#<body[^>]*>(.*?)</body[^>]*>#si",'$1',$content);
    //echo preg_replace("#.*?<body[^>]*>(.*?)</body[^>]*>.*#si", "$1", $content);
    preg_match("#<body[^>]*>(.*?)</body[^>]*>.*#siU", $content, $m);
    if (isset($m[1])) { echo $m[1]; }

?>