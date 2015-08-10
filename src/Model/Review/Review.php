<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Review;

use Commercetools\Core\Model\Common\Resource;

/**
 * @package Commercetools\Core\Model\Review
 * @method string getId()
 * @method Review setId(string $id = null)
 * @method int getVersion()
 * @method Review setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Review setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Review setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getProductId()
 * @method Review setProductId(string $productId = null)
 * @method string getCustomerId()
 * @method Review setCustomerId(string $customerId = null)
 * @method string getAuthorName()
 * @method Review setAuthorName(string $authorName = null)
 * @method string getTitle()
 * @method Review setTitle(string $title = null)
 * @method string getText()
 * @method Review setText(string $text = null)
 * @method float getScore()
 * @method Review setScore(float $score = null)
 */
class Review extends Resource
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
            'score' => [static::TYPE => 'float']
        ];
    }
}
