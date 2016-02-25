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
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeIsDefaultAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeNameAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeTaxCategoryAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetDescriptionAction;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;

class ShippingMethodUpdateRequestTest extends ApiTestCase
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
     * @param $name
     * @return ShippingMethodDraft
     */
    protected function getDraft($name)
    {
        $draft = ShippingMethodDraft::ofNameTaxCategoryZoneRateAndDefault(
            'test-' . $this->getTestRun() . '-' . $name,
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

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $shippingMethod = $this->createShippingMethod($draft);


        $name = $this->getTestRun() . '-new-name';
        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        )
            ->addAction(ShippingMethodChangeNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $shippingMethod = $this->createShippingMethod($draft);


        $description = $this->getTestRun() . '-new-description';
        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        )
            ->addAction(ShippingMethodSetDescriptionAction::of()->setDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
        $this->assertSame($description, $result->getDescription());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
    }

    public function testChangeTaxCategory()
    {
        $draft = $this->getDraft('change-tax-category');
        $shippingMethod = $this->createShippingMethod($draft);

        $taxCategoryDraft = TaxCategoryDraft::ofNameAndRates(
            'test-' . $this->getTestRun() . '-new-name',
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
        $newTaxCategory = $request->mapResponse($response);

        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        )
            ->addAction(ShippingMethodChangeTaxCategoryAction::ofTaxCategory($newTaxCategory->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
        $this->assertSame($newTaxCategory->getId(), $result->getTaxCategory()->getId());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();
        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);

        $request = TaxCategoryDeleteRequest::ofIdAndVersion(
            $this->taxCategory->getId(),
            $this->taxCategory->getVersion()
        );
        $request->executeWithClient($this->getClient());
    }

    public function testChangeIsDefault()
    {
        $draft = $this->getDraft('change-is-default');
        $shippingMethod = $this->createShippingMethod($draft);


        $isDefault = true;
        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        )
            ->addAction(ShippingMethodChangeIsDefaultAction::ofIsDefault($isDefault))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);

        $this->assertSame($isDefault, $result->getIsDefault());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
    }

    public function testAddRemoveShippingRate()
    {
        $draft = $this->getDraft('shipping-rates');
        $shippingMethod = $this->createShippingMethod($draft);
        $actualVersion = $shippingMethod->getVersion();

        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $actualVersion
        )
            ->addAction(ShippingMethodAddShippingRateAction::ofZoneAndShippingRate(
                $this->getZone()->getReference(),
                $rate
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);


        $this->assertCount(2, $result->getZoneRates()->current()->getShippingRates());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());
        $actualVersion = $result->getVersion();

        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $actualVersion
        )
            ->addAction(ShippingMethodRemoveShippingRateAction::ofZoneAndShippingRate(
                $this->getZone()->getReference(),
                $rate
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result->getZoneRates()->current()->getShippingRates());
        $this->assertNotSame($actualVersion, $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
    }

    public function testAddRemoveZone()
    {
        $draft = $this->getDraft('shipping-rates');
        $shippingMethod = $this->createShippingMethod($draft);
        $actualVersion = $shippingMethod->getVersion();

        $zoneDraft = ZoneDraft::ofNameAndLocations(
            'test-' . $this->getTestRun() . '-new-name',
            LocationCollection::of()->add(
                Location::of()->setCountry('DE')->setState('new-' . $this->getState())
            )
        );
        $request = ZoneCreateRequest::ofDraft($zoneDraft);
        $response = $request->executeWithClient($this->getClient());
        $zone = $request->mapResponse($response);

        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $actualVersion
        )
            ->addAction(ShippingMethodAddZoneAction::ofZone($zone->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
        $this->assertGreaterThan($shippingMethod->getZoneRates()->count(), $result->getZoneRates()->count());
        $this->assertNotSame($actualVersion, $result->getVersion());

        $actualVersion = $result->getVersion();
        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $actualVersion
        )
            ->addAction(ShippingMethodRemoveZoneAction::ofZone($zone->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
        $this->assertSame($shippingMethod->getZoneRates()->count(), $result->getZoneRates()->count());
        $this->assertNotSame($actualVersion, $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\ShippingMethod\ShippingMethod', $result);
    }
}
