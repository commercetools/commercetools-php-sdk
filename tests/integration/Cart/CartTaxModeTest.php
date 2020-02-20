<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Cart;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\ShippingMethod\ShippingMethodFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraftCollection;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Model\TaxCategory\SubRate;
use Commercetools\Core\Model\TaxCategory\SubRateCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxModeAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxRateAction;

class CartTaxModeTest extends ApiTestCase
{
    public function testCreateWithTaxModeExternal()
    {
        $client = $this->getApiClient();

        CartFixture::withDraftCart(
            $client,
            function (CartDraft $draft) {
                return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
            },
            function (Cart $cart) use ($client) {
                $this->assertSame(Cart::TAX_MODE_EXTERNAL, $cart->getTaxMode());
            }
        );
    }

    public function testCreateWithTaxModeDisabled()
    {
        $client = $this->getApiClient();

        CartFixture::withDraftCart(
            $client,
            function (CartDraft $draft) {
                return $draft->setTaxMode(Cart::TAX_MODE_DISABLED);
            },
            function (Cart $cart) use ($client) {
                $this->assertSame(Cart::TAX_MODE_DISABLED, $cart->getTaxMode());
            }
        );
    }

    public function testCreateWithTaxModePlatform()
    {
        $client = $this->getApiClient();

        CartFixture::withDraftCart(
            $client,
            function (CartDraft $draft) {
                return $draft->setTaxMode(Cart::TAX_MODE_PLATFORM);
            },
            function (Cart $cart) use ($client) {
                $this->assertSame(Cart::TAX_MODE_PLATFORM, $cart->getTaxMode());
            }
        );
    }

    public function testAddLineItemExternalTaxRate()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                CartFixture::withUpdateableDraftCart(
                    $client,
                    function (CartDraft $draft) {
                        return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
                    },
                    function (Cart $cart) use ($client, $product) {
                        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
                        $taxRateName = 'test';
                        $taxRateCountry = 'DE';
                        $taxRate = 0.1;

                        $request = RequestBuilder::of()->carts()->update($cart)
                            ->addAction(
                                CartAddLineItemAction::ofProductIdVariantIdAndQuantity(
                                    $product->getId(),
                                    $variant->getId(),
                                    1
                                )
                                    ->setExternalTaxRate(
                                        ExternalTaxRateDraft::ofNameCountryAndAmount(
                                            $taxRateName,
                                            $taxRateCountry,
                                            $taxRate
                                        )->setIncludedInPrice(true)
                                    )
                            );
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($taxRateName, $result->getLineItems()->current()->getTaxRate()->getName());
                        $this->assertSame(
                            $taxRateCountry,
                            $result->getLineItems()->current()->getTaxRate()->getCountry()
                        );
                        $this->assertSame($taxRate, $result->getLineItems()->current()->getTaxRate()->getAmount());
                        $this->assertTrue($result->getLineItems()->current()->getTaxRate()->getIncludedInPrice());
                    }
                );
            }
        );
    }

    public function getSubRates()
    {
        return [
            [0.13, [0.06, 0.05, 0.02]],
            [0.1, [0.07, 0.02, 0.01]],
            [0.1, [0.08, 0.02]],
            [0.3, [0.2, 0.1]],
            [0.1, [0.09, 0.01]],
            [0.07, [0.06, 0.01]],
        ];
    }

    /**
     * @dataProvider getSubRates
     */
    public function testAddLineItemExternalTaxSubRates($testTaxRate, array $testSubRates)
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client, $testSubRates, $testTaxRate) {
                CartFixture::withUpdateableDraftCart(
                    $client,
                    function (CartDraft $draft) {
                        return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
                    },
                    function (Cart $cart) use ($client, $product, $testSubRates, $testTaxRate) {
                        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
                        $taxRateName = 'test';
                        $taxRateCountry = 'DE';
                        $subRateCollection = SubRateCollection::of();
                        $i = 1;
                        foreach ($testSubRates as $testSubRate) {
                            $subRateCollection->add(SubRate::of()->setName('test-' . $i)->setAmount($testSubRate));
                            $i++;
                        }

                        $request = RequestBuilder::of()->carts()->update($cart)
                            ->addAction(
                                CartAddLineItemAction::ofProductIdVariantIdAndQuantity(
                                    $product->getId(),
                                    $variant->getId(),
                                    1
                                )->setExternalTaxRate(
                                    ExternalTaxRateDraft::ofNameCountryAmountAndSubRates(
                                        $taxRateName,
                                        $taxRateCountry,
                                        $testTaxRate,
                                        $subRateCollection
                                    )
                                )
                            );
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($taxRateName, $result->getLineItems()->current()->getTaxRate()->getName());
                        $this->assertSame(
                            $taxRateCountry,
                            $result->getLineItems()->current()->getTaxRate()->getCountry()
                        );
                        $this->assertSame($testTaxRate, $result->getLineItems()->current()->getTaxRate()->getAmount());
                        $subRates = [];
                        foreach ($result->getLineItems()->current()->getTaxRate()->getSubRates() as $subRate) {
                            $subRates[] = $subRate->getAmount();
                        }
                        foreach ($testSubRates as $testSubRate) {
                            $this->assertContains($testSubRate, $subRates);
                        }
                    }
                );
            }
        );
    }

    public function testAddLineItemExternalTaxSubRatesOnly()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                CartFixture::withUpdateableDraftCart(
                    $client,
                    function (CartDraft $draft) {
                        return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
                    },
                    function (Cart $cart) use ($client, $product) {
                        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

                        $taxRateName = 'test';
                        $taxRateCountry = 'DE';
                        $taxRate = 0.1;
                        $subRate1 = 0.08;
                        $subRate2 = 0.02;

                        $request = RequestBuilder::of()->carts()->update($cart)
                            ->addAction(
                                CartAddLineItemAction::ofProductIdVariantIdAndQuantity(
                                    $product->getId(),
                                    $variant->getId(),
                                    1
                                )
                                    ->setExternalTaxRate(
                                        ExternalTaxRateDraft::ofNameCountryAndSubRates(
                                            $taxRateName,
                                            $taxRateCountry,
                                            SubRateCollection::of()
                                                ->add(SubRate::of()->setName('test-1')->setAmount($subRate1))
                                                ->add(SubRate::of()->setName('test-2')->setAmount($subRate2))
                                        )
                                    )
                            );
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($taxRateName, $result->getLineItems()->current()->getTaxRate()->getName());
                        $this->assertSame(
                            $taxRateCountry,
                            $result->getLineItems()->current()->getTaxRate()->getCountry()
                        );
                        $this->assertSame($taxRate, $result->getLineItems()->current()->getTaxRate()->getAmount());
                        $this->assertFalse($result->getLineItems()->current()->getTaxRate()->getIncludedInPrice());

                        $subRates = [];
                        foreach ($result->getLineItems()->current()->getTaxRate()->getSubRates() as $subRate) {
                            $subRates[] = $subRate->getAmount();
                        }
                        $this->assertContains($subRate1, $subRates);
                        $this->assertContains($subRate2, $subRates);
                    }
                );
            }
        );
    }

    public function testAddCustomLineItemExternalTaxRate()
    {
        $client = $this->getApiClient();

        CartFixture::withUpdateableDraftCart(
            $client,
            function (CartDraft $draft) {
                return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
            },
            function (Cart $cart) use ($client) {
                $taxRateName = 'test';
                $taxRateCountry = 'DE';
                $taxRate = 0.1;

                $request = RequestBuilder::of()->carts()->update($cart)
                    ->addAction(
                        CartAddCustomLineItemAction::ofNameQuantityMoneySlugAndExternalTaxRate(
                            LocalizedString::ofLangAndText('en', 'Test'),
                            1,
                            Money::ofCurrencyAndAmount('EUR', 100),
                            'test',
                            ExternalTaxRateDraft::ofNameCountryAndAmount($taxRateName, $taxRateCountry, $taxRate)
                                ->setIncludedInPrice(false)
                        )
                    );
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($taxRateName, $result->getCustomLineItems()->current()->getTaxRate()->getName());
                $this->assertSame(
                    $taxRateCountry,
                    $result->getCustomLineItems()->current()->getTaxRate()->getCountry()
                );
                $this->assertSame($taxRate, $result->getCustomLineItems()->current()->getTaxRate()->getAmount());
                $this->assertFalse($result->getCustomLineItems()->current()->getTaxRate()->getIncludedInPrice());
            }
        );
    }

    /**
     * @dataProvider getSubRates
     */
    public function testAddCustomLineItemExternalTaxSubRates($testTaxRate, array $testSubRates)
    {
        $client = $this->getApiClient();

        CartFixture::withUpdateableDraftCart(
            $client,
            function (CartDraft $draft) {
                return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
            },
            function (Cart $cart) use ($client, $testSubRates, $testTaxRate) {
                $taxRateName = 'test';
                $taxRateCountry = 'DE';
                $i = 1;
                $subRateCollection = SubRateCollection::of();
                foreach ($testSubRates as $testSubRate) {
                    $subRateCollection->add(SubRate::of()->setName('test-' . $i)->setAmount($testSubRate));
                    $i++;
                }

                $request = RequestBuilder::of()->carts()->update($cart)
                    ->addAction(
                        CartAddCustomLineItemAction::ofNameQuantityMoneySlugAndExternalTaxRate(
                            LocalizedString::ofLangAndText('en', 'Test'),
                            1,
                            Money::ofCurrencyAndAmount('EUR', 100),
                            'test',
                            ExternalTaxRateDraft::ofNameCountryAmountAndSubRates(
                                $taxRateName,
                                $taxRateCountry,
                                $testTaxRate,
                                $subRateCollection
                            )
                        )
                    );
                $response = $client->execute($request);
                $cart = $request->mapFromResponse($response);

                $this->assertSame($taxRateName, $cart->getCustomLineItems()->current()->getTaxRate()->getName());
                $this->assertSame($taxRateCountry, $cart->getCustomLineItems()->current()->getTaxRate()->getCountry());
                $this->assertSame($testTaxRate, $cart->getCustomLineItems()->current()->getTaxRate()->getAmount());
                $subRates = [];
                foreach ($cart->getCustomLineItems()->current()->getTaxRate()->getSubRates() as $subRate) {
                    $subRates[] = $subRate->getAmount();
                }
                foreach ($testSubRates as $testSubRate) {
                    $this->assertContains($testSubRate, $subRates);
                }
            }
        );
    }

    public function testAddCustomLineItemExternalTaxSubRatesOnly()
    {
        $client = $this->getApiClient();

        CartFixture::withUpdateableDraftCart(
            $client,
            function (CartDraft $draft) {
                return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
            },
            function (Cart $cart) use ($client) {
                $taxRateName = 'test';
                $taxRateCountry = 'DE';
                $taxRate = 0.1;
                $subRate1 = 0.08;
                $subRate2 = 0.02;

                $request = RequestBuilder::of()->carts()->update($cart)
                    ->addAction(
                        CartAddCustomLineItemAction::ofNameQuantityMoneySlugAndExternalTaxRate(
                            LocalizedString::ofLangAndText('en', 'Test'),
                            1,
                            Money::ofCurrencyAndAmount('EUR', 100),
                            'test',
                            ExternalTaxRateDraft::ofNameCountryAndSubRates(
                                $taxRateName,
                                $taxRateCountry,
                                SubRateCollection::of()
                                    ->add(SubRate::of()->setName('test-1')->setAmount($subRate1))
                                    ->add(SubRate::of()->setName('test-2')->setAmount($subRate2))
                            )
                        )
                    );
                $response = $client->execute($request);
                $cart = $request->mapFromResponse($response);

                $this->assertSame($taxRateName, $cart->getCustomLineItems()->current()->getTaxRate()->getName());
                $this->assertSame($taxRateCountry, $cart->getCustomLineItems()->current()->getTaxRate()->getCountry());
                $this->assertSame($taxRate, $cart->getCustomLineItems()->current()->getTaxRate()->getAmount());

                $subRates = [];
                foreach ($cart->getCustomLineItems()->current()->getTaxRate()->getSubRates() as $subRate) {
                    $subRates[] = $subRate->getAmount();
                }
                $this->assertContains($subRate1, $subRates);
                $this->assertContains($subRate2, $subRates);
            }
        );
    }

    public function testSetCustomLineItemExternalTaxRate()
    {
        $client = $this->getApiClient();

        CartFixture::withUpdateableDraftCart(
            $client,
            function (CartDraft $draft) {
                return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL)
                    ->setCustomLineItems(
                        CustomLineItemDraftCollection::of()->add(
                            CustomLineItemDraft::ofNameMoneySlugAndQuantity(
                                LocalizedString::ofLangAndText('en', 'Test'),
                                Money::ofCurrencyAndAmount('EUR', 100),
                                'test',
                                1
                            )
                        )
                    );
            },
            function (Cart $cart) use ($client) {
                $taxRateName = 'test';
                $taxRateCountry = 'DE';
                $taxRate = 0.1;

                $request = RequestBuilder::of()->carts()->update($cart)
                    ->addAction(
                        CartSetCustomLineItemTaxRateAction::ofCustomLineItemId(
                            $cart->getCustomLineItems()->current()->getId()
                        )->setExternalTaxRate(
                            ExternalTaxRateDraft::ofNameCountryAndAmount(
                                $taxRateName,
                                $taxRateCountry,
                                $taxRate
                            )
                        )
                    );
                $response = $client->execute($request);
                $cart = $request->mapFromResponse($response);

                $this->assertSame($taxRateName, $cart->getCustomLineItems()->current()->getTaxRate()->getName());
                $this->assertSame($taxRateCountry, $cart->getCustomLineItems()->current()->getTaxRate()->getCountry());
                $this->assertSame($taxRate, $cart->getCustomLineItems()->current()->getTaxRate()->getAmount());
            }
        );
    }

    public function testSetLineItemExternalTaxRate()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                CartFixture::withUpdateableDraftCart(
                    $client,
                    function (CartDraft $draft) use ($product) {
                        return $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL)
                            ->setLineItems(
                                LineItemDraftCollection::of()->add(
                                    LineItemDraft::ofProductIdVariantIdAndQuantity(
                                        $product->getId(),
                                        $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                                        1
                                    )
                                )
                            );
                    },
                    function (Cart $cart) use ($client, $product) {
                        $taxRateName = 'test';
                        $taxRateCountry = 'DE';
                        $taxRate = 0.1;

                        $request = RequestBuilder::of()->carts()->update($cart)
                            ->addAction(
                                CartSetLineItemTaxRateAction::ofLineItemId($cart->getLineItems()->current()->getId())
                                    ->setExternalTaxRate(
                                        ExternalTaxRateDraft::ofNameCountryAndAmount(
                                            $taxRateName,
                                            $taxRateCountry,
                                            $taxRate
                                        )
                                    )
                            );
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($taxRateName, $result->getLineItems()->current()->getTaxRate()->getName());
                        $this->assertSame(
                            $taxRateCountry,
                            $result->getLineItems()->current()->getTaxRate()->getCountry()
                        );
                        $this->assertSame($taxRate, $result->getLineItems()->current()->getTaxRate()->getAmount());
                    }
                );
            }
        );
    }

    public function testSetShippingMethodExternalTaxRate()
    {
        $client = $this->getApiClient();

        ShippingMethodFixture::withShippingMethod(
            $client,
            function (ShippingMethod $shippingMethod, Zone $zone) use ($client) {
                CartFixture::withUpdateableDraftCart(
                    $client,
                    function (CartDraft $cartDraft) use ($shippingMethod, $zone) {
                        $cartDraft->setShippingAddress(
                            Address::of()->setCountry($zone->getLocations()->current()->getCountry())
                                ->setState($zone->getLocations()->current()->getState())
                        )->setShippingMethod($shippingMethod->getReference())->setTaxMode(Cart::TAX_MODE_EXTERNAL);

                        return $cartDraft;
                    },
                    function (Cart $cart) use ($client, $shippingMethod) {
                        $taxRateName = 'test';
                        $taxRateCountry = 'DE';
                        $taxRate = 0.1;

                        $request = RequestBuilder::of()->carts()->update($cart)
                            ->addAction(
                                CartSetShippingMethodTaxRateAction::of()
                                    ->setExternalTaxRate(
                                        ExternalTaxRateDraft::ofNameCountryAndAmount(
                                            $taxRateName,
                                            $taxRateCountry,
                                            $taxRate
                                        )
                                    )
                            );
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($taxRateName, $result->getShippingInfo()->getTaxRate()->getName());
                        $this->assertSame($taxRateCountry, $result->getShippingInfo()->getTaxRate()->getCountry());
                        $this->assertSame($taxRate, $result->getShippingInfo()->getTaxRate()->getAmount());
                    }
                );
            }
        );
    }

    public function testChangeTaxMode()
    {
        $client = $this->getApiClient();
        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client, $taxRateName, $taxRateCountry, $taxRate) {
                CartFixture::withUpdateableDraftCart(
                    $client,
                    function (CartDraft $draft) use ($product, $taxRateName, $taxRateCountry, $taxRate) {
                        return $draft->setLineItems(
                            LineItemDraftCollection::of()->add(
                                LineItemDraft::ofProductIdVariantIdAndQuantity(
                                    $product->getId(),
                                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                                    1
                                )->setExternalTaxRate(
                                    ExternalTaxRateDraft::ofNameCountryAndAmount(
                                        $taxRateName,
                                        $taxRateCountry,
                                        $taxRate
                                    )
                                )
                            )
                        )->setTaxMode(Cart::TAX_MODE_EXTERNAL);
                    },
                    function (Cart $cart) use ($client, $product, $taxRateName, $taxRateCountry, $taxRate) {
                        $this->assertSame($taxRateName, $cart->getLineItems()->current()->getTaxRate()->getName());
                        $this->assertSame(
                            $taxRateCountry,
                            $cart->getLineItems()->current()->getTaxRate()->getCountry()
                        );
                        $this->assertSame($taxRate, $cart->getLineItems()->current()->getTaxRate()->getAmount());

                        $request = RequestBuilder::of()->carts()->update($cart)
                            ->addAction(
                                CartChangeTaxModeAction::of()->setTaxMode(Cart::TAX_MODE_PLATFORM)
                            );
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertNull($result->getLineItems()->current()->getTaxRate());
                    }
                );
            }
        );
    }
}
