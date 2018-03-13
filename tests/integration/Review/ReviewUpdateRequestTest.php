<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Review;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetAuthorNameAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetCustomerAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetKeyAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetLocaleAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetRatingAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTargetAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTextAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTitleAction;
use Commercetools\Core\Request\Reviews\Command\ReviewTransitionStateAction;
use Commercetools\Core\Request\Reviews\ReviewCreateRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateRequest;

class ReviewUpdateRequestTest extends ApiTestCase
{
    /**
     * @param $name
     * @return ReviewDraft
     */
    protected function getDraft($name)
    {
        $draft = ReviewDraft::ofTitle(
            'test-' . $this->getTestRun() . '-' . $name
        )->setKey('test-' . $this->getTestRun() . '-' . $name);

        return $draft;
    }

    protected function createReview(ReviewDraft $draft)
    {
        $request = ReviewCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $review = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = ReviewDeleteRequest::ofIdAndVersion(
            $review->getId(),
            $review->getVersion()
        );

        return $review;
    }

    public function testUpdateByKey()
    {
        $draft = $this->getDraft('update-by-key');
        $review = $this->createReview($draft);

        $text = 'test-' . $this->getTestRun() . '-new text';
        $request = ReviewUpdateByKeyRequest::ofKeyAndVersion($review->getKey(), $review->getVersion())
            ->addAction(
                ReviewSetTextAction::of()->setText($text)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($text, $result->getText());
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $review = $this->createReview($draft);

        $key = 'new-' . $this->getTestRun();
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetKeyAction::of()->setKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetAuthorName()
    {
        $draft = $this->getDraft('set-author-name');
        $review = $this->createReview($draft);

        $author = 'new-' . $this->getTestRun();
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetAuthorNameAction::of()->setAuthorName($author)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($author, $result->getAuthorName());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetCustomer()
    {
        $draft = $this->getDraft('set-author-name');
        $review = $this->createReview($draft);

        $customer = $this->getCustomer();
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetCustomerAction::of()->setCustomer($customer->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetRating()
    {
        $draft = $this->getDraft('set-rating');
        $review = $this->createReview($draft);

        $rating = mt_rand(1, 100);
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetRatingAction::of()->setRating($rating)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($rating, $result->getRating());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetTargetProduct()
    {
        $draft = $this->getDraft('set-target-product');
        $review = $this->createReview($draft);

        $target = $this->getProduct();
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetTargetAction::of()->setTarget($target->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($target->getId(), $result->getTarget()->getId());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetTargetChannel()
    {
        $draft = $this->getDraft('set-target-channel');
        $review = $this->createReview($draft);

        $target = $this->getChannel();
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetTargetAction::of()->setTarget($target->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($target->getId(), $result->getTarget()->getId());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetText()
    {
        $draft = $this->getDraft('set-text');
        $review = $this->createReview($draft);

        $text = 'test-' . $this->getTestRun() . '-new text';
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetTextAction::of()->setText($text)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($text, $result->getText());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetTitle()
    {
        $draft = $this->getDraft('set-title');
        $review = $this->createReview($draft);

        $title = 'test-' . $this->getTestRun() . '-new title';
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetTitleAction::of()->setTitle($title)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($title, $result->getTitle());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testSetLocale()
    {
        $draft = $this->getDraft('set-locale');
        $review = $this->createReview($draft);

        $locale = 'de_DE';
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewSetLocaleAction::of()->setLocale($locale)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($locale, \Locale::canonicalize($result->getLocale()));
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testTransitionState()
    {
        $draft = $this->getDraft('transition-state');
        $review = $this->createReview($draft);

        /**
         * @var State $state1
         * @var State $state2
         */
        list($state1, $state2) = $this->createStates('ReviewState');
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewTransitionStateAction::of()->setState($state1->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($state1->getId(), $result->getState()->getId());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
        $review = $result;

        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                ReviewTransitionStateAction::of()->setState($state2->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($state2->getId(), $result->getState()->getId());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testCustomType()
    {
        $draft = $this->getDraft('custom-type');
        $review = $this->createReview($draft);

        $type = $this->getType($this->getTestRun().'-key', 'review');
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                SetCustomTypeAction::of()
                    ->setType($type->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testCustomField()
    {
        $draft = $this->getDraft('custom-field');
        $review = $this->createReview($draft);

        $type = $this->getType($this->getTestRun().'-key', 'review');
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                SetCustomTypeAction::of()
                    ->setType($type->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $review = $result;

        $value = $this->getTestRun() . '-value';
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion())
            ->addAction(
                SetCustomFieldAction::ofName('testField')
                    ->setValue($value)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Review::class, $result);
        $this->assertSame($value, $result->getCustom()->getFields()->getTestField());
        $this->assertNotSame($review->getVersion(), $result->getVersion());
    }

    public function testReferenceExpansion()
    {
        $customer = $this->getCustomer();
        $draft = $this->getDraft('update-reference-expansion');
        $draft->setCustomer($customer->getReference());
        $review = $this->createReview($draft);

        $request = ReviewUpdateByKeyRequest::ofKeyAndVersion($review->getKey(), $review->getVersion());
        $request->expand('customer.id');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Customer::class, $result->getCustomer()->getObj());
    }
}
