<?php
$d = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("c:/bbc_project/resources/views"));
foreach ($d as $f) {
    if ($f->getExtension() == "php") {
        $c = file_get_contents($f);
        $nc = str_replace(" onclick=\"document.body.classList.add('public-skeleton-loading');\"", "", $c);
        $nc = str_replace("document.body.classList.add('public-skeleton-loading');", "", $nc);
        if ($c !== $nc) {
            file_put_contents($f, $nc);
        }
    }
}
echo "Done.";
