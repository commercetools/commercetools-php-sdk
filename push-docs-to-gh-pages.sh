#!/bin/bash

# docs get auto-committed only in our own repo (no forks), only in one of the build environments (to avoid duplicate pushes),
# not on pull requests and only for builds in the master (gitflow = releases) branch and also for tags.
#
# with helpful help from http://benlimmer.com/2013/12/26/automatically-publish-javadoc-to-gh-pages-with-travis-ci/
# and https://github.com/mapnik/node-mapnik/blob/master/scripts/validate_tag.sh

# to be called as "after_success: - ./push-docs-to-gh-pages.sh" in .travis.yml

if [ "$TRAVIS_REPO_SLUG" == "sphereio/sphere-php-sdk" ] && [ $(phpenv version-name) = "5.4" ] && [ "$TRAVIS_PULL_REQUEST" == "false" ] && ( [ "$TRAVIS_BRANCH" == "master" ] || [ "$TRAVIS_BRANCH" == `git describe --tags --always HEAD` ] ); then

  echo -e "Publishing documentation to gh-pages branch ...\n"

  cp -R build/docs $HOME/phpdoc-current

  cd $HOME
  git config --global user.email "automation@commercetools.de"
  git config --global user.name "travis CI"
  git clone --quiet --branch=gh-pages https://${GH_TOKEN}@github.com/sphereio/sphere-php-sdk gh-pages > /dev/null

  cd gh-pages
  mkdir -p ./docs/$TRAVIS_BRANCH
  git rm -rf ./docs/$TRAVIS_BRANCH
  cp -Rf $HOME/phpdoc-current/* ./docs/$TRAVIS_BRANCH/
  git add -f .
  # for testing the big conditional we do "git status" only for now.
  git status
  git commit -m "Auto-pushed phpdoc for $TRAVIS_BRANCH on successful travis build $TRAVIS_BUILD_NUMBER to gh-pages"
  git push -fq origin gh-pages > /dev/null

  echo -e "Published Documentation to gh-pages.\n"

fi
