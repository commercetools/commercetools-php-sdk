#!/usr/bin/env php
<?php

$iterator = new DirectoryIterator('./docs');

$indexStr = <<<HTML
<html>
<body>
HTML;

foreach ($iterator as $fileInfo) {
    if (!$fileInfo->isDot() && $fileInfo->isDir()) {
        $indexStr.='<a href="./' . $fileInfo->getFilename() . '/index.html">' . $fileInfo->getFilename() . '</a><br/>' . PHP_EOL;
    }
}

$indexStr.=<<<HTML
</body>
</html>
HTML;

file_put_contents('./docs/index.html', $indexStr);
