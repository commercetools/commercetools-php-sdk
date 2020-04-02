<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ProductDiscount;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeIsActiveAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeNameAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangePredicateAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeSortOrderAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeValueAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetDescriptionAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetKeyAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidFromAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidFromAndUntilAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidUntilAction;

class ProductDiscountUpdateRequestTest extends ApiTestCase
{
    public function testChangeIsActive()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'change-is-active';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $isActive = true;

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountChangeIsActiveAction::of()->setIsActive($isActive));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $this->assertSame($isActive, $result->getIsActive());
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangePredicate()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'change-predicate';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $predicate = '2=2';

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountChangePredicateAction::ofPredicate($predicate));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $this->assertSame($predicate, $result->getPredicate());
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withdraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'change-name';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $name = LocalizedString::ofLangAndText(
                    'en',
                    ProductDiscountFixture::uniqueProductDiscountString() . '-new-name'
                );

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $this->assertSame($name->en, $result->getName()->en);
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'set-description';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $description = LocalizedString::ofLangAndText(
                    'en',
                    ProductDiscountFixture::uniqueProductDiscountString() . '-new-description'
                );

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountSetDescriptionAction::of()->setDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $this->assertSame($description->en, $result->getDescription()->en);
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeSortOrder()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'change-sort-order';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $sortOrder = '0.90' . trim((string)mt_rand(1, ProductDiscountFixture::RAND_MAX), '0');

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountChangeSortOrderAction::ofSortOrder($sortOrder));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $this->assertSame($sortOrder, $result->getSortOrder());
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeValue()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'change-value';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $value = ProductDiscountValue::of()->setType('absolute')->setMoney(
                    MoneyCollection::of()
                        ->add(
                            Money::ofCurrencyAndAmount('EUR', 200)
                        )
                );

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountChangeValueAction::ofProductDiscountValue($value));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $this->assertSame(
                    $value->getMoney()->current()->getCentAmount(),
                    $result->getValue()->getMoney()->current()->getCentAmount()
                );
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetValidFrom()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'set-valid-from';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $validFrom = new \DateTime();

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountSetValidFromAction::of()->setValidFrom($validFrom));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $validFrom->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetValidUntil()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'set-valid-from';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $validUntil = new \DateTime();

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountSetValidUntilAction::of()->setValidUntil($validUntil));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $validUntil->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetValidFromAndUntil()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'set-valid-from-until';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ));
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $validFrom = new \DateTime();
                $validUntil = new \DateTime('+1 second');

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(
                        ProductDiscountSetValidFromAndUntilAction::of()
                            ->setValidFrom($validFrom)->setValidUntil($validUntil)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $validUntil->setTimezone(new \DateTimeZone('UTC'));
                $validFrom->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
                $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withUpdateableDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'set-key';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ))->setKey('key-' . ProductDiscountFixture::uniqueProductDiscountString());
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $newKey = 'another-key-' . ProductDiscountFixture::uniqueProductDiscountString();

                $request = RequestBuilder::of()->productDiscounts()->update($productDiscount)
                    ->addAction(ProductDiscountSetKeyAction::ofKey($newKey));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $result);
                $this->assertSame($newKey, $result->getKey());
                $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testDeleteByKey()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();

        ProductDiscountFixture::withDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                $name = 'set-key';

                return $draft->setName(LocalizedString::ofLangAndText(
                    'en',
                    'test-' . ProductDiscountFixture::uniqueProductDiscountString() . $name
                ))->setKey('key-' . ProductDiscountFixture::uniqueProductDiscountString());
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $request = RequestBuilder::of()->productDiscounts()->deleteByKey($productDiscount);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($productDiscount->getId(), $result->getId());
                $this->assertInstanceOf(ProductDiscount::class, $result);

                $request = RequestBuilder::of()->productDiscounts()->getByKey($result->getKey());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }
}
