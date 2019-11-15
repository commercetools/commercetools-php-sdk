<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Cart;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraftCollection;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Model\TaxCategory\SubRate;
use Commercetools\Core\Model\TaxCategory\SubRateCollection;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;
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
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $this->assertSame(Cart::TAX_MODE_EXTERNAL, $cart->getTaxMode());
    }

    public function testCreateWithTaxModeDisabled()
    {
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_DISABLED);
        $cart = $this->createCart($draft);

        $this->assertSame(Cart::TAX_MODE_DISABLED, $cart->getTaxMode());
    }

    public function testCreateWithTaxModePlatform()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $this->assertSame(Cart::TAX_MODE_PLATFORM, $cart->getTaxMode());
    }

    public function testAddLineItemExternalTaxRate()
    {
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
                    ->setExternalTaxRate(
                        ExternalTaxRateDraft::ofNameCountryAndAmount($taxRateName, $taxRateCountry, $taxRate)->setIncludedInPrice(true)
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxRateName, $cart->getLineItems()->current()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getLineItems()->current()->getTaxRate()->getCountry());
        $this->assertSame($taxRate, $cart->getLineItems()->current()->getTaxRate()->getAmount());
        $this->assertTrue($cart->getLineItems()->current()->getTaxRate()->getIncludedInPrice());
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
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $subRateCollection = SubRateCollection::of();
        $i = 1;
        foreach ($testSubRates as $testSubRate) {
            $subRateCollection->add(SubRate::of()->setName('test-' . $i)->setAmount($testSubRate));
            $i++;
        }
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
                    ->setExternalTaxRate(
                        ExternalTaxRateDraft::ofNameCountryAmountAndSubRates(
                            $taxRateName,
                            $taxRateCountry,
                            $testTaxRate,
                            $subRateCollection
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxRateName, $cart->getLineItems()->current()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getLineItems()->current()->getTaxRate()->getCountry());
        $this->assertSame($testTaxRate, $cart->getLineItems()->current()->getTaxRate()->getAmount());
        $subRates = [];
        foreach ($cart->getLineItems()->current()->getTaxRate()->getSubRates() as $subRate) {
            $subRates[] = $subRate->getAmount();
        }
        foreach ($testSubRates as $testSubRate) {
            $this->assertContains($testSubRate, $subRates);
        }
    }

    public function testAddLineItemExternalTaxSubRatesOnly()
    {
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;
        $subRate1 = 0.08;
        $subRate2 = 0.02;
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
                    ->setExternalTaxRate(
                        ExternalTaxRateDraft::ofNameCountryAndSubRates(
                            $taxRateName,
                            $taxRateCountry,
                            SubRateCollection::of()
                                ->add(SubRate::of()->setName('test-1')->setAmount($subRate1))
                                ->add(SubRate::of()->setName('test-2')->setAmount($subRate2))
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxRateName, $cart->getLineItems()->current()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getLineItems()->current()->getTaxRate()->getCountry());
        $this->assertSame($taxRate, $cart->getLineItems()->current()->getTaxRate()->getAmount());
        $this->assertFalse($cart->getLineItems()->current()->getTaxRate()->getIncludedInPrice());

        $subRates = [];
        foreach ($cart->getLineItems()->current()->getTaxRate()->getSubRates() as $subRate) {
            $subRates[] = $subRate->getAmount();
        }
        $this->assertContains($subRate1, $subRates);
        $this->assertContains($subRate2, $subRates);
    }

    public function testAddCustomLineItemExternalTaxRate()
    {
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddCustomLineItemAction::ofNameQuantityMoneySlugAndExternalTaxRate(
                    LocalizedString::ofLangAndText('en', 'Test'),
                    1,
                    Money::ofCurrencyAndAmount('EUR', 100),
                    'test',
                    ExternalTaxRateDraft::ofNameCountryAndAmount($taxRateName, $taxRateCountry, $taxRate)
                        ->setIncludedInPrice(false)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxRateName, $cart->getCustomLineItems()->current()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getCustomLineItems()->current()->getTaxRate()->getCountry());
        $this->assertSame($taxRate, $cart->getCustomLineItems()->current()->getTaxRate()->getAmount());
        $this->assertFalse($cart->getCustomLineItems()->current()->getTaxRate()->getIncludedInPrice());
    }

    /**
     * @dataProvider getSubRates
     */
    public function testAddCustomLineItemExternalTaxSubRates($testTaxRate, array $testSubRates)
    {
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $i = 1;
        $subRateCollection = SubRateCollection::of();
        foreach ($testSubRates as $testSubRate) {
            $subRateCollection->add(SubRate::of()->setName('test-' . $i)->setAmount($testSubRate));
            $i++;
        }
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
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
            )
        ;

        $response = $request->executeWithClient($this->getClient());

        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

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

    public function testAddCustomLineItemExternalTaxSubRatesOnly()
    {
        $draft = $this->getDraft();
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;
        $subRate1 = 0.08;
        $subRate2 = 0.02;
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
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
            )
        ;

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

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

    public function testSetCustomLineItemExternalTaxRate()
    {
        $draft = $this->getDraft();
        $draft->setCustomLineItems(
            CustomLineItemDraftCollection::of()->add(
                CustomLineItemDraft::of()
                    ->setName(LocalizedString::ofLangAndText('en', 'Test'))
                    ->setQuantity(1)
                    ->setMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    ->setSlug('test')
            )
        );
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetCustomLineItemTaxRateAction::ofCustomLineItemId($cart->getCustomLineItems()->current()->getId())
                    ->setExternalTaxRate(
                        ExternalTaxRateDraft::ofNameCountryAndAmount(
                            $taxRateName,
                            $taxRateCountry,
                            $taxRate
                        )
                    )
            )
        ;

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxRateName, $cart->getCustomLineItems()->current()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getCustomLineItems()->current()->getTaxRate()->getCountry());
        $this->assertSame($taxRate, $cart->getCustomLineItems()->current()->getTaxRate()->getAmount());
    }

    public function testSetLineItemExternalTaxRate()
    {
        $product = $this->getProduct();

        $draft = $this->getDraft();
        $draft->setLineItems(
            LineItemDraftCollection::of()->add(
                LineItemDraft::of()
                    ->setProductId($product->getId())
                    ->setQuantity(1)
                    ->setVariantId($product->getMasterData()->getCurrent()->getMasterVariant()->getId())
            )
        );
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetLineItemTaxRateAction::ofLineItemId($cart->getLineItems()->current()->getId())
                    ->setExternalTaxRate(
                        ExternalTaxRateDraft::ofNameCountryAndAmount(
                            $taxRateName,
                            $taxRateCountry,
                            $taxRate
                        )
                    )
            )
        ;

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxRateName, $cart->getLineItems()->current()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getLineItems()->current()->getTaxRate()->getCountry());
        $this->assertSame($taxRate, $cart->getLineItems()->current()->getTaxRate()->getAmount());
    }

    public function testSetShippingMethodExternalTaxRate()
    {
        $shippingMethod = $this->getShippingMethod();

        $draft = $this->getDraft();
        $draft->setShippingAddress(Address::of()->setCountry('DE')->setState($this->getRegion()));
        $draft->setShippingMethod(
            $shippingMethod->getReference()
        );
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartSetShippingMethodTaxRateAction::of()
                    ->setExternalTaxRate(
                        ExternalTaxRateDraft::ofNameCountryAndAmount(
                            $taxRateName,
                            $taxRateCountry,
                            $taxRate
                        )
                    )
            )
        ;

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($taxRateName, $cart->getShippingInfo()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getShippingInfo()->getTaxRate()->getCountry());
        $this->assertSame($taxRate, $cart->getShippingInfo()->getTaxRate()->getAmount());
    }

    public function testChangeTaxMode()
    {
        $product = $this->getProduct();
        $draft = $this->getDraft();

        $taxRateName = 'test';
        $taxRateCountry = 'DE';
        $taxRate = 0.1;

        $draft->setLineItems(
            LineItemDraftCollection::of()->add(
                LineItemDraft::of()
                    ->setProductId($product->getId())
                    ->setQuantity(1)
                    ->setVariantId($product->getMasterData()->getCurrent()->getMasterVariant()->getId())
                    ->setExternalTaxRate(
                        ExternalTaxRateDraft::ofNameCountryAndAmount(
                            $taxRateName,
                            $taxRateCountry,
                            $taxRate
                        )
                    )
            )
        );
        $draft->setTaxMode(Cart::TAX_MODE_EXTERNAL);
        $cart = $this->createCart($draft);

        $this->assertSame($taxRateName, $cart->getLineItems()->current()->getTaxRate()->getName());
        $this->assertSame($taxRateCountry, $cart->getLineItems()->current()->getTaxRate()->getCountry());
        $this->assertSame($taxRate, $cart->getLineItems()->current()->getTaxRate()->getAmount());

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartChangeTaxModeAction::of()->setTaxMode(Cart::TAX_MODE_PLATFORM)
            )
        ;

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertNull($cart->getLineItems()->current()->getTaxRate());
    }

    /**
     * @return CartDraft
     */
    protected function getDraft()
    {
        $draft = CartDraft::ofCurrencyAndCountry('EUR', 'DE');

        return $draft;
    }

    protected function createCart(CartDraft $draft)
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
        $this->cleanupRequests[] = $this->deleteRequest;

        return $cart;
    }
}
