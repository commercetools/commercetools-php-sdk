<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\State;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class StateDraft
 * @package Sphere\Core\Model\State
 * @link http://dev.sphere.io/http-api-projects-states.html#create-state
 * @method string getKey()
 * @method StateDraft setKey(string $key = null)
 * @method string getType()
 * @method StateDraft setType(string $type = null)
 * @method LocalizedString getName()
 * @method StateDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method StateDraft setDescription(LocalizedString $description = null)
 * @method bool getInitial()
 * @method StateDraft setInitial(bool $initial = null)
 * @method StateReferenceCollection getTransitions()
 * @method StateDraft setTransitions(StateReferenceCollection $transitions = null)
 */
class StateDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'type' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'initial' => [static::TYPE => 'bool'],
            'transitions' => [static::TYPE => '\Sphere\Core\Model\State\StateReferenceCollection']
        ];
    }
}
