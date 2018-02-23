<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Commercetools\Core\Model\Common\JsonObject;
use Symfony\Component\Yaml\Yaml;


class RamlModelTest extends AbstractModelTest
{
    const RAML_MODEL_PATH = __DIR__ . '/../../../vendor/commercetools/commercetools-api-reference/types/';
    const MODEL_PATH = __DIR__ . '/../../../src/Core/Model';
    const COMMAND_PATH = __DIR__ . '/../../../src/Core/Request';

    /**
     * @dataProvider modelFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function modelValidProperties($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        $validFields = array_flip($validFields);
        foreach ($object->fieldDefinitions() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @test
     * @dataProvider modelFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function modelPropertiesExist($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->fieldDefinitions(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
    }

    /**
     * @test
     * @dataProvider commandFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function commandValidProperties($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        $validFields = array_flip($validFields);
        foreach ($object->fieldDefinitions() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @test
     * @dataProvider commandFieldProvider
     * @param string $className
     * @param array $validFields
     */
    public function commandPropertiesExist($className, array $validFields = [])
    {
        $object = $this->getInstance($className);

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->fieldDefinitions(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
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
            case 'Inventory':
                break;
            default:
                $domain .= 's';
                break;
        }
        return 'Commercetools\\Core\\Request\\' . ucfirst($domain) . '\\Command\\' . ucfirst($model);
    }

    public function modelFieldProvider()
    {
        return $this->objectFieldProvider(static::MODEL_PATH);
    }

    public function commandFieldProvider()
    {
        return $this->objectFieldProvider(static::COMMAND_PATH, 'getCommandClass');
    }

    public function objectFieldProvider($searchPath, $classNameBuilder = 'getClassName') {
        $ramlTypesFile = static::RAML_MODEL_PATH . 'types.raml';
        if (!file_exists($ramlTypesFile)) {
            return [];
        }
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
            $domain = $this->mapRamlToDomain($package, $typeName);
            $model = $this->mapRamlToModel($package, $typeName);
            $className = $this->$classNameBuilder($domain, $model);
            $fields = $this->resolveProperties($ramlTypes, $ramlType);
            $fields = array_filter(
                $fields,
                function ($field) {
                    return strpos($field, '/') === false;
                }
            );
            $ramlInfos[$typeName] = [
                'class' => $className,
                'fields' => $fields,
                'domain' => $package,
                'model' => $typeName,
            ];
        }

        $fixtures = array_filter(
            $ramlInfos,
            function ($fixture) use ($modelClasses) {
                $className = $fixture['class'];
                return class_exists($className) && isset($modelClasses[$className]);
            }
        );

        return array_filter(
            $fixtures,
            function ($fixture) use ($modelClasses) {
                return count($fixture['fields']) > 0;
            }
        );
    }

    private function getUncoveredClassed($modelClasses, $fixtures) {
        $fixtureClasses = array_flip(array_map(function ($fixture) { return $fixture['class']; }, $fixtures));
        $filteredClasses = array_filter(
            $modelClasses,
            function ($class) use ($fixtureClasses) {
                $t = new \ReflectionClass($class);
                return !isset($fixtureClasses[$class])
                    && strpos($t->getDocComment(), '@deprecated') === false
                    && !$t->isAbstract();
            }
        );
        return $filteredClasses;
    }

    private function resolveProperties($ramlTypes, $ramlType)
    {
        if (isset($ramlType['type'])) {
            $parentType = isset($ramlTypes[$ramlType['type']]) ? $ramlTypes[$ramlType['type']] : [];
            $parentProperties = $this->resolveProperties($ramlTypes, $parentType);
        } else {
            $parentProperties = [];
        }
        if (isset($ramlType['properties'])) {
            $properties = array_map(
                function ($property) {
                    return str_replace('?', '', $property);
                },
                array_keys($ramlType['properties'])
            );
        } else {
            $properties = [];
        }
        return array_merge($parentProperties, $properties);
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
            'Channel\ChannelSetGeolocationAction' => 'Channel\ChannelSetGeoLocation',
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
