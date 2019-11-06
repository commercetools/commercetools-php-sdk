<?php


namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types#productremovedfromcategory-message
 *
 * @method string getId()
 * @method ProductRemovedFromCategoryMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductRemovedFromCategoryMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductRemovedFromCategoryMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductRemovedFromCategoryMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductRemovedFromCategoryMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductRemovedFromCategoryMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductRemovedFromCategoryMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductRemovedFromCategoryMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductRemovedFromCategoryMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method CategoryReference getCategory()
 * @method ProductRemovedFromCategoryMessage setCategory(CategoryReference $category = null)
 * @method bool getStaged()
 * @method ProductRemovedFromCategoryMessage setStaged(bool $staged = null)
 */
class ProductRemovedFromCategoryMessage extends Message
{
    const MESSAGE_TYPE = 'ProductRemovedFromCategory';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['category'] = [static::TYPE => CategoryReference::class];
        $definitions['staged'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
