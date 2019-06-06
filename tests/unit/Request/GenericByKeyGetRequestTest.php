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
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\Categories\CategoryByKeyGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByKeyGetRequest;
use Commercetools\Core\Request\Customers\CustomerByKeyGetRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditByKeyGetRequest;
use Commercetools\Core\Request\Payments\PaymentByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductByKeyGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeByKeyGetRequest;
use Commercetools\Core\Request\Reviews\ReviewByKeyGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByKeyGetRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListByKeyGetRequest;
use Commercetools\Core\Request\Stores\StoreByKeyGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionByKeyGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryByKeyGetRequest;
use Commercetools\Core\Request\Types\TypeByKeyGetRequest;
use Commercetools\Core\RequestTestCase;

class GenericByKeyGetRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofKey', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            CategoryByKeyGetRequest::class => [
                CategoryByKeyGetRequest::class,
                Category::class
            ],
            CustomerGroupByKeyGetRequest::class => [
                CustomerGroupByKeyGetRequest::class,
                CustomerGroup::class
            ],
            CustomerByKeyGetRequest::class => [
                CustomerByKeyGetRequest::class,
                Customer::class
            ],
            OrderEditByKeyGetRequest::class => [
                OrderEditByKeyGetRequest::class,
                OrderEdit::class
            ],
            PaymentByKeyGetRequest::class => [
                PaymentByKeyGetRequest::class,
                Payment::class,
            ],
            ProductByKeyGetRequest::class => [
                ProductByKeyGetRequest::class,
                Product::class,
            ],
            ProductTypeByKeyGetRequest::class => [
                ProductTypeByKeyGetRequest::class,
                ProductType::class,
            ],
            ReviewByKeyGetRequest::class => [
                ReviewByKeyGetRequest::class,
                Review::class,
            ],
            ShippingMethodByKeyGetRequest::class => [
                ShippingMethodByKeyGetRequest::class,
                ShippingMethod::class,
            ],
            ShoppingListByKeyGetRequest::class => [
                ShoppingListByKeyGetRequest::class,
                ShoppingList::class,
            ],
            SubscriptionByKeyGetRequest::class => [
                SubscriptionByKeyGetRequest::class,
                Subscription::class,
            ],
            TaxCategoryByKeyGetRequest::class => [
                TaxCategoryByKeyGetRequest::class,
                TaxCategory::class,
            ],
            TypeByKeyGetRequest::class => [
                TypeByKeyGetRequest::class,
                Type::class,
            ],
            StoreByKeyGetRequest::class => [
                StoreByKeyGetRequest::class,
                Store::class,
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
        $result = $this->mapResult($requestClass, ['key']);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['key']);
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

        $domainBuilder = $builder->$domain();
        $request = $domainBuilder->getByKey('');
        $this->assertInstanceOf($requestClass, $request);
    }
}
