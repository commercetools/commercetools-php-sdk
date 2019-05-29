<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\CartDiscount;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Request\CartDiscounts\CartDiscountByKeyGetRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteByKeyRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateByKeyRequest;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeStackingModeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateRequest;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetKeyAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAndUntilAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction;

class CartDiscountUpdateRequestTest extends ApiTestCase
{
    public function testChangeValue()
    {
        $draft = $this->getDraft('change-value');
        $cartDiscount = $this->createCartDiscount($draft);


        $value = CartDiscountValue::of()->setType('absolute')->setMoney(
            MoneyCollection::of()
                ->add(
                    Money::ofCurrencyAndAmount('EUR', 200)
                )
        );
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeValueAction::ofCartDiscountValue($value))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame(
            $value->getMoney()->current()->getCentAmount(),
            $result->getValue()->getMoney()->current()->getCentAmount()
        );
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testChangeCartPredicate()
    {
        $draft = $this->getDraft('change-predicate');
        $cartDiscount = $this->createCartDiscount($draft);


        $predicate = '2=2';
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(
                CartDiscountChangeCartPredicateAction::ofCartPredicate($predicate)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($predicate, $result->getCartPredicate());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testChangeTarget()
    {
        $draft = $this->getDraft('change-predicate');
        $cartDiscount = $this->createCartDiscount($draft);


        $target = CartDiscountTarget::of()->setType('lineItems')->setPredicate('2=2');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(
                CartDiscountChangeTargetAction::ofTarget($target)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($target->getPredicate(), $result->getTarget()->getPredicate());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testChangeIsActive()
    {
        $draft = $this->getDraft('change-is-active');
        $cartDiscount = $this->createCartDiscount($draft);


        $isActive = true;
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(
                CartDiscountChangeIsActiveAction::ofIsActive($isActive)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($isActive, $result->getIsActive());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $cartDiscount = $this->createCartDiscount($draft);


        $name = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-name');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($name->en, $result->getName()->en);
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $cartDiscount = $this->createCartDiscount($draft);


        $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetDescriptionAction::of()->setDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($description->en, $result->getDescription()->en);
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testChangeSortOrder()
    {
        $draft = $this->getDraft('change-sort-order');
        $cartDiscount = $this->createCartDiscount($draft);


        $sortOrder = '0.90' . trim((string)mt_rand(1, 1000), '0');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeSortOrderAction::ofSortOrder($sortOrder))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($sortOrder, $result->getSortOrder());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testChangeRequiresDiscountCode()
    {
        $draft = $this->getDraft('change-requires-discount-code');
        $cartDiscount = $this->createCartDiscount($draft);


        $requiresDiscountCode = true;
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeRequiresDiscountCodeAction::ofRequiresDiscountCode($requiresDiscountCode))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertEquals($requiresDiscountCode, $result->getRequiresDiscountCode());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testSetValidFrom()
    {
        $draft = $this->getDraft('set-valid-from');
        $cartDiscount = $this->createCartDiscount($draft);


        $validFrom = new \DateTime();
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetValidFromAction::of()->setValidFrom($validFrom))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $validFrom->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testSetValidUntil()
    {
        $draft = $this->getDraft('set-valid-from');
        $cartDiscount = $this->createCartDiscount($draft);


        $validUntil = new \DateTime();
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetValidUntilAction::of()->setValidUntil($validUntil))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $validUntil->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testStackingMode()
    {
        $draft = $this->getDraft('stacking-mode');
        $cartDiscount = $this->createCartDiscount($draft);

        $this->assertSame(CartDiscount::MODE_STACKING, $cartDiscount->getStackingMode());

        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeStackingModeAction::ofStackingMode(CartDiscount::MODE_STOP))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertSame(CartDiscount::MODE_STOP, $result->getStackingMode());
        $cartDiscount = $result;

        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeStackingModeAction::ofStackingMode(CartDiscount::MODE_STACKING))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertSame(CartDiscount::MODE_STACKING, $result->getStackingMode());
    }

    public function testSetValidFromAndUntil()
    {
        $draft = $this->getDraft('set-valid-from-until');
        $cartDiscount = $this->createCartDiscount($draft);

        $validFrom = new \DateTime();
        $validUntil = new \DateTime('+1 second');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetValidFromAndUntilAction::of()->setValidFrom($validFrom)->setValidUntil($validUntil))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $validUntil->setTimezone(new \DateTimeZone('UTC'));
        $validFrom->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
        $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key')->setKey('test-' . $this->getTestRun() . '-foo');
        $cartDiscount = $this->createCartDiscount($draft);

        $this->assertSame('test-' . $this->getTestRun() . '-foo', $cartDiscount->getKey());

        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetKeyAction::ofKey('test-' . $this->getTestRun() . '-bar'))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame('test-' . $this->getTestRun() . '-bar', $result->getKey());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testUpdateByKey()
    {
        $draft = $this->getDraft('update-by-key')->setKey('test-' . $this->getTestRun() . '-update');
        $cartDiscount = $this->createCartDiscount($draft);

        $this->assertSame('test-' . $this->getTestRun() . '-update-by-key', $cartDiscount->getName()->en);

        $request = CartDiscountUpdateByKeyRequest::ofKeyAndVersion(
            $cartDiscount->getKey(),
            $cartDiscount->getVersion()
        )
            ->addAction(
                CartDiscountChangeNameAction::ofName(
                    LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-updated-name')
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame('test-' . $this->getTestRun() . '-updated-name', $result->getName()->en);
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());
    }

    public function testDeleteByKey()
    {
        $draft = $this->getDraft('delete-by-key')->setKey('test-' . $this->getTestRun() . '-delete');
        $cartDiscount = $this->createCartDiscount($draft);

        $request = CartDiscountDeleteByKeyRequest::ofKeyAndVersion(
            $cartDiscount->getKey(),
            $cartDiscount->getVersion()
        );

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);

        $request = CartDiscountByKeyGetRequest::ofKey($result->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertNull($result);
    }

    /**
     * @param $name
     * @return CartDiscountDraft
     */
    protected function getDraft($name)
    {
        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            CartDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            CartDiscountTarget::of()->setType('lineItems')->setPredicate('1=1'),
            '0.9' . trim((string)mt_rand(1, 1000), '0'),
            false,
            false
        );

        return $draft;
    }

    protected function createCartDiscount(CartDiscountDraft $draft)
    {
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cartDiscount = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = CartDiscountDeleteRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        );

        return $cartDiscount;
    }
}
