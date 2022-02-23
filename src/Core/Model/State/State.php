<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\State
 * @link https://docs.commercetools.com/http-api-projects-states.html#state
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
 * @method State setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method State setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method bool getBuiltIn()
 * @method State setBuiltIn(bool $builtIn = null)
 * @method array getRoles()
 * @method State setRoles(array $roles = null)
 * @method CreatedBy getCreatedBy()
 * @method State setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method State setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method StateReference getReference()
 */
class State extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'key' => [static::TYPE => 'string'],
            'type' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'initial' => [static::TYPE => 'bool'],
            'builtIn' => [static::TYPE => 'bool'],
            'roles' => [static::TYPE => 'array', static::OPTIONAL => true],
            'transitions' => [static::TYPE => StateReferenceCollection::class, static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }
}
