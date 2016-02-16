<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\ShippingMethod;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;

class ShippingMethodQueryRequestTest extends ApiTestCase
{
    /**
     * @var TaxCategory
     */
    private $taxCategory;

    /**
     * @var Zone
     */
    private $zone;

    private $state;

    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteTaxCategory();
        $this->deleteZone();
    }

    private function getState()
    {
        if (is_null($this->state)) {
            $this->state = (string)mt_rand(1, 1000);
        }

        return $this->state;
    }

    private function getTaxCategory()
    {
        if (is_null($this->taxCategory)) {
            $taxCategoryDraft = TaxCategoryDraft::ofNameAndRates(
                'test-' . $this->getTestRun() . '-name',
                TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . $this->getTestRun() . '-name')
                        ->setAmount(0.2)
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($this->getState())
                )
            );
            $request = TaxCategoryCreateRequest::ofDraft($taxCategoryDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }

        return $this->taxCategory;
    }

    private function deleteTaxCategory()
    {
        if (!is_null($this->taxCategory)) {
            $request = TaxCategoryDeleteRequest::ofIdAndVersion(
                $this->taxCategory->getId(),
                $this->taxCategory->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }
        $this->taxCategory = null;
    }

    private function getZone()
    {
        if (is_null($this->zone)) {
            $zoneDraft = ZoneDraft::ofNameAndLocations(
                'test-' . $this->getTestRun() . '-name',
                LocationCollection::of()->add(
                    Location::of()->setCountry('DE')->setState($this->getState())
                )
            );
            $request = ZoneCreateRequest::ofDraft($zoneDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->zone = $request->mapResponse($response);
        }

        return $this->zone;
    }

    private function deleteZone()
    {
        if (!is_null($this->zone)) {
            $request = ZoneDeleteRequest::ofIdAndVersion(
                $this->zone->getId(),
                $this->zone->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->zone = $request->mapResponse($response);
        }
        $this->zone = null;
    }

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

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $shippingMethod = $this->createShippingMethod($draft);

        $result = $this->getClient()->execute(
            ShippingMethodQueryRequest::of()->where('name="' . $draft->getName() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result->getAt(0));
        $this->assertSame($shippingMethod->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $shippingMethod = $this->createShippingMethod($draft);

        $result = $this->getClient()->execute(ShippingMethodByIdGetRequest::ofId($shippingMethod->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $shippingMethod);
        $this->assertSame($shippingMethod->getId(), $result->getId());

    }
}
