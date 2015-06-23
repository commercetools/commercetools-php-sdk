<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Review;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * Class ReviewDraft
 * @package Sphere\Core\Model\Review
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
 */
class ReviewDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
            'score' => [static::TYPE => 'float']
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
