<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\CartDiscount;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\AbsoluteCartDiscountValue;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeStackingModeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetKeyAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAndUntilAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction;

class CartDiscountUpdateRequestTest extends ApiTestCase
{
    public function testChangeValue()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change-value'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $value = AbsoluteCartDiscountValue::of()->setMoney(
                    MoneyCollection::of()
                        ->add(Money::ofCurrencyAndAmount('EUR', 200))
                );

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeValueAction::ofCartDiscountValue($value));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame(
                    $value->getMoney()->current()->getCentAmount(),
                    $result->getValue()->getMoney()->current()->getCentAmount()
                );
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeCartPredicate()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change-predicate'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeCartPredicateAction::ofCartPredicate('2=2'));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame('2=2', $result->getCartPredicate());
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeTarget()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change-predicate'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $target = CartDiscountTarget::of()->setType('lineItems')->setPredicate('2=2');

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                   ->addAction(CartDiscountChangeTargetAction::ofTarget($target));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($target->getPredicate(), $result->getTarget()->getPredicate());
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeIsActiveFromDefaultToFalse()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change-is-active'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeIsActiveAction::ofIsActive(false));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame(false, $result->getIsActive());
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change-name'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $name = LocalizedString::ofLangAndText(
                    'en',
                    'new-name-' . CartDiscountFixture::uniqueCartDiscountString()
                );

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($name->en, $result->getName()->en);
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setDescription(LocalizedString::ofLangAndText('en', 'set-description'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $description = LocalizedString::ofLangAndText(
                    'en',
                    'new-description-' . CartDiscountFixture::uniqueCartDiscountString()
                );

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountSetDescriptionAction::of()->setDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($description->en, $result->getDescription()->en);
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeSortOrder()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change-sort-order'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $sortOrder = '0.90' . trim((string)mt_rand(1, CartDiscountFixture::RAND_MAX), '0');

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeSortOrderAction::ofSortOrder($sortOrder));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($sortOrder, $result->getSortOrder());
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeRequiresDiscountCode()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change-requires-discount-code'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeRequiresDiscountCodeAction::ofRequiresDiscountCode(true));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertEquals(true, $result->getRequiresDiscountCode());
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetValidFrom()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'set-valid-from'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $validFrom = new \DateTime();

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountSetValidFromAction::of()->setValidFrom($validFrom));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $validFrom->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetValidUntil()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'set-valid-until'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $validUntil = new \DateTime();

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountSetValidUntilAction::of()->setValidUntil($validUntil));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $validUntil->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testStackingMode()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'stacking-mode'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $this->assertSame(CartDiscount::MODE_STACKING, $cartDiscount->getStackingMode());

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeStackingModeAction::ofStackingMode(CartDiscount::MODE_STOP));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame(CartDiscount::MODE_STOP, $result->getStackingMode());

                $cartDiscount = $result;
                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountChangeStackingModeAction::ofStackingMode(CartDiscount::MODE_STACKING));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame(CartDiscount::MODE_STACKING, $result->getStackingMode());

                return $result;
            }
        );
    }

    public function testSetValidFromAndUntil()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'set-valid-from-until'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $validFrom = new \DateTime();
                $validUntil = new \DateTime('+1 second');

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(
                        CartDiscountSetValidFromAndUntilAction::of()
                            ->setValidFrom($validFrom)
                            ->setValidUntil($validUntil)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $validUntil->setTimezone(new \DateTimeZone('UTC'));
                $validFrom->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
                $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();
        $keyBar = 'test-' . CartDiscountFixture::uniqueCartDiscountString() . '-bar';
        $keyFoo = 'test-' . CartDiscountFixture::uniqueCartDiscountString() . '-foo';

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) use ($keyFoo) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'set-key'))
                    ->setKey($keyFoo);
            },
            function (CartDiscount $cartDiscount) use ($client, $keyFoo, $keyBar) {
                $this->assertSame($keyFoo, $cartDiscount->getKey());

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(CartDiscountSetKeyAction::ofKey($keyBar));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($keyBar, $result->getKey());
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();
        $updateName = 'test-' . CartDiscountFixture::uniqueCartDiscountString() . '-updated-name';

        CartDiscountFixture::withUpdateableDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'update-by-key'))
                    ->setKey('test-' . CartDiscountFixture::uniqueCartDiscountString() . '-update');
            },
            function (CartDiscount $cartDiscount) use ($client, $updateName) {
                $this->assertSame('update-by-key', $cartDiscount->getName()->en);

                $request = RequestBuilder::of()->cartDiscounts()->update($cartDiscount)
                    ->addAction(
                        CartDiscountChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $updateName))
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($updateName, $result->getName()->en);
                $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testDeleteByKey()
    {
        $client = $this->getApiClient();

        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        CartDiscountFixture::withDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'delete-by-key'))
                    ->setKey('test-' . CartDiscountFixture::uniqueCartDiscountString() . '-delete');
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->deleteByKey($cartDiscount);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);

                $request = RequestBuilder::of()->cartDiscounts()->getByKey($result->getKey());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }
}
