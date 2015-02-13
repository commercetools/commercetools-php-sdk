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

    protected $params = [];

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
        if (substr($context,-1) == 'y') {
            $module = substr($context,0,-1) . 'ies';
        } else {
            $module = $context . 's';
        }
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'UpdateRequest';
        $this->request = new $request('id', 'version');
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
        $expectedResult = json_encode(json_decode($result, true));
        $httpRequest = $this->request->httpRequest();
        $request = $httpRequest->getBody();

        if ($expectedResult != $request) {
            var_dump($expectedResult);
            var_dump($request);
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
        $this->params[] = $this->object;
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
        if (substr($context,-1) == 'y') {
            $module = substr($context,0,-1) . 'ies';
        } else {
            $module = $context . 's';
        }
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'CreateRequest';

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

    /**
     * @Given the localized :locale :field is :value
     */
    public function theLocalizedIs($locale, $field, $value)
    {
        $localizedString = new \Sphere\Core\Model\Common\LocalizedString([$locale => $value]);
        if (
            isset($this->draftValues[$field])
            && $this->draftValues[$field] instanceof \Sphere\Core\Model\Common\LocalizedString
        ) {
            $this->draftValues[$field]->merge($localizedString);
        } else {
            $this->draftValues[$field] = $localizedString;
        }
    }

    /**
     * @Given i have the :field with value :value
     */
    public function iHaveTheWithValue($field, $value)
    {
        $this->params[$field] = $value;
    }

    /**
     * @Given i :action the :field with these values
     */
    public function iTheWithTheseValues($action, $field)
    {
        $method = $action . ucfirst($field);
        call_user_func_array([$this->request, $method], $this->params);
        $this->params = [];
    }

    /**
     * @Given i have a localized :locale :field with value :value
     */
    public function iHaveALocalizedWithValue($locale, $field, $value)
    {
        $localizedString = new \Sphere\Core\Model\Common\LocalizedString([$locale => $value]);
        $this->iHaveTheWithValue($field, $localizedString);
    }

    /**
     * @Given i have a :typeId reference to :id
     */
    public function iHaveAReferenceTo($typeId, $id)
    {
        $reference = '\Sphere\Core\Model\\' . ucfirst($typeId) . '\\' . ucfirst($typeId) . 'Reference';
        $reference = new $reference($id);
        $this->iHaveTheWithValue($typeId, $reference);
    }

    /**
     * @Given i have the date :dateTime
     */
    public function iHaveTheDate($dateTime)
    {
        $dateTime = new DateTime($dateTime);
        $this->params[] = $dateTime;
    }
}
