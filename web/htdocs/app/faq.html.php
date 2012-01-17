<?php

    $content = file_get_contents('docs/pisg-faq.html');
    preg_match("#<body[^>]*>(.*?)</body[^>]*>.*#siU", $content, $m);
    if (isset($m[1])) { echo $m[1]; }