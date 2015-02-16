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

    protected function getModuleName($context)
    {
        if (substr($context,-1) == 'y') {
            $module = substr($context, 0, -1) . 'ies';
        } elseif (substr($context,-1) == 's') {
            $module = $context;
        } else {
            $module = $context . 's';
        }

        return $module;
    }


    /**
     * @Given i want to update a :context identified by :id and at version :version
     */
    public function iWantToUpdateAIdentifiedByAndAtVersion($context, $id, $version)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'UpdateRequest';
        $this->request = new $request($id, $version);
    }

    /**
     * @Then the path should be :path
     */
    public function thePathShouldBe($expectedPath)
    {
        $httpRequest = $this->request->httpRequest();

        if ($httpRequest->getPath() !== $expectedPath) {
            var_dump($expectedPath);
            var_dump($httpRequest->getPath());
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
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'CreateRequest';

        $reflection = new ReflectionClass($this->draftClass);
        $draft = $reflection->newInstanceArgs($this->draftValues);

        $this->request = new $request($draft);
    }

    /**
     * @Then the method should be :method
     */
    public function theMethodShouldBe($expectedMethod)
    {
        $httpRequest = $this->request->httpRequest();

        if ($httpRequest->getHttpMethod() !== strtolower($expectedMethod)) {
            var_dump($expectedMethod);
            var_dump($httpRequest->getHttpMethod());
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

    /**
     * @Given i want to delete a :context identified by :id and at version :version
     */
    public function iWantToDeleteAIdentifiedByAndAtVersion($context, $id, $version)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'DeleteByIdRequest';
        $this->request = new $request($id, $version);
    }

    /**
     * @Given i want to create a :context token identified by :id and at version :version with :ttl minutes lifetime
     */
    public function iWantToCreateATokenIdentifiedByAndAtVersionWithMinutesLifetime($context, $id, $version, $ttl)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'EmailTokenRequest';
        $this->request = new $request($id, $version, $ttl);
    }

    /**
     * @Given i want to confirm a :context token identified by :id and at version :version with :token value
     */
    public function iWantToConfirmATokenIdentifiedByAndAtVersionWithValue($context, $id, $version, $token)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'EmailConfirmRequest';
        $this->request = new $request($id, $version, $token);
    }

    /**
     * @Given i want to fetch a :context identified by :id
     */
    public function iWantToFetchAIdentifiedBy($context, $id)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'FetchByIdRequest';
        $this->request = new $request($id);
    }

    /**
     * @Given i want to query :context
     */
    public function iWantToQuery($context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'QueryRequest';
        $this->request = new $request();
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
     * @Given i want to create a password token for :context identified by :email
     */
    public function iWantToCreateAPasswordTokenForIdentifiedBy($context, $email)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'PasswordTokenRequest';
        $this->request = new $request($email);
    }

    /**
     * @Given i want to fetch a :context identified by a password token with value :tokenValue
     */
    public function iWantToFetchAIdentifiedByAPasswordTokenWithValue($context, $tokenValue)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'FetchByTokenRequest';
        $this->request = new $request($tokenValue);
    }

    /**
     * @Given i :action the :context password
     */
    public function iResetThePassword($action, $context)
    {
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' .
            ucfirst($context) . 'Password' . ucfirst($action) . 'Request';
        $reflection = new ReflectionClass($request);
        $this->request = $reflection->newInstanceArgs($this->params);
    }
}
