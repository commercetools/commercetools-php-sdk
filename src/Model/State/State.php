<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\State;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class State
 * @package Sphere\Core\Model\State
 * @method string getId()
 * @method State setId(string $id = null)
 * @method int getVersion()
 * @method State setVersion(int $version = null)
 * @method string getKey()
 * @method State setKey(string $key = null)
 * @method string getType()
 * @method State setType(string $type = null)
 * @method LocalizedString getName()
 * @method State setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method State setDescription(LocalizedString $description = null)
 * @method bool getInitial()
 * @method State setInitial(bool $initial = null)
 * @method StateReferenceCollection getTransitions()
 * @method State setTransitions(StateReferenceCollection $transitions = null)
 */
class State extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'key' => [static::TYPE => 'string'],
            'type' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'initial' => [static::TYPE => 'bool'],
            'builtIn' => [static::TYPE => 'bool'],
            'transitions' => [static::TYPE => '\Sphere\Core\Model\State\StateReferenceCollection']
        ];
    }
}
