<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\Categories\CategoryDeleteByKeyRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteByKeyRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteByKeyRequest;
use Commercetools\Core\Request\Products\ProductDeleteByKeyRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteByKeyRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteByKeyRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteByKeyRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteByKeyRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteByKeyRequest;
use Commercetools\Core\Request\Types\TypeDeleteByKeyRequest;
use Commercetools\Core\RequestTestCase;

class GenericDeleteByKeyRequestTest extends RequestTestCase
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
            CategoryDeleteByKeyRequest::class => [
                CategoryDeleteByKeyRequest::class,
                Category::class
            ],
            CustomerGroupDeleteByKeyRequest::class => [
                CustomerGroupDeleteByKeyRequest::class,
                CustomerGroup::class
            ],
            CustomerDeleteByKeyRequest::class => [
                CustomerDeleteByKeyRequest::class,
                Customer::class
            ],
            PaymentDeleteByKeyRequest::class => [
                PaymentDeleteByKeyRequest::class,
                Payment::class
            ],
            ProductDeleteByKeyRequest::class => [
                ProductDeleteByKeyRequest::class,
                Product::class
            ],
            ProductTypeDeleteByKeyRequest::class => [
                ProductTypeDeleteByKeyRequest::class,
                ProductType::class,
            ],
            ReviewDeleteByKeyRequest::class => [
                ReviewDeleteByKeyRequest::class,
                Review::class,
            ],
            ShippingMethodDeleteByKeyRequest::class => [
                ShippingMethodDeleteByKeyRequest::class,
                ShippingMethod::class
            ],
            ShoppingListDeleteByKeyRequest::class => [
                ShoppingListDeleteByKeyRequest::class,
                ShoppingList::class
            ],
            SubscriptionDeleteByKeyRequest::class => [
                SubscriptionDeleteByKeyRequest::class,
                Subscription::class
            ],
            TaxCategoryDeleteByKeyRequest::class => [
                TaxCategoryDeleteByKeyRequest::class,
                TaxCategory::class
            ],
            TypeDeleteByKeyRequest::class => [
                TypeDeleteByKeyRequest::class,
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
        $request = $domainBuilder->deleteByKey($result->reveal());
        $this->assertInstanceOf($requestClass, $request);
    }
}
