<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ShippingMethod;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Project\ProjectFixture;
use Commercetools\Core\IntegrationTests\TaxCategory\TaxCategoryFixture;
use Commercetools\Core\IntegrationTests\Zone\ZoneFixture;
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
use Commercetools\Core\Model\ShippingMethod\ShippingRatePriceTierCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;
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
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetLocalizedDescriptionAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetLocalizedNameAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetPredicateAction;

class ShippingMethodUpdateRequestTest extends ApiTestCase
{
    protected function getRateSetPriceFunction()
    {
        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
        $rate->setTiers(
            ShippingRatePriceTierCollection::of()->add(
                CartScore::of()
                    ->setScore(1)
                    ->setPriceFunction(
                        PriceFunction::of()->setCurrencyCode('USD')->setFunction('200 * x')
                    )
            )
        );

        return $rate;
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableDraftShippingMethod(
            $client,
            function (ShippingMethodDraft $draft) {
                return $draft->setKey('test-' . ShippingMethodFixture::uniqueShippingMethodString() . '-update-by-key');
            },
            function (ShippingMethod $shippingMethod) use ($client) {
                $text = 'test-' . ShippingMethodFixture::uniqueShippingMethodString() . '-new-name';

                $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                    ->addAction(ShippingMethodChangeNameAction::ofName($text));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($text, $result->getName());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableDraftShippingMethod(
            $client,
            function (ShippingMethodDraft $draft) {
                return $draft->setKey('test-' . ShippingMethodFixture::uniqueShippingMethodString() . '-update-by-key');
            },
            function (ShippingMethod $shippingMethod) use ($client) {
                $key = 'new-' . ShippingMethodFixture::uniqueShippingMethodString();

                $request = RequestBuilder::of()->shippingMethods()->updateByKey($shippingMethod)
                    ->addAction(ShippingMethodSetKeyAction::of()->setKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetPredicate()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableDraftShippingMethod(
            $client,
            function (ShippingMethodDraft $draft) {
                return $draft->setKey('test-' . ShippingMethodFixture::uniqueShippingMethodString() . '-update-by-key');
            },
            function (ShippingMethod $shippingMethod) use ($client) {
                $predicate = '1 = 1';

                $request = RequestBuilder::of()->shippingMethods()->updateByKey($shippingMethod)
                    ->addAction(ShippingMethodSetPredicateAction::of()->setPredicate($predicate));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($predicate, $result->getPredicate());
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod) use ($client) {
                $name = 'new-name-' . ShippingMethodFixture::uniqueShippingMethodString();

                $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                    ->addAction(ShippingMethodChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($name, $result->getName());
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod) use ($client) {
                $description = 'new-description-' . ShippingMethodFixture::uniqueShippingMethodString();

                $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                    ->addAction(ShippingMethodSetDescriptionAction::of()->setDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($description, $result->getDescription());
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeTaxCategory()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withTaxCategory(
            $client,
            function (TaxCategory $newTaxCategory) use ($client) {
                ShippingMethodFixture::withUpdateableShippingMethod(
                    $client,
                    function (
                        ShippingMethod $shippingMethod,
                        Zone $zone,
                        TaxCategory $oldTaxCategory
                    ) use (
                        $client,
                        $newTaxCategory
                    ) {
                        $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                            ->addAction(
                                ShippingMethodChangeTaxCategoryAction::ofTaxCategory($newTaxCategory->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShippingMethod::class, $result);
                        $this->assertSame($newTaxCategory->getId(), $result->getTaxCategory()->getId());
                        $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                        $oldTaxCategoryReference = $oldTaxCategory->getReference();
                        $shippingMethod = $result;

                        $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                            ->addAction(
                                ShippingMethodChangeTaxCategoryAction::ofTaxCategory($oldTaxCategoryReference)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        return $result;
                    }
                );
            }
        );
    }

    public function testChangeIsDefault()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                $isDefault = true;

                $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                    ->addAction(ShippingMethodChangeIsDefaultAction::ofIsDefault($isDefault));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($isDefault, $result->getIsDefault());
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAddRemoveShippingRate()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));

                $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                    ->addAction(
                        ShippingMethodAddShippingRateAction::ofZoneAndShippingRate($zone->getReference(), $rate)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertCount(2, $result->getZoneRates()->current()->getShippingRates());
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                $actualVersion = $result->getVersion();
                $request = RequestBuilder::of()->shippingMethods()->update($result)
                    ->addAction(ShippingMethodRemoveShippingRateAction::ofZoneAndShippingRate(
                        $zone->getReference(),
                        $rate
                    ));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result->getZoneRates()->current()->getShippingRates());
                $this->assertNotSame($actualVersion, $result->getVersion());

                return $result;
            }
        );
    }

    public function testAddRemoveZone()
    {
        $client = $this->getApiClient();

        ZoneFixture::withZone(
            $client,
            function (Zone $newZone) use ($client) {
                ShippingMethodFixture::withUpdateableShippingMethod(
                    $client,
                    function (ShippingMethod $shippingMethod) use ($client, $newZone) {
                        $actualVersion = $shippingMethod->getVersion();

                        $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                            ->addAction(ShippingMethodAddZoneAction::ofZone($newZone->getReference()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShippingMethod::class, $result);
                        $this->assertGreaterThan(
                            $shippingMethod->getZoneRates()->count(),
                            $result->getZoneRates()->count()
                        );
                        $this->assertNotSame($actualVersion, $result->getVersion());

                        $actualVersion = $result->getVersion();

                        $request = RequestBuilder::of()->shippingMethods()->update($result)
                            ->addAction(
                                ShippingMethodRemoveZoneAction::ofZone($newZone->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShippingMethod::class, $result);
                        $this->assertSame($shippingMethod->getZoneRates()->count(), $result->getZoneRates()->count());
                        $this->assertNotSame($actualVersion, $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testShippingMethodPriceTierClassification()
    {
        $this->markTestSkipped();
        $client = $this->getApiClient();

        ProjectFixture::withSetupProject(
            $client,
            function (ProjectUpdateRequest $request) {
                return $request->addAction(
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
            },
            function (Project $project) use ($client) {
                ShippingMethodFixture::withUpdateableShippingMethod(
                    $client,
                    function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
                        $rate->setTiers(
                            ShippingRatePriceTierCollection::of()->add(
                                CartClassification::of()
                                    ->setValue('small')
                                    ->setPrice(Money::ofCurrencyAndAmount('USD', 90))
                            )
                        );

                        $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                            ->addAction(ShippingMethodAddShippingRateAction::ofZoneAndShippingRate(
                                $zone->getReference(),
                                $rate
                            ));

                        $response = $this->eventually(
                            function () use ($client, $request) {
                                return $this->execute($client, $request, ['X-Vrap-Disable-Validation' => 'response']);
                            }
                        );
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShippingMethod::class, $result);

                        $rate = null;
                        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
                            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                                $rate = $shippingRate;
                            }
                        }
                        $this->assertInstanceOf(ShippingRate::class, $rate);
                        $this->assertInstanceOf(CartClassification::class, $rate->getTiers()->current());

                        return $result;
                    }
                );
            }
        );
    }

    public function testShippingMethodPriceTierScoreFunction()
    {
        $client = $this->getApiClient();

        ProjectFixture::withSetupProject(
            $client,
            function (ProjectUpdateRequest $request) {
                return $request->addAction(
                    ProjectSetShippingRateInputTypeAction::of()
                        ->setShippingRateInputType(CartScoreType::of())
                );
            },
            function (Project $project) use ($client) {
                ShippingMethodFixture::withUpdateableShippingMethod(
                    $client,
                    function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                        $rate = $this->getRateSetPriceFunction();

                        $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                            ->addAction(
                                ShippingMethodAddShippingRateAction::ofZoneAndShippingRate(
                                    $zone->getReference(),
                                    $rate
                                )
                            );
                        $response = $this->eventually(
                            function () use ($client, $request) {
                                return $this->execute($client, $request);
                            }
                        );
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShippingMethod::class, $result);
                        $rate = null;
                        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
                            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                                $rate = $shippingRate;
                            }
                        }
                        $this->assertInstanceOf(ShippingRate::class, $rate);
                        $this->assertInstanceOf(CartScore::class, $rate->getTiers()->current());
                    }
                );
            }
        );
    }

    public function testShippingMethodPriceTierScorePrice()
    {
        $client = $this->getApiClient();

        ProjectFixture::withSetupProject(
            $client,
            function (ProjectUpdateRequest $request) {
                return $request->addAction(
                    ProjectSetShippingRateInputTypeAction::of()
                        ->setShippingRateInputType(CartScoreType::of())
                );
            },
            function (Project $project) use ($client) {
                ShippingMethodFixture::withUpdateableShippingMethod(
                    $client,
                    function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                        $rate = $this->getRateSetPriceFunction();

                        $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                            ->addAction(
                                ShippingMethodAddShippingRateAction::ofZoneAndShippingRate(
                                    $zone->getReference(),
                                    $rate
                                )
                            );
                        $response = $this->eventually(
                            function () use ($client, $request) {
                                return $this->execute($client, $request);
                            }
                        );
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShippingMethod::class, $result);
                        $rate = null;
                        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
                            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                                $rate = $shippingRate;
                            }
                        }
                        $this->assertInstanceOf(ShippingRate::class, $rate);
                        $this->assertInstanceOf(CartScore::class, $rate->getTiers()->current());
                    }
                );
            }
        );
    }

    public function testShippingMethodPriceTierCartValue()
    {
        $client = $this->getApiClient();

        ProjectFixture::withSetupProject(
            $client,
            function (ProjectUpdateRequest $request) {
                return $request->addAction(
                    ProjectSetShippingRateInputTypeAction::of()
                        ->setShippingRateInputType(CartValueType::of())
                );
            },
            function (Project $project) use ($client) {
                ShippingMethodFixture::withUpdateableShippingMethod(
                    $client,
                    function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                        $rate = ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('USD', 100));
                        $rate->setTiers(
                            ShippingRatePriceTierCollection::of()->add(
                                CartValue::of()
                                    ->setMinimumCentAmount(10)
                                    ->setPrice(Money::ofCurrencyAndAmount('USD', 90))
                            )
                        );

                        $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                            ->addAction(
                                ShippingMethodAddShippingRateAction::ofZoneAndShippingRate(
                                    $zone->getReference(),
                                    $rate
                                )
                            );
                        $response = $this->eventually(
                            function () use ($client, $request) {
                                return $this->execute($client, $request);
                            }
                        );
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ShippingMethod::class, $result);
                        $rate = null;
                        foreach ($result->getZoneRates()->current()->getShippingRates() as $shippingRate) {
                            if ($shippingRate->getPrice()->getCurrencyCode() == 'USD') {
                                $rate = $shippingRate;
                            }
                        }
                        $this->assertInstanceOf(ShippingRate::class, $rate);
                        $this->assertInstanceOf(CartValue::class, $rate->getTiers()->current());
                    }
                );
            }
        );
    }

    public function testSetLocalizedDescription()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod) use ($client) {
                $localizedDescription = LocalizedString::ofLangAndText('en', 'localized-description');

                $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                    ->addAction(
                        ShippingMethodSetLocalizedDescriptionAction::of()
                            ->setLocalizedDescription($localizedDescription)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($localizedDescription->en, $result->getLocalizedDescription()->en);
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }


    public function testSetLocalizedName()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withUpdateableShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod) use ($client) {
                $localizedName = LocalizedString::ofLangAndText('en', 'localized-name');

                $request = RequestBuilder::of()->shippingMethods()->update($shippingMethod)
                    ->addAction(
                        ShippingMethodSetLocalizedNameAction::of()
                            ->setLocalizedName($localizedName)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ShippingMethod::class, $result);
                $this->assertSame($localizedName->en, $result->getLocalizedName()->en);
                $this->assertNotSame($shippingMethod->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }
}
