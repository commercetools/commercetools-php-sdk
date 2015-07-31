<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

require_once __DIR__ . '/../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';
require_once __DIR__ . '/ApiContext.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    use \Commercetools\Core\ApiContext;

    protected static $coverage;

    /**
     * @BeforeSuite
     */
    public static function setup()
    {
        if (isset($_SERVER['BEHAT_COVERAGE']) && $_SERVER['BEHAT_COVERAGE'] == true) {
            $filter = new \PHP_CodeCoverage_Filter();
            $filter->addDirectoryToBlacklist(__DIR__ . "/../vendor");
            $filter->addDirectoryToBlacklist(__DIR__ . "/../tests");
            $filter->addDirectoryToBlacklist(__DIR__ . "/../features");
            $filter->addDirectoryToWhitelist(__DIR__ . "/../src");

            static::$coverage = new \PHP_CodeCoverage(null, $filter);
            static::$coverage->start('Behat Test');
        }
        date_default_timezone_set('UTC');
    }


    /**
     * @AfterSuite
     */
    public static function teardown()
    {
        if (isset($_SERVER['BEHAT_COVERAGE']) && $_SERVER['BEHAT_COVERAGE'] == true) {
            static::$coverage->stop();

            echo 'Generating code coverage report in Clover XML format ... ';
            $writer = new \PHP_CodeCoverage_Report_Clover();
            $writer->process(static::$coverage, __DIR__ . "/../../build/logs/behat-clover.cov");
            echo 'done' . PHP_EOL;

//            echo 'Generating code coverage report in HTML format ... ';
//            $writer = new PHP_CodeCoverage_Report_HTML();
//            $writer->process(static::$coverage, __DIR__ . "/../../build/behat/coverage");
//            echo 'done' . PHP_EOL;
        }
    }
}
