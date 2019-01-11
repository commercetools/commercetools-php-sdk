<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\Categories\CategoryUpdateByKeyRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateByKeyRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditUpdateByKeyRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateByKeyRequest;
use Commercetools\Core\Request\Products\ProductUpdateByKeyRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateByKeyRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateByKeyRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateByKeyRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionUpdateByKeyRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateByKeyRequest;
use Commercetools\Core\Request\Types\TypeUpdateByKeyRequest;
use Commercetools\Core\RequestTestCase;

class GenericUpdateByKeyRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofKeyAndVersion', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            CategoryUpdateByKeyRequest::class => [
                CategoryUpdateByKeyRequest::class,
                Category::class
            ],
            CustomerGroupUpdateByKeyRequest::class => [
                CustomerGroupUpdateByKeyRequest::class,
                CustomerGroup::class
            ],
            CustomerUpdateByKeyRequest::class => [
                CustomerUpdateByKeyRequest::class,
                Customer::class
            ],
            OrderEditUpdateByKeyRequest::class => [
                OrderEditUpdateByKeyRequest::class,
                OrderEdit::class
            ],
            PaymentUpdateByKeyRequest::class => [
                PaymentUpdateByKeyRequest::class,
                Payment::class
            ],
            ProductUpdateByKeyRequest::class => [
                ProductUpdateByKeyRequest::class,
                Product::class
            ],
            ProductTypeUpdateByKeyRequest::class => [
                ProductTypeUpdateByKeyRequest::class,
                ProductType::class,
            ],
            ReviewUpdateByKeyRequest::class => [
                ReviewUpdateByKeyRequest::class,
                Review::class,
            ],
            ShippingMethodUpdateByKeyRequest::class => [
                ShippingMethodUpdateByKeyRequest::class,
                ShippingMethod::class
            ],
            ShoppingListUpdateByKeyRequest::class => [
                ShoppingListUpdateByKeyRequest::class,
                ShoppingList::class
            ],
            SubscriptionUpdateByKeyRequest::class => [
                SubscriptionUpdateByKeyRequest::class,
                Subscription::class
            ],
            TaxCategoryUpdateByKeyRequest::class => [
                TaxCategoryUpdateByKeyRequest::class,
                TaxCategory::class
            ],
            TypeUpdateByKeyRequest::class => [
                TypeUpdateByKeyRequest::class,
                Type::class,
            ],
        ];
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapResult($requestClass, $resultClass)
    {
        $result = $this->mapResult($requestClass, ['key', 1]);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['key', 1]);
        $this->assertNull($result);
    }


    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testBuilder($requestClass, $resultClass)
    {
        $class = new \ReflectionClass($requestClass);
        $domain = lcfirst(basename(dirname($class->getFileName())));

        $builder = RequestBuilder::of();

        $result = $this->prophesize($resultClass);

        $domainBuilder = $builder->$domain();
        $request = $domainBuilder->updateByKey($result->reveal());
        $this->assertInstanceOf($requestClass, $request);
    }
}
