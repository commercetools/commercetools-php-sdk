<?php


namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types#productaddedtocategory-message
 *
 * @method string getId()
 * @method ProductAddedToCategoryMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductAddedToCategoryMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductAddedToCategoryMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductAddedToCategoryMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductAddedToCategoryMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductAddedToCategoryMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductAddedToCategoryMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductAddedToCategoryMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductAddedToCategoryMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method CategoryReference getCategory()
 * @method ProductAddedToCategoryMessage setCategory(CategoryReference $category = null)
 * @method bool getStaged()
 * @method ProductAddedToCategoryMessage setStaged(bool $staged = null)
 */
class ProductAddedToCategoryMessage extends Message
{
    const MESSAGE_TYPE = 'ProductAddedToCategory';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['category'] = [static::TYPE => CategoryReference::class];
        $definitions['staged'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
