<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Message\Message;
use Symfony\Component\Yaml\Yaml;

class RamlModelTest extends AbstractModelTest
{
//    const RAML_MODEL_PATH = __DIR__ . '/../../../vendor/commercetools/commercetools-api-reference/types/';
    const RAML_MODEL_PATH = __DIR__ . '/../../../../commercetools-api-reference/types/';
    const MODEL_PATH = __DIR__ . '/../../../src/Core/Model';
    const COMMAND_PATH = __DIR__ . '/../../../src/Core/Request';

    private $ramlTypes = [];

    /**
     * @test
     * @dataProvider modelFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function modelValidProperties($className, array $validFields = [])
    {
        $validFields = array_flip($validFields);
        $t = new \ReflectionClass($className);
        $missingFields = [];
        foreach ($this->fieldDefinitions($className) as $fieldKey => $field) {
            if (!isset($validFields[$fieldKey])) {
                $missingFields[] = $fieldKey;
            }
        }
        $this->assertEmpty(
            $missingFields,
            sprintf(
                'Failed asserting that \'%s\' %s at \'%s\' (%s:0)',
                implode('\', \'', $missingFields),
                count($missingFields) > 1 ? 'are valid fields': 'is a valid field',
                $className,
                $t->getFileName()
            )
        );
    }

    private $primitives = [
        'boolean' => 'bool',
        'number' => ['float', 'int'],
        'int64' => 'int',
        'int32' => 'int',
        'int8' => 'int',
        'string' => ['string', 'DateTime'],
        'datetime' => ['DateTime', 'string']
    ];

    /**
     * @test
     * @dataProvider modelFieldTypeProvider
     * @param string $className
     * @param array $validFields
     */
    public function modelFieldType($className, array $validFields = [])
    {
        $t = new \ReflectionClass($className);
        $wrongTypes = [];
        foreach ($this->fieldDefinitions($className) as $fieldKey => $field) {
            $expectedFieldType = $validFields[$fieldKey]['type'];
            if ($validFields[$fieldKey]['type'] === 'number' && isset($validFields[$fieldKey]['format'])) {
                $expectedFieldType = $validFields[$fieldKey]['format'];
            }
            if (!isset($this->primitives[$expectedFieldType]) || !isset($field[JsonObject::TYPE])) {
                continue;
            }
            $primitiveType = $this->primitives[$expectedFieldType];
            if (is_array($primitiveType)) {
                $this->assertContains(
                    $field[JsonObject::TYPE],
                    $primitiveType,
                    sprintf(
                        'Failed asserting that \'%s\' is of type \'%s\' at \'%s\' (%s:0)',
                        $fieldKey,
                        $validFields[$fieldKey]['type'],
                        $className,
                        $t->getFileName()
                    )
                );
                if (!in_array($field[JsonObject::TYPE], $primitiveType)) {
                    $wrongTypes[$fieldKey] = $fieldKey;
                }
            } else {
                $this->assertSame(
                    $this->primitives[$expectedFieldType],
                    $field[JsonObject::TYPE],
                    sprintf(
                        'Failed asserting that \'%s\' is of type \'%s\' at \'%s\' (%s:0)',
                        $fieldKey,
                        $validFields[$fieldKey]['type'],
                        $className,
                        $t->getFileName()
                    )
                );
                if ($this->primitives[$expectedFieldType] != $field[JsonObject::TYPE]) {
                    $wrongTypes[$fieldKey] = $fieldKey;
                }
            }
        }
        $this->assertEmpty(
            $wrongTypes,
            sprintf(
                'Failed asserting that \'%s\' %s at \'%s\' (%s:0)',
                implode('\', \'', $wrongTypes),
                count($wrongTypes) > 1 ? 'are valid fields': 'is a valid field',
                $className,
                $t->getFileName()
            )
        );
    }

    /**
     * @test
     * @dataProvider commandFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function commandValidProperties($className, array $validFields = [])
    {
        $validFields = array_flip($validFields);
        $t = new \ReflectionClass($className);
        $missingFields = [];
        foreach ($this->fieldDefinitions($className) as $fieldKey => $field) {
            if (!isset($validFields[$fieldKey])) {
                $missingFields[] = $fieldKey;
            }
        }
        $this->assertEmpty(
            $missingFields,
            sprintf(
                'Failed asserting that \'%s\' %s at \'%s\' (%s:0)',
                implode('\', \'', $missingFields),
                count($missingFields) > 1 ? 'are valid fields': 'is a valid field',
                $className,
                $t->getFileName()
            )
        );
    }

    /**
     * @test
     * @dataProvider modelClassProvider
     */
    public function uncoveredModelClass($className, $hasFixture)
    {
        $t = new \ReflectionClass($className);
        $this->assertTrue($hasFixture, sprintf("No fixture for %s found (%s:0)", $className, $t->getFileName()));
    }

    /**
     * @test
     * @dataProvider commandClassProvider
     */
    public function uncoveredCommandClass($className, $hasFixture)
    {
        $t = new \ReflectionClass($className);
        $this->assertTrue($hasFixture, sprintf("No fixture for %s found (%s:0)", $className, $t->getFileName()));
    }

    /**
     * @dataProvider modelFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function modelPropertiesExist($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        $t = new \ReflectionClass($className);
        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->fieldDefinitions(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\' (%s:0)', $className, $fieldKey, $t->getFileName())
            );
        }
    }

    /**
     * @dataProvider commandFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function commandPropertiesExist($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        $t = new \ReflectionClass($className);
        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->fieldDefinitions(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\' (%s:0)', $className, $fieldKey, $t->getFileName())
            );
        }
    }

    private function fieldDefinitions($className)
    {
        /**
         * @var JsonObject $object
         */
        $object = $this->getInstance($className);
        $definitions = $object->fieldDefinitions();

        $t = new \ReflectionClass($className);
        $comment = $t->getDocComment();
        $fields = [];
        if (strpos($comment, '@ramlTestIgnoreFields') > 0) {
            preg_match('/@ramlTestIgnoreFields\(([\s"\',a-zA-Z0-9]+)\)/', $comment, $matches);
            $fields = preg_split('/[\s,"\']+/', $matches[1]);
        }
        return array_filter(
            $definitions,
            function ($key) use ($fields) {
                return !in_array($key, $fields);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    protected function getCommandClass($domain, $model)
    {
        switch ($domain) {
            case 'TaxCategory':
                $domain = 'TaxCategories';
                break;
            case 'Category':
                $domain = 'Categories';
                break;
            case 'Project':
                break;
            case 'Inventory':
                $model = str_replace('InventoryEntry', 'Inventory', $model);
                break;
            case 'OrderEdit':
                $domain .= 's';
                if (strpos($model, 'StagedOrder') === 0) {
                    $domain = 'OrderEdits\\StagedOrder';
                }
                break;
            default:
                $domain .= 's';
                break;
        }
        return 'Commercetools\\Core\\Request\\' . ucfirst($domain) . '\\Command\\' . ucfirst($model);
    }

    private function classProvider($modelClasses, $classNameField)
    {
        $ramlInfos = $this->getRamlTypes();
        $fixtures = $this->getFixtures($modelClasses, $ramlInfos, $classNameField);
        $fixtureClasses = $this->getFixtureClasses($fixtures, $classNameField);

        $filteredClasses = array_filter(
            $modelClasses,
            function ($class) {
                $t = new \ReflectionClass($class);
                return strpos($t->getDocComment(), '@deprecated') === false
                    && strpos($t->getDocComment(), '@ramlTestIgnoreClass') === false
                    && !$t->isAbstract();
            }
        );

        $data = array_map(
            function ($modelClass) use ($fixtureClasses) {
                return [
                    'class' => $modelClass,
                    'hasFixture' => isset($fixtureClasses[$modelClass])
                ];
            },
            $filteredClasses
        );
        return $data;
    }

    public function modelClassProvider()
    {
        $modelClasses = $this->getModelClasses(static::MODEL_PATH);
        return $this->classProvider($modelClasses, 'modelClass');
    }

    public function commandClassProvider()
    {
        $modelClasses = $this->getModelClasses(static::COMMAND_PATH);
        return $this->classProvider($modelClasses, 'commandClass');
    }

    public function modelFieldProvider()
    {
        $modelClasses = $this->getModelClasses(static::MODEL_PATH);
        return $this->objectFieldProvider($modelClasses);
    }

    public function modelFieldTypeProvider()
    {
        $modelClasses = $this->getModelClasses(static::MODEL_PATH);
        return $this->objectFieldTypeProvider($modelClasses);
    }

    public function commandFieldProvider()
    {
        $commandClasses = $this->getModelClasses(static::COMMAND_PATH);
        return $this->objectFieldProvider($commandClasses, 'commandClass');
    }


    public function objectFieldProvider(array $modelClasses, $classNameField = 'modelClass')
    {
        $ramlInfos = $this->getRamlTypes();

        $fixtures = $this->getFixtures($modelClasses, $ramlInfos, $classNameField);

        return array_map(
            function ($fixture) use ($classNameField) {
                return [$fixture[$classNameField], array_keys($fixture['fields'])];
            },
            array_filter(
                $fixtures,
                function ($fixture) use ($modelClasses) {
                    return count($fixture['fields']) > 0;
                }
            )
        );
    }

    public function objectFieldTypeProvider(array $modelClasses, $classNameField = 'modelClass')
    {
        $ramlInfos = $this->getRamlTypes();

        $fixtures = $this->getFixtures($modelClasses, $ramlInfos, $classNameField);

        return array_map(
            function ($fixture) use ($classNameField) {
                return [$fixture[$classNameField], $fixture['fields']];
            },
            array_filter(
                $fixtures,
                function ($fixture) use ($modelClasses) {
                    return count($fixture['fields']) > 0;
                }
            )
        );
    }

    private function getRamlTypes()
    {
        if (empty($this->ramlTypes)) {
            $ramlTypesFile = static::RAML_MODEL_PATH . 'types.raml';
            if (!file_exists($ramlTypesFile)) {
                return [];
            }

            $types = Yaml::parse(file_get_contents($ramlTypesFile));

            $ramlTypes = [];
            foreach ($types as $typeName => $typeFile) {
                $ramlFile = trim(str_replace('!include', '', $typeFile));
                $ramlType = Yaml::parse(file_get_contents(static::RAML_MODEL_PATH . $ramlFile));

                if (isset($ramlType['properties']) || isset($ramlType['type'])) {
                    $ramlTypes[$typeName] = $ramlType;
                }
            }

            $ramlInfos = [];
            foreach ($ramlTypes as $typeName => $ramlType) {
                $ramlFile = trim(str_replace('!include', '', $types[$typeName]));
                $package = $this->pascalcase(dirname($ramlFile));
                $package = preg_replace('/\/updates$/', '', $package);
                $domain = $this->mapRamlToDomain($package, $typeName);
                $model = $this->mapRamlToModel($package, $typeName);
                $modelClassName = $this->getClassName($domain, $model);
                $commandClassName = $this->getCommandClass($domain, $model);
                $fields = $this->resolveProperties($ramlTypes, $ramlType);
                $fields = array_filter(
                    $fields,
                    function ($field) {
                        return strpos($field, '/') === false;
                    },
                    ARRAY_FILTER_USE_KEY
                );
                $ramlInfos[$typeName] = [
                    'fields' => $fields,
                    'domain' => $package,
                    'model' => $typeName,
                    'modelClass' => $modelClassName,
                    'commandClass' => $commandClassName
                ];
            }
            ksort($ramlInfos);
            $this->ramlTypes = $ramlInfos;
        }

        return $this->ramlTypes;
    }

    private function resolveProperties($ramlTypes, $ramlType)
    {
        if (isset($ramlType['type']) && !is_array($ramlType['type'])) {
            $parentType = isset($ramlTypes[$ramlType['type']]) ? $ramlTypes[$ramlType['type']] : [];
            $parentProperties = $this->resolveProperties($ramlTypes, $parentType);
        } else {
            $parentProperties = [];
        }
        if (isset($ramlType['properties'])) {
            $properties = array_map(
                [$this, 'parseProperty'],
                array_keys($ramlType['properties']),
                $ramlType['properties']
            );
            $properties = array_combine(array_map(function ($property) {
                return $property['name'];
            }, $properties), $properties);
        } else {
            $properties = [];
        }
        foreach ($properties as $name => $property) {
            $parentProperty = isset($parentProperties[$name]) ? $parentProperties[$name] : [];
            $parentProperties[$name] = $this->mergeProperty($parentProperty, $property);
        }
        return $parentProperties;
    }

    private function mergeProperty($parentProperty, $property)
    {
        foreach ($property as $key => $value) {
            if (is_array($property[$key])) {
                $parentPropertyValue = isset($parentProperty[$key]) ? $parentProperty[$key] : [];
                $parentProperty[$key] = array_merge($parentPropertyValue, $property[$key]);
            } else if (isset($property[$key])) {
                $parentProperty[$key] = $property[$key];
            }
        }

        return $parentProperty;
    }

    private function parseProperty($key, $property)
    {
        $name = str_replace('?', '', $key);
        if (!is_array($property)) {
            $property = ['type' => $property];
        }
        $property['name'] = $name;
        $optional = strpos($key, '?') > 0;
        $property['required'] = isset($property['required']) ? ($property['required'] == true) : !$optional;
        return $property;
    }

    public function getModelClasses($searchPath)
    {
        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($searchPath));
        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

        $modelClasses = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getFileClassName($phpFile->getRealPath());
            if (strpos($class, 'Core\\Helper') > 0) {
                continue;
            }

            if (!empty($class)) {
                if (in_array(JsonObject::class, class_parents($class))) {
                    $modelClasses[$class] = $class;
                }
            }
        }

        return $modelClasses;
    }

    private function getFixtures($modelClasses, $ramlInfos, $classNameField)
    {
        return array_filter(
            $ramlInfos,
            function ($fixture) use ($modelClasses, $classNameField) {
                $className = $fixture[$classNameField];
                return class_exists($className) && isset($modelClasses[$className]);
            }
        );
    }

    private function getFixtureClasses($fixtures, $classNameField)
    {
        return array_flip(array_map(function ($fixture) use ($classNameField) {
            return $fixture[$classNameField];
        }, $fixtures));
    }

    private function getFileClassName($fileName)
    {
        $content = file_get_contents($fileName);
        $tokens = token_get_all($content);
        $namespace = '';
        for ($index = 0; isset($tokens[$index]); $index++) {
            if (!isset($tokens[$index][0])) {
                continue;
            }
            if (T_NAMESPACE === $tokens[$index][0]) {
                $index += 2; // Skip namespace keyword and whitespace
                while (isset($tokens[$index]) && is_array($tokens[$index])) {
                    $namespace .= $tokens[$index++][1];
                }
            }
            if (T_CLASS === $tokens[$index][0]) {
                $index += 2; // Skip class keyword and whitespace
                $class = $namespace.'\\'.$tokens[$index][1];
                return $class;
            }
        }

        return null;
    }

    protected function pascalcase($scored)
    {
        return ucfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode('-', $scored)
                    )
                )
            )
        );
    }

    private function ramlToModelMap()
    {
        return [
            'Common\GeoJsonPoint' => 'Common\GeoPoint',
            'Common\AssetDimensions' => 'Common\AssetDimension',
            'Cart\TaxPortion' => 'Common\TaxPortion',
            'Common\GeoJson' => 'Common\GeoLocation',
            'Product\Attribute' => 'Common\Attribute',
            'ProductType\AttributeLocalizedEnumValue' => 'Common\LocalizedEnum',
            'Common\ImageDimensions' => 'Common\ImageDimension',
            'Cart\TaxedPrice' => 'Common\TaxedPrice',
            'ProductType\AttributePlainEnumValue' => 'Common\Enum',
            'Cart\TaxedItemPrice' => 'Common\TaxedItemPrice',
            'Subscription\SubscriptionDelivery' => 'Subscription\Delivery',
            'Subscription\SnsDestination' => 'Subscription\SNSDestination',
            'Subscription\IronMqDestination' => 'Subscription\IronMQDestination',
            'Subscription\SqsDestination' => 'Subscription\SQSDestination',
            'ShoppingList\ShoppingListLineItemDraft' => 'ShoppingList\LineItemDraft',
            'ShoppingList\ShoppingListLineItem' => 'ShoppingList\LineItem',
            'Inventory\InventoryEntryDraft' => 'Inventory\InventoryDraft',
            'Cart\DiscountedLineItemPriceForQuantity' => 'Cart\DiscountedPricePerQuantity',
            'CartDiscount\CartDiscountValueAbsolute' => 'CartDiscount\AbsoluteCartDiscountValue',
            'CartDiscount\CartDiscountValueRelative' => 'CartDiscount\RelativeCartDiscountValue',
            'CartDiscount\CartDiscountValueGiftLineItem' => 'CartDiscount\GiftLineItemCartDiscountValue',
            'CartDiscount\CartDiscountShippingCostTarget' => 'CartDiscount\ShippingCostTarget',
            'CartDiscount\CartDiscountLineItemsTarget' => 'CartDiscount\LineItemsTarget',
            'CartDiscount\CartDiscountCustomLineItemsTarget' => 'CartDiscount\CustomLineItemsTarget',
            'Customer\CustomerSignInResult' => 'Customer\CustomerSigninResult',
            'Me\MyLineItemDraft' => 'Cart\MyLineItemDraft',
            'Me\MyCartDraft' => 'Cart\MyCartDraft',
            'Me\MyCustomerDraft' => 'Customer\MyCustomerDraft',
            'Me\MyShoppingListDraft' => 'ShoppingList\MyShoppingListDraft',
            'ProductType\AttributeDateType' => 'ProductType\DateType',
            'ProductType\AttributeSetType' => 'ProductType\SetType',
            'ProductType\AttributeEnumType' => 'ProductType\EnumType',
            'ProductType\AttributeNumberType' => 'ProductType\NumberType',
            'ProductType\AttributeLocalizedEnumType' => 'ProductType\LocalizedEnumType',
            'ProductType\AttributeTimeType' => 'ProductType\TimeType',
            'ProductType\AttributeDateTimeType' => 'ProductType\DateTimeType',
            'ProductType\AttributeBooleanType' => 'ProductType\BooleanType',
            'ProductType\AttributeLocalizableTextType' => 'ProductType\LocalizedStringType',
            'ProductType\AttributeReferenceType' => 'ProductType\ReferenceType',
            'ProductType\AttributeMoneyType' => 'ProductType\MoneyType',
            'ProductType\AttributeNestedType' => 'ProductType\NestedType',
            'ProductType\AttributeTextType' => 'ProductType\StringType',
            'Type\CustomFieldDateType' => 'Type\DateType',
            'Type\CustomFieldSetType' => 'Type\SetType',
            'Type\CustomFieldEnumType' => 'Type\EnumType',
            'Type\CustomFieldNumberType' => 'Type\NumberType',
            'Type\CustomFieldLocalizedEnumType' => 'Type\LocalizedEnumType',
            'Type\CustomFieldTimeType' => 'Type\TimeType',
            'Type\CustomFieldDateTimeType' => 'Type\DateTimeType',
            'Type\CustomFieldBooleanType' => 'Type\BooleanType',
            'Type\CustomFieldLocalizedStringType' => 'Type\LocalizedStringType',
            'Type\CustomFieldReferenceType' => 'Type\ReferenceType',
            'Type\CustomFieldMoneyType' => 'Type\MoneyType',
            'Type\CustomFieldStringType' => 'Type\StringType',
            'Product\FacetResultRange' => 'Product\FacetRange',
            'Product\FacetResultTerm' => 'Product\FacetTerm',
            'Message\MessageConfiguration' => 'Message\MessagesConfiguration',
            'Message\MessageConfigurationDraft' => 'Message\MessagesConfigurationDraft',
            'Message\OrderPaymentStateChangedMessage' => 'Message\OrderPaymentChangedMessage',
            'Order\PaymentInfo' => 'Payment\PaymentInfo',
            'Cart\ExternalTaxRateDraft' => 'TaxCategory\ExternalTaxRateDraft',
            'Type\CustomFields' => 'CustomField\CustomFieldObject',
            'Type\FieldContainer' => 'CustomField\FieldContainer',
            'Type\CustomFieldsDraft' => 'CustomField\CustomFieldObjectDraft',
            'Customer\CustomerRemoveBillingAddressIdAction' => 'Customer\CustomerRemoveBillingAddressAction',
            'Customer\CustomerAddBillingAddressIdAction' => 'Customer\CustomerAddBillingAddressAction',
            'Customer\CustomerRemoveShippingAddressIdAction' => 'Customer\CustomerRemoveShippingAddressAction',
            'Customer\CustomerAddShippingAddressIdAction' => 'Customer\CustomerAddShippingAddressAction',
            'ProductType\ProductTypeChangeLocalizedEnumValueLabelAction' => 'ProductType\ProductTypeChangeLocalizedEnumLabelAction',
            'ProductType\ProductTypeChangePlainEnumValueLabelAction' => 'ProductType\ProductTypeChangePlainEnumLabelAction',
            'Product\ProductSetProductPriceCustomFieldAction' => 'Product\ProductSetPriceCustomFieldAction',
            'Product\ProductSetProductPriceCustomTypeAction' => 'Product\ProductSetPriceCustomTypeAction',
            'Order\OrderSetCustomerEmailAction' => 'Order\OrderSetCustomerEmail',
            'Order\OrderSetShippingAddressAction' => 'Order\OrderSetShippingAddress',
            'Order\OrderSetBillingAddressAction' => 'Order\OrderSetBillingAddress',
            'Channel\ChannelSetGeoLocationAction' => 'Channel\ChannelSetGeoLocation',
            'ShippingMethod\CartScoreTier' => 'ShippingMethod\CartScore',
            'ShippingMethod\CartClassificationTier' => 'ShippingMethod\CartClassification',
            'ShippingMethod\CartValueTier' => 'ShippingMethod\CartValue',
            'Extension\ExtensionHttpDestination' => 'Extension\HttpDestination',
            'Extension\ExtensionDestination' => 'Extension\Destination',
            'Extension\ExtensionAWSLambdaDestination' => 'Extension\AWSLambdaDestination',
            'Extension\ExtensionHttpDestinationAuthentication' => 'Extension\HttpDestinationAuthentication',
            'Extension\ExtensionAzureFunctionsAuthentication' => 'Extension\AzureFunctionsAuthentication',
            'Extension\ExtensionAuthorizationHeaderAuthentication' => 'Extension\AuthorizationHeaderAuthentication',
            'Extension\ExtensionTrigger' => 'Extension\Trigger',
        ];
    }

    private function mapRamlToModel($domain, $model)
    {
        $map = $this->ramlToModelMap();
        if (isset($map[$domain . '\\' . $model])) {
            list($domain, $model) = explode('\\', $map[$domain . '\\' . $model], 2);
        }
        return $model;
    }

    private function mapRamlToDomain($domain, $model)
    {
        $map = $this->ramlToModelMap();
        if (isset($map[$domain . '\\' . $model])) {
            list($domain, $model) = explode('\\', $map[$domain . '\\' . $model], 2);
        }
        return $domain;
    }
}
