<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Review;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\Common\ResourceIdentifier;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Review
 * @method string getId()
 * @method Review setId(string $id = null)
 * @method int getVersion()
 * @method Review setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Review setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
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
 * @method StateReference getState()
 * @method Review setState(StateReference $state = null)
 * @method string getKey()
 * @method Review setKey(string $key = null)
 * @method string getUniquenessValue()
 * @method Review setUniquenessValue(string $uniquenessValue = null)
 * @method string getLocale()
 * @method Review setLocale(string $locale = null)
 * @method ResourceIdentifier getTarget()
 * @method Review setTarget(ResourceIdentifier $target = null)
 * @method int getRating()
 * @method Review setRating(int $rating = null)
 * @method bool getIncludedInStatistics()
 * @method Review setIncludedInStatistics(bool $includedInStatistics = null)
 * @method CustomerReference getCustomer()
 * @method Review setCustomer(CustomerReference $customer = null)
 * @method CustomFieldObject getCustom()
 * @method Review setCustom(CustomFieldObject $custom = null)
 */
class Review extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'key' => [static::TYPE => 'string'],
            'uniquenessValue' => [static::TYPE => 'string'],
            'locale' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
            'target' => [static::TYPE => '\Commercetools\Core\Model\Common\ResourceIdentifier'],
            'rating' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
            'includedInStatistics' => [static::TYPE => 'bool'],
            'customer' => [static::TYPE => '\Commercetools\Core\Model\Customer\CustomerReference'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
        ];
    }
}
