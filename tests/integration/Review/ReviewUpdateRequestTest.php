<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Review;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Channel\ChannelFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\State\StateFixture;
use Commercetools\Core\IntegrationTests\Type\TypeFixture;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\State\StateReferenceCollection;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
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

class ReviewUpdateRequestTest extends ApiTestCase
{
    const REVIEW_STATE = 'ReviewState';

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $text = 'test-' . ReviewFixture::uniqueReviewString() . '-new text';

                $request = RequestBuilder::of()->reviews()->updateByKey($review)
                    ->addAction(ReviewSetTextAction::of()->setText($text));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($text, $result->getText());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $key = 'new-' . ReviewFixture::uniqueReviewString();

                $request = RequestBuilder::of()->reviews()->update($review)
                    ->addAction(ReviewSetKeyAction::of()->setKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($review->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetAuthorName()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $author = 'new-' . ReviewFixture::uniqueReviewString();

                $request = RequestBuilder::of()->reviews()->update($review)
                    ->addAction(ReviewSetAuthorNameAction::of()->setAuthorName($author));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($author, $result->getAuthorName());
                $this->assertNotSame($review->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

//todo migration for Customer is missing
    public function testSetCustomer()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $customer = $this->getCustomer();

                $request = RequestBuilder::of()->reviews()->update($review)
                    ->addAction(ReviewSetCustomerAction::of()->setCustomer($customer->getReference()));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($customer->getId(), $result->getCustomer()->getId());
                $this->assertNotSame($review->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetRating()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $rating = mt_rand(1, 100);

                $request = RequestBuilder::of()->reviews()->update($review)
                    ->addAction(ReviewSetRatingAction::of()->setRating($rating));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($rating, $result->getRating());
                $this->assertNotSame($review->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetTargetProduct()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                ReviewFixture::withUpdateableReview(
                    $client,
                    function (Review $review) use ($client, $product) {
                        $request = RequestBuilder::of()->reviews()->update($review)
                            ->addAction(ReviewSetTargetAction::of()->setTarget($product->getReference()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Review::class, $result);
                        $this->assertSame($product->getId(), $result->getTarget()->getId());
                        $this->assertNotSame($review->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetTargetChannel()
    {
        $client = $this->getApiClient();

        ChannelFixture::withChannel(
            $client,
            function (Channel $channel) use ($client) {
                ReviewFixture::withUpdateableReview(
                    $client,
                    function (Review $review) use ($client, $channel) {
                        $request = RequestBuilder::of()->reviews()->update($review)
                            ->addAction(
                                ReviewSetTargetAction::of()->setTarget($channel->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Review::class, $result);
                        $this->assertSame($channel->getId(), $result->getTarget()->getId());
                        $this->assertNotSame($review->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetText()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $text = 'test-' . ReviewFixture::uniqueReviewString() . '-new text';

                $request = RequestBuilder::of()->reviews()->update($review)
                    ->addAction(ReviewSetTextAction::of()->setText($text));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($text, $result->getText());
                $this->assertNotSame($review->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetTitle()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $title = 'test-' . ReviewFixture::uniqueReviewString() . '-new title';

                $request = RequestBuilder::of()->reviews()->update($review)
                    ->addAction(ReviewSetTitleAction::of()->setTitle($title));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($title, $result->getTitle());
                $this->assertNotSame($review->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetLocale()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableReview(
            $client,
            function (Review $review) use ($client) {
                $locale = 'de_DE';

                $request = RequestBuilder::of()->reviews()->update($review)
                    ->addAction(ReviewSetLocaleAction::of()->setLocale($locale));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($locale, \Locale::canonicalize($result->getLocale()));
                $this->assertNotSame($review->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testTransitionState()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $state1Draft) {
                return $state1Draft->setType(self::REVIEW_STATE)->setInitial(true);
            },
            function (State $state1) use ($client) {
                StateFixture::withDraftState(
                    $client,
                    function (StateDraft $state2Draft) use ($state1) {
                        return $state2Draft->setType(self::REVIEW_STATE)
                            ->setTransitions(StateReferenceCollection::of()->add($state1->getReference()));
                    },
                    function (State $state2) use ($client, $state1) {
                        ReviewFixture::withUpdateableReview(
                            $client,
                            function (Review $review) use ($client, $state1, $state2) {
                                $request = RequestBuilder::of()->reviews()->update($review)
                                    ->addAction(
                                        ReviewTransitionStateAction::of()->setState($state1->getReference())
                                    );
                                $response = $this->execute($client, $request);
                                $result = $request->mapFromResponse($response);

                                $this->assertInstanceOf(Review::class, $result);
                                $this->assertSame($state1->getId(), $result->getState()->getId());
                                $this->assertNotSame($review->getVersion(), $result->getVersion());

                                $review = $result;
                                $request = RequestBuilder::of()->reviews()->update($review)
                                    ->addAction(
                                        ReviewTransitionStateAction::of()->setState($state2->getReference())
                                    );
                                $response = $this->execute($client, $request);
                                $result = $request->mapFromResponse($response);

                                $this->assertInstanceOf(Review::class, $result);
                                $this->assertSame($state2->getId(), $result->getState()->getId());
                                $this->assertNotSame($review->getVersion(), $result->getVersion());

                                return $result;
                            }
                        );
                    }
                );
            }
        );
    }

    public function testCustomType()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setResourceTypeIds(['review']);
            },
            function (Type $type) use ($client) {
                ReviewFixture::withUpdateableReview(
                    $client,
                    function (Review $review) use ($client, $type) {
                        $request = RequestBuilder::of()->reviews()->update($review)
                            ->addAction(SetCustomTypeAction::of()->setType($type->getReference()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Review::class, $result);
                        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
                        $this->assertNotSame($review->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testCustomField()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setResourceTypeIds(['review']);
            },
            function (Type $type) use ($client) {
                ReviewFixture::withUpdateableReview(
                    $client,
                    function (Review $review) use ($client, $type) {
                        $request = RequestBuilder::of()->reviews()->update($review)
                            ->addAction(SetCustomTypeAction::of()->setType($type->getReference()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $review = $result;
                        $value = 'new-value';

                        $request = RequestBuilder::of()->reviews()->update($review)
                            ->addAction(SetCustomFieldAction::ofName('testField')->setValue($value));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Review::class, $result);
                        $this->assertSame($value, $result->getCustom()->getFields()->getTestField());
                        $this->assertNotSame($review->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

//todo migration for Customer is missing
    public function testReferenceExpansion()
    {
        $client = $this->getApiClient();

        ReviewFixture::withUpdateableDraftReview(
            $client,
            function (ReviewDraft $reviewDraft) {
                $customer = $this->getCustomer();

                return $reviewDraft->setCustomer($customer->getReference());
            },
            function (Review $review) use ($client) {
                $request = RequestBuilder::of()->reviews()->update($review);
                $request->expand('customer.id');
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $result->getCustomer()->getObj());

                return $result;
            }
        );
    }
}
