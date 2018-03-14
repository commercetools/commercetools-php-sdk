#!/bin/bash

# docs get auto-committed only in our own repo (no forks), only in one of the build environments (to avoid duplicate pushes),
# not on pull requests and only for builds in the master (gitflow = releases) branch and also for tags.
#
# with helpful help from http://benlimmer.com/2013/12/26/automatically-publish-javadoc-to-gh-pages-with-travis-ci/
# and https://github.com/mapnik/node-mapnik/blob/master/scripts/validate_tag.sh

# to be called as "after_success: - ./push-docs-to-gh-pages.sh" in .travis.yml

export SDK_VERSION=$TRAVIS_BRANCH;

echo -e "Publishing documentation to gh-pages branch ...\n"

cp -R build/docs $HOME/phpdoc-current
cp tools/docs_index.php $HOME/docs_index.php

cd $HOME
git config --global user.email "automation@commercetools.de"
git config --global user.name "travis CI"
git clone --quiet --branch=gh-pages git@github.com:${TRAVIS_REPO_SLUG}.git gh-pages > /dev/null 2>&1

cd gh-pages
git rm -rf ./docs/$TRAVIS_BRANCH
mkdir -p ./docs/$TRAVIS_BRANCH
cp -Rf $HOME/phpdoc-current/* ./docs/$TRAVIS_BRANCH/
php $HOME/docs_index.php
git add -f .

# for testing the big conditional we do "git status" only for now.
git status
git commit -m "Auto-pushed phpdoc for $TRAVIS_BRANCH on successful travis build $TRAVIS_BUILD_NUMBER to gh-pages"
git push -fq origin gh-pages > /dev/null 2>&1

echo -e "Published Documentation to gh-pages.\n"
