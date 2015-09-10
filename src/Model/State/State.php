<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\State
 * @apidoc http://dev.sphere.io/http-api-projects-states.html#state
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
 * @method DateTimeDecorator getCreatedAt()
 * @method State setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method State setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method bool getBuiltIn()
 * @method State setBuiltIn(bool $builtIn = null)
 */
class State extends Resource
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
            'type' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'initial' => [static::TYPE => 'bool'],
            'builtIn' => [static::TYPE => 'bool'],
            'transitions' => [static::TYPE => '\Commercetools\Core\Model\State\StateReferenceCollection']
        ];
    }
}
