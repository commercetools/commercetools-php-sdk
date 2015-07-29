#!/usr/bin/env node

'use strict';

var fs = require('fs');
var cl = require('conventional-changelog');

var changelogFile = '../CHANGELOG.md';

var config = {
    file: changelogFile,
    repository: require('./package.json').homepage,
    version: require('./package.json').version
};

cl(config, function(err, log) {
    if (err) {
        console.error('Failed to generate changelog: ' + err);
        return;
    }

    fs.writeFileSync(changelogFile, log);
});
