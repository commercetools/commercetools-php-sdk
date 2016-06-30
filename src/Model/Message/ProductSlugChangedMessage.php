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
 * @link https://dev.commercetools.com/http-api-projects-messages.html#productslugchanged-message
 * @method string getId()
 * @method ProductSlugChangedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductSlugChangedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ProductSlugChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductSlugChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductSlugChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductSlugChangedMessage setType(string $type = null)
 * @method LocalizedString getSlug()
 * @method ProductSlugChangedMessage setSlug(LocalizedString $slug = null)
 * @method int getVersion()
 * @method ProductSlugChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductSlugChangedMessage setLastModifiedAt(\DateTime $lastModifiedAt = null)
 */
class ProductSlugChangedMessage extends Message
{
    const MESSAGE_TYPE = 'ProductSlugChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['slug'] = [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'];

        return $definitions;
    }
}
