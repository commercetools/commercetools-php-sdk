<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Comment;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * Class CommentDraft
 * @package Sphere\Core\Model\Comment
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
     */
    public function __construct($productId, $customerId, $context = null)
    {
        $this->setContext($context)->setProductId($productId)->setCustomerId($customerId);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static(
            $data['productId'],
            $data['customerId'],
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
