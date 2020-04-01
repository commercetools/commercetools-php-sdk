#!/bin/sh
export PATH="/usr/local/bin:$PATH"
php vendor/bin/phpunit --configuration phpunit.xml.dist --testsuite=unit
if [[ $? -ne 0 ]]; then
    exit 1
fi

PROJECT=`php -r "echo dirname(dirname(dirname(realpath('$0'))));"`
STAGED_FILES_CMD=`git diff --cached --name-only --diff-filter=ACMR HEAD | grep \\\\.php`

# Determine if a file list is passed
if [ "$#" -eq 1 ]
then
    oIFS=$IFS
    IFS='
    '
    SFILES="$1"
    IFS=$oIFS
fi
SFILES=${SFILES:-$STAGED_FILES_CMD}

echo "Checking PHP Lint..."
for FILE in $SFILES
do
    php -l -d display_errors=0 $PROJECT/$FILE
    if [ $? != 0 ]
    then
        echo "Fix the error before commit."
        exit 1
    fi
    FILES="$FILES $PROJECT/$FILE"
done

if [ "$FILES" != "" ]
then
    echo "Running Code Sniffer..."
    ./vendor/bin/ecs check $FILES
    if [ $? != 0 ]
    then
        echo "Coding standards errors have been detected. Running phpcbf..."
        ./vendor/bin/ecs check --fix $FILES
        git add $FILES
        echo "Running Code Sniffer again..."
        ./vendor/bin/ecs check $FILES
        if [ $? != 0 ]
        then
            echo "Errors found not fixable automatically"
            exit 1
        fi
    fi
fi

exit $?
