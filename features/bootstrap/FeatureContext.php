<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

require_once __DIR__ . '/../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

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

    protected $requestParams = [];
    protected $objectParams = [];

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
            $writer->process(static::$coverage, __DIR__ . "/../../build/logs/behat-clover.cov");
            echo 'done' . PHP_EOL;

//            echo 'Generating code coverage report in HTML format ... ';
//            $writer = new PHP_CodeCoverage_Report_HTML();
//            $writer->process(static::$coverage, __DIR__ . "/../../build/behat/coverage");
//            echo 'done' . PHP_EOL;
        }
    }

    protected function getModuleName($context)
    {
        if (substr($context, -1) == 'y') {
            $module = substr($context, 0, -1) . 'ies';
        } elseif (substr($context, -1) == 's') {
            $module = $context;
        } else {
            $module = $context . 's';
        }

        return $module;
    }

    protected function createRequestInstance($className)
    {
        $reflection = new ReflectionClass($className);
        $this->request = $reflection->newInstanceArgs($this->requestParams);
        $this->requestParams = [];
    }

    /**
     * @Given i want to update a :context
     */
    public function iWantToUpdateAIdentifiedByAndAtVersion($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'UpdateRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given i want to create a :context
     */
    public function iWantToCreateA($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'CreateRequest';

        $this->createRequestInstance($request);
    }

    /**
     * @Then the path should be :path
     */
    public function thePathShouldBe($expectedPath)
    {
        $httpRequest = $this->request->httpRequest();

        assertSame($expectedPath, $httpRequest->getPath());
    }

    /**
     * @Then the request should be
     */
    public function theRequestShouldBe(PyStringNode $result)
    {
        $expectedResult = (string)$result;
        $httpRequest = $this->request->httpRequest();
        $request = $httpRequest->getBody();

        assertJsonStringEqualsJsonString($expectedResult, $request);
    }

    /**
     * @Then the method should be :method
     */
    public function theMethodShouldBe($expectedMethod)
    {
        $httpRequest = $this->request->httpRequest();

        assertSame(strtolower($expectedMethod), $httpRequest->getHttpMethod());
    }

    /**
     * @When i have the :context object :className
     */
    public function iHaveTheObject($context, $className)
    {
        $objectClass = '\Sphere\Core\Model\\' . ucfirst($context) . '\\' . ucfirst($className);

        $reflection = new ReflectionClass($objectClass);
        $this->object = $reflection->newInstanceArgs($this->objectParams);
        $this->requestParams[] = $this->object;
        $this->objectParams = [];
    }

    /**
     * @Given i have a :context draft
     */
    public function iHaveADraft($context)
    {
        $this->iHaveTheObject($context, $context . 'Draft');
    }

    /**
     * @Given the localized :locale :field is :value
     */
    public function theLocalizedIs($locale, $field, $value)
    {
        $localizedString = new \Sphere\Core\Model\Common\LocalizedString([$locale => $value]);
        if (
            isset($this->objectParams[$field]) &&
            $this->objectParams[$field] instanceof \Sphere\Core\Model\Common\LocalizedString
        ) {
            $this->object->merge($localizedString);
        } else {
            $this->object = $localizedString;
            $this->objectParams[$field] = $this->object;
        }
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
     * @Given i have the :field with value :value
     */
    public function iHaveTheWithValue($field, $value)
    {
        $this->requestParams[$field] = $value;
    }

    /**
     * @Given i have a :object :field with value :value
     */
    public function iHaveTheWithValue2($object, $field, $value)
    {
        $this->objectParams[$field] = $value;
    }

    /**
     * @Given i :action the :field with these values
     */
    public function iTheWithTheseValues($action, $field)
    {
        $method = $action . ucfirst($field);
        call_user_func_array([$this->request, $method], $this->requestParams);
        $this->requestParams = [];
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
        $this->requestParams[] = $dateTime;
    }

    /**
     * @Given i want to delete a :context
     */
    public function iWantToDeleteA($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'DeleteByIdRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given i want to create a :context token
     */
    public function iWantToCreateAToken($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'EmailTokenRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given i want to confirm a :context token
     */
    public function iWantToConfirmAToken($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'EmailConfirmRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given i want to fetch a :context
     */
    public function iWantToFetchA($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'FetchByIdRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given i want to query :context
     */
    public function iWantToQuery($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'QueryRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given filter them with criteria :where
     */
    public function filterThemWithCriteriaName($where)
    {
        /**
         * @var \Sphere\Core\Request\AbstractQueryRequest $request
         */
        $this->request->where($where);
    }

    /**
     * @Given limit the result to :limit
     */
    public function limitTheResultTo($limit)
    {
        $this->request->limit($limit);
    }

    /**
     * @Given offset the result with :offset
     */
    public function offsetTheResultWith($offset)
    {
        $this->request->offset($offset);
    }

    /**
     * @Given sort them by :sort
     */
    public function sortThemBy($sort)
    {
        $this->request->sort($sort);
    }

    /**
     * @Given i want to create a password token for :context
     */
    public function iWantToCreateAPasswordTokenFor($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'PasswordTokenRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given i want to fetch a :context by token
     */
    public function iWantToFetchAByToken($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'FetchByTokenRequest';
        $this->createRequestInstance($request);
    }

    /**
     * @Given i :action the :context password
     */
    public function iResetThePassword($action, $context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' .
            ucfirst($context) . 'Password' . ucfirst($action) . 'Request';
        $this->createRequestInstance($request);
    }

    /**
     * @Given query by customers id :customerId
     */
    public function queryByCustomersId($customerId)
    {
        $this->request->byCustomerId($customerId);
    }
}
