<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\ShippingMethod;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByLocationGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;

class ShippingMethodQueryRequestTest extends ApiTestCase
{
    /**
     * @return ShippingMethodDraft
     */
    protected function getDraft()
    {
        $draft = ShippingMethodDraft::ofNameTaxCategoryZoneRateAndDefault(
            'test-' . $this->getTestRun() . '-name',
            $this->getTaxCategory()->getReference(),
            ZoneRateCollection::of()->add(
                ZoneRate::of()->setZone($this->getZone()->getReference())
                    ->setShippingRates(
                        ShippingRateCollection::of()->add(
                            ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100))
                        )
                    )
            ),
            false
        );

        return $draft;
    }

    protected function createShippingMethod(ShippingMethodDraft $draft)
    {
        $request = ShippingMethodCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $shippingMethod = $request->mapResponse($response);

        $this->cleanupRequests[] = ShippingMethodDeleteRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        );

        return $shippingMethod;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $shippingMethod = $this->createShippingMethod($draft);

        $request = ShippingMethodQueryRequest::of()->where('name="' . $draft->getName() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(ShippingMethod::class, $result->getAt(0));
        $this->assertSame($shippingMethod->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $shippingMethod = $this->createShippingMethod($draft);

        $request = ShippingMethodByIdGetRequest::ofId($shippingMethod->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ShippingMethod::class, $shippingMethod);
        $this->assertSame($shippingMethod->getId(), $result->getId());
    }

    public function testByLocation()
    {
        $draft = $this->getDraft();
        $shippingMethod = $this->createShippingMethod($draft);

        $request = ShippingMethodByLocationGetRequest::ofCountry('DE')->withState($this->getRegion());
        $response = $request->executeWithClient($this->getClient(), ['X-Vrap-Disable-Validation' => 'response']);
        $result = $request->mapResponse($response);

        $this->assertTrue($result->current()->getZoneRates()->current()->getShippingRates()->current()->getIsMatching());
        $this->assertInstanceOf(ShippingMethodCollection::class, $result);
        $this->assertSame($shippingMethod->getId(), $result->current()->getId());
    }
}
