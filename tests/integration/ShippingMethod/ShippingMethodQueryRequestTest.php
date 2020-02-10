<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ShippingMethod;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\TaxCategory\TaxCategoryFixture;
use Commercetools\Core\IntegrationTests\Zone\ZoneFixture;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Zone\Location as Location;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByLocationGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;

class ShippingMethodQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod) use ($client) {
                $request = RequestBuilder::of()->shippingMethods()->query()
                    ->where('name=:name', ['name' => $shippingMethod->getName()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(ShippingMethod::class, $result->current());
                $this->assertSame($shippingMethod->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod) use ($client) {
                $request = RequestBuilder::of()->shippingMethods()->getById($shippingMethod->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $shippingMethod);
                $this->assertSame($shippingMethod->getId(), $result->getId());
            }
        );
    }

    public function testByLocation()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                $request = RequestBuilder::of()->shippingMethods()->getByLocation($zone->getLocations()->current());
                $request->expand('taxCategory.id');

                $response = $this->execute($client, $request, ['X-Vrap-Disable-Validation' => 'response']);

                $result = $request->mapFromResponse($response);

                $this->assertTrue(
                    $result->current()->getZoneRates()->current()->getShippingRates()->current()->getIsMatching()
                );
                $this->assertInstanceOf(ShippingMethodCollection::class, $result);
                $this->assertSame($shippingMethod->getId(), $result->current()->getId());
                $this->assertInstanceOf(TaxCategory::class, $result->current()->getTaxCategory()->getObj());
            }
        );
    }
}
