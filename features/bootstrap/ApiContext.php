<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Commercetools\Core\Model\Common\AbstractJsonDeserializeObject;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Product\Search\Filter;
use Commercetools\Core\Request\Products\ProductProjectionSearchRequest;

trait ApiContext
{
    protected $request;

    protected $objects = [];

    protected $context;

    protected $actions = [];

    protected function getModuleName($context)
    {
        if (substr($context, -1) == 's' || strtolower($context) == 'inventory') {
            $module = $context;
        } elseif (substr($context, -1) == 'y') {
            $module = substr($context, 0, -1) . 'ies';
        } else {
            $module = $context . 's';
        }

        return ucfirst($module);
    }

    protected function getQueryContext($context)
    {
        if (substr($context, -3) == 'ies') {
            $context = substr($context, 0, -3) . 'y';
        } elseif (substr($context, -1) == 's') {
            $context = substr($context, 0, -1);
        }
        return ucfirst($context);
    }

    protected function getContext($context)
    {
        return ucfirst($context);
    }

    /**
     * @Given i have a :context draft with values
     */
    public function iHaveAContextDraftWithValuesJson($context, PyStringNode $json)
    {
        $context = $this->getContext($context);
        $class = '\Commercetools\Core\Model\\' . $context . '\\' . $context . 'Draft';

        $rawData = json_decode((string)$json, true);
        $object = call_user_func_array($class.'::fromArray', [$rawData]);
        $this->forceTyping($object, $rawData);

        $this->objects[$context] = $object;
        $this->context = $context;
    }

    protected function forceTyping($object)
    {
        if ($object instanceof JsonObject) {
            $fields = $object->fieldDefinitions();
            foreach ($fields as $field => $definition) {
                $dummy = $object->get($field);
                if ($dummy instanceof AbstractJsonDeserializeObject) {
                    $this->forceTyping($dummy);
                }
            }
        } elseif ($object instanceof Collection) {
            foreach ($object as $index => $element) {
                $this->forceTyping($element);
            }
        }
    }

    /**
     * @Given add the :actionName action to :context with values
     */
    public function addTheActionToWithValues($actionName, $context, PyStringNode $json)
    {
        $module = $this->getModuleName($context);
        $context = $this->getContext($context);
        $actionName = $this->getContext($actionName);
        $class = '\Commercetools\Core\Request\\' . $module . '\\Command\\' . $context . $actionName . 'Action';
        $json = (string)$json;
        assertJson($json);
        $rawData = json_decode($json, true);
        $object = call_user_func_array($class.'::fromArray', [$rawData]);
        $this->forceTyping($object, $rawData);

        $this->request->addAction($object);
    }

    /**
     * @Given i want to create a :context
     */
    public function iWantToCreateAContext($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'CreateRequest';
        if ($context == 'CustomObject') {
            $this->request = call_user_func_array($request. '::ofObject', [$this->objects[$context]]);
        } else {
            $this->request = call_user_func_array($request. '::ofDraft', [$this->objects[$context]]);
        }
    }

    /**
     * @Given a :context is identified by key :key and version :version
     */
    public function aContextIsIdentifiedByKeyAndVersionNr($context, $key, $version)
    {
        $context = $this->getContext($context);
        $requestContext = $context . 'Request';
        $this->objects[$requestContext] = ['key' => $key, 'version' => (int)$version, 'params' => []];
        $this->context = $requestContext;
    }

    /**
     * @Given a :context is identified by :id and version :version
     */
    public function aContextIsIdentifiedByIdAndVersionNr($context, $id, $version)
    {
        $context = $this->getContext($context);
        $requestContext = $context . 'Request';
        $this->objects[$requestContext] = ['id' => $id, 'version' => (int)$version, 'params' => []];
        $this->context = $requestContext;
    }

    /**
     * @Given a :context is identified by :container and key :key
     */
    public function aContextIsIdentifiedByContainerAndKey($context, $container, $key)
    {
        $context = $this->getContext($context);
        $requestContext = $context . 'Request';
        $this->objects[$requestContext] = ['container' => $container, 'key' => $key, 'params' => []];
        $this->context = $requestContext;
    }


    /**
     * @Given a :context is identified by :id
     */
    public function aContextIsIdentifiedById($context, $id)
    {
        $context = $this->getContext($context);
        $requestContext = $context . 'Request';
        $this->objects[$requestContext] = ['id' => $id];
    }

    /**
     * @Given i want to delete a :context
     */
    public function iWantToDeleteAContext($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'DeleteRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array($request. '::ofIdAndVersion', [$id, $version]);
    }

    /**
     * @Given i want to fetch a :context
     */
    public function iWantToFetchAContext($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ByIdGetRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $this->request = call_user_func_array($request. '::ofId', [$id]);
    }

    /**
     * @Given i want to fetch a :context by key
     */
    public function iWantToFetchAContextByKey($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ByKeyGetRequest';
        $requestContext = $context . 'Request';
        $key = $this->objects[$requestContext]['id'];
        $this->request = call_user_func_array($request. '::ofKey', [$key]);
    }

    /**
     * @Given i want to fetch a :context by container and key
     */
    public function iWantToFetchAContextByContainerAndKey($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ByKeyGetRequest';
        $requestContext = $context . 'Request';
        $container = $this->objects[$requestContext]['container'];
        $key = $this->objects[$requestContext]['key'];
        $this->request = call_user_func_array($request. '::ofContainerAndKey', [$container, $key]);
    }

    /**
     * @Given i want to fetch a :context by customerId
     */
    public function iWantToFetchAContextByCustomerId($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ByCustomerIdGetRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $this->request = call_user_func_array($request. '::ofCustomerId', [$id]);
    }

    /**
     * @Given i want to fetch a :context by cartId
     */
    public function iWantToFetchAContextByCartId($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ByCartIdGetRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $this->request = call_user_func_array($request. '::ofCartId', [$id]);
    }

    /**
     * @Given i want to fetch a :context by location
     */
    public function iWantToFetchAContextByLocation($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ByLocationGetRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $this->request = call_user_func_array($request. '::ofCountry', [$id]);
    }

    /**
     * @Given with :field :value
     */
    public function withFieldValue($field, $value)
    {
        $method = 'with' . ucfirst($field);
        $this->request->$method($value);
    }

    /**
     * @Given i want to query :context
     */
    public function iWantToQuery($context)
    {
        $module = $this->getModuleName($context);
        $context = $this->getQueryContext($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'QueryRequest';
        $this->request = call_user_func($request. '::of');
    }

    /**
     * @Given i want to search products
     */
    public function iWantToSearchProducts()
    {
        $request = ProductProjectionSearchRequest::class;
        $this->request = call_user_func($request. '::of');
    }

    /**
     * @Given i want to update a :context
     */
    public function iWantToUpdateAContext($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'UpdateRequest';

        $requestContext = $context . 'Request';
        if (isset($this->objects[$requestContext]['key'])) {
            $id = $this->objects[$requestContext]['key'];
            $method = 'ofKeyAndVersion';
        } else {
            $id = $this->objects[$requestContext]['id'];
            $method = 'ofIdAndVersion';
        }
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array($request . '::' . $method, [$id, $version]);
    }

    /**
     * @Given i want to update a :context by key
     */
    public function iWantToUpdateAContextByKey($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'UpdateByKeyRequest';

        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array($request. '::ofKeyAndVersion', [$id, $version]);
    }


    /**
     * @Given i want to delete a :context by key
     */
    public function iWantToDeleteAContextByKey($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'DeleteByKeyRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array($request. '::ofKeyAndVersion', [$id, $version]);
    }

    /**
     * @Given i want to delete a :context by container and key
     */
    public function iWantToDeleteAContextByContainerAndKey($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'DeleteByKeyRequest';
        $requestContext = $context . 'Request';
        $container = $this->objects[$requestContext]['container'];
        $key = $this->objects[$requestContext]['key'];
        $this->request = call_user_func_array($request. '::ofContainerAndKey', [$container, $key]);
    }

    /**
     * @Given query by customers id :customerId
     */
    public function queryByCustomersId($customerId)
    {
        $this->request->byCustomerId($customerId);
    }

    /**
     * @Then the path should be :expectedPath
     */
    public function thePathShouldBe($expectedPath)
    {
        $httpRequest = $this->request->httpRequest();

        assertSame($expectedPath, (string)$httpRequest->getUri());
    }

    /**
     * @Then the request should be
     */
    public function theRequestShouldBe(PyStringNode $result)
    {
        $expectedResult = (string)$result;
        $httpRequest = $this->request->httpRequest();
        $request = (string)$httpRequest->getBody();

        assertJsonStringEqualsJsonString($expectedResult, $request);
    }

    /**
     * @Then the body should be
     */
    public function theBodyShouldBe(PyStringNode $result)
    {
        $expectedResult = (string)$result;
        $httpRequest = $this->request->httpRequest();
        $request = (string)$httpRequest->getBody();

        assertEquals($expectedResult, $request);
    }

    /**
     * @Then the method should be :method
     */
    public function theMethodShouldBe($expectedMethod)
    {
        $httpRequest = $this->request->httpRequest();

        assertSame(strtoupper($expectedMethod), $httpRequest->getMethod());
    }

    /**
     * @Given filter them with criteria :where
     */
    public function filterThemWithCriteriaName($where)
    {
        /**
         * @var \Commercetools\Core\Request\AbstractQueryRequest $request
         */
        $this->request->where($where);
    }

    /**
     * @Given filter :field with value :value
     */
    public function filterFieldWithValue($field, $value)
    {
        /**
         * @var \Commercetools\Core\Request\AbstractQueryRequest $request
         */
        $filter = Filter::ofName($field)->setValue($value);
        $this->request->addFilter($filter);
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
     * @Given i want to create a :context token with :minutes minutes ttl
     */
    public function iWantToCreateATokenWithMinutesTtl($context, $minutes)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'EmailTokenRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array(
            $request. '::ofIdVersionAndTtl',
            [$id, $version, $minutes]
        );
    }

    /**
     * @When i want to signin a :context with email :email, password :password and anonymousCartId :cartId
     */
    public function iWantToSignInAWithEmailPasswordAndAnonymousCartId($context, $email, $password, $cartId)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'LoginRequest';
        $this->request = call_user_func_array(
            $request. '::ofEmailAndPassword',
            [$email, $password, $cartId]
        );
    }

    /**
     * @Given a :context is identified by the email :email
     */
    public function aIsIdentifiedByTheEmail($context, $email)
    {
        $context = $this->getContext($context);
        $requestContext = $context . 'Request';
        $this->objects[$requestContext] = ['email' => $email];
    }

    /**
     * @Given i want to create a password token for :context
     */
    public function iWantToCreateAPasswordTokenFor($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'PasswordTokenRequest';
        $requestContext = $context . 'Request';
        $email = $this->objects[$requestContext]['email'];
        $this->request = call_user_func_array(
            $request. '::ofEmail',
            [$email]
        );
    }

    /**
     * @Given a :context is identified by the token :token
     */
    public function aContextIsIdentifiedByTheToken($context, $token)
    {
        $context = $this->getContext($context);
        $requestContext = $context . 'Request';
        $this->objects[$requestContext] = ['token' => $token];
    }

    /**
     * @Given i want to fetch a :context by token
     */
    public function iWantToFetchAContextByToken($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ByTokenGetRequest';
        $requestContext = $context . 'Request';
        $token = $this->objects[$requestContext]['token'];
        $this->request = call_user_func_array($request. '::ofToken', [$token]);
    }

    /**
     * @Given i want to reset the :context password to :newPassword with token :token
     */
    public function iWantToResetTheContextPasswordToNewPasswordWithToken($context, $newPassword, $token)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'PasswordResetRequest';
        $this->request = call_user_func_array(
            $request. '::ofTokenAndPassword',
            [$token, $newPassword]
        );
    }

    /**
     * @Given i want to confirm the :context email with token :token
     */
    public function iWantToConfirmTheContextEmailWithToken($context, $token)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'EmailConfirmRequest';
        $this->request = call_user_func_array(
            $request. '::ofToken',
            [$token]
        );
    }

    /**
     * @Given i want to change the :context password from :currentPassword to :newPassword
     */
    public function iWantToChangeTheContextPasswordFromCurrentToNewPassword($context, $currentPassword, $newPassword)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'PasswordChangeRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array(
            $request. '::ofIdVersionAndPasswords',
            [$id, $version, $currentPassword, $newPassword]
        );
    }

    /**
     * @Given i want to create a :context from :context2
     */
    public function iWantToCreateAContextFromContext2($context, $context2)
    {
        $context = $this->getContext($context);
        $context2 = $this->getContext($context2);
        $module = $this->getModuleName($context);
        $request = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'CreateFrom' . $context2 . 'Request';
        $requestContext = $context2 . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array(
            $request. '::ofCartIdAndVersion',
            [$id, $version]
        );
    }

    /**
     * @Given set the orderNumber to :orderNumber and the paymentState to :paymentState
     */
    public function setTheOrderNumberToAndThePaymentStateTo($orderNumber, $paymentState)
    {
        $this->request->setOrderNumber($orderNumber)->setPaymentState($paymentState);
    }

    /**
     * @Given i want to import a :context with values
     */
    public function iWantToImportAWithValues($context, PyStringNode $json)
    {
        $module = $this->getModuleName($context);
        $context = $this->getContext($context);

        $importClass = '\Commercetools\Core\Model\\' . $context . '\\Import' . $context;
        $requestClass = '\Commercetools\Core\Request\\' . $module . '\\' . $context . 'ImportRequest';

        $rawData = json_decode((string)$json, true);
        $object = call_user_func_array($importClass.'::fromArray', [$rawData]);
        $this->forceTyping($object, $rawData);

        $this->request = call_user_func_array(
            $requestClass . '::ofImport'.$context,
            [$object]
        );
    }
}
