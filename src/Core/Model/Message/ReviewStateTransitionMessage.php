<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\State\StateReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#reviewstatetransition-message
 * @method string getId()
 * @method ReviewStateTransitionMessage setId(string $id = null)
 * @method int getVersion()
 * @method ReviewStateTransitionMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ReviewStateTransitionMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ReviewStateTransitionMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ReviewStateTransitionMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ReviewStateTransitionMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ReviewStateTransitionMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ReviewStateTransitionMessage setType(string $type = null)
 * @method StateReference getOldState()
 * @method ReviewStateTransitionMessage setOldState(StateReference $oldState = null)
 * @method StateReference getNewState()
 * @method ReviewStateTransitionMessage setNewState(StateReference $newState = null)
 * @method bool getOldIncludedInStatistics()
 * @method ReviewStateTransitionMessage setOldIncludedInStatistics(bool $oldIncludedInStatistics = null)
 * @method bool getNewIncludedInStatistics()
 * @method ReviewStateTransitionMessage setNewIncludedInStatistics(bool $newIncludedInStatistics = null)
 * @method Reference getTarget()
 * @method ReviewStateTransitionMessage setTarget(Reference $target = null)
 * @method bool getForce()
 * @method ReviewStateTransitionMessage setForce(bool $force = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ReviewStateTransitionMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ReviewStateTransitionMessage extends Message
{
    const MESSAGE_TYPE = 'ReviewStateTransition';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['oldState'] = [static::TYPE => StateReference::class];
        $definitions['newState'] = [static::TYPE => StateReference::class];
        $definitions['oldIncludedInStatistics'] = [static::TYPE => 'bool'];
        $definitions['newIncludedInStatistics'] = [static::TYPE => 'bool'];
        $definitions['target'] = [static::TYPE => Reference::class];
        $definitions['force'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
