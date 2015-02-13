<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var \Sphere\Core\Request\AbstractApiRequest
     */
    protected $request;

    protected $object;

    protected $draftClass;

    protected $draftValues = [];

    protected static $coverage;

    /**
     * @BeforeSuite
     */
    public static function setup()
    {
        if (isset($_SERVER['BEHAT_COVERAGE']) && $_SERVER['BEHAT_COVERAGE'] == true) {
            $filter = new PHP_CodeCoverage_Filter();
            $filter->addDirectoryToBlacklist(__DIR__ . "/../vendor");
            $filter->addDirectoryToBlacklist(__DIR__ . "/../tests");
            $filter->addDirectoryToBlacklist(__DIR__ . "/../features");
            $filter->addDirectoryToWhitelist(__DIR__ . "/../src");

            static::$coverage = new PHP_CodeCoverage(null, $filter);
            static::$coverage->start('Behat Test');
        }
    }


    /**
     * @AfterSuite
     */
    public static function teardown()
    {
        if (isset($_SERVER['BEHAT_COVERAGE']) && $_SERVER['BEHAT_COVERAGE'] == true) {
            static::$coverage->stop();

            echo 'Generating code coverage report in Clover XML format ... ';
            $writer = new PHP_CodeCoverage_Report_Clover();
            $writer->process(static::$coverage, __DIR__ . "/../../build/behat/behat-clover.xml");
            echo 'done' . PHP_EOL;

            echo 'Generating code coverage report in HTML format ... ';
            $writer = new PHP_CodeCoverage_Report_HTML();
            $writer->process(static::$coverage, __DIR__ . "/../../build/behat/coverage");
            echo 'done' . PHP_EOL;
        }
    }

    /**
     * @Given i want to update a :context
     */
    public function iWantToUpdateA($context)
    {
        $request = '\Sphere\Core\Request\\' . ucfirst($context) . '\\' . ucfirst($context) . 'UpdateRequest';
        $this->request = new $request('id', 'version');
    }

    /**
     * @When i :action the :field to :value
     */
    public function iTheTo($action, $field, $value)
    {
        $values = explode(' ', $value);
        $method = $action . ucfirst($field);

        call_user_func_array([$this->request, $method], $values);
    }

    /**
     * @Then the path should be :arg1
     */
    public function thePathShouldBe($arg1)
    {
        $httpRequest = $this->request->httpRequest();

        if ($httpRequest->getPath() !== $arg1) {
            throw new Exception('Path wrong');
        };
    }

    /**
     * @Then the request should be
     */
    public function theRequestShouldBe(PyStringNode $result)
    {
        $result = json_encode(json_decode($result, true));
        $httpRequest = $this->request->httpRequest();
        $request = $httpRequest->getBody();

        if ($result != $request) {
            throw new Exception('Json differs');
        }
    }

    /**
     * @When i have the :context object :className
     */
    public function iHaveTheObject($context, $className)
    {
        $objectClass = '\Sphere\Core\Model\\' . ucfirst($context) . '\\' . ucfirst($className);
        $this->object = new $objectClass();
    }

    /**
     * @When set the objects :field to :value
     */
    public function setTheObjectsTo($field, $value)
    {
        $method = 'set' . ucfirst($field);
        $this->object->$method($value);
    }

    /**
     * @When i :action the :field object to :request
     */
    public function iTheObjectTo($action, $field, $request)
    {
        $method = $action . ucfirst($field);
        $this->request->$method($this->object);
    }

    /**
     * @Given i have a :context draft
     */
    public function iHaveADraft($context)
    {
        $this->draftClass = '\Sphere\Core\Model\\' . ucfirst($context) . '\\' . ucfirst($context) . 'Draft';
    }

    /**
     * @Given the :field is :value
     */
    public function theIs($field, $value)
    {
        $this->draftValues[$field] = $value;
    }

    /**
     * @Given i want to create a :context
     */
    public function iWantToCreateA($context)
    {
        $request = '\Sphere\Core\Request\\' . ucfirst($context) . '\\' . ucfirst($context) . 'CreateRequest';

        $reflection = new ReflectionClass($this->draftClass);
        $draft = $reflection->newInstanceArgs($this->draftValues);

        $this->request = new $request($draft);
    }

    /**
     * @Then the method should be :method
     */
    public function theMethodShouldBe($method)
    {
        $httpRequest = $this->request->httpRequest();

        if ($httpRequest->getHttpMethod() !== strtolower($method)) {
            throw new Exception('Wrong http method');
        };
    }
}
