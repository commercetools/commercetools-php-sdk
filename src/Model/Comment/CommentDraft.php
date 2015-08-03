<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Comment;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Comment
 * @method string getProductId()
 * @method CommentDraft setProductId(string $productId = null)
 * @method string getCustomerId()
 * @method CommentDraft setCustomerId(string $customerId = null)
 * @method string getAuthorName()
 * @method CommentDraft setAuthorName(string $authorName = null)
 * @method string getTitle()
 * @method CommentDraft setTitle(string $title = null)
 * @method string getText()
 * @method CommentDraft setText(string $text = null)
 */
class CommentDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
        ];
    }


    /**
     * @param string $productId
     * @param string $customerId
     * @param Context|callable $context
     * @return CommentDraft
     */
    public static function ofProductIdAndCustomerId($productId, $customerId, $context = null)
    {
        return static::of($context)->setProductId($productId)->setCustomerId($customerId);
    }
}
