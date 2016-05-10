#!/usr/bin/env php
<?php

$iterator = new DirectoryIterator('./docs');

$dirs = [];
foreach ($iterator as $fileInfo) {
    if (!$fileInfo->isDot() && $fileInfo->isDir()) {
        $dirs[] = $fileInfo->getFilename();
    }
}

usort($dirs, function ($a, $b) {
    if ($a == 'master') {
        return -1;
    }
    if ($b == 'master') {
        return 1;
    }
    $aParts = explode('-', $a);
    $bParts = explode('-', $b);

    $aVersion = $aParts[0];
    $bVersion = $bParts[0];

    $aAddition = isset($aParts[1]) ? $aParts[1] : '';
    $bAddition = isset($bParts[1]) ? $bParts[1] : '';
    if ($aVersion == $bVersion) {
        if (empty($aAddition) || $bAddition == 'M0') {
            return -1;
        }
        if (empty($bAddition) || $aAddition == 'M0') {
            return 1;
        }
        return strnatcasecmp($aAddition, $bAddition) * -1;
    }
    return strnatcasecmp($aVersion, $bVersion) * -1;
});

$indexStr = <<<HTML
<html>
<body>
HTML;

foreach ($dirs as $dir) {
    $indexStr.='<a href="./' . $dir . '/index.html">' . $dir . '</a><br/>' . PHP_EOL;
}

$indexStr.=<<<HTML
</body>
</html>
HTML;

file_put_contents('./docs/index.html', $indexStr);
