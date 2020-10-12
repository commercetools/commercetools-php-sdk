<?php

$changeLog = file(__DIR__ . '/../CHANGELOG.md');

if ($changeLog == false) {
    exit(1);
}

$readBlocks = 1;

$changes = [];
foreach ($changeLog as $line) {
    if (strpos($line, "# [") === 0) {
        if ($readBlocks > 0) {
            $readBlocks--;
            continue;
        }
        break;
    }
    $changes[] = trim($line);
}

echo trim(implode(PHP_EOL, $changes)) . PHP_EOL;
