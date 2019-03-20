<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#productrevertedstagedchanges-message
 * @method string getId()
 * @method ProductRevertedStagedChangesMessage setId(string $id = null)
 * @method int getVersion()
 * @method ProductRevertedStagedChangesMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductRevertedStagedChangesMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductRevertedStagedChangesMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ProductRevertedStagedChangesMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ProductRevertedStagedChangesMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ProductRevertedStagedChangesMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ProductRevertedStagedChangesMessage setType(string $type = null)
 * @method array getRemovedImageUrls()
 * @method ProductRevertedStagedChangesMessage setRemovedImageUrls(array $removedImageUrls = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ProductRevertedStagedChangesMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ProductRevertedStagedChangesMessage extends Message
{
    const MESSAGE_TYPE = 'ProductRevertedStagedChanges';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['removedImageUrls'] = [static::TYPE => 'array'];

        return $definitions;
    }
}
