<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#category-slug-changed-message
 * @method string getId()
 * @method CategorySlugChangedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CategorySlugChangedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method CategorySlugChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CategorySlugChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CategorySlugChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CategorySlugChangedMessage setType(string $type = null)
 * @method LocalizedString getSlug()
 * @method CategorySlugChangedMessage setSlug(LocalizedString $slug = null)
 */
class CategorySlugChangedMessage extends Message
{
    const MESSAGE_TYPE = 'CategorySlugChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['slug'] = [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'];

        return $definitions;
    }
}
