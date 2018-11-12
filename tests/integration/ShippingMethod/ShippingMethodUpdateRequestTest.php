<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\ShippingMethod;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Project\CartClassificationType;
use Commercetools\Core\Model\Project\CartScoreType;
use Commercetools\Core\Model\Project\CartValueType;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Model\ShippingMethod\CartClassification;
use Commercetools\Core\Model\ShippingMethod\CartScore;
use Commercetools\Core\Model\ShippingMethod\CartValue;
use Commercetools\Core\Model\ShippingMethod\PriceFunction;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ShippingRatePriceTierCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Request\Project\ProjectUpdateRequest;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeIsDefaultAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeNameAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeTaxCategoryAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetDescriptionAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetKeyAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetPredicateAction;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateByKeyRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;

class ShippingMethodUpdateRequestTest extends ApiTestCase
{
    public function tearDown()
    {
        parent::tearDown();
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        if ($project instanceof Project) {
            $request = ProjectUpdateRequest::ofVersion($project->getVersion());
            $request->addAction(ProjectSetShippingRateInputTypeAction::of());
            $request->executeWithClient($this->getClient());
        }
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

        $this->cleanupRequests[] = $this->deleteRequest = ShippingMethodDeleteRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        );

        return $shippingMethod;
    }

    public function testUpdateByKey()
    {
        $draft = $this->getDraft('update-by-key');
        $draft->setKey('test-' . $this->getTestRun() . '-update-by-key');
        $shippingMethod = $this->createShippingMethod($draft);

        $text = 'test-' . $this->getTestRun() . '-new-name';
        $request = ShippingMethodUpdateByKeyRequest::ofKeyAndVersion($shippingMethod->getKey(), $shippingMethod->getVersion())
            ->addAction(
                ShippingMethodChangeNameAction::ofName($text)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $this->assertSame($text, $result->getName());
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $draft->setKey('test-' . $this->getTestRun() . '-update-by-key');
        $shippingMethod = $this->createShippingMethod($draft);

        $key = 'new-' . $this->getTestRun();
        $request = ShippingMethodUpdateByKeyRequest::ofKeyAndVersion($shippingMethod->getKey(), $shippingMethod->getVersion())
            ->addAction(
                ShippingMethodSetKeyAction::of()->setKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());
    }

    public function testSetPredicate()
    {
        $draft = $this->getDraft('set-predicate');
        $draft->setKey('test-' . $this->getTestRun() . '-update-by-key');
        $shippingMethod = $this->createShippingMethod($draft);

        $predicate = '1 = 1';
        $request = ShippingMethodUpdateByKeyRequest::ofKeyAndVersion($shippingMethod->getKey(), $shippingMethod->getVersion())
            ->addAction(
                ShippingMethodSetPredicateAction::of()->setPredicate($predicate)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $this->assertSame($predicate, $result->getPredicate());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $this->assertSame($description, $result->getDescription());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());
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
                    ->setState($this->getRegion())
            )
        );
        $request = TaxCategoryCreateRequest::ofDraft($taxCategoryDraft);
        $response = $request->executeWithClient($this->getClient());
        $newTaxCategory = $request->mapResponse($response);

        $oldTaxCategory = $shippingMethod->getTaxCategory();
        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        )
            ->addAction(ShippingMethodChangeTaxCategoryAction::ofTaxCategory($newTaxCategory->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $this->assertSame($newTaxCategory->getId(), $result->getTaxCategory()->getId());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());
        $shippingMethod = $result;

        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $shippingMethod->getVersion()
        )
            ->addAction(ShippingMethodChangeTaxCategoryAction::ofTaxCategory($oldTaxCategory))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $deleteRequest = TaxCategoryDeleteRequest::ofIdAndVersion(
            $newTaxCategory->getId(),
            $newTaxCategory->getVersion()
        );
        $this->getClient()->execute($deleteRequest);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);

        $this->assertSame($isDefault, $result->getIsDefault());
        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);


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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertCount(1, $result->getZoneRates()->current()->getShippingRates());
        $this->assertNotSame($actualVersion, $result->getVersion());
    }

    public function testAddRemoveZone()
    {
        $draft = $this->getDraft('shipping-rates');
        $shippingMethod = $this->createShippingMethod($draft);
        $actualVersion = $shippingMethod->getVersion();

        $zoneDraft = ZoneDraft::ofNameAndLocations(
            'test-' . $this->getTestRun() . '-new-name',
            LocationCollection::of()->add(
                Location::of()->setCountry('DE')->setState('new-' . $this->getRegion())
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $this->assertSame($shippingMethod->getZoneRates()->count(), $result->getZoneRates()->count());
        $this->assertNotSame($actualVersion, $result->getVersion());

        $deleteRequest = ZoneDeleteRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        );
        $this->getClient()->execute($deleteRequest)->toObject();
    }

    public function testShippingMethodPriceTierClassification()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
            ProjectSetShippingRateInputTypeAction::of()
                ->setShippingRateInputType(
                    CartClassificationType::of()->setValues(
                        LocalizedEnumCollection::of()->add(
                            LocalizedEnum::of()->setKey('small')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'small'))
                        )->add(
                            LocalizedEnum::of()->setKey('medium')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'medium'))
                        )->add(
                            LocalizedEnum::of()->setKey('large')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'large'))
                        )
                    )
                )
        );
        $request->executeWithClient($this->getClient());

        $draft = $this->getDraft('shipping-rate-tiers');
        $shippingMethod = $this->createShippingMethod($draft);
        $actualVersion = $shippingMethod->getVersion();

        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
        $rate->setTiers(
            ShippingRatePriceTierCollection::of()->add(
                CartClassification::of()->setValue('small')->setPrice(Money::ofCurrencyAndAmount('USD', 90))
            )
        );
        $request = ShippingMethodUpdateRequest::ofIdAndVersion(
            $shippingMethod->getId(),
            $actualVersion
        )
            ->addAction(ShippingMethodAddShippingRateAction::ofZoneAndShippingRate(
                $this->getZone()->getReference(),
                $rate
            ))
        ;
        $response = $request->executeWithClient($this->getClient(), ['X-Vrap-Disable-Validation' => 'response']);
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $rate = null;
        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                $rate = $shippingRate;
            }
        }
        $this->assertInstanceOf(ShippingRate::class, $rate);
        $this->assertInstanceOf(
            CartClassification::class,
            $rate->getTiers()->current()
        );
    }

    public function testShippingMethodPriceTierScoreFunction()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
            ProjectSetShippingRateInputTypeAction::of()
                ->setShippingRateInputType(CartScoreType::of())
        );
        $request->executeWithClient($this->getClient());

        $draft = $this->getDraft('shipping-rate-tiers');
        $shippingMethod = $this->createShippingMethod($draft);
        $actualVersion = $shippingMethod->getVersion();

        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
        $rate->setTiers(
            ShippingRatePriceTierCollection::of()->add(
                CartScore::of()
                    ->setScore(1)
                    ->setPriceFunction(PriceFunction::of()->setCurrencyCode('USD')->setFunction('200 * x'))
            )
        );
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $rate = null;
        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                $rate = $shippingRate;
            }
        }
        $this->assertInstanceOf(ShippingRate::class, $rate);
        $this->assertInstanceOf(
            CartScore::class,
            $rate->getTiers()->current()
        );
    }

    public function testShippingMethodPriceTierScorePrice()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
            ProjectSetShippingRateInputTypeAction::of()
                ->setShippingRateInputType(CartScoreType::of())
        );
        $request->executeWithClient($this->getClient());

        $draft = $this->getDraft('shipping-rate-tiers');
        $shippingMethod = $this->createShippingMethod($draft);
        $actualVersion = $shippingMethod->getVersion();

        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
        $rate->setTiers(
            ShippingRatePriceTierCollection::of()->add(
                CartScore::of()
                    ->setScore(1)
                    ->setPrice(Money::ofCurrencyAndAmount('USD', 90))
            )
        );
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $rate = null;
        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                $rate = $shippingRate;
            }
        }
        $this->assertInstanceOf(ShippingRate::class, $rate);
        $this->assertInstanceOf(
            CartScore::class,
            $rate->getTiers()->current()
        );
    }

    public function testShippingMethodPriceTierCartValue()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
            ProjectSetShippingRateInputTypeAction::of()
                ->setShippingRateInputType(CartValueType::of())
        );
        $request->executeWithClient($this->getClient());

        $draft = $this->getDraft('shipping-rate-tiers');
        $shippingMethod = $this->createShippingMethod($draft);
        $actualVersion = $shippingMethod->getVersion();

        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
        $rate->setTiers(
            ShippingRatePriceTierCollection::of()->add(
                CartValue::of()
                    ->setMinimumCentAmount(10)
                    ->setPrice(Money::ofCurrencyAndAmount('USD', 90))
            )
        );
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ShippingMethod::class, $result);
        $rate = null;
        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                $rate = $shippingRate;
            }
        }
        $this->assertInstanceOf(ShippingRate::class, $rate);
        $this->assertInstanceOf(
            CartValue::class,
            $rate->getTiers()->current()
        );
    }
}
