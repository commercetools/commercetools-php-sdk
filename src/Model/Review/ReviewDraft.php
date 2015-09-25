<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Review;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Review
 * @method string getProductId()
 * @method ReviewDraft setProductId(string $productId = null)
 * @method string getCustomerId()
 * @method ReviewDraft setCustomerId(string $customerId = null)
 * @method string getAuthorName()
 * @method ReviewDraft setAuthorName(string $authorName = null)
 * @method string getTitle()
 * @method ReviewDraft setTitle(string $title = null)
 * @method string getText()
 * @method ReviewDraft setText(string $text = null)
 * @method float getScore()
 * @method ReviewDraft setScore(float $score = null)
 * @method StateReference getState()
 * @method ReviewDraft setState(StateReference $state = null)
 */
class ReviewDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
            'score' => [static::TYPE => 'float'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
        ];
    }

    /**
     * @param string $productId
     * @param string $customerId
     * @param Context|callable $context
     * @return ReviewDraft
     */
    public static function ofProductIdAndCustomerId($productId, $customerId, $context = null)
    {
        return static::of($context)->setProductId($productId)->setCustomerId($customerId);
    }
}
