<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ProductDiscount;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\TestHelper;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Model\Common\LocalizedString;
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
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteByKeyRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateByKeyRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateRequest;

class ProductDiscountUpdateRequestTest extends ApiTestCase
{
    /**
     * @param $name
     * @return ProductDiscountDraft
     */
    protected function getDraft($name)
    {
        $draft = ProductDiscountDraft::ofNameDiscountPredicateOrderAndActive(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            ProductDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()
                    ->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            '0.9' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0'),
            false
        );

        return $draft;
    }

    protected function createProductDiscount(ProductDiscountDraft $draft)
    {
        $request = ProductDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $productDiscount = $request->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = ProductDiscountDeleteRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        );

        return $productDiscount;
    }

    public function testChangeIsActive()
    {
        $draft = $this->getDraft('change-is-active');
        $productDiscount = $this->createProductDiscount($draft);


        $isActive = true;
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(
                ProductDiscountChangeIsActiveAction::of()->setIsActive($isActive)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame($isActive, $result->getIsActive());
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());
        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testChangePredicate()
    {
        $draft = $this->getDraft('change-predicate');
        $productDiscount = $this->createProductDiscount($draft);


        $predicate = '2=2';
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(
                ProductDiscountChangePredicateAction::ofPredicate($predicate)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame($predicate, $result->getPredicate());
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }



    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $productDiscount = $this->createProductDiscount($draft);


        $name = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-name');
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountChangeNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame($name->en, $result->getName()->en);
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $productDiscount = $this->createProductDiscount($draft);


        $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountSetDescriptionAction::of()->setDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame($description->en, $result->getDescription()->en);
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testChangeSortOrder()
    {
        $draft = $this->getDraft('change-sort-order');
        $productDiscount = $this->createProductDiscount($draft);


        $sortOrder = '0.90' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0');
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountChangeSortOrderAction::ofSortOrder($sortOrder))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame($sortOrder, $result->getSortOrder());
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testChangeValue()
    {
        $draft = $this->getDraft('change-value');
        $productDiscount = $this->createProductDiscount($draft);


        $value = ProductDiscountValue::of()->setType('absolute')->setMoney(
            MoneyCollection::of()
                ->add(
                    Money::ofCurrencyAndAmount('EUR', 200)
                )
        );
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountChangeValueAction::ofProductDiscountValue($value))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame(
            $value->getMoney()->current()->getCentAmount(),
            $result->getValue()->getMoney()->current()->getCentAmount()
        );
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetValidFrom()
    {
        $draft = $this->getDraft('set-valid-from');
        $productDiscount = $this->createProductDiscount($draft);


        $validFrom = new \DateTime();
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountSetValidFromAction::of()->setValidFrom($validFrom))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $validFrom->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());
    }

    public function testSetValidUntil()
    {
        $draft = $this->getDraft('set-valid-from');
        $productDiscount = $this->createProductDiscount($draft);


        $validUntil = new \DateTime();
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountSetValidUntilAction::of()->setValidUntil($validUntil))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $validUntil->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());
    }

    public function testSetValidFromAndUntil()
    {
        $draft = $this->getDraft('set-valid-from-until');
        $productDiscount = $this->createProductDiscount($draft);

        $validFrom = new \DateTime();
        $validUntil = new \DateTime('+1 second');
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountSetValidFromAndUntilAction::of()->setValidFrom($validFrom)->setValidUntil($validUntil))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $validUntil->setTimezone(new \DateTimeZone('UTC'));
        $validFrom->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
        $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key')->setKey('key-' .$this->getTestRun());
        $productDiscount = $this->createProductDiscount($draft);

        $newKey = 'another-key-' . $this->getTestRun();
        $request = ProductDiscountUpdateRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountSetKeyAction::ofKey($newKey))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame($newKey, $result->getKey());
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testUpdateAndDeleteByKey()
    {
        $draft = $this->getDraft('set-key')->setKey('key-' .$this->getTestRun());
        $productDiscount = $this->createProductDiscount($draft);

        $newKey = 'another-key-' . $this->getTestRun();
        $request = ProductDiscountUpdateByKeyRequest::ofKeyAndVersion(
            $productDiscount->getKey(),
            $productDiscount->getVersion()
        )
            ->addAction(ProductDiscountSetKeyAction::ofKey($newKey))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
        $this->assertSame($newKey, $result->getKey());
        $this->assertNotSame($productDiscount->getVersion(), $result->getVersion());

        $deleteRequest = ProductDiscountDeleteByKeyRequest::ofKeyAndVersion($newKey, $result->getVersion());
        $response = $deleteRequest->executeWithClient($this->getClient());
        $result = $deleteRequest->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $result);
    }
}
