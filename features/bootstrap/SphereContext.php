<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core;

use Behat\Gherkin\Node\PyStringNode;
use Sphere\Core\Model\Common\AbstractJsonDeserializeObject;
use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\JsonObject;

trait SphereContext
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
        $class = '\Sphere\Core\Model\\' . $context . '\\' . $context . 'Draft';

        $rawData = json_decode((string)$json, true);
        $object = call_user_func_array($class.'::fromArray', [$rawData]);
        $this->forceTyping($object, $rawData);

        $this->objects[$context] = $object;
        $this->context = $context;
    }

    protected function forceTyping($object, $rawData)
    {
        if ($object instanceof JsonObject) {
            foreach ($rawData as $field => $value) {
                $dummy = $object->get($field);
                if ($dummy instanceof AbstractJsonDeserializeObject) {
                    $this->forceTyping($dummy, $value);
                }
            }
        } elseif ($object instanceof Collection) {
            foreach ($rawData as $index => $element) {
                $this->forceTyping($object->getAt($index), $element);
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
        $class = '\Sphere\Core\Request\\' . $module . '\\Command\\' . $context . $actionName . 'Action';

        $rawData = json_decode((string)$json, true);
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
        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'CreateRequest';
        $this->request = call_user_func_array($request. '::ofDraft', [$this->objects[$context]]);
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
        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'DeleteByIdRequest';
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
        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'FetchByIdRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $this->request = call_user_func_array($request. '::ofId', [$id]);
    }

    /**
     * @Given i want to fetch a :context by customerId
     */
    public function iWantToFetchAContextByCustomerId($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'FetchByCustomerIdRequest';
        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $this->request = call_user_func_array($request. '::ofCustomerId', [$id]);
    }

    /**
     * @Given i want to query :context
     */
    public function iWantToQuery($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'QueryRequest';
        $this->request = call_user_func($request. '::of');
    }

    /**
     * @Given i want to update a :context
     */
    public function iWantToUpdateAContext($context)
    {
        $context = $this->getContext($context);
        $module = $this->getModuleName($context);
        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'UpdateRequest';

        $requestContext = $context . 'Request';
        $id = $this->objects[$requestContext]['id'];
        $version = $this->objects[$requestContext]['version'];
        $this->request = call_user_func_array($request. '::ofIdAndVersion', [$id, $version]);
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

























//
//
//
//
//
//
//    protected function createRequestInstance($className, $params = [])
//    {
//        $reflection = new ReflectionClass($className);
//        $this->request = $reflection->newInstanceArgs($params);
//    }
//
//
//    /**
//     * @Given i have a :context draft
//     */
//    public function iHaveADraft($context)
//    {
//        $context = $this->getContext($context);
//        $class = '\Sphere\Core\Model\\' . $context . '\\' . $context . 'Draft';
//
//        $this->objects[$context] = [
//            'class' => $class,
//            'params' => [],
//            'instance' => null
//        ];
//        $this->context = $context;
//    }
//
//    /**
//     * @Given the :field is :value in :locale
//     */
//    public function theContextFieldIsValueInLocale($field, $value, $locale)
//    {
//        $context = $this->context;
//        $localizedString = new \Sphere\Core\Model\Common\LocalizedString([$locale => $value]);
//        if (
//            isset($this->objects[$context]['params'][$field]) &&
//            $this->objects[$context]['params'][$field] instanceof \Sphere\Core\Model\Common\LocalizedString
//        ) {
//            $this->objects[$context]['params'][$field]->merge($localizedString);
//        } else {
//            $this->objects[$context]['params'][$field] = $localizedString;
//        }
//    }
//
//    public function getContextObject($context)
//    {
//        $context = $this->getContext($context);
//
//        if (!isset($this->objects[$context]['instance'])) {
//            $reflection = new ReflectionClass($this->objects[$context]['class']);
//            $this->objects[$context]['instance'] = $reflection->newInstanceArgs($this->objects[$context]['params']);
//        }
//
//        return $this->objects[$context]['instance'];
//    }
//
//    /**
//     * @Given i want to create a :context from :context2
//     */
//    public function iWantToCreateAContextFromCart($context, $context2)
//    {
//        $context = $this->getContext($context);
//        $context2 = $this->getContext($context2);
//        $module = $this->getModuleName($context);
//        $contextParams = $this->objects[$context2. 'Request'];
//        $request = '\Sphere\Core\Request\\' . $module . '\\' .
//            $context . 'CreateFrom' . $context2 . 'Request';
//        $this->createRequestInstance($request, [$contextParams['id'], $contextParams['version']]);
//        $this->context = $context . 'Request';
//        $this->objects[$this->context]['instance'] = $this->request;
//    }
//

//
//    /**
//     * @Given the :field is :value as :type
//     */
//    public function theContextFieldIsValueAsType($field, $value, $type)
//    {
//        if ($type == 'bool') {
//            $value = (bool)$value;
//        } else {
//            $method = $type . 'val';
//            $value = $method($value);
//        }
//        $this->theContextFieldIsValue($field, $value);
//    }
//
//    /**
//     * @Given the :field is :value
//     */
//    public function theContextFieldIsValue($field, $value)
//    {
//        $context = $this->context;
//        $this->objects[$context]['params'][$field] = $value;
//    }
//
//    /**
//     * @Given a :context is identified by the email :email
//     */
//    public function aContextIsIdentifiedByTheEmail($context, $email)
//    {
//        $context = $this->getContext($context);
//        $requestContext = $context . 'Request';
//        $this->context = $requestContext;
//        $this->objects[$requestContext] = ['email' => $email];
//    }
//
//    /**
//     * @Given a :context is identified by the token :token
//     */
//    public function aContextIsIdentifiedByTheToken($context, $token)
//    {
//        $context = $this->getContext($context);
//        $requestContext = $context . 'Request';
//        $this->objects[$requestContext] = ['token' => $token];
//    }
//
//
//    /**
//     * @Given i want to :action of :context as :alias
//     */
//    public function iWantToActionOfContextAsAlias($action, $context, $alias)
//    {
//        $this->iWantToActionOfContext($action, $context, $alias);
//    }
//
//    /**
//     * @Given i want to :action of :context
//     */
//    public function iWantToActionOfContext($action, $context, $alias = null)
//    {
//        $context = $this->getContext($context);
//        $action = $this->getContext($action);
//        $alias = $this->getContext($alias);
//
//        $module = $this->getModuleName($context);
//        $actionClass = '\Sphere\Core\Request\\' . $module . '\\Command\\' . $context . $action . 'Action';
//        $context = ($alias ? : $context.$action);
//        $this->objects[$context] = [
//            'class' => $actionClass,
//            'params' => [],
//            'instance' => null
//        ];
//        $this->context = $context;
//        $this->actions[] = $this->context;
//    }
//
//    /**
//     * @Given the :type reference :field is :id
//     */
//    public function theTypeReferenceFieldIsId($type, $field, $id)
//    {
//        $type = $this->getContext($type);
//        $reference = '\Sphere\Core\Model\\' . $type . '\\' . $type . 'Reference';
//        $reference = new $reference($id);
//        $this->theContextFieldIsValue($field, $reference);
//    }
//
//    /**
//     * @Given i have a :domain :context object as :alias
//     */
//    public function iHaveADomainContextObjectAsAlias($domain, $context, $alias)
//    {
//        $this->iHaveADomainContextObject($domain, $context, $alias);
//    }
//    /**
//     * @Given i have a :domain :context object
//     */
//    public function iHaveADomainContextObject($domain, $context, $alias = null)
//    {
//        $domain = $this->getContext($domain);
//        $context = $this->getContext($context);
//        $alias = $this->getContext($alias);
//
//        $class = '\Sphere\Core\Model\\' . $domain . '\\' . $context;
//        $context = ($alias ? : $domain.$context);
//        $this->objects[$context] = [
//            'class' => $class,
//            'params' => [],
//            'instance' => null
//        ];
//        $this->context = $context;
//    }
//
//    /**
//     * @Given set the :field to :value
//     */
//    public function setTheFieldToValue($field, $value)
//    {
//        $object = $this->getContextObject($this->context);
//        $method = 'set' . ucfirst($field);
//        $object->$method($value);
//    }
//
//    /**
//     * @Given set the :field to :value as :type
//     */
//    public function setTheFieldToValueAsType($field, $value, $type)
//    {
//        if ($type == 'array') {
//            $value = array_map('trim', explode(',', $value));
//        } elseif ($type == 'bool') {
//            $value = (bool)$value;
//        } else {
//            $method = $type.'val';
//            $value = $method($value);
//        }
//        $this->setTheFieldToValue($field, $value);
//    }
//
//    /**
//     * @Given set the :field to :value in :locale
//     */
//    public function setTheContextFieldToValueInLocale($field, $value, $locale)
//    {
//        $localizedString = new \Sphere\Core\Model\Common\LocalizedString([$locale => $value]);
//        $this->setTheFieldToValue($field, $localizedString);
//    }
//
//    /**
//     * @Given set the :type reference :field to :id
//     */
//    public function setTheTypeReferenceFieldToId($type, $field, $id)
//    {
//        $type = $this->getContext($type);
//        $reference = '\Sphere\Core\Model\\' . $type . '\\' . $type . 'Reference';
//        $reference = new $reference($id);
//        $this->setTheFieldToValue($field, $reference);
//    }
//
//    /**
//     * @Given set the :field date to :value
//     */
//    public function setTheFieldDateToValue($field, $value)
//    {
//        $object = $this->getContextObject($this->context);
//        $method = 'set' . ucfirst($field);
//        $object->$method(new DateTime($value));
//    }
//
//    /**
//     * @Given set the :domain :context object to :field
//     */
//    public function setTheDomainContextObjectToField($domain, $context, $field)
//    {
//        $context = $this->getContext($domain) . $this->getContext($context);
//        $this->theContextFieldIsValue($field, $this->getContextObject($context));
//    }
//
//    /**
//     * @Given the :field is :alias object
//     */
//    public function theFieldIsAliasObject($field, $alias)
//    {
//        $alias = $this->getContext($alias);
//        $this->theContextFieldIsValue($field, $this->getContextObject($alias));
//    }
//
//    /**
//     * @Given set the :Alias object to :field
//     */
//    public function setTheAliasObjectToField($alias, $field)
//    {
//        $alias = $this->getContext($alias);
//        $object = $this->getContextObject($alias);
//        $this->setTheFieldToValue($field, $object);
//    }
//
//    /**
//     * @Given add the :Alias object to :field collection
//     */
//    public function addTheAliasObjectToFieldCollection($alias, $field)
//    {
//        $alias = $this->getContext($alias);
//        $object = $this->getContextObject($alias);
//        $method = 'get' . ucfirst($field);
//        $contextObject = $this->getContextObject($this->context);
//        if ($contextObject instanceof \Sphere\Core\Model\Common\Collection) {
//            $contextObject->add($object);
//        } else {
//            $contextObject->$method()->add($object);
//        }
//    }
//
//    /**
//     * @Given set the :Alias object to :field collection at :offset
//     */
//    public function setTheAliasObjectToFieldCollectionAtOffset($alias, $field, $offset)
//    {
//        $alias = $this->getContext($alias);
//        $object = $this->getContextObject($alias);
//        $method = 'get' . ucfirst($field);
//        $contextObject = $this->getContextObject($this->context);
//        if ($contextObject instanceof \Sphere\Core\Model\Common\Collection) {
//            $contextObject->setAt($offset, $object);
//        } else {
//            $contextObject->$method()->setAt($offset, $object);
//        }
//    }
//
//    /**
//     * @Given i want to delete a :context by key
//     */
//    public function iWantToDeleteAByKey($context)
//    {
//        $context = $this->getContext($context);
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'DeleteByKeyRequest';
//        $requestContext = $context . 'Request';
//        $id = $this->objects[$requestContext]['id'];
//        $version = $this->objects[$requestContext]['version'];
//        $this->createRequestInstance($request, [$id, $version]);
//    }
//
//    /**
//     * @Given i want to create a :context token
//     */
//    public function iWantToCreateAToken($context)
//    {
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'EmailTokenRequest';
//        $requestContext = $context . 'Request';
//        $id = $this->objects[$requestContext]['id'];
//        $version = $this->objects[$requestContext]['version'];
//        $params = array_merge([$id, $version], $this->objects[$requestContext]['params']);
//
//        $this->createRequestInstance($request, $params);
//    }
//
//    /**
//     * @Given i want to signin a :context
//     */
//    public function iWantToSigninAContext($context)
//    {
//        $context = $this->getContext($context);
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'LoginRequest';
//        $requestContext = $context . 'Request';
//        $args = array_merge([$this->objects[$requestContext]['email']], $this->objects[$requestContext]['params']);
//        $this->createRequestInstance($request, $args);
//    }
//
//    /**
//     * @Given i want to confirm a :context token
//     */
//    public function iWantToConfirmAContextToken($context)
//    {
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . ucfirst($module) . '\\' . ucfirst($context) . 'EmailConfirmRequest';
//        $requestContext = $context . 'Request';
//        $id = $this->objects[$requestContext]['id'];
//        $version = $this->objects[$requestContext]['version'];
//        $params = array_merge([$id, $version], $this->objects[$requestContext]['params']);
//        $this->createRequestInstance($request, $params);
//    }
//
//    /**
//     * @Given i want to fetch a :context by key
//     */
//    public function iWantToFetchAContextByKey($context)
//    {
//        $context = $this->getContext($context);
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'FetchByKeyRequest';
//        $requestContext = $context . 'Request';
//        $container = $this->objects[$requestContext]['id'];
//        $key = $this->objects[$requestContext]['version'];
//        $this->createRequestInstance($request, [$container, $key]);
//    }
//
//
//
//
//
//    /**
//     * @Given i want to create a password token for :context
//     */
//    public function iWantToCreateAPasswordTokenFor($context)
//    {
//        $context = $this->getContext($context);
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'PasswordTokenRequest';
//        $requestContext = $context . 'Request';
//        $email = $this->objects[$requestContext]['email'];
//        $this->createRequestInstance($request, [$email]);
//    }
//
//    /**
//     * @Given i want to fetch a :context by token
//     */
//    public function iWantToFetchAByToken($context)
//    {
//        $context = $this->getContext($context);
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'FetchByTokenRequest';
//        $requestContext = $context . 'Request';
//        $token = $this->objects[$requestContext]['token'];
//        $this->createRequestInstance($request, [$token]);
//    }
//
//    /**
//     * @Given i :action the :context password
//     */
//    public function iResetThePassword($action, $context)
//    {
//        $context = $this->getContext($context);
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . $module . '\\' .
//            $context . 'Password' . ucfirst($action) . 'Request';
//        $requestContext = $context . 'Request';
//        $id = $this->objects[$requestContext]['id'];
//        $version = $this->objects[$requestContext]['version'];
//        $params = array_merge([$id, $version], $this->objects[$requestContext]['params']);
//        $this->createRequestInstance($request, $params);
//    }
//
//    /**
//     * @Given i want to import a :context
//     */
//    public function iWantToImportAContext($context)
//    {
//        $context = $this->getContext($context);
//        $module = $this->getModuleName($context);
//        $request = '\Sphere\Core\Request\\' . $module . '\\' . $context . 'ImportRequest';
//        $this->createRequestInstance($request, [$this->getContextObject($context)]);
//    }
}
