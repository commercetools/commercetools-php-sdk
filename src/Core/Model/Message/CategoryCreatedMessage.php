<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Category\Category;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#categorycreated-message
 * @method string getId()
 * @method CategoryCreatedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CategoryCreatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method CategoryCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CategoryCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CategoryCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CategoryCreatedMessage setType(string $type = null)
 * @method Category getCategory()
 * @method CategoryCreatedMessage setCategory(Category $category = null)
 * @method int getVersion()
 * @method CategoryCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CategoryCreatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class CategoryCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'CategoryCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['category'] = [static::TYPE => Category::class];

        return $definitions;
    }
}
