<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\DiscountCode;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\AbsoluteCartDiscountValue;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeCartDiscountsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeGroupsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeIsActiveAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCartPredicateAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetDescriptionAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsPerCustomerAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetNameAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetValidFromAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetValidUntilAction;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeUpdateRequest;

class DiscountCodeUpdateRequestTest extends ApiTestCase
{
    private $discountDeleteRequests = [];

    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteCartDiscount();
    }

    protected function createCartDiscount($draft)
    {
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cartDiscount = $request->mapResponse($response);

        $this->discountDeleteRequests[] = $this->discountDeleteRequest = CartDiscountDeleteRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        );

        return $cartDiscount;
    }

    protected function deleteCartDiscount()
    {
        if (count($this->discountDeleteRequests) > 0) {
            foreach ($this->discountDeleteRequests as $request) {
                $this->getClient()->addBatchRequest($request);
            }
            $this->getClient()->executeBatch();
            $this->discountDeleteRequests = [];
            $this->cartDiscount = null;
        }
    }

    /**
     * @param $code
     * @return DiscountCodeDraft
     */
    protected function getDraft($code)
    {
        return $this->getDiscountCodeDraft($code)->setIsActive(false);
    }

    protected function createDiscountCode(DiscountCodeDraft $draft)
    {
        $request = DiscountCodeCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $discountCode = $request->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = DiscountCodeDeleteRequest::ofIdAndVersion(
            $discountCode->getId(),
            $discountCode->getVersion()
        );

        return $discountCode;
    }

    public function testCustomTypeCreate()
    {
        $type = $this->getType($this->getTestRun() . '-discount-type', 'discount-code');
        $draft = $this->getDraft('discount-type');
        $draft->setCustom(CustomFieldObjectDraft::ofTypeKey($type->getKey()));
        $discountCode = $this->createDiscountCode($draft);
        $this->deleteRequest->setVersion($discountCode->getVersion());

        $this->assertSame($type->getId(), $discountCode->getCustom()->getType()->getId());
    }

    public function testCustomTypeUpdate()
    {
        $type = $this->getType($this->getTestRun() . '-discount-type', 'discount-code');
        $draft = $this->getDraft('discount-type');
        $discountCode = $this->createDiscountCode($draft);

        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(SetCustomTypeAction::ofTypeKey($type->getKey()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
    }

    public function testCustomFieldUpdate()
    {
        $type = $this->getType($this->getTestRun() . '-discount-type', 'discount-code');
        $draft = $this->getDraft('discount-type');
        $draft->setCustom(CustomFieldObjectDraft::ofTypeKey($type->getKey()));
        $discountCode = $this->createDiscountCode($draft);

        $newValue = $this->getTestRun() . '-value';
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(SetCustomFieldAction::ofName('testField')->setValue($newValue))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertSame($newValue, $result->getCustom()->getFields()->getTestField());
    }


    public function testChangeCartDiscountAction()
    {
        $draft = $this->getDraft('change-cart-discount');
        $discountCode = $this->createDiscountCode($draft);

        $cartDiscountDraft = $this->getCartDiscountDraft('new-cart-discount');
        $cartDiscount = $this->createCartDiscount($cartDiscountDraft);
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(DiscountCodeChangeCartDiscountsAction::ofCartDiscountReference($cartDiscount->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame($cartDiscount->getId(), $result->getCartDiscounts()->current()->getId());
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testChangeCartDiscountsAction()
    {
        $draft = $this->getDraft('change-cart-discount');
        $discountCode = $this->createDiscountCode($draft);

        $cartDiscountDraft = $this->getCartDiscountDraft('new-cart-discount');
        $cartDiscount = $this->createCartDiscount($cartDiscountDraft);

        $discounts = $discountCode->getCartDiscounts()->add($cartDiscount->getReference());
        $expectedIds = [];
        foreach ($discounts as $discount) {
            $expectedIds[] = $discount->getId();
        }
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(DiscountCodeChangeCartDiscountsAction::ofCartDiscountReferences($discounts))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertCount(2, $result->getCartDiscounts());
        $ids = [];
        foreach ($result->getCartDiscounts() as $discount) {
            $ids[] = $discount->getId();
        }
        $this->assertSame($expectedIds, $ids);
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $discountCode = $this->createDiscountCode($draft);


        $description = $this->getTestRun() . '-new description';
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(
                DiscountCodeSetDescriptionAction::of()->setDescription(
                    LocalizedString::ofLangAndText('en', $description)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame($description, $result->getDescription()->en);
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testChangeIsActive()
    {
        $draft = $this->getDraft('change-is-active');
        $discountCode = $this->createDiscountCode($draft);


        $isActive = true;
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(
                DiscountCodeChangeIsActiveAction::of()->setIsActive($isActive)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame($isActive, $result->getIsActive());
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testChangeGroups()
    {
        $draft = $this->getDraft('change-groups');
        $draft->setGroups(['test']);
        $discountCode = $this->createDiscountCode($draft);
        $this->assertSame('test', current($discountCode->getGroups()));


        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(
                DiscountCodeChangeGroupsAction::of()->setGroups(['test2'])
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame('test2', current($result->getGroups()));
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());
    }

    public function testSetCartPredicate()
    {
        $draft = $this->getDraft('set-cart-predicate');
        $discountCode = $this->createDiscountCode($draft);


        $cartPredicate = '2=2';
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(
                DiscountCodeSetCartPredicateAction::of()->setCartPredicate($cartPredicate)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame($cartPredicate, $result->getCartPredicate());
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetMaxApplications()
    {
        $draft = $this->getDraft('set-max-applications');
        $discountCode = $this->createDiscountCode($draft);


        $maxApplications = mt_rand(1, 10);
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(
                DiscountCodeSetMaxApplicationsAction::of()->setMaxApplications($maxApplications)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame($maxApplications, $result->getMaxApplications());
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetMaxApplicationsPerCustomer()
    {
        $draft = $this->getDraft('set-max-applications-per-customer');
        $discountCode = $this->createDiscountCode($draft);


        $maxApplicationsPerCustomer = mt_rand(1, 10);
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(
                DiscountCodeSetMaxApplicationsPerCustomerAction::of()
                    ->setMaxApplicationsPerCustomer($maxApplicationsPerCustomer)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame($maxApplicationsPerCustomer, $result->getMaxApplicationsPerCustomer());
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetName()
    {
        $draft = $this->getDraft('set-name');
        $discountCode = $this->createDiscountCode($draft);


        $name = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-name');
        $request = DiscountCodeUpdateRequest::ofIdAndVersion($discountCode->getId(), $discountCode->getVersion())
            ->addAction(
                DiscountCodeSetNameAction::of()
                    ->setName($name)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $result);
        $this->assertSame($name->en, $result->getName()->en);
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSetValidFrom()
    {
        $draft = $this->getDraft('set-valid-from');
        $discountCode = $this->createDiscountCode($draft);


        $validFrom = new \DateTime();
        $request = DiscountCodeUpdateRequest::ofIdAndVersion(
            $discountCode->getId(),
            $discountCode->getVersion()
        )
            ->addAction(DiscountCodeSetValidFromAction::of()->setValidFrom($validFrom))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(DiscountCode::class, $result);
        $validFrom->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validFrom->format('c'), $result->getValidFrom()->format('c'));
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());
    }

    public function testValidUntilFrom()
    {
        $draft = $this->getDraft('set-valid-until');
        $discountCode = $this->createDiscountCode($draft);


        $validUntil = new \DateTime();
        $request = DiscountCodeUpdateRequest::ofIdAndVersion(
            $discountCode->getId(),
            $discountCode->getVersion()
        )
            ->addAction(DiscountCodeSetValidUntilAction::of()->setValidUntil($validUntil))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(DiscountCode::class, $result);
        $validUntil->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($validUntil->format('c'), $result->getValidUntil()->format('c'));
        $this->assertNotSame($discountCode->getVersion(), $result->getVersion());
    }
}
