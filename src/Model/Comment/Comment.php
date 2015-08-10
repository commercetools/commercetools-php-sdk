<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Comment;

use Commercetools\Core\Model\Common\Resource;

/**
 * @package Commercetools\Core\Model\Comment
 * @method string getId()
 * @method Comment setId(string $id = null)
 * @method int getVersion()
 * @method Comment setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Comment setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Comment setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getProductId()
 * @method Comment setProductId(string $productId = null)
 * @method string getCustomerId()
 * @method Comment setCustomerId(string $customerId = null)
 * @method string getAuthorName()
 * @method Comment setAuthorName(string $authorName = null)
 * @method string getTitle()
 * @method Comment setTitle(string $title = null)
 * @method string getText()
 * @method Comment setText(string $text = null)
 */
class Comment extends Resource
{
    public function getPropertyDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'productId' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
        ];
    }
}
