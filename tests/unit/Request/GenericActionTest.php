<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;


class GenericActionTest extends \PHPUnit_Framework_TestCase
{
    public function actionProvider()
    {
        return [
            [
                '\Sphere\Core\Request\AbstractAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddExternalImageAction',
                ['action', 'variantId', 'image', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddPriceAction',
                ['action', 'variantId', 'price', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddToCategoryAction',
                ['action', 'category', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductAddVariantAction',
                ['action', 'prices', 'sku', 'attributes', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangeNameAction',
                ['action', 'name', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangePriceAction',
                ['action', 'variantId', 'price', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductChangeSlugAction',
                ['action', 'slug', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductPublishAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveFromCategoryAction',
                ['action', 'category', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveImageAction',
                ['action', 'variantId', 'imageUrl', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemovePriceAction',
                ['action', 'variantId', 'price', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRemoveVariantAction',
                ['action', 'id', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductRevertStagedChangesAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetAttributeAction',
                ['action', 'variantId', 'name', 'value', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction',
                ['action', 'name', 'value', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetDescriptionAction',
                ['action', 'description', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetMetaAttributesAction',
                ['action', 'metaTitle', 'metaDescription', 'metaKeywords', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetSearchKeywordsAction',
                ['action', 'searchKeywords', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetSKUAction',
                ['action', 'variantId', 'sku']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductSetTaxCategoryAction',
                ['action', 'taxCategory', 'staged']
            ],
            [
                '\Sphere\Core\Request\Products\Command\ProductUnpublishAction',
                ['action']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddDeliveryAction',
                ['action', 'items', 'parcels', 'measurements', 'trackingData']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction',
                ['action', 'deliveryId', 'measurements', 'trackingData']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderAddReturnInfoAction',
                ['action', 'returnDate', 'returnTrackingId', 'items']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangeOrderStateAction',
                ['action', 'orderState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangePaymentStateAction',
                ['action', 'paymentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderChangeShipmentStateAction',
                ['action', 'shipmentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction',
                ['action', 'customLineItemId', 'state']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderImportLineItemStateAction',
                ['action', 'lineItemId', 'state']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetOrderNumberAction',
                ['action', 'orderNumber']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction',
                ['action', 'returnItemId', 'paymentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction',
                ['action', 'returnItemId', 'shipmentState']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction',
                ['action', 'customLineItemId', 'quantity', 'fromState', 'toState', 'actualTransitionDate']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderTransitionLineItemStateAction',
                ['action', 'lineItemId', 'quantity', 'fromState', 'toState', 'actualTransitionDate']
            ],
            [
                '\Sphere\Core\Request\Orders\Command\OrderUpdateSyncInfoAction',
                ['action', 'channel', 'externalId', 'syncedAt']
            ],
        ];
    }

    /**
     * @dataProvider actionProvider
     * @param string $className
     * @param array $validFields
     */
    public function testValidProperties($className, array $validFields = [])
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = $class->newInstanceWithoutConstructor();
        } else {
            $object = $this->getMockForAbstractClass($className, [], '', false);
        }

        $validFields = array_flip($validFields);
        foreach ($object->getFields() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @dataProvider actionProvider
     * @param string $className
     * @param array $validFields
     */
    public function testPropertiesExist($className, array $validFields = [])
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = $class->newInstanceWithoutConstructor();
        } else {
            $object = $this->getMockForAbstractClass($className, [], '', false);
        }

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->getFields(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
    }
}
