<?php
/**
 */

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\OrderEdit\OrderEditFixture;
use Commercetools\Core\IntegrationTests\ShippingMethod\ShippingMethodFixture;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\Zone\Zone;

class OrderEditQueryRequestTest extends OrderQueryRequestTest
{
    public function testGetById()
    {
        $client = $this->getApiClient();
        OrderEditFixture::withOrderEdit(
            $client,
            function (OrderEdit $orderEdit) use ($client) {
                $request = RequestBuilder::of()->orderEdits()->getById($orderEdit->getId());
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(OrderEdit::class, $result);
                $this->assertSame($orderEdit->getId(), $result->getId());
            }
        );
    }

    public function testQuery()
    {
        $client = $this->getApiClient();
        OrderEditFixture::withOrderEdit(
            $client,
            function (OrderEdit $orderEdit) use ($client) {
                $request = RequestBuilder::of()->orderEdits()->query()
                    ->where('key = :key', ['key' => $orderEdit->getKey()]);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(OrderEdit::class, $result->getAt(0));
                $this->assertSame($orderEdit->getId(), $result->getAt(0)->getId());
            }
        );
    }

    //todo to collocate into ShippingMethodQueryRequestTest after migration and add some assertions
    public function testMatchingOrderEdit()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                OrderEditFixture::withOrderEdit(
                    $client,
                    function (OrderEdit $orderEdit) use ($client, $zone) {
                        $request = RequestBuilder::of()->shippingMethods()
                            ->getMatchingOrderEdit($orderEdit->getId(), $zone->getLocations()->current());
                        $response = $this->execute($client, $request, ['X-Vrap-Disable-Validation' => 'response']);
                        $result = $request->mapFromResponse($response);

                        $this->assertTrue(
                            $result->current()->getZoneRates()->current()->getShippingRates()->current()->getIsMatching()
                        );
                        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
                        $this->assertInstanceOf(TaxCategoryReference::class, $result->current()->getTaxCategory());
                    }
                );
            }
        );
    }
}
